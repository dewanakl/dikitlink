<?php return array (
  0 => 
  array (
    'method' => 'GET',
    'path' => '/',
    'controller' => NULL,
    'function' => 'App\\Controllers\\LandingController',
    'middleware' => 
    array (
      0 => 'App\\Middleware\\GuestMiddleware',
    ),
    'name' => 'landing',
  ),
  1 => 
  array (
    'method' => 'GET',
    'path' => '/login',
    'controller' => 'App\\Controllers\\AuthController',
    'function' => 'login',
    'middleware' => 
    array (
      0 => 'App\\Middleware\\GuestMiddleware',
    ),
    'name' => 'login',
  ),
  2 => 
  array (
    'method' => 'POST',
    'path' => '/login',
    'controller' => 'App\\Controllers\\AuthController',
    'function' => 'auth',
    'middleware' => 
    array (
      0 => 'App\\Middleware\\GuestMiddleware',
    ),
    'name' => NULL,
  ),
  3 => 
  array (
    'method' => 'GET',
    'path' => '/register',
    'controller' => 'App\\Controllers\\AuthController',
    'function' => 'register',
    'middleware' => 
    array (
      0 => 'App\\Middleware\\GuestMiddleware',
    ),
    'name' => 'register',
  ),
  4 => 
  array (
    'method' => 'POST',
    'path' => '/register',
    'controller' => 'App\\Controllers\\AuthController',
    'function' => 'submit',
    'middleware' => 
    array (
      0 => 'App\\Middleware\\GuestMiddleware',
    ),
    'name' => NULL,
  ),
  5 => 
  array (
    'method' => 'GET',
    'path' => '/forget',
    'controller' => 'App\\Controllers\\AuthController',
    'function' => 'forget',
    'middleware' => 
    array (
      0 => 'App\\Middleware\\GuestMiddleware',
    ),
    'name' => 'forget',
  ),
  6 => 
  array (
    'method' => 'POST',
    'path' => '/forget',
    'controller' => 'App\\Controllers\\AuthController',
    'function' => 'send',
    'middleware' => 
    array (
      0 => 'App\\Middleware\\GuestMiddleware',
    ),
    'name' => NULL,
  ),
  7 => 
  array (
    'method' => 'GET',
    'path' => '/reset/([\\w-]*)',
    'controller' => 'App\\Controllers\\AuthController',
    'function' => 'reset',
    'middleware' => 
    array (
      0 => 'App\\Middleware\\GuestMiddleware',
    ),
    'name' => 'reset',
  ),
  8 => 
  array (
    'method' => 'GET',
    'path' => '/dashboard',
    'controller' => NULL,
    'function' => 'App\\Controllers\\DashboardController',
    'middleware' => 
    array (
      0 => 'App\\Middleware\\AuthMiddleware',
    ),
    'name' => 'dashboard',
  ),
  9 => 
  array (
    'method' => 'GET',
    'path' => '/list',
    'controller' => 'App\\Controllers\\DashboardController',
    'function' => 'list',
    'middleware' => 
    array (
      0 => 'App\\Middleware\\AuthMiddleware',
    ),
    'name' => 'list',
  ),
  10 => 
  array (
    'method' => 'GET',
    'path' => '/api/link',
    'controller' => 'App\\Controllers\\LinkController',
    'function' => 'show',
    'middleware' => 
    array (
      0 => 'App\\Middleware\\AuthMiddleware',
    ),
    'name' => 'show.link',
  ),
  11 => 
  array (
    'method' => 'POST',
    'path' => '/api/link',
    'controller' => 'App\\Controllers\\LinkController',
    'function' => 'create',
    'middleware' => 
    array (
      0 => 'App\\Middleware\\AuthMiddleware',
    ),
    'name' => 'create.link',
  ),
  12 => 
  array (
    'method' => 'GET',
    'path' => '/api/link/detail',
    'controller' => 'App\\Controllers\\LinkController',
    'function' => 'detail',
    'middleware' => 
    array (
      0 => 'App\\Middleware\\AuthMiddleware',
      1 => 'App\\Middleware\\NoPermissionMiddleware',
    ),
    'name' => 'detail.link',
  ),
  13 => 
  array (
    'method' => 'PUT',
    'path' => '/api/link',
    'controller' => 'App\\Controllers\\LinkController',
    'function' => 'update',
    'middleware' => 
    array (
      0 => 'App\\Middleware\\AuthMiddleware',
      1 => 'App\\Middleware\\NoPermissionMiddleware',
    ),
    'name' => 'update.link',
  ),
  14 => 
  array (
    'method' => 'DELETE',
    'path' => '/api/link',
    'controller' => 'App\\Controllers\\LinkController',
    'function' => 'delete',
    'middleware' => 
    array (
      0 => 'App\\Middleware\\AuthMiddleware',
      1 => 'App\\Middleware\\NoPermissionMiddleware',
    ),
    'name' => 'delete.link',
  ),
  15 => 
  array (
    'method' => 'GET',
    'path' => '/statistik',
    'controller' => 'App\\Controllers\\StatistikController',
    'function' => 'index',
    'middleware' => 
    array (
      0 => 'App\\Middleware\\AuthMiddleware',
    ),
    'name' => 'statistik',
  ),
  16 => 
  array (
    'method' => 'GET',
    'path' => '/statistik/download',
    'controller' => 'App\\Controllers\\StatistikController',
    'function' => 'download',
    'middleware' => 
    array (
      0 => 'App\\Middleware\\AuthMiddleware',
    ),
    'name' => 'statistik.download',
  ),
  17 => 
  array (
    'method' => 'GET',
    'path' => '/profile',
    'controller' => 'App\\Controllers\\ProfileController',
    'function' => 'index',
    'middleware' => 
    array (
      0 => 'App\\Middleware\\AuthMiddleware',
      1 => 'App\\Middleware\\TemaMiddleware',
    ),
    'name' => 'profile',
  ),
  18 => 
  array (
    'method' => 'PUT',
    'path' => '/profile',
    'controller' => 'App\\Controllers\\ProfileController',
    'function' => 'update',
    'middleware' => 
    array (
      0 => 'App\\Middleware\\AuthMiddleware',
      1 => 'App\\Middleware\\TemaMiddleware',
    ),
    'name' => NULL,
  ),
  19 => 
  array (
    'method' => 'GET',
    'path' => '/profile/avatar',
    'controller' => 'App\\Controllers\\ProfileController',
    'function' => 'avatar',
    'middleware' => 
    array (
      0 => 'App\\Middleware\\AuthMiddleware',
    ),
    'name' => 'avatar',
  ),
  20 => 
  array (
    'method' => 'GET',
    'path' => '/profile/log',
    'controller' => 'App\\Controllers\\ProfileController',
    'function' => 'log',
    'middleware' => 
    array (
      0 => 'App\\Middleware\\AuthMiddleware',
    ),
    'name' => 'log',
  ),
  21 => 
  array (
    'method' => 'PUT',
    'path' => '/profile/statistik',
    'controller' => 'App\\Controllers\\ProfileController',
    'function' => 'statistik',
    'middleware' => 
    array (
      0 => 'App\\Middleware\\AuthMiddleware',
    ),
    'name' => 'statistik.profile',
  ),
  22 => 
  array (
    'method' => 'POST',
    'path' => '/profile/delete',
    'controller' => 'App\\Controllers\\ProfileController',
    'function' => 'delete',
    'middleware' => 
    array (
      0 => 'App\\Middleware\\AuthMiddleware',
    ),
    'name' => 'hapus.profile',
  ),
  23 => 
  array (
    'method' => 'POST',
    'path' => '/profile/email',
    'controller' => 'App\\Controllers\\ProfileController',
    'function' => 'email',
    'middleware' => 
    array (
      0 => 'App\\Middleware\\AuthMiddleware',
      1 => 'App\\Middleware\\EmailMiddleware',
    ),
    'name' => 'email',
  ),
  24 => 
  array (
    'method' => 'GET',
    'path' => '/profile/email/([\\w-]*)',
    'controller' => 'App\\Controllers\\ProfileController',
    'function' => 'verify',
    'middleware' => 
    array (
      0 => 'App\\Middleware\\AuthMiddleware',
      1 => 'App\\Middleware\\EmailMiddleware',
    ),
    'name' => 'verify',
  ),
  25 => 
  array (
    'method' => 'DELETE',
    'path' => '/logout',
    'controller' => 'App\\Controllers\\AuthController',
    'function' => 'logout',
    'middleware' => 
    array (
      0 => 'App\\Middleware\\AuthMiddleware',
    ),
    'name' => 'logout',
  ),
  26 => 
  array (
    'method' => 'GET',
    'path' => '/admin/users',
    'controller' => 'App\\Controllers\\UsersController',
    'function' => 'index',
    'middleware' => 
    array (
      0 => 'App\\Middleware\\AuthMiddleware',
      1 => 'App\\Middleware\\AdminMiddleware',
    ),
    'name' => 'users',
  ),
  27 => 
  array (
    'method' => 'GET',
    'path' => '/admin/users/([\\w-]*)/detail',
    'controller' => 'App\\Controllers\\UsersController',
    'function' => 'detail',
    'middleware' => 
    array (
      0 => 'App\\Middleware\\AuthMiddleware',
      1 => 'App\\Middleware\\AdminMiddleware',
    ),
    'name' => NULL,
  ),
  28 => 
  array (
    'method' => 'DELETE',
    'path' => '/admin/users/([\\w-]*)/delete',
    'controller' => 'App\\Controllers\\UsersController',
    'function' => 'delete',
    'middleware' => 
    array (
      0 => 'App\\Middleware\\AuthMiddleware',
      1 => 'App\\Middleware\\AdminMiddleware',
    ),
    'name' => 'delete.users',
  ),
  29 => 
  array (
    'method' => 'GET',
    'path' => '/admin/stats',
    'controller' => 'App\\Controllers\\AdminController',
    'function' => 'index',
    'middleware' => 
    array (
      0 => 'App\\Middleware\\AuthMiddleware',
      1 => 'App\\Middleware\\AdminMiddleware',
    ),
    'name' => 'stats',
  ),
  30 => 
  array (
    'method' => 'GET',
    'path' => '/([\\w-]*)',
    'controller' => 'App\\Controllers\\StatistikController',
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
    'controller' => 'App\\Controllers\\StatistikController',
    'function' => 'click',
    'middleware' => 
    array (
    ),
    'name' => NULL,
  ),
);