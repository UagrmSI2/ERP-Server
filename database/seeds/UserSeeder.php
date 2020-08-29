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
        $usuario = new User();
        $usuario->email = "abc@gmail.com";
        $usuario->password = bcrypt("123");
        $usuario->employee_id = 1;
        $usuario->rol_id = 1;
        $usuario->save();
    }
}
