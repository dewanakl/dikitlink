<?php return array (
  0 => 
  array (
    'method' => 'GET',
    'path' => '/',
    'controller' => NULL,
    'function' => 'Controllers\\LandingController',
    'middleware' => 
    array (
      0 => 'Middleware\\GuestMiddleware',
    ),
    'name' => 'landing',
  ),
  1 => 
  array (
    'method' => 'GET',
    'path' => '/login',
    'controller' => 'Controllers\\AuthController',
    'function' => 'login',
    'middleware' => 
    array (
      0 => 'Middleware\\GuestMiddleware',
    ),
    'name' => 'login',
  ),
  2 => 
  array (
    'method' => 'POST',
    'path' => '/login',
    'controller' => 'Controllers\\AuthController',
    'function' => 'auth',
    'middleware' => 
    array (
      0 => 'Middleware\\GuestMiddleware',
    ),
    'name' => NULL,
  ),
  3 => 
  array (
    'method' => 'GET',
    'path' => '/register',
    'controller' => 'Controllers\\AuthController',
    'function' => 'register',
    'middleware' => 
    array (
      0 => 'Middleware\\GuestMiddleware',
    ),
    'name' => 'register',
  ),
  4 => 
  array (
    'method' => 'POST',
    'path' => '/register',
    'controller' => 'Controllers\\AuthController',
    'function' => 'submit',
    'middleware' => 
    array (
      0 => 'Middleware\\GuestMiddleware',
    ),
    'name' => NULL,
  ),
  5 => 
  array (
    'method' => 'GET',
    'path' => '/forget',
    'controller' => 'Controllers\\AuthController',
    'function' => 'forget',
    'middleware' => 
    array (
      0 => 'Middleware\\GuestMiddleware',
    ),
    'name' => 'forget',
  ),
  6 => 
  array (
    'method' => 'POST',
    'path' => '/forget',
    'controller' => 'Controllers\\AuthController',
    'function' => 'send',
    'middleware' => 
    array (
      0 => 'Middleware\\GuestMiddleware',
    ),
    'name' => NULL,
  ),
  7 => 
  array (
    'method' => 'GET',
    'path' => '/reset/([\\w-]*)',
    'controller' => 'Controllers\\AuthController',
    'function' => 'reset',
    'middleware' => 
    array (
      0 => 'Middleware\\GuestMiddleware',
    ),
    'name' => 'reset',
  ),
  8 => 
  array (
    'method' => 'GET',
    'path' => '/dashboard',
    'controller' => NULL,
    'function' => 'Controllers\\DashboardController',
    'middleware' => 
    array (
      0 => 'Middleware\\AuthMiddleware',
    ),
    'name' => 'dashboard',
  ),
  9 => 
  array (
    'method' => 'GET',
    'path' => '/list',
    'controller' => 'Controllers\\DashboardController',
    'function' => 'list',
    'middleware' => 
    array (
      0 => 'Middleware\\AuthMiddleware',
    ),
    'name' => 'list',
  ),
  10 => 
  array (
    'method' => 'GET',
    'path' => '/api/link/show',
    'controller' => 'Controllers\\LinkController',
    'function' => 'show',
    'middleware' => 
    array (
      0 => 'Middleware\\AuthMiddleware',
    ),
    'name' => 'show.link',
  ),
  11 => 
  array (
    'method' => 'GET',
    'path' => '/api/link/detail',
    'controller' => 'Controllers\\LinkController',
    'function' => 'detail',
    'middleware' => 
    array (
      0 => 'Middleware\\AuthMiddleware',
    ),
    'name' => 'detail.link',
  ),
  12 => 
  array (
    'method' => 'POST',
    'path' => '/api/link/create',
    'controller' => 'Controllers\\LinkController',
    'function' => 'create',
    'middleware' => 
    array (
      0 => 'Middleware\\AuthMiddleware',
    ),
    'name' => 'create.link',
  ),
  13 => 
  array (
    'method' => 'PUT',
    'path' => '/api/link/update',
    'controller' => 'Controllers\\LinkController',
    'function' => 'update',
    'middleware' => 
    array (
      0 => 'Middleware\\AuthMiddleware',
    ),
    'name' => 'update.link',
  ),
  14 => 
  array (
    'method' => 'DELETE',
    'path' => '/api/link/delete',
    'controller' => 'Controllers\\LinkController',
    'function' => 'delete',
    'middleware' => 
    array (
      0 => 'Middleware\\AuthMiddleware',
    ),
    'name' => 'delete.link',
  ),
  15 => 
  array (
    'method' => 'GET',
    'path' => '/statistik',
    'controller' => 'Controllers\\StatistikController',
    'function' => 'index',
    'middleware' => 
    array (
      0 => 'Middleware\\AuthMiddleware',
    ),
    'name' => 'statistik',
  ),
  16 => 
  array (
    'method' => 'GET',
    'path' => '/statistik/download',
    'controller' => 'Controllers\\StatistikController',
    'function' => 'download',
    'middleware' => 
    array (
      0 => 'Middleware\\AuthMiddleware',
    ),
    'name' => 'statistik.download',
  ),
  17 => 
  array (
    'method' => 'GET',
    'path' => '/profile',
    'controller' => 'Controllers\\ProfileController',
    'function' => 'index',
    'middleware' => 
    array (
      0 => 'Middleware\\AuthMiddleware',
    ),
    'name' => 'profile',
  ),
  18 => 
  array (
    'method' => 'PUT',
    'path' => '/profile',
    'controller' => 'Controllers\\ProfileController',
    'function' => 'update',
    'middleware' => 
    array (
      0 => 'Middleware\\AuthMiddleware',
    ),
    'name' => NULL,
  ),
  19 => 
  array (
    'method' => 'GET',
    'path' => '/profile/avatar',
    'controller' => 'Controllers\\ProfileController',
    'function' => 'avatar',
    'middleware' => 
    array (
      0 => 'Middleware\\AuthMiddleware',
    ),
    'name' => 'avatar',
  ),
  20 => 
  array (
    'method' => 'GET',
    'path' => '/profile/log',
    'controller' => 'Controllers\\ProfileController',
    'function' => 'log',
    'middleware' => 
    array (
      0 => 'Middleware\\AuthMiddleware',
    ),
    'name' => 'log',
  ),
  21 => 
  array (
    'method' => 'PUT',
    'path' => '/profile/statistik',
    'controller' => 'Controllers\\ProfileController',
    'function' => 'statistik',
    'middleware' => 
    array (
      0 => 'Middleware\\AuthMiddleware',
    ),
    'name' => 'statistik.profile',
  ),
  22 => 
  array (
    'method' => 'POST',
    'path' => '/profile/delete',
    'controller' => 'Controllers\\ProfileController',
    'function' => 'delete',
    'middleware' => 
    array (
      0 => 'Middleware\\AuthMiddleware',
    ),
    'name' => 'hapus.profile',
  ),
  23 => 
  array (
    'method' => 'POST',
    'path' => '/profile/email',
    'controller' => 'Controllers\\ProfileController',
    'function' => 'email',
    'middleware' => 
    array (
      0 => 'Middleware\\AuthMiddleware',
      1 => 'Middleware\\EmailMiddleware',
    ),
    'name' => 'email',
  ),
  24 => 
  array (
    'method' => 'GET',
    'path' => '/profile/email/([\\w-]*)',
    'controller' => 'Controllers\\ProfileController',
    'function' => 'verify',
    'middleware' => 
    array (
      0 => 'Middleware\\AuthMiddleware',
      1 => 'Middleware\\EmailMiddleware',
    ),
    'name' => 'verify',
  ),
  25 => 
  array (
    'method' => 'DELETE',
    'path' => '/logout',
    'controller' => 'Controllers\\AuthController',
    'function' => 'logout',
    'middleware' => 
    array (
      0 => 'Middleware\\AuthMiddleware',
    ),
    'name' => 'logout',
  ),
  26 => 
  array (
    'method' => 'GET',
    'path' => '/admin/users',
    'controller' => 'Controllers\\UsersController',
    'function' => 'index',
    'middleware' => 
    array (
      0 => 'Middleware\\AuthMiddleware',
      1 => 'Middleware\\AdminMiddleware',
    ),
    'name' => 'users',
  ),
  27 => 
  array (
    'method' => 'GET',
    'path' => '/admin/users/([\\w-]*)/detail',
    'controller' => 'Controllers\\UsersController',
    'function' => 'detail',
    'middleware' => 
    array (
      0 => 'Middleware\\AuthMiddleware',
      1 => 'Middleware\\AdminMiddleware',
    ),
    'name' => NULL,
  ),
  28 => 
  array (
    'method' => 'DELETE',
    'path' => '/admin/users/([\\w-]*)/delete',
    'controller' => 'Controllers\\UsersController',
    'function' => 'delete',
    'middleware' => 
    array (
      0 => 'Middleware\\AuthMiddleware',
      1 => 'Middleware\\AdminMiddleware',
    ),
    'name' => 'delete.users',
  ),
  29 => 
  array (
    'method' => 'GET',
    'path' => '/admin/stats',
    'controller' => 'Controllers\\AdminController',
    'function' => 'index',
    'middleware' => 
    array (
      0 => 'Middleware\\AuthMiddleware',
      1 => 'Middleware\\AdminMiddleware',
    ),
    'name' => 'stats',
  ),
  30 => 
  array (
    'method' => 'GET',
    'path' => '/([\\w-]*)',
    'controller' => 'Controllers\\StatistikController',
    'function' => 'click',
    'middleware' => 
    array (
    ),
    'name' => 'click',
  ),
  31 => 
  array (
    'method' => 'POST',
    'path' => '/([\\w-]*)',
    'controller' => 'Controllers\\StatistikController',
    'function' => 'click',
    'middleware' => 
    array (
    ),
    'name' => NULL,
  ),
);