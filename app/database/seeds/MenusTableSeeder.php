<?php



class MenusTableSeeder extends Seeder {

	public function run()
	{
        DB::table('menu')->delete();

        Menu::create([
            'naziv' => 'Dodaj kategoriju sefova',
            'putanja' => '/kategorije/create',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);

        Menu::create([
            'naziv' => 'Administriraj kategorije',
            'putanja' => '/kategorije',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);

        Menu::create([
            'naziv' => 'Dodaj sef',
            'putanja' => '/sefovi/create',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);

        Menu::create([
            'naziv' => 'Administriraj sefove',
            'putanja' => '/sefovi',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);
	}
}
