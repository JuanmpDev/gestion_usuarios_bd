<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="gestion_usuarios",
 *      description="Proyecto API REST hecho en Laravel para la gestión de usuarios de una base de datos MySQL",
 *      @OA\Contact(
 *          email="juanmanuel.pernia@ara-tech.es"
 *      ),
 *      @OA\License(
 *         name="Apache 2.0",
 *         url="https://www.apache.org/licenses/LICENSE-2.0.html"
 *     ),
 *      x={
 *          "logo": {
 *              "url": "https://via.placeholder.com/190x90.png?text=L5-Swagger"
 *          }
 *      }
 * )
 *
 * @OA\Server(url="http://127.0.0.1:80/gestion_usuarios/public/"),
 *
 * @OA\SecurityScheme(
 *     type="http",
 *     description="API Key Auth",
 *     name="Token based Based",
 *     in="header",
 *     scheme="bearer",
 *     bearerFormat="JWT",
 *     securityScheme="apiAuth",
 * )
 */



class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
