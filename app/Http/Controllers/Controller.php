<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * Clase Controller
 * 
 * Esta clase sirve como clase base para todos los controladores en la aplicación Laravel.
 * Extiende BaseController y utiliza traits para autorización y validación de solicitudes.
 */
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}