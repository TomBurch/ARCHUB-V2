<?php

namespace App;

use Exception;

enum RoleEnum
{
    case ARMA_MEMBER;
    case ARMA_RECRUIT;
    case TESTER;
    case SENIOR_TESTER;
    case STAFF;
    case OPERATIONS;

    public function id(): string
    {
        return match ($this) {
            RoleEnum::ARMA_MEMBER => config('services.discord.arma_recruit_role'),
            RoleEnum::ARMA_RECRUIT => config('services.discord.arma_member_role'),
            RoleEnum::TESTER => config('services.discord.tester_role'),
            RoleEnum::SENIOR_TESTER => config('services.discord.senior_tester_role'),
            RoleEnum::STAFF => config('services.discord.staff_role'),
            RoleEnum::OPERATIONS => config('services.discord.operations_role'),
            default => throw new Exception("RoleId not found"),
        };
    }
}
