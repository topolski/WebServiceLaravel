<?php


class UsersTableSeeder extends Seeder {

	public function run()
	{
        DB::table('users')->delete();

	    User::create([
            'email' => 'tope1991@gmail.com',
            'password' => Hash::make('admin'),
            'activated' => true,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            'last_name' => 'Topolski',
            'first_name' => 'Milanko'
		]);
    }


}
