<?php

namespace App\Services\Auth;

class AuthServiceSelector {

    private $fooAuthService;
    private $barAuthService;
    private $bazAuthService;

    public function __construct (FooAuthService  $fooAuthService, BarAuthService  $barAuthService, BazAuthService  $bazAuthService) {

        $this->fooAuthService = $fooAuthService;
        $this->barAuthService = $barAuthService;
        $this->bazAuthService = $bazAuthService;
    }

    public function select (string $login): BarAuthService|BazAuthService|FooAuthService {

        $prefix = substr($login, 0, 4);

        switch ($prefix) {

            case 'FOO_':
                return $this->fooAuthService;

            case 'BAR_':
                return $this->barAuthService;

            case 'BAZ_':
                return $this->bazAuthService;
        }

        throw new \Exception('Invalid login');
    }
}
