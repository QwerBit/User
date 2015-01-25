<?php

Route::filter('user.auth', function() {
    if (Auth::guest()) {
        if (Request::ajax()) {
            return Response::make('Unauthorized', 401);
        } else {
            return Redirect::route('user.login');
        }
    }
});


Route::filter('user.is_auth', function() {
    if (Auth::check()) {
        if (Request::ajax()) {
            return Response::make('Unauthorized', 401);
        } else {
            return Redirect::route('user.profile');
        }
    }
});