<?php

namespace App\Services;

use App\Enums\LinkStatusEnum;
use App\Models\User;
use App\Models\UserLink;
use Illuminate\Support\Str;

class LinkService
{
    public function create(User $user): UserLink
    {
        $uuid = Str::uuid()->toString();
        return UserLink::create([
            'user_id' => $user->id,
            'uuid' => $uuid,
            'url' => url(sprintf("room/%s", $uuid)),
            'status' => LinkStatusEnum::active->name,
            'expired_at' => now()->addDays(7),
        ]);
    }

    public function delete(User $user, string $uuid): void
    {
        $user->links()->where('link', $uuid)->delete();
    }
}
