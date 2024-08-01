<?php

declare(strict_types=1);

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Mail\Mailer;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Kirschbaum\PowerJoins\PowerJoins;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class MailLog extends Model
{
    use PowerJoins;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be encrypted.
     * Values are only encrypted when the config liberiser.mail.log.encrypted is set to `true`.
     *
     * @var array
     */
    protected $encryptable = [
        'message',
        'raw',
    ];

    /** @var array */
    protected $casts = [
        'data' => 'object',
        'purged' => 'boolean',
    ];

    /**
     * Helper method for storing a Swift_Message.
     *
     * @param array $raw
     * @param array $data
     *
     * @return static
     */
    public static function message(array $raw, array $data): self
    {
        /** @var Message $message */
        $message = $raw['message'];

        $original = array_key_exists('original_id', $raw) ? $raw['original_id'] : null;

        return static::create([
            'original_id' => $original,
            'message_id' => $message->getHeaders()->get('alternate-message-id')->getId(),
            'message' => $message->toString(), // Need this for rendering
            'raw' => $raw,
            'data' => $data,
        ]);
    }

    public function original(): BelongsTo
    {
        return $this->belongsTo(self::class);
    }

    /**
     * Serialize the raw message.
     *
     * @param array|string $value
     *
     * @return $this
     */
    public function setRawAttribute($value): self
    {
        $this->attributes['raw'] = serialize($value);

        return $this;
    }

    public function getUnserializedRaw(): array|null
    {
        return unserialize($this->raw);
    }

    /**
     * Get an attribute from the model.
     *
     * @param string|mixed $key
     *
     * @return mixed
     */
    public function getAttribute($key): mixed
    {
        $value = parent::getAttribute($key);

        if (config('liberiser.mail.log.encrypted') === true && in_array($key, $this->encryptable)) {
            $value = Crypt::decrypt($value);
        }

        return $value;
    }

    /** @return Message|null */
    public function getMessage(): ?Message
    {
        $raw = $this->getUnserializedRaw();
        if (! $raw || ! array_key_exists('message', $raw)) {
            return null;
        }

        return $raw['message'];
    }

    public function getFromAddressAttribute(): ?string
    {
        return $this->data->from_address;
    }

    public function getFromNameAttribute(): ?string
    {
        return $this->data->from_name;
    }

    public function getToAddressAttribute(): ?string
    {
        return $this->data->to_address;
    }

    public function getToNameAttribute(): ?string
    {
        return $this->data->to_name;
    }

    public function getSubjectAttribute(): ?string
    {
        return $this->data->subject;
    }

    public function getBodyAttribute(): ?string
    {
        if ($this->purged) {
            return $this->getRawOriginal('message');
        }

        try {
            if (strpos($this->message_id, '@swift.generated') !== false) {
                // Fix for old Swift mail messages: only display the body
                return optional($this->data)->body;
            }

            $message = $this->getMessage();

            if (is_null($message) || is_null($message->getSymfonyMessage())) {
                return null;
            }

            return $message->getHtmlBody();
        } catch (Exception $exception) {
            return  null;
        }
    }

    public function getStrippedBodyAttribute(): ?string
    {
        return $this->data->body;
    }

    /**
     * Set a given attribute on the model.
     *
     * @param string|mixed $key
     * @param mixed $value
     *
     * @return $this
     */
    public function setAttribute($key, $value): self
    {
        if (config('liberiser.mail.log.encrypted') === true && in_array($key, $this->encryptable)) {
            $value = Crypt::encrypt($value);
        }

        return parent::setAttribute($key, $value);
    }

    public function getDisplayNameAttribute(): string
    {
        return $this->message_id;
    }

    public function purge(): self
    {
        // Remove the body from data, only keep other meta data
        $data = $this->data;
        unset($data->body);

        // Store the body from raw as message
        $message = $this->body;

        if (! empty($message)) {
            // Minify the message and remove comments
            $search = [
                '/\>[^\S ]+/s',         // strip whitespaces after tags, except space
                '/[^\S ]+\</s',         // strip whitespaces before tags, except space
                '/(\s)+/s',             // shorten multiple whitespace sequences
                '/<!--(.|\s)*?-->/',    // Remove HTML comments
            ];

            $replace = [
                '>',
                '<',
                '\\1',
                '',
            ];

            $message = preg_replace($search, $replace, $message);
        } else {
            $message = '';
        }

        $this->update([
            'message' => $message,  // The rendered html is stored as message when purged
            'raw' => null,          // Raw is deleted
            'data' => $data,        // Update the data without the body
            'purged' => true,       // Mark as purged
        ]);

        return $this;
    }
}
