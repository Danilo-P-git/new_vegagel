<?php

use App\Fornitori;
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
              // "date_of_birth" => "1994-02-17",
              "email" => "massimo.admin@kemedia.it",
              "indirizzo" => "via milazzo 98",
              "is_admin" => "1" ,
              "is_worker" => "0"
            ],
            [
              "name" => "Danilo",
              // "date_of_birth" => "1998-01-25",
              "email" => "d.admin@kemedia.com",
              "indirizzo" => "via ingegnere 92",
              "is_admin" => "1" ,
              "is_worker" => "0"
            ],
            
            [
              "name" => "Giuseppe",
              // "date_of_birth" => "1998-12-21",
              "email" => "g.admin@kemedia.it",
              "indirizzo" => "via etnea 125",
              "is_admin" => "0" ,
              "is_worker" =>  "1"
            ],
            [
              "name" => "daniel",
              // "date_of_birth" => "1983-06-23",
              "email" => "daniel.admin@kemedia.it",
              "indirizzo" => "via etnea 122",
              "is_admin" => "0" ,
              "is_worker" => "0"
            ],
            [
              "name" => "Andrea",
              // "date_of_birth" => "1989-05-19",
              "email" => "test.admin@kemedia.it",
              // "indirizzo" => "via etnea 123",
              "is_admin" =>  "0",
              "is_worker" => "0"
            ],
            [
              "name" => "Alessio",
              // "date_of_birth" => "1989-05-19",
              "email" => "alessioscionti@gmail.com",
              // "indirizzo" => "via etnea 123",
              "is_admin" =>  "1",
              "is_worker" => "0"
            ]
          ];

          foreach($users as $user) {

            $newUser = new User;
            $newUser->name = $user["name"];
            // $newUser->date_of_birth = $user["date_of_birth"];
            $newUser->password = Hash::make('admin007');
            // $newUser->indirizzo = $user["indirizzo"];
            $newUser->email = $user["email"];
            $newUser->is_admin = $user["is_admin"];
            $newUser->is_worker = $user["is_worker"];
            $newUser->save();
          }

          $fornitori= [
            [
              "name" => "Alessio",
              // "date_of_birth" => "1994-02-17",
              "email" => "alessioscionti@gmail.com",
              "indirizzo" => "via milazzo 98",
              "is_supplier" => "1" ,
            ],
          ];
          foreach ($fornitori as $user) {
            $newfornitori = new Fornitori;
            $newfornitori->name=$user["name"];
            $newfornitori->password = Hash::make('admin007');
            $newfornitori->email = $user["email"];
            $newfornitori->is_supplier = $user["is_supplier"];
            $newfornitori->save();
          }
    }
}
