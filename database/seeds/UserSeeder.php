<?php

use Illuminate\Database\Seeder;

use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Bruce Brophy',
                'email' => 'bruce@brucebrophy.com',
                'email_verified_at' => now(),
                'password' => \Hash::make('password'),
            ],
        ];

        foreach ($users as $user) {
            $user = (object) $user;
            User::create([
                'name' => $user->name,
                'email' => $user->email,
                'email_verified_at' => $user->email_verified_at,
                'password' => $user->password,
            ]);
        }
    }
}
