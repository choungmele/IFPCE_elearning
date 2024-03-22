<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ApprenantController;
use App\Http\Controllers\FormateurController;
use App\Http\controllers\programmationCoursController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\CoursController;
use App\Models\Apprenant;
use App\Models\Formateur;
use App\Http\Controllers\quizzController;
use App\Http\Controllers\questionController;

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
Route::get('apprenants/logout', [LoginController::class, 'logout']);
Route::get('formateur/logout', [LoginController::class, 'logout']);
Route::get('gestionnaire/logout', [LoginController::class, 'logout']);
Route::get('administrateur/logout', [LoginController::class, 'logout']);

Route::get('/apprenants/dashboard', [LoginController::class, 'apprenantsDashboard'])->middleware('isLoggedIn');
Route::get('/formateur/dashboard', [LoginController::class, 'formateurDashboard'])->middleware('isLoggedIn');
Route::get('/gestionnaire/dashboard', [LoginController::class, 'gestionnaireDashboard'])->middleware('isLoggedIn');
Route::get('/administrateur/dashboard', [LoginController::class, 'administrateurDashboard'])->middleware('isLoggedIn');
//FONCTIONNALITE ADMINISTRATEUR
// Routes pour l'administrateur

    Route::get('/listeAd', [LoginController::class, 'liste'])->name('utilisateur.liste');
    Route::get('/createAd', [LoginController::class, 'create'])->name('utilisateur.create');
    Route::post('/listeAd', [LoginController::class, 'store'])->name('utilisateur.store');
    Route::get('/{user}/editAd', [LoginController::class, 'edit'])->name('utilisateur.edit');
    Route::put('/{user}', [LoginController::class, 'update'])->name('utilisateur.update');
    Route::delete('/{user}', [LoginController::class, 'destroy'])->name('utilisateur.destroy');
    Route::get('/export-pdf', [LoginController::class, 'exportPDF']);
    Route::get('/gestionnaire/dashboard', [LoginController::class, 'listeProgram_programmationCours']);
    Route::get('/apprenants/dashboard', [LoginController::class, 'listeProgram']);
 





