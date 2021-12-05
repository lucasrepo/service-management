<?php

require 'vendor/autoload.php';
require 'UserController.php';

use eftec\bladeone\BladeOne;

/* Guarda el json en un array */
$users = new UserController(json_decode(file_get_contents('json/content.json'), true));
$blade = new BladeOne();

switch(json_last_error()) {
    case JSON_ERROR_NONE:
        echo $blade->run("app", [
			'tags' => $users->filter("tag"),
			'users' => $users->content,
			'social_media' => $users->getSocialMedia()
		]);
    break;
    case JSON_ERROR_DEPTH:
        echo 'Excedido tamaño máximo de la pila';
    break;
    case JSON_ERROR_STATE_MISMATCH:
        echo 'Desbordamiento de buffer o los modos no coinciden';
    break;
    case JSON_ERROR_CTRL_CHAR:
        echo 'Encontrado carácter de control no esperado';
    break;
    case JSON_ERROR_SYNTAX:
        echo 'Error de sintaxis, JSON mal formado';
    break;
    case JSON_ERROR_UTF8:
        echo 'Caracteres UTF-8 malformados, posiblemente codificados de forma incorrecta';
    break;
    default:
        echo 'Json: Error desconocido';
    break;
}