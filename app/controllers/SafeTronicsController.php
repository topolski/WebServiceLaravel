<?php

class SafeTronicsController extends \BaseController {

	public function index()
	{
        $sefovi = Sef::take(9)->get(array('slika', 'mimeType', 'naziv', 'cena', 'id'))->sortBy('created_at');

        return Response::json(array(
                'nazivAkcije' => 'Pregled kategorija',
                'error'       => false,
                 'sefovi'  => $sefovi->toArray()
            ),
            200
        );
	}

    public function kategorije()
    {
        $kategorije = Kategorija::get();

        return Response::json(array(
                'nazivAkcije' => 'Pregled kategorija',
                'error'       => false,
                'kategorije'  => $kategorije->toArray()
            ),
            200
        );
    }

    public function all()
    {
        $sefovi = Sef::get(array('slika', 'mimeType', 'naziv', 'cena', 'id'))->sortBy('naziv');

        return Response::json(array(
                'nazivAkcije' => 'Pregled svih sefova',
                'error'       => false,
                'sefovi'  => $sefovi->toArray()
            ),
            200
        );
    }

	public function show($id)
	{
        try
        {
            $sefovi = Sef::with('kategorija')->find($id);
            $poruka = $sefovi->naziv;
            $greska = false;
            $sefovi = $sefovi->toArray();
        }catch (Exception $e)
        {
            $poruka = 'Sef nije pronađen u bazi!';
            $greska = true;
        }
        return Response::json(array(
                'nazivAkcije' => $poruka,
                'error'       => $greska,
                'sefovi'  => $sefovi),
            200
        );
	}

	public function kategorija($id)
    {
        try
        {
            $sefovi = Sef::where('idKategorija', '=', $id)->with('kategorija')->get();
            $kategorija = Kategorija::find($id, array('naziv'));
            $poruka = $kategorija->naziv;
            $greska = false;
            $sefovi->toArray();
        }catch (Exception $e)
        {
            $poruka = "Kategorija nije pronađena u bazi!";
            $greska = true;
        }

        return Response::json(array(
                'nazivAkcije' => $poruka,
                'error'       => $greska,
                'sefovi'  => $sefovi),
            200
        );
    }
}