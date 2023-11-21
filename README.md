# VacationRental

Este es un sistema de reservas de habitaciones de hotel desarrollado en PHP. Permite a los clientes realizar reservas de habitaciones de hotel y a los administradores gestionar esas reservas.

## Video Explicación Entrega 1

- https://udistritaleduco.sharepoint.com/:v:/s/AnlisisSocialColombiano302/EY5BVlKKH4tKhDFIGgydQWcBHdhZliI4sn7LhOYl2R1EFA?e=VrHTzQ

## Video Explicación Entrega Final (Apps para internet)

- https://udistritaleduco.sharepoint.com/:v:/s/AnlisisSocialColombiano302/EdpVwiMorzpFjg30yCeqBGIBw-Zm8YYA5OIqYQASoLDTsw?nav=eyJyZWZlcnJhbEluZm8iOnsicmVmZXJyYWxBcHAiOiJTdHJlYW1XZWJBcHAiLCJyZWZlcnJhbFZpZXciOiJTaGFyZURpYWxvZy1FbWFpbCIsInJlZmVycmFsQXBwUGxhdGZvcm0iOiJXZWIiLCJyZWZlcnJhbE1vZGUiOiJ2aWV3In19&e=elQR2Q

## Características

- Registro de usuarios: Los usuarios pueden registrarse en el sistema.
- Inicio de sesión: Los usuarios pueden iniciar sesión con sus credenciales.
- Recuperar contraseña: Los usuarios que no recuerden su contraseña podrán recuperarla a traves de correo electronico.
- Reserva de habitaciones: Los usuarios pueden reservar habitaciones y especificar sus preferencias.
- Administración de reservas: Los administradores pueden ver y gestionar las reservas realizadas por los clientes.
- Gestión de habitaciones: Los administradores pueden agregar, editar y eliminar habitaciones.

## Requisitos

- PHP 7.0 o superior
- MySQL 5.6 o superior
- Un servidor web (por ejemplo, Apache)
- Composer (para la gestión de dependencias)
- PaperCut SMTP (como servidor SMTP)

## Instalación

1. Clona este repositorio en tu servidor web local o en un servidor en línea:

```shell
git clone [https://github.com/Win1125/Hotel.git]
```

2. Configura la base de datos: Importa el archivo SQL proporcionado en la carpeta `config` para crear las tablas necesarias en tu base de datos MySQL.

3. Configura las credenciales de la base de datos: Abre el archivo `config.php` y modifica las variables para establecer la conexión con tu base de datos:

```php
$host = "localhost";
$dbname = "nombre_de_la_base_de_datos";
$username = "tu_usuario_de_mysql";
$password = "tu_contraseña_de_mysql";
```

4. Instala las dependencias usando Composer:

```shell
composer install
```

## Uso

1. Accede al sistema a través de tu navegador web.

2. Los usuarios pueden registrarse o iniciar sesión.

3. Los usuarios pueden buscar habitaciones disponibles y realizar reservas.

4. Los administradores pueden acceder a la sección de administración y gestionar las reservas y las habitaciones.

## Licencia

Este proyecto está bajo la licencia MIT. Consulta el archivo [LICENSE](LICENSE) para obtener más información.

## Autor

- [Edwin Fandiño Salazar](https://github.com/Win1125)
- Laura Daniela Aponte Beltran
- Luz Nidian Lasso Chavarro
- Juan José cita
---
