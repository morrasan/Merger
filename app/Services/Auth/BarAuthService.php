<?php

namespace App\Services\Auth;

use External\Bar\Auth\LoginService;

class BarAuthService implements AuthServiceInterface {

    public string $authSystemName = 'LoginService';

    private LoginService $loginService;

    public function __construct(LoginService $loginService) {

        $this->loginService = $loginService;
    }

    /**
     * @param string $login
     * @param string $password
     *
     * @return bool
     */
    public function authenticate (string $login, string $password): bool {

        return $this->loginService->login($login, $password);
    }
}
