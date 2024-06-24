<?php
namespace App\Services;

use App\Models\HumanResources\User;

class MainService {

    public function authorize (User $user, string $autorization): bool
    {
        return $user;
    }
}