<?php

namespace App\Responses;

abstract class AbstractResponse
{
    abstract public function statusCode(): int;
    abstract public function render(): mixed;
}
