<?php

namespace Core\Auth\Payloads;

use Core\Auth\Enums\UserAccessEnum;

class UserPayload
{
    public $accesses = [];

    function __construct(
        public string $name,
        public string $email,
        private array $rawAccesses
    ) {
        $this->prepareAccesses();
    }

    private function prepareAccesses()
    {
        foreach ($this->rawAccesses as $access) {
            $this->accesses[] = UserAccessEnum::from($access);
        }
    }
}
