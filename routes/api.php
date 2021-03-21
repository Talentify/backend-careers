<?php

Route::apiResource('apicompanies', 'api\CompanyController');

Route::apiResource('apirecruiters', 'api\RecruiterController');

Route::apiResource('apivacancies', 'api\VacancyController');
Route::get('myvacancies/{id}', 'api\VacancyController@myvacancies')->name('apimyvacancies');
Route::post('filtervacancies', 'api\VacancyController@filtervacancies')->name('filtervacancies');
