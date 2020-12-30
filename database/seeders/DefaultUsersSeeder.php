<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class DefaultUsersSeeder extends Seeder
{
    protected $data = [
        ['name' => 'Admin User', 'email' => 'admin@example.com', 'password' => 'password'],
        ['name' => 'Guest User', 'email' => 'subscriber@example.com', 'password' => 'password'],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->data as $user_data) {
            $user = User::whereEmail($user_data['email'])->first();

            if (!$user) {
                $user = new User($user_data);
            }

            $user->email = $user_data['email'];
            $user->password = $user_data['password'];

            $user->remember_token = Str::random(10);

            // save and verify
            $user->markEmailAsVerified();
        }
    }
}
