<?php
// tanaryo-cloud/shared/src/Services/JwtService.php
namespace TanaryoCloud\Shared\Services;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JwtService
{
    private string $secret;

    public function __construct(string $secret)
    {
        $this->secret = $secret;
    }

    public function generate(array $payload): string
    {
        return JWT::encode(
            array_merge($payload, [
                'iat' => time(),
                'exp' => time() + (60 * 60 * 24) // 24時間
            ]),
            $this->secret,
            'HS256'
        );
    }

    public function verify(string $token): array
    {
        return (array) JWT::decode($token, new Key($this->secret, 'HS256'));
    }
}
