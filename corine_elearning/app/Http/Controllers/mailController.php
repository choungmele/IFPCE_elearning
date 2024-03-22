<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;
use App\Models\apprenant;


class mailController extends Controller
{
    //

    public function show_valider($id)
    {
        $app = apprenant::find($id);
        return view('apprenants.mail',compact('app'));
    }

    public function show_refuser($id)
    {
        $app = apprenant::find($id);
        return view('apprenants.mail_refus',compact('app'));
    }

    public function send(Request $request, $id)
    {
        $request->validate([
            //pour dire que les champs sont requis
            'objet' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:255'],

        ],);

        //je récupère l'apprenant dans la BD
        $app = apprenant::find($id);

        //je récupère l'email
        $recepteur = $app->email;

        // Adresse email du destinataire
        $destinataire = $recepteur;

        // Contenu de l'email
        $contenu = $request->message;
        $objet = $request->objet;

        // Envoi de l'email
        Mail::raw($contenu, function ($message) use ($destinataire) {
            $message->to($destinataire);
            $message->subject($objet);
        });


        return redirect()->back()->withsuccess('email envoyé avec succès !');

    }

    public function valider(Request $request, $id)
    {
        $request->validate([
            //pour dire que les champs sont requis
            //'objet' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:255'],

        ],);

        //je récupère l'apprenant dans la BD
        $app = apprenant::find($id);

        //je récupère l'email
        $recepteur = $app->email;

        // Adresse email du destinataire
        $destinataire = $recepteur;

        // Contenu de l'email
        $contenu = $request->message;

        // Envoi de l'email
        Mail::raw($contenu, function ($message) use ($destinataire) {
            $message->to($destinataire);
            $message->subject('Validation de votre candidature à IFPCE');
        });

        $app->valider = 1;
        $app->update();

        return redirect('/apprenant_postulants')->with('status','email envoyé avec succes');

    }

    public function refuser(Request $request, $id)
    {
        $request->validate([
            //pour dire que les champs sont requis
            //'objet' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:255'],

        ],);

        //je récupère l'apprenant dans la BD
        $app = apprenant::find($id);

        //je récupère l'email
        $recepteur = $app->email;

        // Adresse email du destinataire
        $destinataire = $recepteur;

        // Contenu de l'email
        $contenu = $request->message;

        // Envoi de l'email
        Mail::raw($contenu, function ($message) use ($destinataire) {
            $message->to($destinataire);
            $message->subject('Refus de votre candidature à IFPCE');
        });

        $app->delete();


        return redirect('/apprenant_postulants')->with('status','email envoyé avec succes');
    }

}
