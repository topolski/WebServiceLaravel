<?php

class SefoviController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /sefovi
	 *
	 * @return Response
	 */

	public function index()
	{
        $sefovi = Sef::with('kategorija')->get();

        return Response::json(array(
                'nazivAkcije' => 'Pregled sefova',
                'error'       => false,
                'sefovi'  => $sefovi->toArray()),
            200
        );
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /sefovi/create
	 *
	 * @return Response
	 */
	public function create()
	{
        $kategorije = Kategorija::get(array('id', 'naziv'));
		$kat = '{ "0" : "Izaberite kategoriju..."';
        $katID = array(0);
		foreach($kategorije as $kategorija){
			$id = $kategorija["id"];
			$naziv = $kategorija["naziv"];
			
			$kat .= ", " . "\"$id\"" . ":" . "\"$naziv\"";
            $katID[] = $id;
		}
		$kat .= "}";
		$nizKategorija = json_decode($kat);
		
		return Response::json(array(
                'nazivAkcije' => 'Kreiranje novog sefa',
                'error'       => false,
				'formaAndroid'		  => array(
				'meta' 		  => array('type' => 'meta', 'name' => 'Sef'),
				'naziv'       => array('type' => 'string', 'id' => 'naziv', 'default' => '', 'priority' => '0'),
				'opis'		  => array('type' => 'string', 'id' => 'opis', 'default' => '', 'priority' => '1'),
				'cena'		  => array('type' => 'integer', 'id' => 'cena', 'default' => '', 'priority' => '2', 'hint' => 'cena u €'),
				'kategorija'  => array('type' => 'integer', 'id' => 'idKategorija', 'default' => '0', 'priority' => '3', 'options' => $nizKategorija),
				'boja'        => array('type' => 'string', 'id' => 'boja', 'default' => '', 'priority' => '4'),
				'brava'		  => array('type' => 'string', 'id' => 'brava', 'default' => '', 'priority' => '5'),
				'unutrašnja_brava' => array('type' => 'string', 'id' => 'ubrava', 'default' => '', 'priority' => '6'),
				'zabravljivanje' => array('type' => 'string', 'id' => 'zabravljivanje', 'default' => '', 'priority' => '7'),
				'tip'		  => array('type' => 'string', 'id' => 'tip', 'default' => '', 'priority' => '8'),
				'spoljašnja_visina' => array('type' => 'integer', 'id' => 'sv', 'default' => '', 'priority' => '9', 'hint' => 'u mm'),
				'spoljašnja_širina' => array('type' => 'integer', 'id' => 'ss', 'default' => '', 'priority' => '10', 'hint' => 'u mm'),
				'spoljašnja_dubina' => array('type' => 'integer', 'id' => 'sd', 'default' => '', 'priority' => '11', 'hint' => 'u mm'),
				'unutrašnja_visina' => array('type' => 'integer', 'id' => 'uv', 'default' => '', 'priority' => '12', 'hint' => 'u mm'),
				'unutrašnja_širina' => array('type' => 'integer', 'id' => 'us', 'default' => '', 'priority' => '13', 'hint' => 'u mm'),
				'unutrašnja_dubina' => array('type' => 'integer', 'id' => 'ud', 'default' => '', 'priority' => '14', 'hint' => 'u mm'),
				'police' 	  => array('type' => 'integer', 'id' => 'police', 'default' => '', 'priority' => '15'),
				'težina' 	  => array('type' => 'integer', 'id' => 'tezina', 'default' => '', 'priority' => '16', 'hint' => 'u kg'),
				'zapremina'   => array('type' => 'integer', 'id' => 'zapremina', 'default' => '', 'priority' => '17', 'hint' => 'u mm3')
				),
                'schema'  => array('type' => 'object', 'title' => 'Sef', 'properties' => array(
                        'naziv'       => array('type' => 'string', 'id' => 'naziv', 'default' => '', 'title' => 'Naziv:', 'required' => true),
                        'opis'		  => array('type' => 'string', 'id' => 'opis', 'default' => '', 'title' => 'Opis:'),
                        'cena'		  => array('type' => 'integer', 'id' => 'cena', 'default' => '', 'title' => 'Cena:', 'required' => true),
                        'idKategorija'  => array('type' => 'string', 'id' => 'idKategorija', 'default' => '0', 'title' => 'Kategorija:', 'enum' => $katID),
                        'boja'        => array('type' => 'string', 'id' => 'boja', 'default' => '', 'title' => 'Boja:'),
                        'brava'		  => array('type' => 'string', 'id' => 'brava', 'default' => '', 'title' => 'Brava:'),
                        'ubrava' => array('type' => 'string', 'id' => 'ubrava', 'default' => '', 'title' => 'Unutrašnja brava:'),
                        'zabravljivanje' => array('type' => 'string', 'id' => 'zabravljivanje', 'default' => '', 'title' => 'Zabravljivanje:'),
                        'tip'		  => array('type' => 'string', 'id' => 'tip', 'default' => '', 'title' => 'Tip:'),
                        'sv' => array('type' => 'integer', 'id' => 'sv', 'default' => '', 'title' => 'Spoljašnja visina:', 'required' => true),
                        'ss' => array('type' => 'integer', 'id' => 'ss', 'default' => '', 'title' => 'Spoljašnja širina:', 'required' => true),
                        'sd' => array('type' => 'integer', 'id' => 'sd', 'default' => '', 'title' => 'Spoljašnja dubina:', 'required' => true),
                        'uv' => array('type' => 'integer', 'id' => 'uv', 'default' => '', 'title' => 'Unutrašnja visina:'),
                        'us' => array('type' => 'integer', 'id' => 'us', 'default' => '', 'title' => 'Unutrašnja širina:'),
                        'ud' => array('type' => 'integer', 'id' => 'ud', 'default' => '', 'title' => 'Unutrašnja dubina:'),
                        'police' 	  => array('type' => 'integer', 'id' => 'police', 'default' => '', 'title' => 'Police:'),
                        'tezina' 	  => array('type' => 'integer', 'id' => 'tezina', 'default' => '', 'title' => 'Težina:', 'required' => true),
                        'zapremina'   => array('type' => 'integer', 'id' => 'zapremina', 'default' => '', 'title' => 'Zapremina:'))),
                'form'  => array(
                        array(
                            'key' => 'naziv',
                            'htmlClass' => 'form-group has-warning',
                            'fieldHtmlClass' => 'form-control',
                            'placeholder' => 'Naziv'
                        ),
                        array(
                            'key' => 'opis',
                            'type' => 'textarea',
                            'htmlClass' => 'form-group',
                            'fieldHtmlClass' => 'form-control',
                            'placeholder' => 'Opis'
                        ),
                        array(
                            'key' => 'cena',
                            'htmlClass' => 'form-group has-warning',
                            'fieldHtmlClass' => 'form-control',
                            'placeholder' => 'Cena u €'
                        ),
                        array(
                          'key' => 'idKategorija',
                          'htmlClass' => 'form-group has-warning',
                          'fieldHtmlClass' => 'form-control',
                          'titleMap' => $nizKategorija
                        ),
                        array(
                            'key' => 'boja',
                            'htmlClass' => 'form-group',
                            'fieldHtmlClass' => 'form-control',
                            'placeholder' => 'Boja'
                        ),
                        array(
                            'key' => 'brava',
                            'htmlClass' => 'form-group',
                            'fieldHtmlClass' => 'form-control',
                            'placeholder' => 'Brava'
                        ),
                        array(
                            'key' => 'ubrava',
                            'htmlClass' => 'form-group',
                            'fieldHtmlClass' => 'form-control',
                            'placeholder' => 'Unutrašnja brava'
                        ),
                        array(
                            'key' => 'zabravljivanje',
                            'htmlClass' => 'form-group',
                            'fieldHtmlClass' => 'form-control',
                            'placeholder' => 'Zabravljivanje'
                        ),
                        array(
                            'key' => 'tip',
                            'htmlClass' => 'form-group',
                            'fieldHtmlClass' => 'form-control',
                            'placeholder' => 'Tip'
                        ),
                        array(
                            'key' => 'sv',
                            'htmlClass' => 'form-group has-warning',
                            'fieldHtmlClass' => 'form-control',
                            'placeholder' => 'Spoljašnja visina (u mm)'
                        ),
                        array(
                            'key' => 'ss',
                            'htmlClass' => 'form-group has-warning',
                            'fieldHtmlClass' => 'form-control',
                            'placeholder' => 'Spoljašnja širina (u mm)'
                        ),
                        array(
                            'key' => 'sd',
                            'htmlClass' => 'form-group has-warning',
                            'fieldHtmlClass' => 'form-control',
                            'placeholder' => 'Spoljašnja dubina (u mm)'
                        ),
                        array(
                            'key' => 'uv',
                            'htmlClass' => 'form-group',
                            'fieldHtmlClass' => 'form-control',
                            'placeholder' => 'Unutrašnja visina (u mm)'
                        ),
                        array(
                            'key' => 'us',
                            'htmlClass' => 'form-group',
                            'fieldHtmlClass' => 'form-control',
                            'placeholder' => 'Unutrašnja širina (u mm)'
                        ),
                        array(
                            'key' => 'ud',
                            'htmlClass' => 'form-group',
                            'fieldHtmlClass' => 'form-control',
                            'placeholder' => 'Unutrašnja dubina (u mm)'
                        ),
                        array(
                            'key' => 'police',
                            'htmlClass' => 'form-group',
                            'fieldHtmlClass' => 'form-control',
                            'placeholder' => 'Police'
                        ),
                        array(
                            'key' => 'tezina',
                            'htmlClass' => 'form-group has-warning',
                            'fieldHtmlClass' => 'form-control',
                            'placeholder' => 'Težina (u kg)'
                        ),
                        array(
                            'key' => 'zapremina',
                            'htmlClass' => 'form-group',
                            'fieldHtmlClass' => 'form-control',
                            'placeholder' => 'Zapremina (u mm3)'
                        ),
                    )
                ),
            200
        );
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /sefovi
	 *
	 * @return Response
	 */
	public function store()
	{
        $naziv = Input::get('naziv');
        $opis = Input::get('opis');
        $slika = Input::get('slika');
        $cena = Input::get('cena');
        $mimeType = Input::get('mimeType');
        $idKategorija = Input::get('idKategorija');
        $boja = Input::get('boja');
        $brava = Input::get('brava');
        $ubrava = Input::get('ubrava');
        $zabravljivanje = Input::get('zabravljivanje');
        $tip = Input::get('tip');
        $sv = Input::get('sv');
        $ss = Input::get('ss');
        $sd = Input::get('sd');
        $uv = Input::get('uv');
        $us = Input::get('us');
        $ud = Input::get('ud');
        $police = Input::get('police');
        $tezina = Input::get('tezina');
        $zapremina = Input::get('zapremina');
        $poruka = "";
        $greska = false;
        if($naziv != null && $naziv != "" && $slika != "" && $cena != null && $cena != "" && $idKategorija != null && $idKategorija != "0" && $sv != null && $sv != "" && $ss != null && $ss != "" && $sd != null && $sd != "" && $tezina != null && $tezina != "")
        {
            if(Sef::insert(array('naziv' => $naziv, 'opis' => $opis, 'mimeType' => $mimeType, 'slika' => $slika, 'cena' => $cena, 'idKategorija' => $idKategorija, 'boja' => $boja, 'brava' => $brava, 'ubrava' => $ubrava, 'zabravljivanje' => $zabravljivanje,'tip' => $tip, 'sv' => $sv, 'ss' => $ss, 'sd' => $sd, 'uv' => $uv, 'us' => $us, 'ud' => $ud, 'police' => $police, 'tezina' => $tezina, 'zapremina' => $zapremina, 'created_at' => new DateTime(), 'updated_at' => new DateTime())))
            {
                $poruka = 'Uspešno ste dodali novi sef sa nazivom '.$naziv;
                $greska = false;
            }else
            {
                $poruka = 'Sef sa nazivom '.$naziv.' nije dodata u bazu.';
                $greska = true;
            }
        }else{
            $poruka = "Podaci za sef nisu dobro popunjeni!";
            $greska = true;
        }
        return Response::json(array(
                'nazivAkcije' => $poruka,
                'error'       => $greska),
            200
        );
	}

	/**
	 * Display the specified resource.
	 * GET /sefovi/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        try
        {
            $sefovi = Sef::with('kategorija')->find($id);
            $poruka = 'Pregled sefa ' . $sefovi->naziv;
            $greska = false;
            $sefovi = $sefovi->toArray();
        }catch(Exception $e)
        {
            $poruka = 'Sef nije pronađen!';
            $greska = true;
        }

        return Response::json(array(
                'nazivAkcije' => $poruka,
                'error'       => $greska,
                'sefovi'  => $sefovi),
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
            $sef = Sef::find($id);
            if($sef == null) throw Exception;
            $kategorije = Kategorija::get(array('id', 'naziv'));
            $kat = '{ "0" : "Izaberite kategoriju..."';
            $katID = array(0);
            foreach($kategorije as $kategorija){
                $id = $kategorija["id"];
                $naziv = $kategorija["naziv"];

                $kat .= ", " . "\"$id\"" . ":" . "\"$naziv\"";
                $katID[] = $id;
            }
            $kat .= "}";
            $nizKategorija = json_decode($kat);
            return Response::json(array(
                    'nazivAkcije' => 'Izmena podataka za sef',
                    'error'       => false,
                    'formaAndroid' => array(
                        'meta' 		  => array('type' => 'meta', 'name' => 'Sef'),
                        'naziv'       => array('type' => 'string', 'id' => 'naziv', 'default' => $sef["naziv"], 'priority' => '0'),
                        'opis'		  => array('type' => 'string', 'id' => 'opis', 'default' => $sef["opis"], 'priority' => '1'),
                        'cena'		  => array('type' => 'integer', 'id' => 'cena', 'default' => $sef["cena"], 'priority' => '2', 'hint' => 'cena u €'),
                        'kategorija'  => array('type' => 'integer', 'id' => 'idKategorija', 'default' => $sef["idKategorija"], 'priority' => '3', 'options' => $nizKategorija),
                        'boja'        => array('type' => 'string', 'id' => 'boja', 'default' => $sef["boja"], 'priority' => '4'),
                        'brava'		  => array('type' => 'string', 'id' => 'brava', 'default' => $sef["brava"], 'priority' => '5'),
                        'unutrašnja_brava' => array('type' => 'string', 'id' => 'ubrava', 'default' => $sef["ubrava"], 'priority' => '6'),
                        'zabravljivanje' => array('type' => 'string', 'id' => 'zabravljivanje', 'default' => $sef["zabravljivanje"], 'priority' => '7'),
                        'tip'		  => array('type' => 'string', 'id' => 'tip', 'default' => $sef["tip"], 'priority' => '8'),
                        'spoljašnja_visina' => array('type' => 'integer', 'id' => 'sv', 'default' => $sef["sv"], 'priority' => '9', 'hint' => 'u mm'),
                        'spoljašnja_širina' => array('type' => 'integer', 'id' => 'ss', 'default' => $sef["ss"], 'priority' => '10', 'hint' => 'u mm'),
                        'spoljašnja_dubina' => array('type' => 'integer', 'id' => 'sd', 'default' => $sef["sd"], 'priority' => '11', 'hint' => 'u mm'),
                        'unutrašnja_visina' => array('type' => 'integer', 'id' => 'uv', 'default' => $sef["uv"], 'priority' => '12', 'hint' => 'u mm'),
                        'unutrašnja_širina' => array('type' => 'integer', 'id' => 'us', 'default' => $sef["us"], 'priority' => '13', 'hint' => 'u mm'),
                        'unutrašnja_dubina' => array('type' => 'integer', 'id' => 'ud', 'default' => $sef["ud"], 'priority' => '14', 'hint' => 'u mm'),
                        'police' 	  => array('type' => 'integer', 'id' => 'police', 'default' => $sef["police"], 'priority' => '15'),
                        'težina' 	  => array('type' => 'integer', 'id' => 'tezina', 'default' => $sef["tezina"], 'priority' => '16', 'hint' => 'u kg'),
                        'zapremina'   => array('type' => 'integer', 'id' => 'zapremina', 'default' => $sef["zapremina"], 'priority' => '17', 'hint' => 'u mm3')
                    ),
                    'schema'  => array('type' => 'object', 'title' => 'Sef', 'properties' => array(
                        'naziv'       => array('type' => 'string', 'id' => 'naziv', 'default' => $sef["naziv"], 'title' => 'Naziv:', 'required' => true),
                        'opis'		  => array('type' => 'string', 'id' => 'opis', 'default' => $sef["opis"], 'title' => 'Opis:'),
                        'cena'		  => array('type' => 'integer', 'id' => 'cena', 'default' => $sef["cena"], 'title' => 'Cena:', 'required' => true),
                        'idKategorija'  => array('type' => 'string', 'id' => 'idKategorija', 'default' => $sef["idKategorija"], 'title' => 'Kategorija:', 'enum' => $katID),
                        'boja'        => array('type' => 'string', 'id' => 'boja', 'default' => $sef["boja"], 'title' => 'Boja:'),
                        'brava'		  => array('type' => 'string', 'id' => 'brava', 'default' => $sef["brava"], 'title' => 'Brava:'),
                        'ubrava' => array('type' => 'string', 'id' => 'ubrava', 'default' => $sef["ubrava"], 'title' => 'Unutrašnja brava:'),
                        'zabravljivanje' => array('type' => 'string', 'id' => 'zabravljivanje', 'default' => $sef["zabravljivanje"], 'title' => 'Zabravljivanje:'),
                        'tip'		  => array('type' => 'string', 'id' => 'tip', 'default' => $sef["tip"], 'title' => 'Tip:'),
                        'sv' => array('type' => 'integer', 'id' => 'sv', 'default' => $sef["sv"], 'title' => 'Spoljašnja visina:', 'required' => true),
                        'ss' => array('type' => 'integer', 'id' => 'ss', 'default' => $sef["ss"], 'title' => 'Spoljašnja širina:', 'required' => true),
                        'sd' => array('type' => 'integer', 'id' => 'sd', 'default' => $sef["sd"], 'title' => 'Spoljašnja dubina:', 'required' => true),
                        'uv' => array('type' => 'integer', 'id' => 'uv', 'default' => $sef["uv"], 'title' => 'Unutrašnja visina:'),
                        'us' => array('type' => 'integer', 'id' => 'us', 'default' => $sef["us"], 'title' => 'Unutrašnja širina:'),
                        'ud' => array('type' => 'integer', 'id' => 'ud', 'default' => $sef["ud"], 'title' => 'Unutrašnja dubina:'),
                        'police' 	  => array('type' => 'integer', 'id' => 'police', 'default' => $sef["police"], 'title' => 'Police:'),
                        'tezina' 	  => array('type' => 'integer', 'id' => 'tezina', 'default' => $sef["tezina"], 'title' => 'Težina:', 'required' => true),
                        'zapremina'   => array('type' => 'integer', 'id' => 'zapremina', 'default' => $sef["zapremina"], 'title' => 'Zapremina:'))),
                    'form'  => array(
                        array(
                            'key' => 'naziv',
                            'htmlClass' => 'form-group has-warning',
                            'fieldHtmlClass' => 'form-control',
                            'placeholder' => 'Naziv'
                        ),
                        array(
                            'key' => 'opis',
                            'type' => 'textarea',
                            'htmlClass' => 'form-group',
                            'fieldHtmlClass' => 'form-control',
                            'placeholder' => 'Opis'
                        ),
                        array(
                            'key' => 'cena',
                            'htmlClass' => 'form-group has-warning',
                            'fieldHtmlClass' => 'form-control',
                            'placeholder' => 'Cena u €'
                        ),
                        array(
                            'key' => 'idKategorija',
                            'htmlClass' => 'form-group has-warning',
                            'fieldHtmlClass' => 'form-control',
                            'titleMap' => $nizKategorija
                        ),
                        array(
                            'key' => 'boja',
                            'htmlClass' => 'form-group',
                            'fieldHtmlClass' => 'form-control',
                            'placeholder' => 'Boja'
                        ),
                        array(
                            'key' => 'brava',
                            'htmlClass' => 'form-group',
                            'fieldHtmlClass' => 'form-control',
                            'placeholder' => 'Brava'
                        ),
                        array(
                            'key' => 'ubrava',
                            'htmlClass' => 'form-group',
                            'fieldHtmlClass' => 'form-control',
                            'placeholder' => 'Unutrašnja brava'
                        ),
                        array(
                            'key' => 'zabravljivanje',
                            'htmlClass' => 'form-group',
                            'fieldHtmlClass' => 'form-control',
                            'placeholder' => 'Zabravljivanje'
                        ),
                        array(
                            'key' => 'tip',
                            'htmlClass' => 'form-group',
                            'fieldHtmlClass' => 'form-control',
                            'placeholder' => 'Tip'
                        ),
                        array(
                            'key' => 'sv',
                            'htmlClass' => 'form-group has-warning',
                            'fieldHtmlClass' => 'form-control',
                            'placeholder' => 'Spoljašnja visina (u mm)'
                        ),
                        array(
                            'key' => 'ss',
                            'htmlClass' => 'form-group has-warning',
                            'fieldHtmlClass' => 'form-control',
                            'placeholder' => 'Spoljašnja širina (u mm)'
                        ),
                        array(
                            'key' => 'sd',
                            'htmlClass' => 'form-group has-warning',
                            'fieldHtmlClass' => 'form-control',
                            'placeholder' => 'Spoljašnja dubina (u mm)'
                        ),
                        array(
                            'key' => 'uv',
                            'htmlClass' => 'form-group',
                            'fieldHtmlClass' => 'form-control',
                            'placeholder' => 'Unutrašnja visina (u mm)'
                        ),
                        array(
                            'key' => 'us',
                            'htmlClass' => 'form-group',
                            'fieldHtmlClass' => 'form-control',
                            'placeholder' => 'Unutrašnja širina (u mm)'
                        ),
                        array(
                            'key' => 'ud',
                            'htmlClass' => 'form-group',
                            'fieldHtmlClass' => 'form-control',
                            'placeholder' => 'Unutrašnja dubina (u mm)'
                        ),
                        array(
                            'key' => 'police',
                            'htmlClass' => 'form-group',
                            'fieldHtmlClass' => 'form-control',
                            'placeholder' => 'Police'
                        ),
                        array(
                            'key' => 'tezina',
                            'htmlClass' => 'form-group has-warning',
                            'fieldHtmlClass' => 'form-control',
                            'placeholder' => 'Težina (u kg)'
                        ),
                        array(
                            'key' => 'zapremina',
                            'htmlClass' => 'form-group',
                            'fieldHtmlClass' => 'form-control',
                            'placeholder' => 'Zapremina (u mm3)'
                        ),
                    )
                ),
                200
            );
        }catch (Exception $e)
        {
            return Response::json(array(
                    'nazivAkcije' => 'Sef nije pronađen!',
                    'error'       => true),
                200
            );
        }
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /sefovi/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $pslika = Sef::find($id, array('slika', 'mimeType'));
        $slika = $pslika['slika'];
        $mimeType = $pslika['mimeType'];
        if(Input::get('slika') != null && Input::get('mimeType') != null)
        {
            $slika = Input::get('slika');
            $mimeType = Input::get('mimeType');
        }
        $naziv = Input::get('naziv');
        $opis = Input::get('opis');
        $cena = Input::get('cena');
        $idKategorija = Input::get('idKategorija');
        $boja = Input::get('boja');
        $brava = Input::get('brava');
        $ubrava = Input::get('ubrava');
        $zabravljivanje = Input::get('zabravljivanje');
        $tip = Input::get('tip');
        $sv = Input::get('sv');
        $ss = Input::get('ss');
        $sd = Input::get('sd');
        $uv = Input::get('uv');
        $us = Input::get('us');
        $ud = Input::get('ud');
        $police = Input::get('police');
        $tezina = Input::get('tezina');
        $zapremina = Input::get('zapremina');
        $poruka = "";
        $greska = false;
        if($naziv != null && $naziv != "" && $slika != "" && $cena != null && $cena != "" && $idKategorija != null && $idKategorija != "0" && $sv != null && $sv != "" && $ss != null && $ss != "" && $sd != null && $sd != "" && $tezina != null && $tezina != "")
        {
            if(Sef::where('id', '=', $id)->update(array('naziv' => $naziv, 'opis' => $opis, 'mimeType' => $mimeType, 'slika' => $slika, 'cena' => $cena, 'idKategorija' => $idKategorija, 'boja' => $boja, 'brava' => $brava, 'ubrava' => $ubrava, 'zabravljivanje' => $zabravljivanje,'tip' => $tip, 'sv' => $sv, 'ss' => $ss, 'sd' => $sd, 'uv' => $uv, 'us' => $us, 'ud' => $ud, 'police' => $police, 'tezina' => $tezina, 'zapremina' => $zapremina, 'updated_at' => new DateTime())))
            {
                $poruka = 'Uspešno ste izmenili podatke o sefu sa nazivom '.$naziv;
                $greska = false;
            }else
            {
                $poruka = 'Podaci za sef sa nazivom '.$naziv.' nisu izmenjeni.';
                $greska = true;
            }
        }else{
            $poruka = "Podaci za sef nisu dobro popunjeni!";
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
            $sef = Sef::find($id);
            if($sef == null) throw Exception;
            if(Sef::destroy($id))
            {
                $poruka = "Uspešno ste obrisali sef: ".$sef->naziv;
                $greska = false;
            }
        }catch (Exception $e){
            $poruka = "Došlo je do greške prilikom brisanja sefa";
            $greska = true;
        }
        return Response::json(array(
                'nazivAkcije' => $poruka,
                'error'       => $greska),
            200
        );
	}

}