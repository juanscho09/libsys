# LibSys Admin

Sistema para la gestión de biblioteca

## Requisitos

Encontrarás este detalle en el readme del frontend y del backend
Frontend: Angular
Backend: Laravel
Base de Datos: MySql
Servidor: Apache para laravel, Nginx para angular

## Instalación

1. Clona este repositorio.
2. Crear el archivo de entorno (.env) desde el archivo de entorno que viene como ejemplo (.env.example) en el proyecto de backend
    ```
    cp .env.example .env
    ```
3. Completar los datos importantes, tanto de conexión a la base, como del servidor de mail:
    ```
    APP_URL=http://127.0.0.1:8080/public/

    DB_CONNECTION=mysql
    DB_HOST=libsys_mysql
    DB_PORT=3306
    DB_DATABASE=libsysdb
    DB_USERNAME=root
    DB_PASSWORD=11235813

    MAIL_MAILER=smtp
    MAIL_HOST=sandbox.smtp.mailtrap.io
    MAIL_PORT=2525
    MAIL_USERNAME=1111111
    MAIL_PASSWORD=0000000
    MAIL_ENCRYPTION=null
    MAIL_FROM_ADDRESS="hello@biblioteca.com"
    MAIL_FROM_NAME="Biblioteca"
    ```
    
    Tener en cuenta que para trabajar con mailtrap, debe obtener una cuenta y podrá ver todos los envíos que se vayan ejecutando.
    También tener en cuenta que para completar el valor de "DB_HOST", tiene que ver con el nombre dle contenedor de la base de datos, en el caso configurado: libsys_mysql.

4.  En el front lo que se debe configurar es lo siguiente: el archivo environment.prod.ts, debería tener la ruta a la cuál va a     acceder a la api:
    ```
    export const environment = {
        production: true,
        api: 'http://127.0.0.1:8080/public/api'
    };
    ```

5. Crear el archivo .env si no existe en la carpeta raíz. Nuevamente, se puede copiar de .env.example para ver los datos que necesitamos, luego hay que ponerles los datos correctos. Probablemente ya venga con el proyecto, verificar si son los valores correctos:
    ```
    PROJECT_NAME=libsys

    MYSQL_PASSWORD=local
    MYSQL_DB=libsysdb
    MYSQL_PASS_ROOT=local
    ```
6. Correr el comando deploy.sh, ubicado en /docker/bin/, esto va a hacer el build correspondiente, además de levantar el contenedor.
    ```
    deploy.sh
    ```
7. Correr el comando initback.sh, ubicado también en /docker/bin/, y este se encargará de inicialiar el proyecto, además de la base de datos.
    ```
    initback.sh
    ```
8. Una vez realizado todo lo anterior, se levantará cada servicio (front y back) en un puerto distinto cada uno:
    ```
    Frontend -> http://127.0.0.1:8088
    Backend -> http://127.0.0.1:8080/public/api
    ```
9. Pude usar los siguientes datos para ingresar al sistema:
    ```
    usuario: jjct_@hotmail.com
    password: 11235813
    ```


### Posibles fallos:
- Puede que cuando este ejecutando el primer comando (deploy.sh), obtenga errores en el proceso del "build", se puede dar ya que la conexión es débil y no permite una descarga completa de las librerías de node_modules. Como solución a esto, volver a ejecutar el código, y no tendrá problemas.

- Si ejecuta dos veces seguidas el comando de inicializar el proyecto (initback.sh), puede que le de error, ya que hay un usuario que se agrega para que pueda probar el sistema, entonces repetir este comando hará que se quiera agregar este mismo usuario, pero al haber validación a nivel de tablas, donde no puede haber personas con el mismo mail, resultará en la interrupción del comando y no continuará la ejecución, mostrando un error de validación.


#### Comandos a tener en cuenta de docker:
- Hará el build:
    ```
    docker-compose build
    ```
- Levantará el contenedor:
    ```
    docker-compose up -d
    ```
- Parará el contenedor:
    ```
    docker-compose down
    ```
- Ver contenedores activos:
    ```
    docker ps
    ```
- Acceder a un contenedor:
    ```
    docker exec -i -t <nombre_contenedor> /bin/bash
    ```

#### Tener en cuenta si se agrega dominio:
- Si realiza un cambio de dominio, deberá modificar las rutas tanto acá en el backend, como en la aplicación frontend. 
    - En backend deberá modificarse lo siguiente:
        ```
        APP_URL=http://libsys-back.local
        ```
    - En frontend deberá modificarse el archivo environment.prod.ts:
        ```
        export const environment = {
            production: true,
            api: 'http://libsys-back.local/api/'
        };
        ```
