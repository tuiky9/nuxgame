<?php

namespace App\DTOs;

readonly class UserDto
{
    public function __construct(
        public string $userName,
        public string $phoneNumber,
    ) {
    }
}
