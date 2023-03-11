<?php

namespace App\Traits;
use Illuminate\Support\Str;

trait IdAsUuidTrait
{
    public function initializeIdAsUuidTrait(): void
    {
        $this->keyType = 'string';
        $this->id = Str::orderedUuid()->toString();
    }
}

?>