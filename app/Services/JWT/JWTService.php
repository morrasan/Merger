<?php

namespace App\Services\JWT;

class JWTService {

    public static function generateToken (string $login, string $authSystemName) {

        // Assume that the generated token contains a login and a password
        return 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJsb2dpbiI6IkZPT18xIiwiY29udGV4dCI6IkZPTyIsImlhdCI6MTUxNjIzOTAyMn0.iOLIsd1TXyU53nrMGfjShXD7KSMz_lbaT256TQVYDz8';
    }
}
