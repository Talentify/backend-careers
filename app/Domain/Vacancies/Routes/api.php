<?php
Route::resource("api/vacancies", "VacancyController", ['except' => ['create', 'edit']]);