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

4. **Generar la clave de la aplicación**:
   ```bash
   php artisan key:generate
5. **Ejecutar las migraciones de la base de datos**:
   ```bash
    php artisan migrate
6. **Iniciar el servidor de desarrollo**:
   ```bash
   php artisan serve
7. **Compila los activos front-end (si es necesario)**:
   ```bash
   npm run dev
8. **Acceder a la aplicación**:
   La aplicación estará disponible en http://localhost:8000.




