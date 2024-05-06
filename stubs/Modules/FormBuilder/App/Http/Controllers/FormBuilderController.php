<?php

namespace App\Http\Controllers;

use App\Filament\Plugins\BlockModule;
use App\Http\Controllers\Controller;
use App\Http\Requests\FormBuilderRequest;
use App\Models\Form;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;

class FormBuilderController extends Controller
{
    public function __invoke(FormBuilderRequest $request, Form $form): RedirectResponse
    {
        $formData = [];

        foreach ($form->content as $blockContent) {
            $block = BlockModule::reconstructBlock($blockContent['type'], $blockContent['data']);
            $blockData = $request->get($block->id);

            $formData[$block->id] = [
                'question' => $block->getQuestion(),
                'answer' => $block->getAnswer($blockData),
            ];
        }

        $response = $form
            ->formResponses()
            ->create(['form_data' => $formData]);

        // TODO: Send mails

        Session::flash('form_success_' . $form->id);
        return redirect()->back();
    }
}
