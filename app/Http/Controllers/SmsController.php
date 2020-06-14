<?php

namespace App\Http\Controllers;

use App\Http\Requests\passePartout;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class SmsController extends Controller
{




    public function index(){
        return view('index/welcome');
    }


    public function getUserNumber(passePartout $request)
    {
        $phone_number = $request->input('telephone');

        $message = "M/Mme Bienvenu sur notre site";

        $this->initiateSmsGuzzle($phone_number, $message);

        return redirect()->back()->with('message', 'Message envoyé avec succès');
    }

                public function initiateSmsGuzzle($phone_number, $message)
            {
                    $client = new Client();
                    $response = $client->get("http://obitsms.com/api/bulksms?username=" . 'emarc237@gmail.com' .
                                "&password=" . 'j5nU51cM' .
                                "&sender=" . 'lalala' . "&destination=" . $phone_number . "&message=" . $message);

                $response = json_decode($response->getBody(), true);
            }




}
