<?php

namespace App\Contracts;

interface FormBlock
{
    /** Get the validation rules */
    public function getRules(): array;

    /** Get the attribute translations */
    public function getAttributes(): array;

    /** Get the question shown on forms */
    public function getQuestion(): string;

    /** Get the answer from the form data */
    public function getAnswer(array $data): ?string;
}
