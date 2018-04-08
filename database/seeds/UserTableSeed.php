<?php

use Illuminate\Database\Seeder;

class UserTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = App\User::create([
            'name' => 'hassan',
            'email' => 'hassanjuniedi@gmail.com',
            'password' => bcrypt('123456'),
            'admin' => 1
        ]);

        App\Profile::create([
            'user_id' => $user->id,
            'avatar' => 'uploads/avatars/default.png',
            'about' => 'verr e wewwd dwdwe vgevre vervrevr ewewdwd dwewedew dewewdew',
            'facebook' => 'facebook.com',
            'twitter' => 'twitter.com',
        ]);
    }
}
