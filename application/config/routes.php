<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$route['default_controller'] = "system/dashboard";
$route['404_override'] = 'system/notfound';

/* System - Login */
$route['login'] = "system/login";
$route['logoff'] = "system/logoff";
$route['password/new'] = "system/passwordNew";
$route['password/edit'] = "system/passwordEdit";

/* System - Usuários */
$route['sistema/usuarios/cadastrar'] = "sistema/usuarioscadastrar";
$route['sistema/usuarios/editar/(:num)'] = "sistema/usuarioseditar/$1";
$route['sistema/usuarios/editar/self'] = "sistema/usuarioseditar/self";
$route['sistema/usuarios/search'] = "sistema/search";
$route['sistema/usuarios/search/(:any)'] = "sistema/search/$1";
$route['sistema/usuarios/search/(:any)/(:num)'] = "sistema/search/$1/$2";
$route['sistema/usuarios/remover/(:num)'] = "sistema/usuariosremover/$1";
$route['sistema/usuarios/trocar-senha/(:num)'] = "sistema/changePassword/$1";
$route['sistema/usuarios/trocar-senha/self'] = "sistema/changePassword/self";
