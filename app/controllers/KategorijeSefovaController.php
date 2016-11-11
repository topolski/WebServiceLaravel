<?php

class KategorijeSefovaController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $kategorije = Kategorija::get();

        return Response::json(array(
            'nazivAkcije' => 'Pregled kategorija',
            'error'       => false,
            'kategorije'  => $kategorije->toArray()),
            200
        );
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return Response::json(array(
            'nazivAkcije' => 'Dodavanje nove kategorije',
            'error'       => false,
			'formaAndroid' => array(
			  'meta' 	  => array('type' => 'meta', 'name' => 'Kategorija'),
			  'naziv_kategorije'     => array('type' => 'string', 'id' => 'naziv_kategorije', 'default' => '', 'priority' => '0')
			),
            'schema'  => array('type' => 'object', 'title' => 'Kategorija', 'properties' => array(
                'naziv' => array('type' => 'string', 'id' => 'naziv', 'default' => '', 'title' => 'Naziv:', 'required' => true))),
            'form'  => array(
                array(
                    'key' => 'naziv',
                    'htmlClass' => 'form-group has-warning',
                    'fieldHtmlClass' => 'form-control',
                    'placeholder' => 'Naziv'
                ))
            ),
            200
        );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$nazivKategorije = Input::get('nazivKategorije');
        $poruka = "";
        $greska = false;
        if($nazivKategorije != null && $nazivKategorije != "")
        {
            if(Kategorija::insert(array('naziv' => $nazivKategorije, 'created_at' => new DateTime(), 'updated_at' => new DateTime())))
            {
                $poruka = 'Uspešno ste dodali novu kategoriju sa nazivom '.$nazivKategorije;
                $greska = false;
            }else
            {
                $poruka = 'Kategorija sa nazivom '.$nazivKategorije.' nije dodata u bazu.';
                $greska = true;
            }
        }else{
            $poruka = "Naziv kategorije mora imati neku vrednost!";
            $greska = true;
        }
        return Response::json(array(
                'nazivAkcije' => $poruka,
                'error'       => $greska),
            200
        );
	}

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws
     */
    public function show($id)
	{
        try{
            $kategorija = Kategorija::find($id);
            if($kategorija == null) throw Exception;
            $poruka = 'Pregled kategorije: '.$kategorija->naziv;
            $greska = false;
            $kategorija = $kategorija->toArray();
        }catch (Exception $e){
            $poruka = "Kategorija nije pronađena!";
            $greska = true;
        }

        return Response::json(array(
                'nazivAkcije' => $poruka,
                'error'       => $greska,
                'kategorije'  => $kategorija),
            200
        );
	}

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws
     */
    public function edit($id)
	{
        try{
            $kategorija = Kategorija::find($id);
            if($kategorija == null) throw Exception;
            return Response::json(array(
                    'nazivAkcije' => 'Izmena podataka kategorije',
                    'error'       => false,
                    'formaAndroid'		  => array(
                        'meta' 	  => array('type' => 'meta', 'name' => 'Kategorija'),
                        'naziv_kategorije'     => array('type' => 'string', 'id' => 'naziv_kategorije', 'default' => $kategorija["naziv"], 'priority' => '0')
                    ),
                    'schema'  => array('type' => 'object', 'title' => 'Kategorija', 'properties' => array(
                        'naziv' => array('type' => 'string', 'id' => 'naziv', 'default' => $kategorija["naziv"], 'title' => 'Naziv:', 'required' => true))),
                    'form'  => array(
                        array(
                            'key' => 'naziv',
                            'htmlClass' => 'form-group has-warning',
                            'fieldHtmlClass' => 'form-control',
                            'placeholder' => 'Naziv'
                        ))
                ),
                200
            );
        }catch (Exception $e){
            return Response::json(array(
                'nazivAkcije' => 'Kategorija nije pronađena',
                'error'       => true,
            ), 200);
        }
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $poruka = "";
        $greska = false;
		if(Kategorija::where('id', '=', $id)->update(array('naziv' => Input::get('nazivKategorije'), 'updated_at' => new DateTime())))
        {
            $poruka = "Uspešno ste izmenili podatke za kategoriju sa nazivom: ".Input::get('nazivKategorije');
            $greska = false;
        }else
        {
            $poruka = "Podaci o kategoriji koja ima naziv: ".Input::get('nazivKategorije')." nisu zamenjeni!";
            $greska = true;
        }
        return Response::json(array(
                'nazivAkcije' => $poruka,
                'error'       => $greska),
            200
        );
	}

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws
     */
    public function destroy($id)
	{
		try{
            $kategorija = Kategorija::find($id);
            if($kategorija == null) throw Exception;
            $poruka = "";
            $greska = false;
            if(Kategorija::destroy($id))
            {
                $poruka = "Uspešno ste obrisali kategoriju: ".$kategorija->naziv;
                $greska = false;
            }
        }catch (Exception $e){
            $poruka = "Došlo je do greške prilikom brisanja kategorije";
            $greska = true;
        }
        return Response::json(array(
                'nazivAkcije' => $poruka,
                'error'       => $greska),
            200
        );
	}
}
