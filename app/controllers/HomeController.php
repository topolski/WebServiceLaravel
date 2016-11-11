<?php

class HomeController extends BaseController {

    public function login()
    {
        try
        {
            $user = Sentry::authenticate(Input::only('email', 'password'), false);

            $token = hash('sha256',Str::random(10),false);

            $user->api_token = $token;

            $user->save();

            $meni = Menu::get(array("naziv", "putanja"));

            return Response::json(array(
                    'nazivAkcije' => 'Uspešno ste se ulogovali.',
                    'error'       => false,
                    'token' 	  => $token,
                    'user' 		  => $user->toArray(),
                    'meni' 		  => $meni->toArray()),
                200
            );
        }
        catch(Exception $e)
        {
            return Response::json(array(
                    'nazivAkcije' => 'Podaci koje ste naveli nisu tačni.',
                    'error'       => true),
                200
            );
        }
    }

    public function logout()
    {
        return Response::json(array(
                'nazivAkcije' => 'Uspešno ste se izlogovali.',
                'error'       => false),
            200
        );
    }
}
