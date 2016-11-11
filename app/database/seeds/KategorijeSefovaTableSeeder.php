<?php


class KategorijeSefovaTableSeeder extends Seeder {

	public function run()
	{
        DB::table('kategorijesefova')->delete();

		Kategorija::create([
            'naziv' => 'Specijalni sefovi',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
		]);

        Kategorija::create([
            'naziv' => 'Kancelarijski (nameštaj) sefovi',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);

	}

}
