<?php

namespace App\Services\Auth;

use External\Baz\Auth\Authenticator;

class BazAuthService implements AuthServiceInterface {

    public string $authSystemName = 'Authenticator';

    private Authenticator $authenticator;

    public function __construct(Authenticator $authenticator) {

        $this->authenticator = $authenticator;
    }

    /**
     * @param string $login
     * @param string $password
     *
     * @return bool
     */
    public function authenticate (string $login, string $password): bool {

        $authResult = $this->authenticator->auth($login, $password);

        if (str_contains(get_class($authResult), 'Success')) {

            return true;
        }
        return false;
    }
}
