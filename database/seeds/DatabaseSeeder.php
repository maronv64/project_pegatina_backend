<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /*
        public function run()
        {
            DB::table('users')->insert([
                'name' => Str::random(10),
                'email' => Str::random(10).'@gmail.com',
                'password' => Hash::make('password'),
            ]);
        }
        */
        $ignorar = array("/", ".", "$");
        // $this->call(UserSeeder::class);
        DB::table('users')->insert([
            'nome_token' => str_replace($ignorar,"",bcrypt(Str::random(10))),
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('adminadmin'),
            'password2' => 'adminadmin',
        ]);
    }
}
