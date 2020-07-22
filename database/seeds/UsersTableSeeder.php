<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user1 = App\User::create([
            'name' => 'Administrator',
            'password' => bcrypt('admin@test.com'),
            'email' => 'admin@test.com',
            'about' => 'Tell the world something about yourself.',
            'role' => 'admin',
        ]);
        App\Profile::create([
            'user_id' => $user1->id,
            'about' => 'Tell the world something about yourself.',
            'avatar' => '/avatars/avatarAdmin.png',
            'facebook' => 'facebook.com',
            'youtube' => 'youtube.com',
        ]);

        $user2 = App\User::create([
            'name' => 'Emily Meyers',
            'password' => bcrypt('emily@test.com'),
            'email' => 'emily@test.com',
            'about' => 'Tell the world something about yourself.',
        ]);
        App\Profile::create([
            'user_id' => $user2->id,
            'about' => 'Tell the world something about yourself.',
            'avatar' => '/avatars/avatarEmily.png',
            'facebook' => 'facebook.com',
            'youtube' => 'youtube.com',
        ]);
    }
}
