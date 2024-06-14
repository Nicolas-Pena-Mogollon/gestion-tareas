# Gestión de Tareas - Aplicación Web

Este proyecto es una aplicación web de gestión de tareas (To-Do List) desarrollada en PHP utilizando Laravel. Permite a los usuarios registrar tareas, marcarlas como completadas, y filtrarlas según su estado.

## Funcionalidades

- Registro e inicio de sesión de usuarios.
- Creación, edición y eliminación de tareas.
- Marcar tareas como completadas.
- Filtrar tareas por completadas y no completadas.

## Requisitos Técnicos

- **PHP Version**: 8.2.12
- **Framework**: Laravel 11.9
- **Composer**
- **Base de Datos**: MySQL
- **Despliegue**: Heroku

## Instalación y Ejecución Local

1. **Clonar el repositorio**:

   ```bash
   git clone https://github.com/tu_usuario/tu_proyecto.git

2. **Instalar dependencias**:

   ```bash
    cd gestion-tareas
    composer install
3. **Configurar el archivo .env**:
    - Copiar el contenido del archivo .env.example al archivo .env.
    - Configurar la conexión a la base de datos y otras variables de entorno necesarias:
        - APP_KEY
        - APP_URL
        - DB_HOST
        - DB_DATABASE
        - DB_USERNAME
        - DB_PASSWORD
        - MAIL_USERNAME
        - MAIL_PASSWORD
        - MAIL_FROM_ADDRESS

**NOTA**: Para la configuración del servicio de correo es necesario usar las credenciales de aplicación, seguir el siguiente paso a paso: https://support.google.com/mail/answer/185833?hl=es-419

4. **Generar la clave de la aplicación**:
   ```bash
   php artisan key:generate
5. **Ejecutar las migraciones de la base de datos**:
   ```bash
    php artisan migrate
6. **Crear los estados en la base de datos**:
    ```sql
    INSERT INTO db_name.taskstatus (name) VALUES
	 ('Completada'),
	 ('No completada');
7. **Iniciar el servidor de desarrollo**:
   ```bash
   php artisan serve
8. **Compila los activos front-end (si es necesario)**:
   ```bash
   npm install
   npm run dev
9. **Acceder a la aplicación**:
   La aplicación estará disponible en http://localhost:8000.

## Despliegue en Heroku
Para desplegar la aplicación en Heroku:
1. **Crear una cuenta gratuita en Heroku (En caso de no tener)**:
2. **Iniciar sesión en Heroku**:
   ```bash
   heroku login
3. **Crea una nueva aplicación en Heroku**:
    ```bash
   heroku create gestion-tareas2024
4. **Añadir el addon de JawsDB para MySQL**:
   ```bash
   heroku addons:create jawsdb:kitefin -a gestion-tareas2024
5. **Verificar las variables de conexión de la base de datos**:
   ```bash
   heroku config:get JAWSDB_URL -a gestion-tareas2024
6. **Crear los estados en la base de datos**:
    ```sql
    INSERT INTO db_name.taskstatus (name) VALUES
	 ('Completada'),
	 ('No completada');
7. **Subir únicamente lo contenido en el archivo .env del proyecto, la configuración de la conexión a la base de datos y otras variables de entorno, realizarla a través de consola o desde el dashboard**.
8. **Despliegue del Código**
   ```bash
    git add .
    git commit -m "Preparar para despliegue en Heroku"
    git push heroku master
9. **Opcional - Configuración de certificado SSL en Heroku**:
   Configurar el certificado SSL desde el dashboard de Heroku.

**ENLACES**:
- [Aplicación en Heroku](http://gestion-tareas2024-bb51e35ab758.herokuapp.com/)



