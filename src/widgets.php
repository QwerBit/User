<?php

View::composer('user::mail.reg', function($view) {
  $view->with('title', 'Загаловок');
  $view->with('site_name', 'Название сайта');
});