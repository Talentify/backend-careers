<?php

Route::resource('users', 'UserController')
    ->only(['index', 'create', 'show']);
