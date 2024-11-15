<?php
// services/auth-service/app/Console/Commands/GenerateJwtSecret.php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenerateJwtSecret extends Command
{
    protected $signature = 'jwt:secret';
    protected $description = 'Generate a new JWT secret key';

    public function handle()
    {
        $secret = base64_encode(random_bytes(32));

        $this->info('JWT secret generated successfully!');
        $this->line('Add this to your .env file:');
        $this->line('JWT_SECRET=' . $secret);

        if ($this->confirm('Would you like to automatically update your .env file?')) {
            $this->updateEnvFile($secret);
        }

        return Command::SUCCESS;
    }

    protected function updateEnvFile($secret)
    {
        $path = base_path('.env');

        if (file_exists($path)) {
            $content = file_get_contents($path);

            if (strpos($content, 'JWT_SECRET=') !== false) {
                $content = preg_replace(
                    '/JWT_SECRET=.*/',
                    'JWT_SECRET=' . $secret,
                    $content
                );
            } else {
                $content .= "\nJWT_SECRET=" . $secret;
            }

            file_put_contents($path, $content);
            $this->info('.env file updated successfully!');
        } else {
            $this->error('.env file not found!');
        }
    }
}
