<?php

namespace App\Services\Auth;

use External\Foo\Auth\AuthWS;
use External\Foo\Exceptions\AuthenticationFailedException;

class FooAuthService implements AuthServiceInterface {

    public string $authSystemName = 'authWS';

    private AuthWS $authWS;

    public function __construct(AuthWS $authWS) {

        $this->authWS = $authWS;
    }

    /**
     * @param string $login
     * @param string $password
     *
     * @return bool
     */
    public function authenticate (string $login, string $password): bool {

        try {
            $this->authWS->authenticate($login, $password);

            return true;

        } catch (AuthenticationFailedException $e) {

            return false;
        }
    }
}
