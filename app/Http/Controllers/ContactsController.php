<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactMessageCreated;
use App\Http\Requests\ContactRequest;
use Illuminate\Support\Facades\Mail;
use MercurySeries\Flashy\Flashy;

class ContactsController extends Controller
{

    public function create()
    {
        return view('index/contacter');
    }

    public function store(ContactRequest $request){


        try {

        sleep(0);
        $mailable=new ContactMessageCreated($request->nom,$request->email,$request->text);
        Mail::to('brondonstyve@gmail.com')->send($mailable);
        Flashy::success('nous vous repondrons dans les plus bref delais!');
        return redirect()->route('home');

        } catch (\Throwable $th) {
            Flashy::error('erreur reseau.vérifiez votre connexion!');
            return redirect()->route('home');
        }

    }

}
