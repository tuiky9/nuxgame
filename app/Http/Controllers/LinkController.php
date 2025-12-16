<?php

namespace App\Http\Controllers;

use App\Services\LinkService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;

class LinkController extends Controller
{
    public function __construct(public LinkService $linkService)
    {
    }

    public function create()
    {
        if (!($user = Auth::user())) {
            throw new AuthorizationException('Only logged in users can create links.');
        }

        return $this->linkService->create($user);
    }

    public function delete(string $uuid)
    {
        if (!($user = Auth::user())) {
            throw new AuthorizationException('Only logged in users can delete links.');
        }

        return $this->linkService->delete($user, $uuid);
    }
}
