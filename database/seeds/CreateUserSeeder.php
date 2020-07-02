<?php

use Illuminate\Database\Seeder;
use App\User;

class CreateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user = [
            [
               'name'=>'Muluh Godson',
               'email'=>'admin@schoolfaqs.store',
                'role'=>'1',
               'password'=> bcrypt('superadmin'),
            ],          
        ];
  
        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
