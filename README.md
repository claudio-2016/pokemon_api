# POKEMON 

API REST relacionada con las cartas de Pokémon que permite ser consumida desde un Front-end o una App con las siguientes acciones:
Crear una carta.

- Actualizar una carta.
- Devolver una carta.
- Devolver todas las cartas.
- Borrar una carta.

La API ofrece diferentes endpoints para cumplir con las acciones ABM, a su vez se decidió incorporar algunas más para facilitar la configuración inicial del servicio y obtener 5 usuarios con los cuales poder interactuar ya que el acceso al uso del servicio está restringido por un token de seguridad.



## Configuración

El proyecto está preparado para correr en contenedores, si ya cuenta con Docker instalado solo debe ejecutar los siguientes comandos dentro del directorio del proyecto clonado.


### Paso 1 

Iniciar los contenedores:

docker compose up -d

Si desea detener los servicios:

docker compose down


### Paso 2

Es necesario correr las migraciones de Laravel para la generación de las diferentes tablas y carga de datos. Este proceso se encuentra automatizado, por lo tanto no es necesario ingresar al contenedor para interactuar con artisan. Solo debe usar los siguiente endpoints en el orden indicado, se adjunta enlace con la documentación de los mismo en donde encontrará más detalles como ejemplos de solicitud y lo que se espera como retorno.

Recuerde modificar el host de los endpoints, por defecto es http://localhost en el puerto 80, y la contraseña por defecto para todos los usuarios es: password

Orden de los endpoints por nombre:

1 config: es el encargado de realizar toda la configuración necesaria.

2 todos los usuarios: devuelve todos los usuarios generados automáticamente, si desea regenerar todos los usuarios puede volver a invocar el endpoint ‘config’ que hace un refresh total reiniciando todo.

3 login: es el encargado de retornar el token para luego poder generar las cartas

IMPORTANTE: Una vez obtenido el token debe agregarlo a Postman en la sección ‘Authorization’ -> ‘Type’ -> ‘Bearer Token’


[Documentacion y ejemplos.](https://documenter.getpostman.com/view/15018307/2s9YsT6oZN)