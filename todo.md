1. **Tarea**: Crear la estructura de directorios
   **Archivo a modificar o crear**: Ninguno
   **Descripción detallada**: Establecer directorios separados para [`views`].

2. **Tarea**: Configurar el enrutador
   **Archivo a modificar o crear**: `app/router.php`
   **Descripción detallada**: Implementar un enrutador para dirigir las solicitudes HTTP a los controladores correspondientes.

3. **Tarea**: Desarrollar el controlador base
   **Archivo a modificar o crear**: `app/controllers/BaseController.php`
   **Descripción detallada**: Crear una clase base para los controladores que maneje las solicitudes y respuestas.

4. **Tarea**: Implementar el modelo base
   **Archivo a modificar o crear**: `app/models/BaseModel.php`
   **Descripción detallada**: Crear una clase base para los modelos que maneje la conexión a la base de datos y las operaciones CRUD.

5. **Tarea**: Crear vistas dinámicas
   **Archivo a modificar o crear**: `app/views/template.php`
   **Descripción detallada**: Desarrollar un sistema de plantillas para las vistas que permita la inserción de datos dinámicos.

6. **Tarea**: Desarrollar controladores específicos
   **Archivo a modificar o crear**: `app/controllers/UserController.php`
   **Descripción detallada**: Crear un controlador para manejar las funcionalidades relacionadas con los usuarios.

7. **Tarea**: Desarrollar modelos específicos
   **Archivo a modificar o crear**: `app/models/User.php`
   **Descripción detallada**: Crear un modelo para representar la entidad de usuario y manejar las operaciones relacionadas con la base de datos.

8. **Tarea**: Implementar la lógica de negocio en los controladores
   **Archivo a modificar o crear**: `app/controllers/ProductController.php`
   **Descripción detallada**: Añadir métodos en el controlador de productos para manejar las solicitudes y coordinar la lógica de negocio.

9. **Tarea**: Conectar modelos y vistas
   **Archivo a modificar o crear**: `app/controllers/ViewController.php`
   **Descripción detallada**: Asegurar que los controladores pasen los datos necesarios desde los modelos a las vistas.

10. **Tarea**: Configurar la gestión de sesiones y autenticación
    **Archivo a modificar o crear**: `app/controllers/AuthController.php`
    **Descripción detallada**: Implementar un sistema de gestión de sesiones y autenticación de usuarios.