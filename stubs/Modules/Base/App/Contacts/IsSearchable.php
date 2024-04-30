<?php

namespace App\Contacts;

interface IsSearchable
{
    public function getName(): string;

    public function getRoute(): string;

    public static function getResourceName(): string;
}
