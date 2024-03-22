<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\formateurController;
use App\Http\Controllers\specialiteController;
use App\http\controllers\programmationCoursController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\coursController;
use App\Http\Controllers\mailController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\domaineController;
use App\Http\Controllers\sessionController;
use App\Http\Controllers\quizzController;
use App\Http\Controllers\questionController;
use App\Http\Controllers\examenController;
use App\Http\Controllers\apprenantController;
use App\Models\Apprenant;
use App\Models\formateur;
use App\Models\specialite;

use App\Models\gestionnaire;
use App\Http\Controllers\gestionnaireController;
/*
|--------------------------------------------------------------------------
| ROUTES LOGIN
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login',[LoginController::class, 'login'])->middleware('alreadyLoggedIn');
Route::get('/registration',[LoginController::class, 'registration'])->middleware('alreadyLoggedIn');
Route::post('/register-user', [LoginController::class,'registerUser'])->name
('register-user');
Route::post('login-user', [LoginController::class, 'loginuser'])->name
('login-user');
Route::get('/dashboard',[LoginController::class, 'dashboard'])->middleware('isLoggedIn');
Route::get('/logout',[LoginController::class, 'logout']);



/*
|--------------------------------------------------------------------------
| ROUTES DU MODULE GESTIONNAIRE
|--------------------------------------------------------------------------
|
*/

Route::post('/gestionnaire_login',[gestionnaireController::class, 'gestionnaire_login'])->name('gestionnaire.login');
Route::get('/login_gestionnaire',[gestionnaireController::class, 'login'])->name('gestionnaire.log');
Route::get('/creer_gestionnaire',[gestionnaireController::class, 'create'])->name('gestionnaire.create');
Route::post('/stocker_gestionnaire', [gestionnaireController::class, 'store'])->name('gestionnaire.store');
Route::get('/gestionnaire/Liste', [gestionnaireController::class, 'list'])->name('gestionnaire.liste');
Route::get('/gestionnaire_supprimer/{id}',[gestionnaireController::class, 'supprimer'])->name('gestionnaire.supprimer');
Route::get('/gestionnaire_liste_examen/{id}',[gestionnaireController::class, 'liste_examen'])->name('examen.liste_examen_envoyé');
Route::get('/gestionnaire_corriger/{id}',[gestionnaireController::class, 'corriger'])->name('gestionnaire.corriger');


//routes de l'administrateur
Route::post('/admin_login',[adminController::class, 'admin_login'])->name('admin.login');
Route::get('/login_admin',[adminController::class, 'login'])->name('admin.log');


//les routes du module formateur
Route::get('/creer_formateur',[formateurController::class, 'create_formateur'])->name('formateur.create');
Route::post('/stocker_formateur', [formateurController::class, 'store_formateur'])->name('formateur.store');
Route::get('/formateur/Liste', [formateurController::class, 'formateur_List'])->name('formateur.liste');
Route::get('/delete_formateur/{id}',[formateurController::class, 'delete'])->name('formateur.supprimer');
Route::get('formateur_update/{id}',[formateurController::class, 'modifier'])->name('formateur.modifier');
Route::post('/formateur_modif/{id}', [formateurController::class, 'store_modif'])->name('formateur.store_modif');



//route de specialite
Route::get('/creer_une_specialite',[specialiteController::class, 'create'])->name('specialite.create');
Route::get('/specialite/Liste', [specialiteController::class, 'liste'])->name('specialite.liste');
Route::post('/store_specialite', [specialiteController::class, 'store'])->name('specialite.store');
Route::get('/delete_specialite/{id}',[specialiteController::class, 'delete'])->name('specialite.supprimer');
Route::get('/specialite_update/{id}',[specialiteController::class, 'modifier'])->name('specialite.modifier');
Route::post('/specialite_modif/{id}', [specialiteController::class, 'store_modif'])->name('specialite.store_modif');

//route de cours
Route::get('/creer_un_cours',[coursController::class, 'create'])->name('cours.create');
Route::get('/cours/Liste', [coursController::class, 'liste'])->name('cours.liste');
Route::post('/store_cours', [coursController::class, 'store'])->name('cours.store');
Route::get('/cours/{id}/edit', [coursController::class, 'edit'])->name('cours.edit');
Route::get('/cours/{id}/delete', [coursController::class, 'delete'])->name('cours.delete');
Route::get('/cours_add_file/{id}', [coursController::class, 'add_file'])->name('cours.add_file');
Route::post('/cours/{id}/add_file', [coursController::class, 'do_add_file'])->name('cours.do_add_file');
Route::get('/cours/{id}/details', [coursController::class, 'details'])->name('cours.details');
Route::get('/cours/{id}/publier', [coursController::class, 'publier'])->name('cours.publier');
Route::get('/cours/Liste_publier', [coursController::class, 'liste_publier'])->name('cours.liste_publier');

//routes de apprenants
Route::get('/login_apprenant',[apprenantController::class, 'login'])->name('apprenant.log');
Route::post('/apprenant_login',[apprenantController::class, 'login_apprenant'])->name('apprenant.login');

Route::get('/apprenant_register',[apprenantController::class, 'register'])->name('apprenant.register');
Route::get('/apprenant_register_plus',[apprenantController::class, 'register2'])->name('apprenant.register2');
Route::post('/store_apprenant', [apprenantController::class, 'store'])->name('apprenant.store');
Route::get('/apprenant_postulants',[apprenantController::class, 'postulants'])->name('apprenant.postulants');
Route::get('/apprenant_liste',[apprenantController::class, 'liste'])->name('apprenant.liste');
Route::get('/apprenant_liste_desactiver',[apprenantController::class, 'liste_desactiver'])->name('apprenant.liste_desactiver');
Route::get('/apprenant_update/{id}',[apprenantController::class, 'modifier'])->name('apprenant.modifier');
Route::post('/apprenant_modif/{id}', [apprenantController::class, 'store_modif'])->name('apprenant.store_modif');

