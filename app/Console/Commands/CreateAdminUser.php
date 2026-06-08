<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class CreateAdminUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $email = $this->ask('Enter admin email, default =>', config('admin.email'));
        $password = $this->secret('Password');

        $existingAdmin = User::where('is_admin', true)->first();

        if ($existingAdmin) {
            $this->warn("Admin already exists: {$existingAdmin->email}");

            if (! $this->confirm('Do you want to update this admin?')) {
                $this->info('Cancelled.');
                return self::SUCCESS;
            }

            $existingAdmin->update([
                'email' => $email,
                'password' => $password,
            ]);

            $this->info('Admin updated.');
            return self::SUCCESS;
        }

        User::create([
            'name' => 'admin',
            'email' => $email,
            'password' => $password,
            'is_admin' => true,
        ]);

        $this->info('Admin created.');

        return self::SUCCESS;
    }
}
