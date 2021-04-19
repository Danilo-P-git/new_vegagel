<?php

use Illuminate\Database\Seeder;
use App\User;

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
              "name" => "Massimo",
              "lastname" => "Admin",
              "date_of_birth" => "1994-02-17",
              "email" => "massimo.admin@kemedia.it",
              "indirizzo" => "via milazzo 98",
              "is_admin" => "1" ,
              "is_worker" => "0"
            ],
            [
              "name" => "Danilo",
              "lastname" => "Patané",
              "date_of_birth" => "1998-01-25",
              "email" => "d.admin@kemedia.com",
              "indirizzo" => "via ingegnere 92",
              "is_admin" => "1" ,
              "is_worker" => "0"
            ],
            
            [
              "name" => "Giuseppe",
              "lastname" => "admin",
              "date_of_birth" => "1998-12-21",
              "email" => "g.admin@kemedia.it",
              "indirizzo" => "via etnea 125",
              "is_admin" => "0" ,
              "is_worker" =>  "1"
            ],
            [
              "name" => "daniel",
              "lastname" => "admin",
              "date_of_birth" => "1983-06-23",
              "email" => "daniel.admin@kemedia.it",
              "indirizzo" => "via etnea 122",
              "is_admin" => "0" ,
              "is_worker" => "0"
            ],
            [
              "name" => "Andrea",
              "lastname" => "test",
              "date_of_birth" => "1989-05-19",
              "email" => "test.admin@kemedia.it",
              "indirizzo" => "via etnea 123",
              "is_admin" =>  "0",
              "is_worker" => "0"
            ]
          ];

          foreach($users as $user) {

            $newUser = new User;
            $newUser->name = $user["name"];
            $newUser->lastname = $user["lastname"];
            $newUser->date_of_birth = $user["date_of_birth"];
            $newUser->password = Hash::make('admin007');
            $newUser->indirizzo = $user["indirizzo"];
            $newUser->email = $user["email"];
            $newUser->is_admin = $user["is_admin"];
            $newUser->is_worker = $user["is_worker"];
            $newUser->save();
          }
    }
}