Route::post('/apprenant_desactivate/{id}',[apprenantController::class, 'desactiver'])->name('apprenant.desactiver');
Route::post('/apprenant_delete/{id}',[apprenantController::class, 'supprimer'])->name('apprenant.supprimer');
Route::post('/apprenant_activate/{id}',[apprenantController::class, 'activer'])->name('apprenant.activer');

Route::get('/apprenant_show_supprimer/{id}',[apprenantController::class, 'show_supprimer'])->name('apprenant.show_supprimer');
Route::get('/apprenant_show_desactiver/{id}',[apprenantController::class, 'show_desactiver'])->name('apprenant.show_desactiver');
Route::get('/apprenant_show_activer/{id}',[apprenantController::class, 'show_activer'])->name('apprenant.show_activer');

Route::get('/apprenant_quizz/{id}',[apprenantController::class, 'liste_quizz'])->name('apprenant.liste_quizz');
Route::get('/apprenant_composer/{id}/{id_app}',[apprenantController::class, 'composer'])->name('apprenant.composer');
Route::post('/apprenant_coriger/{id_quizz}/{id_app}',[apprenantController::class, 'corriger'])->name('apprenant.corriger');

Route::get('/apprenant_liste_cours/{id}',[apprenantController::class, 'liste_cours'])->name('apprenant.liste_cours');
Route::get('/apprenant_liste_examen/{id}',[apprenantController::class, 'liste_examen'])->name('apprenant.liste_examen');

Route::get('/apprenant_rendre_examen/{id_app}/{id_examen}',[apprenantController::class, 'rendre'])->name('examen.rendre');
Route::post('/apprenant_do_rendre_examen/{id_app}/{id_examen}',[apprenantController::class, 'do_rendre'])->name('examen.do_rendre');


//route pour email
Route::get('/show_valider/{id}/mail', [mailController::class, 'show_valider'])->name('mail.show_valider');
Route::get('/show_refuser/{id}/mail', [mailController::class, 'show_refuser'])->name('mail.show_refuser');
Route::post('/apprenant/{id}/valider', [mailController::class, 'valider'])->name('mail.valider');
Route::post('/apprenant/{id}/refuser', [mailController::class, 'refuser'])->name('mail.refuser');
Route::post('/apprenant/{id}/sendmail', [mailController::class, 'send'])->name('mail.send');


//les routes du domaine de competence
Route::get('/creer_domaine',[domaineController::class, 'create_domaine'])->name('domaine.create');
Route::post('/stocker_domaine', [domaineController::class, 'store_domaine'])->name('domaine.store');
Route::get('/domaine/Liste', [domaineController::class, 'list_domaine'])->name('domaine.liste');
Route::get('/delete_domaine/{id}',[domaineController::class, 'delete_domaine'])->name('domaine.supprimer');
Route::get('/domaine_update/{id}',[domaineController::class, 'modifier'])->name('domaine.modifier');
Route::post('/domaine_modif/{id}', [domaineController::class, 'store_modif'])->name('domaine.store_modif');

//les routes de session
Route::get('/creer_session',[sessionController::class, 'create_session'])->name('session.create');
Route::post('/stocker_session', [sessionController::class, 'store_session'])->name('session.store');
Route::get('/session/Liste', [sessionController::class, 'list_session'])->name('session.liste');
Route::get('/delete_session/{id}',[sessionController::class, 'delete_session'])->name('session.supprimer');
Route::get('/session_update/{id}',[sessionController::class, 'modifier'])->name('session.modifier');
Route::post('/sessioon_modif/{id}', [sessionController::class, 'store_modif'])->name('session.store_modif');


//les routes pour le quizz

Route::get('/creer_quizz',[quizzController::class, 'create'])->name('quizz.create');
Route::post('/store_quizz', [quizzController::class, 'store'])->name('quizz.store');
Route::get('/quizz/Liste', [quizzController::class, 'list'])->name('quizz.liste');
Route::get('/quizz/Liste2', [quizzController::class, 'list2'])->name('quizz.liste2');
Route::get('/quizz/{id}/publier', [quizzController::class, 'publier'])->name('quizz.publier');




//les routes de question
Route::get('/quizz_add_question/{id}', [questionController::class, 'addQuestion'])->name('question.add');
Route::post('/store_question/{id}', [questionController::class, 'storeQuestion'])->name('question.store');
Route::get('/question/{id}/details', [questionController::class, 'details'])->name('question.details');

//les routes de examen
Route::get('/creer_examen',[examenController::class, 'create'])->name('examen.create');
Route::post('/store_examen', [examenController::class, 'store'])->name('examen.store');
Route::get('/examen/Liste', [examenController::class, 'liste'])->name('examen.liste');
Route::get('/examen_update/{id}',[examenController::class, 'modifier'])->name('examen.edit');
Route::post('/examen_modif/{id}', [examenController::class, 'store_modif'])->name('examen.store_modif');
Route::get('/delete_examen/{id}',[examenController::class, 'delete'])->name('examen.delete');
Route::get('/publier_examen/{id}',[examenController::class, 'publier'])->name('examen.publier');
Route::get('/examen/Liste_publiée', [examenController::class, 'liste1'])->name('examen.liste_publier');




