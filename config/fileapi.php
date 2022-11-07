<?php

return [

    /*
    |--------------------------------------------------------------------------
    | File API Configs
    |--------------------------------------------------------------------------
    |
    | Aqui se pueden editar ciertas condiguracion de la API de ficheros
    |
    */

    'folder' => env('FILES_API_FOLDER'),
    'max_size' => env('FILES_API_MAX_SIZE_FILE'), # Limite de archivo En Kilobytes
    'max_requests_guests' => env('FILES_API_MAX_REQ_PER_MIN_GUEST'), // Limite por minuto (invitados)
    'max_requests_users' => env('FILES_API_MAX_REQ_PER_MIN_USER') // Limite por minuto (usuarios)
];