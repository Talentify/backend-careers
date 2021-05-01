<?php
Route::resource("api/recruiters", "RecruiterController", ['except' => ['create', 'edit']]);