<?php

namespace App;

use Exception;

enum RoleEnum
{
    case ARMA_MEMBER;
    case ARMA_RECRUIT;

    public function id(): string
    {
        return match ($this) {
            RoleEnum::ARMA_MEMBER => config('services.discord.arma_recruit_role'),
            RoleEnum::ARMA_RECRUIT => config('services.discord.arma_member_role'),
            default => throw new Exception("RoleId not found"),
        };
    }
}
