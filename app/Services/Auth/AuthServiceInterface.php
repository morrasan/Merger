<?php

namespace App\Services\Auth;

interface AuthServiceInterface {

    /**
     * @param string $login
     * @param string $password
     *
     * @return bool
     */
    public function authenticate(string $login, string $password): bool;
}
