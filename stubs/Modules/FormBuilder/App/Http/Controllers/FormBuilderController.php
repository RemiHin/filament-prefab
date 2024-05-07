<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\FormResponse;
use Illuminate\Support\Facades\Mail;
use App\Mail\FormBuilder\InformAdmin;
use App\Filament\Plugins\BlockModule;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\FormBuilderRequest;
use App\Mail\FormBuilder\InformRespondent;

class FormBuilderController extends Controller
{
    public function __invoke(FormBuilderRequest $request, Form $form): RedirectResponse
    {
        $formResponse = $this->createFormResponse($request, $form);

        $this->handleAdminNotification($form, $formResponse);
        $this->handleRespondentNotification($form, $formResponse);

        Session::flash('form_success_' . $form->id);
        return redirect()->back();
    }

    protected function createFormResponse(FormBuilderRequest $request, Form $form): FormResponse
    {
        $formData = [];

        foreach ($form->content as $blockContent) {
            $block = BlockModule::reconstructBlock($blockContent['type'], $blockContent['data']);
            $blockData = $request->get($block->id, []);
            $files = $request->file($block->id);

            if ($files) {
                $blockData = array_merge($blockData, $files);
            }

            $formData[$block->id] = [
                'question' => $block->getQuestion(),
                'answer' => $block->getAnswer($blockData),
            ];
        }

        return $form
            ->formResponses()
            ->create(['form_data' => $formData]);
    }

    protected function handleAdminNotification(Form $form, FormResponse $formResponse): void
    {
        if (! $form->inform_admin || ! $form->admin_name || ! $form->admin_email) {
            return;
        }

        Mail::to($form->admin_email, $form->admin_name)
            ->queue(new InformAdmin(
                $form->admin_email,
                $form->admin_name,
                $form->admin_message,
                url('/admin/form-responses') . '/' . $formResponse->id,
            ));
    }

    protected function handleRespondentNotification(Form $form, FormResponse $formResponse): void
    {
        if (! $form->inform_respondent || ! $formResponse->getRespondentName() || ! $formResponse->getRespondentEmail()) {
            return;
        }

        Mail::to($formResponse->getRespondentEmail(), $formResponse->getRespondentName())
            ->queue(new InformRespondent($formResponse->getRespondentEmail(), $formResponse->getRespondentName(), $form->respondent_message));
    }
}
