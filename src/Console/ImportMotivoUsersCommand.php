<?php

namespace RemiHin\FilamentPrefab\Console;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Psy\Readline\Hoa\ConsoleException;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Exception;

class ImportMotivoUsersCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'motivo:users:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import all users from Motivo';

    /**
     * @var string|null
     */
    public $token;

    /**
     * A static callback that allows the user to alter the role assignment.
     *
     * @var callable|mixed
     */
    public static $assignRoleCallback;

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->token = Config::get('services.motivo.api_key');

        if (!$this->token) {
            $this->error('MOTIVO_API_KEY not set');
            throw new ConsoleException('MOTIVO_API_KEY not set');
            return [];
        }

        $this->comment('Importing Motivo users');
        $this->line('');

        // Do a try catch so we can close gracefully
        try {
            $freshUsers = $this->getUsers();
        } catch (Exception $exception) {
            $this->error($exception->getMessage());

            return 0;
        }

        $this->comment('Updating existing users');
        $this->updateOrCreateUser($freshUsers);
        $this->info('Done updating users');
        $this->line('');

        $this->comment('Deleting old users');
        $this->deleteOldUsers($freshUsers);
        $this->info('Done deleting old users');
        $this->line('');

        $this->cacheUsers($freshUsers);

        $this->info('Done importing Motivo users');

        return 0;
    }

    protected function getUsers(): array
    {
        if (empty($this->token)) {
            $this->info('No API key set');
            return [];
        }

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->token,
        ])
            ->get('https://team-management.motivo-1.enrisezwolle.nl/api/users');

        if ($response->status() !== 200) {
            throw new Exception(sprintf('Error while fetching users %s', $response->body()));
        }

        return $response->json()['users'];
    }

    protected function cacheUsers($data): self
    {
        Storage::put('.motivo_users', Crypt::encrypt($data));

        return $this;
    }

    protected function getCachedUsers(): array
    {
        if (!Storage::exists('.motivo_users')) {
            return [];
        }

        try {
            return Crypt::decrypt(Storage::get('.motivo_users'));
        } catch (DecryptException $decryptionException) {
            $message = 'Failed to decrypt previous employee list.';

            // MACs mismatch in case app key changes (not exclusively, but it's common)
            if ($decryptionException->getMessage() === 'The MAC is invalid.') {
                $message = "{$message} Did the application rotate?";
            }

            // Always write the exception to the log, in case someone's not checking
            // pipeline or CLI output.
            Log::warning($message, ['exception' => $decryptionException]);
            $this->warn("{$message}: {$decryptionException->getMessage()}");

            // Throw exception if we're not on a local environment anyway
            if (!$this->getLaravel()->environment('local')) {
                throw $decryptionException;
            }

            return [];
        }
    }

    protected function updateOrCreateUser(array $freshUsers): void
    {
        foreach ($freshUsers as $user) {
            try {
                User::withoutEvents(function () use ($user) {
                    DB::transaction(function () use ($user) {
                        tap(User::updateOrCreate([
                            'email' => $user['email'],
                        ], [
                            'name'              => $user['name'],
                            'password'          => $user['password'],
                            'email_verified_at' => Carbon::now(),
                            'deleted_at'        => null,
                            'is_admin'          => true,
                        ]), function ($user) {
                            /** @var User $user */

                            $user->wasRecentlyCreated ?
                                $this->info("Created user for {$user->name} [{$user->email}]") :
                                $this->info("Updated user {$user->name} [{$user->email}]");
                        });
                    });
                });
            } catch (Exception $exception) {
                $this->error("Error while importing {$user['fullname']} [{$user['email']}]: " . $exception->getMessage());
            }
        }
    }

    protected function deleteOldUsers(array $freshUsers): void
    {
        $cachedUsers = $this->getCachedUsers();

        $freshUsersEmail = Arr::pluck($freshUsers, 'email');

        $inactive = collect($cachedUsers)->reject(function ($user) use ($freshUsersEmail) {
            return in_array($user['email'], $freshUsersEmail);
        });

        User::withoutEvents(fn () => User::whereIn('email', Arr::pluck($inactive, 'email'))->delete());

        foreach ($inactive as $user) {
            $this->info("Deleted user for {$user['fullname']}");
        }
    }
}
