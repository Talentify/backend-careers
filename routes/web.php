<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//------------PROJETO VAGAS TALENTIFY-------------
Route::resource('/vagas', 'VagasController');
Route::get('/vagas/{vagaId}/vaga', 'VagasController@show');

Route::get('/logar', 'LogarController@index')->name('logar.index');
Route::post('/logar', 'LogarController@logar')->name('logar.logar');

Route::get('/registrar', 'RegistroController@create')->name('registro.create');
Route::post('/registrar', 'RegistroController@store')->name('registro.store');

Route::get('/sair', function () {

    \Illuminate\Support\Facades\Auth::logout();
    return redirect('/logar');
});











//-------------------metodo com o artisan automatico------------
Route::resource('produto', 'ProductController');


Route::get('/login', function () {
    return 'Login';
})->name('login');




//-------------- Trabalhando com namespace CONTROLLER-------------
// Route::middleware([])->group( function(){
//     Route::prefix('admin')->group( function(){
//         Route::namespace('Admin')->group( function(){
//             Route::name('admin.')->group( function(){
//                 Route::get('/', 'TesteController@teste')->name('home');
//                 Route::get('/controle', 'TesteController@teste')->name('controle');
//                 Route::get('/rh', 'TesteController@teste')->name('rh');
//             });
//         });
//     });
// });

//ou mais recomendado

/* Route::group([
    'middleware' => [],
    'prefix' => 'admin',
    'namespace' => 'Admin',
    'name' => 'admin.'
], function (){
    Route::get('/', 'TesteController@teste')->name('home');
    Route::get('/controle', 'TesteController@teste')->name('controle');
    Route::get('/rh', 'TesteController@teste')->name('rh');
}); */


//Route::get('/', 'TesteController@teste');




//--------------------Rotas utilizadas---------------
// trabalhando com os middleware
/* Route::get('/login', function () {
    return 'Login';
})->name('login');

//exeplo rota simples com middleware
Route::get('/admin/dashboard', function () {
    return 'Home Admin';
})->middleware('auth');

// exemplo qnd for grupo de rotas para autentcar "dentro de middleware pode usar um array ['auth', teste]"
Route::middleware([])->group( function(){
    Route::prefix('admin')->group( function(){
        Route::get('/dashboard', function () {
            return 'Home Admin';
        });

        Route::get('/produtos', function () {
            return 'Produtos';
        });

        Route::get('/financeiro', function () {
            return 'Area financeira';
        });

        Route::get('/painel', function () {
            return 'Painel';
        });
    });
});



// rotas com nomes
Route::get('/nome', function () {
    return redirect()->route('urlName');
});

Route::get('/nome-url', function () {
    return 'Redirecionado para esse rota (redirect1)';
})->name('urlName');

//view simples passando parametros, somente qnd for casos simples que não envolva segurança.
Route::view('/view', 'welcome', ['id' => 'teste']);


// Tipos de Redirecionamento de rotas
Route::redirect('/redirect1', '/redirect2');

// Route::get('/redirect1', function () {
//     return redirect('/redirect2');
// });

Route::get('/redirect2', function () {
    return 'Redirecionado para esse rota (redirect1)';
});
// redirecinamento fim


//Rotas com passagem de paramtros
Route::get('/categoria/produto/{id?}', function ($id = '') {
    return "O produto a ser trabalhado é : {$id}";
});

Route::get('/categoria/{flag}', function ($flag) {
    return "O produto a ser trabalhado é : {$flag}";
});
// fim rotas parametros

// rotas simples e tipos de rotas
Route::match(['post', 'get'], '/match', function () {
    return 'Aceita mais de um tipo de requisição';
});

Route::get('/contato', function () {
    return view('contato');
});

Route::any('/any', function () {
    return 'ANy';
});
// fim


Route::get('/', function () {
    return view('welcome');
}); */

