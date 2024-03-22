<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\programmationCours;
use App\Models\CoursPlanification;
use Illuminate\Support\Facades\Hash; // Corrected use statement
use Session; 
use Illuminate\Support\Facades\Validator;
use App\Models\Student; // Assurez-vous d'importer le modèle Student
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;


class LoginController extends Controller
{
    //
    public function login(){
         return view("auth.login");
    }
    public function registration(){
        return view("auth.registration");
    }
   /*
    public function registerUser(Request $request){
        $request->validate([
           'name'=>'required',
           'surname'=>'required',
           'birth'=>'required',
           'contact'=>'required|min:6|max:12',
           'contacts'=>'required|min:6|max:12',
           'pays'=>'required',
           'email'=>'required|email|unique:users',
           'password'=>'required|min:5|max:12',
           'status'=>'required',
              // Conditionnellement, exigez le numéro d'inscription uniquement si le statut est "apprenant"
       'numero_inscription' => $request->status == 'apprenant' ? 'required|exists:students,numero_inscription' : '',
           'occupation'=>'required',
           'cni'=>'required',
           'delivrance'=>'required'
        
        ]);
        $user = new user();
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->birth = $request->birth;
        $user->contact =$request->contact;
        $user->contacts =$request->contacts;
        $user->pays=$request->pays;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->status = $request->status;
        $user->occupation= $request->occupation;
        $user->cni= $request->cni;
        $user->delivrance= $request->delivrance;
        $res = $user->save();
        if($res){
            return back()->with('success', 'you have registered successfully');

        }else{
             return back()->with('failed to connect', 'wrong');
        }
        }
        
*/
        public function registerUser(Request $request)
        {
            $validator = Validator::make($request->all(), [
               'name' => 'required',
               'surname' => 'required',
               'birth' => 'required',
               'contact' => 'required|min:6|max:12',
               'contacts' => 'required|min:6|max:12',
               'pays' => 'required',
               'email' => 'required|email|unique:users',
               'password' => 'required|min:5|max:12',
               'status' => 'required',
               'occupation' => 'required',
               'cni' => 'required',
               'delivrance' => 'required',
              /* 'numero_inscription' => [
                    'required',
                    function ($attribute, $value, $fail) use ($request) {
                        $student = Student::where('numero_inscription', $value)
                                         ->where('email', $request->email)
                                         ->first();
        
                        if (!$student) {
                            $fail('Le numéro d\'inscription ou l\'email ne correspondent pas aux enregistrements des étudiants.');
                        }
                    },*/
                    'numero_inscription' => [
                        function ($attribute, $value, $fail) use ($request) {
                            // Check if status is 'apprenant' to validate 'numero_inscription'
                            if ($request->status === 'apprenant') {
                                $student = Student::where('numero_inscription', $value)
                                                  ->where('email', $request->email)
                                                  ->first();
                
                                if (!$student) {
                                    $fail('Le numéro d\'inscription ou l\'email ne correspondent pas aux enregistrements des étudiants.');
                                }
                            }
                        },
               ],
            ]);
        
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }
        
            $user = new User();
            $user->name = $request->name;
            $user->surname = $request->surname;
            $user->birth = $request->birth;
            $user->contact = $request->contact;
            $user->contacts = $request->contacts;
            $user->pays = $request->pays;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->status = $request->status;
            $user->occupation = $request->occupation;
            $user->cni = $request->cni;
            $user->delivrance = $request->delivrance;
            
            $res = $user->save();
        
            if ($res) {
                return back()->with('success', 'you have registered successfully');
            } else {
                return back()->with('failed to connect', 'wrong');
            }
        }

      
    
    public function loginUser(request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required|min:5|max:12'
         ]);
         $user = User::where('email', "=", $request->email)->first();
         if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $request->session()->put('loginId', $user->id);
                // Redirection en fonction du statut
                switch ($user->status) {
                    case 'apprenant':
                        return redirect('apprenants/dashboard');
                        break;
                    case 'formateur':
                        return redirect('formateur/dashboard');
                        break;
                    case 'gestionnaire':
                        return redirect('gestionnaire/dashboard');
                        break;
                    case 'administrateur':
                        return redirect('administrateur/dashboard');
                        break;
                    default:
                        return redirect('dashboard');
                        break;
                }
            } else {
                return back()->with('fail', 'Mot de passe incorrect');
            }
        }
        
    }
    
    

    private function getUserData()
    {
        $data = [];
        if (Session::has('loginId')) {
            $data = User::where('id', Session::get('loginId'))->first();
        }
        return $data;
    }

    public function apprenantsDashboard(Request $request)
    {
        $data = $this->getUserData();
        return view("apprenants.dashboard", compact('data'));
    }

    public function formateurDashboard(Request $request)
    {
        $data = $this->getUserData();
        return view("formateur.dashboard", compact('data'));
    }

    public function gestionnaireDashboard(Request $request)
    {
        $data = $this->getUserData();
        return view("gestionnaire.dashboard", compact('data'));
        
    }

    public function administrateurDashboard(Request $request)
    {
        $data = $this->getUserData();
        return view("administrateur.dashboard", compact('data'));
    }


    public function logout()
    {
        if (Session::has('loginId')){
            Session::pull('loginId');
            return redirect('login');
        }
    }
