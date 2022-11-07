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
    'max_size_file' => env('FILES_API_MAX_SIZE_FILE'), # Limite de archivo En Kilobytes
    'max_requests_guests' => intval(env('FILES_API_MAX_REQ_PER_MIN_GUEST')), // Limite por minuto (invitados)
    'max_requests_users' => intval(env('FILES_API_MAX_REQ_PER_MIN_USER')) // Limite por minuto (usuarios)
];