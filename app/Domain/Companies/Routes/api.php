<?php
Route::resource("api/companies", "CompanyController", ['except' => ['create', 'edit']]);