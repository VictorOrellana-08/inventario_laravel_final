REQUISITOS PARA EL CORRECTO FUNCIONAMIENTO DEL SISTEMA INVENTARIO LARAVEL.

1º TENER INSTALADO LARAVEL, COMPOSER, NODEJS, XAMPP(Si no se cuenta con ninguno, se proporcionará los comandos de instalación).

PARA EJECUTAR CADA UNO DE ESTOS COMANDOS, ABRIR EL "Simbolo de Sistema".

COMANDO PARA INSTALAR LARAVEL -->> composer global require laravel/installer

ENLACE PARA INSTALAR COMPOSER -->> https://getcomposer.org/download/ 
    Instalar la última versión de COMPOSER -->>  Composer-Setup.exe
    Una vez descargado, da doble click sobre él y darle Next a todo.
    Para verificar que se instalo correctamente abrir el MCD y ejecutar el comando: composer --version

ENLACE PARA INSTALAR NODEJS -->> https://nodejs.org/en
    Descargar la última versión, una vez descargado, da doble click sobre él y darle Next a todo.
    Para verificar que se instalo correctamente abrir el MCD y ejecutar el comando: npm --version

ENLACE PARA DESCARGAR XAMPP -->> https://www.apachefriends.org/es/download.html

ENLACE PARA DESCARGAR VISUAL STUDIO CODE (VSC) -->> https://code.visualstudio.com/
    Dicho programa nos sirve para poder observar todo el código fuente del sistema.


COMPLETADO TODOS LOS PASOS ANTERIORES PASAMOS AL PASO 2.

2º INSTALAR PAQUETES, DEPENDENCIAS, BASE DE DATOS (Esto se hace cuando se halla descargado el sistema de GitHub)

2.1 Instalar las dependencias del proyecto que están definidas en el archivo "package.json" con el siguiente comando -->> npm install

2.2 Ejecutamos el siguiente comando -->> npm run dev 
    Laravel utiliza Laravel Mix, que es una capa de abstracción sobre Webpack, para compilar los assets.

2.3 - PRIMERO CONFIGURAMOS LA BASE DE DATOS.
2.3.1 Creamos un archivo .env en nuevo archivo, una vez creada accedemos al archivo .env.example copiamos todo lo que contiene dicho archivo y lo pegamos en que acabamos de crear.

    Completado esto nos dirigimos a la Línea 14 -->> DB_DATABASE=laravel está línea es donde colocamos el nombre de nuestra base de datos por ejemplo: DB_DATABASE=name_my_database. COMPLETADO ESTO .

    ABRIMOS XAMPP Y EJECUTAMOS "MySQL" ACCEDEMOS AL SIGUIENTE ENLACE: http://localhost/phpmyadmin/index.php
    Creamos una nueva base de datos con el nombre que se colo anteriormente en la línea 14.
    Una vez completado el paso anterior, ejecutamos el siguiente comando para migrar nuestras tablas 
    -->> php artisan migrate

    Si este comando no, nos funciona ejecutamos los siguientes comandos.
    -->> composer update --no-scripts
    -->> composer update
    Ejecutamos nuevamente el comando anterior -->> php artisan migrate
    -->> php artisan key:generate

3º COMPLETADOS TODOS LOS PASOS ANTERIORES, PROCEDEMOS A EJECUTAR NUESTRO SISTEMA.
    Ejecutamos el suguiente comando -->> php artisan serve

    Si todo funciona correctamente nos aparece lo siguiente.

        Starting Laravel development server: http://127.0.0.1:8000
        [Wed May 31 15:22:26 2023] PHP 7.4.27 Development Server (http://127.0.0.1:8000) started

    Damos click o copiamos la URL que nos muestra y la ejecutamos en el navegador.

4º SI TODO FUNCIONA CORRECTAMENTE ESTE NOS MOSTRARÁ UN INICIO DE LARAVEL. ANTES DE ACCEDER AL SISTEMA DEBEMOS CREAR UN NUEVO USUARIO. PARA ESO DAREMOS CLICK EN "REGISTRARSE" CREAMOS UN NUEVO USUARIO Y CONTRASEÑA, CON ESTO PODREMOS ACCEDER AL SISTEMA.