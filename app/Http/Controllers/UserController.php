<?php

namespace App\Http\Controllers;

use App\DTOs\UserDto;
use App\Http\Requests\UserCreateRequest;
use App\Models\User;
use App\Services\UserService;

class UserController extends Controller
{
    public function register(UserCreateRequest $request, UserService $userService): User
    {
        $userDto = new UserDto(
            userName: $request->input('username'),
            phoneNumber: $request->input('phonenumber'),
        );

        return $userService->create($userDto);
    }
}