/*
|--------------------------------------------------------------------------
| ROUTES APPRENANTS
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/delete-apprenant/{id}', [ApprenantController::class, 'delete_apprenant']);
Route::get('/update-apprenant/{id}', [ApprenantController::class, 'update_apprenant']);
Route::post('/update/traitement', [ApprenantController::class, 'update_apprenant_traitement']);
Route::get('/liste', [ApprenantController::class, 'liste_apprenant']);
Route::get('/ajouter', [ApprenantController::class, 'ajouter_apprenant']);
Route::post('/ajouter/trait', [ApprenantController::class, 'ajouter_apprenant_trait']);
Route::get('/generate-pdf', [ApprenantController::class, 'generatePDF']);

Route::get('/apprenant_quizz/{id}',[ApprenantController::class, 'liste_quizz'])->name('apprenant.liste_quizz');
Route::get('/apprenant_composer/{id}/{id_app}',[ApprenantController::class, 'composer'])->name('apprenant.composer');
Route::post('/apprenant_coriger/{id_quizz}/{id_app}',[ApprenantController::class, 'corriger'])->name('apprenant.corriger');

Route::get('/apprenant_liste_cours/{id}',[ApprenantController::class, 'liste_cours'])->name('apprenant.liste_cours');
Route::get('/apprenant_liste_examen/{id}',[ApprenantController::class, 'liste_examen'])->name('apprenant.liste_examen');
Route::get('/apprenant_ressources/{id}',[ApprenantController::class, 'ressources'])->name('apprenant.ressources');

Route::get('/apprenant_rendre_examen/{id_app}/{id_examen}',[ApprenantController::class, 'rendre'])->name('examen.rendre');
Route::post('/apprenant_do_rendre_examen/{id_app}/{id_examen}',[ApprenantController::class, 'do_rendre'])->name('examen.do_rendre');

/*
|--------------------------------------------------------------------------
| ROUTES FORMATEUR
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/deleteF-formateur/{id}', [FormateurController::class, 'deleteF_formateur']);
Route::get('/updateF-formateur/{id}', [FormateurController::class, 'updateF_formateur']);
Route::post('/updateF/traitement', [FormateurController::class, 'updateF_formateur_traitement']);
Route::get('/listeF', [FormateurController::class, 'listeF_formateur']);
Route::get('/ajouterF', [FormateurController::class, 'ajouterF_formateur']);
Route::post('/ajouterF/traitement', [FormateurController::class, 'ajouterF_formateur_traitement']);
Route::get('/generate-pdf-v', [FormateurController::class, 'generatePDFV']);
Route::get('/gestionnaire_corriger',[FormateurController::class, 'liste_rendu'])->name('gestionnaire.rendu');


/*
|--------------------------------------------------------------------------
| ROUTES CREER COURS
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/creer/deleteCours-cours/{id}', [CoursController::class, 'deleteCours_cours']);
Route::get('/creer/updateCours-cours/{id}', [CoursController::class, 'updateCours_cours']);
Route::post('/creer/updateCours/traitement', [CoursController::class, 'updateCours_cours_traitement']);
Route::get('/creer/listeCours', [CoursController::class, 'listeCours_cours']);
Route::get('/creer/ajouterCours', [CoursController::class, 'ajouterCours_cours']);
Route::post('/creer/ajouterCours/traitement', [CoursController::class, 'ajouterCours_cours_traitement']);
Route::get('/generate-pdf-vi', [CoursController::class, 'generatePDFVi']);

/*
|--------------------------------------------------------------------------
| ROUTES PROGRAMMATION D'UN COURS
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/programmer/deleteProgram-programmationCours/{id}', [programmationCoursController::class, 'deleteProgram_programmationCours']);
Route::get('/programmer/updateProgram-programmationCours/{id}', [programmationCoursController::class, 'updateProgram_programmationCours']);
Route::post('/programmer/updateProgram/traitement', [programmationCoursController::class, 'updateProgram_programmationCours_traitement']);
Route::get('/programmer/listeProgram', [programmationCoursController::class, 'listeProgram_programmationCours']);
Route::get('/programmer/ajouterProgram', [programmationCoursController::class, 'ajouterProgram_programmationCours']);
Route::post('/programmer/ajouterProgram/traitement', [programmationCoursController::class, 'ajouterProgram_programmationCours_traitement']);
Route::get('/get-code', [ProgrammationCoursController::class, 'getCode'])->name('get-code');
Route::get('/generate-pdf-view', [programmationCoursController::class, 'generatePDFView']);



/*
|--------------------------------------------------------------------------
| ROUTES DOCUMENTS POUR METTRE EN LIGNE UN FICHIER
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// routes/web.php



Route::get('/publier/upload', [DocumentController::class, 'showUploadForm'])->name('upload.form');
Route::post('/publier/upload', [DocumentController::class, 'uploadDocument'])->name('upload');
Route::get('/publier/documents', [DocumentController::class, 'showDocuments'])->name('documents.list');
Route::get('/publier/download/{id}', [DocumentController::class, 'downloadDocument'])->name('download');
Route::get('/publier/delete/{id}', [DocumentController::class, 'deleteDocument'])->name('delete');



/*
|--------------------------------------------------------------------------
| ROUTES POUR LES SESSIONS
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// routes/web.php
// routes/web.php

use App\Http\Controllers\SessionController;

Route::get('/apprenants-par-session', [SessionController::class, 'apprenantsParSession'])->name('apprenants.par.session');
Route::get('/create-session-form', [SessionController::class, 'showCreateSessionForm'])->name('create.session.form');
Route::post('/create-session-form/create-session', [SessionController::class, 'createSession'])->name('create.session');
Route::post('/export-pdf-sessions', [SessionController::class, 'exportPDF'])->name('export.pdf.sessions');

/*
|--------------------------------------------------------------------------
| ROUTES POUR LA PLANIFICATION DES COURS
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// routes/web.php
// routes/web.php

use App\Http\Controllers\CoursPlanificationController;

Route::get('/planification/form', [CoursPlanificationController::class, 'showForm'])->name('cours.planification.form');
Route::post('/planification/store', [CoursPlanificationController::class, 'store'])->name('planification.store');
//


Route::get('/planification/view', [CoursPlanificationController::class, 'showView'])->name('cours.planification.view');
Route::get('/planification/edit/{id}', [CoursPlanificationController::class, 'edit'])->name('planification.edit');
Route::put('/planification/update/{id}', [CoursPlanificationController::class, 'update'])->name('planification.update');
Route::delete('/planification/delete/{id}', [CoursPlanificationController::class, 'destroy'])->name('planification.delete');
Route::get('/export-pdf/{id}', [CoursPlanificationController::class, 'exportPDF'])->name('planification.export');
Route::get('/planification/synthese', [CoursPlanificationController::class, 'synthese'])->name('planification.synthese');

/*
|--------------------------------------------------------------------------
| ROUTES POUR STUDENTS
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// routes/web.php
// routes/web.php

// routes/web.php

use App\Http\Controllers\StudentController;

Route::get('/form', [StudentController::class, 'showForm'])->name('students.form');
//Route::post('/students/store', 'StudentController@store')->name('students.store');

Route::post('/students/store', [StudentController::class, 'store'])->name('students.store');
Route::get('/edit/{id}', [StudentController::class, 'edit'])->name('students.edit');
Route::delete('/students/{id}', [StudentController::class, 'destroy'])->name('students.destroy');
Route::put('/update/{id}', [StudentController::class, 'update'])->name('students.update');
Route::delete('/delete/{id}', [StudentController::class, 'destroy'])->name('students.delete');
Route::get('/export-pdf', [StudentController::class, 'exportPDF'])->name('students.exportPDF');
Route::post('/students/{id}/send-email', [StudentController::class, 'sendEmail'])->name('students.sendEmail');
//Route::get('/students', [StudentController::class, 'index'])->name('students.index');


/*
|--------------------------------------------------------------------------
| ROUTES POUR LE QUIZZ
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// routes/web.php

use App\Http\Controllers\QuizController;

Route::get('/quizz', [QuizController::class, 'index'])->name('quizz.index');
Route::get('/quizz/create', [QuizController::class, 'create']);
Route::post('/quizz/store', [QuizController::class, 'store'])->name('quizz.store');
Route::get('/quizz/pass', [QuizController::class, 'passQuiz'])->name('quiz.pass');
Route::post('/quizz/submit', [QuizController::class, 'submitQuiz'])->name('quiz.submit');





/*
|--------------------------------------------------------------------------
| ROUTES POUR CREER UNE SPECIALITE
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// routes/web.php

use App\Http\Controllers\SpecialiteController;

Route::get('/apprenants-par-specialite', [SpecialiteController::class, 'apprenantsParSpecialite'])->name('apprenants.par.specialite');
Route::get('/create-specialite-form', [SpecialiteController::class, 'showCreateSpecialiteForm'])->name('create.specialite.form');
Route::post('/create-specialite-form/create-specialite', [SpecialiteController::class, 'createSpecialite'])->name('create.specialite');
Route::delete('/specialites/{id}', [SpecialiteController::class, 'destroy'])->name('specialites.destroy');
Route::post('/export-pdf', [SpecialiteController::class, 'exportPDF'])->name('export.pdf.specialite');


/*
|--------------------------------------------------------------------------
| ROUTES POUR CREER UN EXAMEN
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// routes/web.php

use App\Http\Controllers\ExamenController;

Route::get('/examens/index', [ExamenController::class, 'index'])->name('examens.index');
Route::post('/examens/upload', [ExamenController::class, 'upload'])->name('examens.upload');
Route::get('/examens/{id}', [ExamenController::class, 'show'])->name('examens.show');
Route::get('/examens/download/{id}', [ExamenController::class, 'download'])->name('examens.download');
Route::delete('/examens/{id}', [ExamenController::class, 'destroy'])->name('examens.destroy');
Route::resource('examens', ExamenController::class);
Route::get('/examens/{id}/edit', [ExamenController::class, 'edit'])->name('examens.edit');

/*
|--------------------------------------------------------------------------
| ROUTES POUR CREER UN MODULE DE RATACHEMENT
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// routes/web.php

use App\Http\Controllers\ModuleSpecialiteController;



Route::get('/create', [ModuleSpecialiteController::class, 'create'])->name('create');
Route::post('/store', [ModuleSpecialiteController::class, 'store'])->name('store');
Route::get('/list', [ModuleSpecialiteController::class, 'list'])->name('liste');
// Ajoutez d'autres routes au besoin
Route::get('/editer/{id}', [ModuleSpecialiteController::class, 'editer'])->name('editer');
Route::put('/mettre-a-jour/{id}', [ModuleSpecialiteController::class, 'mettreAJour'])->name('mettreAJour');
Route::delete('/supprimer/{id}', [ModuleSpecialiteController::class, 'supprimer'])->name('supprimer');
Route::get('/modules/specialite/{specialite_id}', [ModuleSpecialiteController::class, 'listBySpecialite'])->name('modules.listBySpecialite');

// Ajoutez d'autres routes au besoin
/*
|--------------------------------------------------------------------------
| ROUTES POUR UN RATTRAPAGE
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// routes/web.php
use App\Http\Controllers\RattrapageController;

Route::get('/rattrapages/accueil', [RattrapageController::class, 'accueil'])->name('rattrapages.accueil');
Route::get('/rattrapages/create', [RattrapageController::class, 'create'])->name('rattrapages.create');
Route::post('/rattrapages/store', [RattrapageController::class, 'store'])->name('rattrapages.store');
Route::get('/rattrapages/{id}/edit', [RattrapageController::class, 'edit'])->name('rattrapages.edit');
Route::delete('/rattrapages/{id}', [RattrapageController::class, 'destroy'])->name('rattrapages.destroy');

/*
|--------------------------------------------------------------------------
| ROUTES POUR UNE COMMUNICATION
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



use App\Http\Controllers\CommunicationController;


Route::post('/communications', [CommunicationController::class, 'communiquer'])->name('communications.communiquer');
Route::get('/communications/{id}', [CommunicationController::class, 'visualiser'])->name('communications.visualiser');


use App\Http\Controllers\Apprenant_adminController;
/*
|--------------------------------------------------------------------------
| ROUTES INFORMATIONS APPRENANTS REMPLI PAR LUI MEME
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/ajouterAP', [Apprenant_adminController::class, 'ajouter_apprenant']);
Route::get('/ajouterA/{id}', [Apprenant_adminController::class, 'ajouter_apprenant']);
Route::post('/ajouter/traitement', [Apprenant_adminController::class, 'ajouter_apprenant_traitement']);
Route::get('/updateA-apprenant/{id}', [Apprenant_adminController::class, 'update_apprenant']);
Route::post('/update/traitement', [Apprenant_adminController::class, 'update_apprenant_traitement']);

//route des examens
Route::get('/apprenant_liste_examen/{id}',[ApprenantController::class, 'liste_examen'])->name('apprenant.liste_examen');
Route::get('/apprenant_rendre_examen/{id_app}/{id_examen}',[ApprenantController::class, 'rendre'])->name('examen.rendre');
Route::post('/apprenant_do_rendre_examen/{id_app}/{id_examen}',[ApprenantController::class, 'do_rendre'])->name('examen.do_rendre');


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