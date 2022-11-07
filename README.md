# files-api-challenge 

Este es mi solución para la prueba técnica de Avanzza - Backend Laravel.  

Se trata de una pequeña REST API para la gestión de archivos (ficheros). 

Autor: Brayan Cruces 

[![Run in Postman](https://run.pstmn.io/button.svg)](https://app.getpostman.com/run-collection/284044-adf24605-e28e-49d3-a349-934606548332?action=collection%2Ffork&collection-url=entityId%3D284044-adf24605-e28e-49d3-a349-934606548332%26entityType%3Dcollection%26workspaceId%3Dd183287f-eb53-41e2-8886-5d605b6940f4)

## Documentación REST API 

[Enlace a la documentación](https://documenter.getpostman.com/view/284044/2s8YYMmfEk)


### Endpoints abiertos

Endpoints que no requieren autenticación.


* [Login](https://documenter.getpostman.com/view/284044/2s8YYMmfEk#c848d3e3-550f-4722-94ba-592c20415338) : `POST /api/auth/login`
* [Registro](https://documenter.getpostman.com/view/284044/2s8YYMmfEk#12de5275-ed3b-4734-8609-3bc0135719ed) : `POST /api/auth/register`

### Endpoints con Autenticacion (Bearer token)

Endpoints cerrados que requieren en la cabecera el Bearer Token para funcionar. 


* [Crear nuevo fichero](https://documenter.getpostman.com/view/284044/2s8YYMmfEk#19899850-3879-4b90-9a95-67233309ae27) : `POST /api/files/`
* [Listar archivos/ficheros](https://documenter.getpostman.com/view/284044/2s8YYMmfEk#8fadc7be-2725-41f1-bbd0-a0a720fc74df) : `GET /api/files/`
* [Mostrar detalle de fichero](https://documenter.getpostman.com/view/284044/2s8YYMmfEk#9af6e6c7-bfd6-4abb-b0c1-8b2e8652f0e9) : `GET /api/files/{id}`
* [Eliminar fichero](https://documenter.getpostman.com/view/284044/2s8YYMmfEk#e4f511ce-5743-4d5c-af7e-bc9060dc823b) : `DELETE /api/files/{id}`
* [Subir ficheros de forma masiva](https://documenter.getpostman.com/view/284044/2s8YYMmfEk#9579141a-5d0d-454d-a5ad-264defbd56ce) : `DELETE /api/files/bulk`

## Características 


✅ Creación de usuario

✅ Logueo de usuario para obtener Auth Token 

✅ Subida de ficheros

✅ Listado de ficheros

✅ Eliminado de ficheros

✅ Subida de ficheros de forma masiva (bulk)

## Requerimientos 

- PHP 8.1 ^
- Laravel 9 ^


## Configuraciones 

Dentro del proyecto se han dejado algunas variables a personalizar dentro del .env tales como: Máximo de tamaño de archivos, directorio de archivos, Rate limit para invitado y usuarios. 

```
FILES_API_FOLDER=avanzza
FILES_API_MAX_SIZE_FILE=500 
FILES_API_MAX_REQ_PER_MIN_GUEST=3  
FILES_API_MAX_REQ_PER_MIN_USER=3 

```



## Instalación

1- Descargar o importar 

2- Ejecutar: composer install 

3- Ejecutar: php artisan serve

 





