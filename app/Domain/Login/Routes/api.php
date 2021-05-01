<?php
Route::resource("api/login", "LoginController", ['only' => ['store']]);