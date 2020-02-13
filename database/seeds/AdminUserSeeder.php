<?php

use Illuminate\Database\Seeder;
use App\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Abnish',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123456'),
        ],
            [
            'name' => 'Amit',
            'email' => 'administ@gmail.com',
            'password' => bcrypt('654321'),
        ],
        [
            'name' => 'Deepak',
            'email' => 'deepk@gmail.com',
            'password' => bcrypt('987654'),
        ],
      );
    }
}
