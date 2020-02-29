<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = DB::table('users')->where('email','poula@pola.com')->first();
        if(!$users)
        {
            User::create([
                'name'=>'poula',
                'email'=>'poula@pola.com',
                'password'=>Hash::make('123456'),
                'role'=>'admin'
            ]);
        }
    }
}
