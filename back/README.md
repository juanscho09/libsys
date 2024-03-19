# Nombre del Proyecto: LibSys Admin

Sistema para la gestión de biblioteca

## Requisitos

```bash
PHP 8.0.2
MySQL: 5.7.31
Apache: 2.4.46

Laravel: 9.19
Composer 2.2.21
```

## Instalación

1. Clona este repositorio.
2. Crear una base de datos
3. Crear vendor
    ```
    composer install
    ```
4. Configurar la conexion a la DB en el archivo **.env** tomar de ejemplo **.env.example**
Ejemplo:
    ```
    DB_CONNECTION=mysql
    DB_HOST=mysql
    DB_PORT=3306
    DB_DATABASE=library_admin
    DB_USERNAME=root
    DB_PASSWORD=11235813
    ```
5. Crear una cuenta en mailtrap y configurarlo
    ```
    MAIL_MAILER=smtp
    MAIL_HOST=sandbox.smtp.mailtrap.io
    MAIL_PORT=2525
    MAIL_USERNAME=1111111
    MAIL_PASSWORD=0000000
    MAIL_ENCRYPTION=null
    MAIL_FROM_ADDRESS="hello@biblioteca.com"
    MAIL_FROM_NAME="Biblioteca"
    ```
6. Dar permisos de escritura a las carpetas (si corresponde):
    ```
    ./storage/logs
    ./storage/framework/sessions
    ```
7. Crear el directorio:
    ```
    ./public/storage
    ```
8. Generar las claves de encriptación
    ```
    php artisan key:generate
    ```
9. Ejecutar comandos para borrar cache después de haber configurado el .env
    ```
    php artisan route:clear
    php artisan view:clear
    php artisan config:cache
    ```
10. Ejecutar comando para levantar la base y cargar datos:
    ```
    php artisan migrate
    php artisan db:seed
    ```
11. Una vez que se ejecuten los seeders, hay un usuario seteado para poder acceder. Los otros usuarios tienen el mismo password.
    ```
    usuario: jjct_@hotmail.com
    password: 11235813
    ``` 


### Opcional:

Se puede generar un virtualhost en windows para acceder al sistema.

- Agregar virtual host en Windows
```
C:\Windows\System32\drivers\etc\hosts --> 127.0.0.1 libsys.local
```
- Agregar la configuración en wamp
Realizarlo en la ruta donde se guarda el wamp: C:\wamp64\bin\apache\apache2.4.46\conf\extra
```
<VirtualHost *:80>
    DocumentRoot "${INSTALL_DIR}/www/"
    ServerName localhost
</VirtualHost>
<VirtualHost *:80>
   ServerName libsys.local
   DocumentRoot "${INSTALL_DIR}/www/library_admin/public"
   <Directory "${INSTALL_DIR}/www/library_admin/public">
       AllowOverride All
       Options Indexes FollowSymLinks
       Allow from all
       Require all granted
   </Directory>
</VirtualHost>
```

#### Tener encuenta:
- Si realiza este cambio, deberá modificar las rutas tanto acá en el backend, como en la aplicación frontend. 
    - En backend deberá modificarse lo siguiente:
        ```
        APP_URL=http://libsys.local
        ```
    - En frontend deberá modificarse el archivo environment.ts:
        ```
        export const environment = {
            production: false,
            api: 'http://libsys.local/api/'
        };
        ```
