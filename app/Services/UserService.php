<?php

namespace App\Services;

use App\DTOs\UserDto;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserService
{
    public function __construct(public LinkService $linkService)
    {
    }

    public function create(UserDto $userDto): User
    {
        $user = new User();
        $user->username = $userDto->userName;
        $user->phonenumber = $userDto->phoneNumber;
        $user->save();

        Auth::login($user);

        $user->links = [$this->linkService->create($user)];
        return $user;
    }
}