//FONCTIONNALITE POUR L'ADMINISTRATEUR
public function liste()
    {
        $users = User::all();
        return view('administrateur.utilisateur.listeAd', compact('users'));
    }

    // Afficher le formulaire pour créer un nouvel utilisateur
    public function create()
    {
        return view('administrateur.utilisateur.createAd');
    }

    // Enregistrer un nouvel utilisateur dans la base de données
    public function store(Request $request)
    {
        // Validation des données
        $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'birth' => 'required',
            'contact' => 'required|min:6|max:12',
            'contacts' => 'required|min:6|max:12',
            'pays' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5|max:12',
            'status' => 'required',
            'occupation' => 'required',
            'cni' => 'required',
            'delivrance' => 'required',
           /* 'numero_inscription' => [
                 'required',
                 function ($attribute, $value, $fail) use ($request) {
                     $student = Student::where('numero_inscription', $value)
                                      ->where('email', $request->email)
                                      ->first();
     
                     if (!$student) {
                         $fail('Le numéro d\'inscription ou l\'email ne correspondent pas aux enregistrements des étudiants.');
                     }
                 },*/
                 'numero_inscription' => [
                     function ($attribute, $value, $fail) use ($request) {
                         // Check if status is 'apprenant' to validate 'numero_inscription'
                         if ($request->status === 'apprenant') {
                             $student = Student::where('numero_inscription', $value)
                                               ->where('email', $request->email)
                                               ->first();
             
                             if (!$student) {
                                 $fail('Le numéro d\'inscription ou l\'email ne correspondent pas aux enregistrements des étudiants.');
                             }
                         }
                     },
            ],
         
        ]);

        // Création de l'utilisateur
        User::create($request->all());

        return redirect()->route('administrateur.utilisateur.listeAd')->with('success', 'Utilisateur créé avec succès.');
    }

    // Afficher le formulaire pour éditer un utilisateur
    public function edit(User $user)
    {
        return view('administrateur.utilisateur.editAd', compact('user'));
    }

    // Mettre à jour un utilisateur dans la base de données
    public function update(Request $request, User $user)
    {
        // Validation des données
        $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'birth' => 'required',
            'contact' => 'required|min:6|max:12',
            'contacts' => 'required|min:6|max:12',
            'pays' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5|max:12',
            'status' => 'required',
            'occupation' => 'required',
            'cni' => 'required',
            'delivrance' => 'required',
           /* 'numero_inscription' => [
                 'required',
                 function ($attribute, $value, $fail) use ($request) {
                     $student = Student::where('numero_inscription', $value)
                                      ->where('email', $request->email)
                                      ->first();
     
                     if (!$student) {
                         $fail('Le numéro d\'inscription ou l\'email ne correspondent pas aux enregistrements des étudiants.');
                     }
                 },*/
                 'numero_inscription' => [
                     function ($attribute, $value, $fail) use ($request) {
                         // Check if status is 'apprenant' to validate 'numero_inscription'
                         if ($request->status === 'apprenant') {
                             $student = Student::where('numero_inscription', $value)
                                               ->where('email', $request->email)
                                               ->first();
             
                             if (!$student) {
                                 $fail('Le numéro d\'inscription ou l\'email ne correspondent pas aux enregistrements des étudiants.');
                             }
                         }
                     },
            ],
         ]);

        // Mise à jour de l'utilisateur
        $user->update($request->all());

        return redirect()->route('administrateur.utilisateur.listeAd')->with('success', 'Utilisateur mis à jour avec succès.');
    }

    // Supprimer un utilisateur de la base de données
    public function destroy(User $user)
    {
        $user->delete();

        return redirect('/listeAd')->with('success', 'Utilisateur supprimé avec succès.');
    }

    // Exporter la liste des utilisateurs au format PDF
    public function exportPDF()
    {
        $users = User::all();

        $pdf = FacadePdf::loadView('administrateur.utilisateur.pdf', compact('users'));

        return $pdf->download('liste_utilisateurs.pdf');
    }

    public function listeProgram_programmationCours(){
        $programmations = ProgrammationCours::all();
        $coursPlanifications = CoursPlanification::all();
        // Récupérer vos données (supposons que $data est une collection de données)
        $data = $this->getUserData();
        return view('gestionnaire.dashboard', compact('programmations', 'coursPlanifications', 'data'));
       
       
     }
     public function listeProgram(){
        $programmations = ProgrammationCours::all();
        $coursPlanifications = CoursPlanification::all();
        // Récupérer vos données (supposons que $data est une collection de données)
        $data = $this->getUserData();
        return view('apprenants.dashboard', compact('programmations', 'coursPlanifications', 'data'));
       
       
     }
    

}
