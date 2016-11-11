<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

	    $this->call('KategorijeSefovaTableSeeder');
        $this->call('SefoviTableSeeder');
        $this->call('UsersTableSeeder');
        $this->call('MenusTableSeeder');
	}

}
