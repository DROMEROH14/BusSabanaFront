<?php

session_start();
require '../../config/conexion.php';

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['user_email'])) {
    header('Location: ../../public/index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Administrador</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Icons">
    <style>
        /* Estilos adicionales */
        .sidebar {
            height: 100vh;
            background-color: #f8f9fa;
            padding-top: 20px;
        }
        .profile-img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 50%;
        }
        .menu-item {
            cursor: pointer;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .menu-item:hover {
            background-color: #e0e0e0;
        }

        .material-symbols-outlined {
            font-size: 1.5em; /* Ajusta el tamaño del icono de Material */
            margin-right: 8px; /* Espacio entre el icono y el texto */
        }

    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Menú lateral izquierdo -->
            <div class="col-md-3 col-lg-2 sidebar">
                <!-- Información del usuario -->
                <div class="text-center mb-4">
                    <img src="../controllers/img/perfil-de-usuario.webp" alt="Imagen de perfil" class="profile-img">
                    <h5 class="mt-2">Administrador</h5>
                    <!--<button class="btn btn-sm btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#changeProfilePicModal">Cambiar Imagen</button>-->
                </div>
                
                <!-- Menú de navegación -->
                <div class="menu-item" onclick="showSection('inicio')">
                    <span class="material-icons">home</span> Inicio
                </div>
                <div class="menu-item" onclick="showSection('buses')">
                    <span class="material-icons">directions_bus</span> Buses
                </div>
                <div class="menu-item" onclick="showSection('rutas')">
                    <span class="material-icons">fact_check</span> Rutas
                </div>
                <div class="menu-item" onclick="showSection('horarios')">
                    <span class="material-icons">event_note</span>  Horarios
                </div>
                <div class="menu-item" onclick="showSection('notificaciones')">
                    <span class="material-icons">bus_alert</span> Notificaciones
                </div>
                <div class="menu-item" onclick="showSection('usuarios')">
                    <span class="material-icons">person</span>  Usuarios
                </div>
                <div class="menu-item mt-4" onclick="logout()">
                    <span class="material-icons">logout</span>  Cerrar sesión
                </div>
            </div>

            <!-- Contenido principal -->
            <div class="col-md-9 col-lg-10">
                <div id="inicio" class="section" style="display: block; padding: 20px;">
                <h3>Resumen de Estadísticas</h3>
                <div class="row">
                    <!-- Contenedor de Buses -->
                    <div class="col-md-3 mb-4">
                        <div class="card text-white bg-primary">
                            <div class="card-body text-center">
                                <h5 class="card-title">Buses</h5>
                                <span class="material-icons">directions_bus</span>
                                <p class="card-text" id="bus-count">
                                    <?php
                                    // Incluir la conexión a la base de datos
                                    require_once '../../config/conexion.php';
                                    try {
                                        // Consulta para contar las rutas no eliminadas
                                        $sql = "SELECT COUNT(*) as totalBuses FROM Bus";
                                        $stmt = $pdo->prepare($sql);
                                        $stmt->execute();
                                        $result = $stmt->fetch(PDO::FETCH_ASSOC);

                                        // Mostrar el número de rutas
                                        echo $result['totalBuses'];
                                    } catch (Exception $e) {
                                        // Manejar errores
                                        echo "Error";
                                    }
                                    ?>
                                </p> <!-- Aquí se muestra la cantidad de buses -->
                            </div>
                        </div>
                    </div>

                    <!-- Contenedor de Rutas -->
                    <div class="col-md-3 mb-4">
                        <div class="card text-white bg-success">
                            <div class="card-body text-center">
                                <h5 class="card-title">Rutas</h5>
                                <span class="material-icons">fact_check</span> 
                                <p class="card-text" id="route-count">
                                    <?php
                                    // Incluir la conexión a la base de datos
                                    require_once '../../config/conexion.php';
                                    try {
                                        // Consulta para contar las rutas no eliminadas
                                        $sql = "SELECT COUNT(*) as totalRoutes FROM Routes WHERE IsDeleted = 0";
                                        $stmt = $pdo->prepare($sql);
                                        $stmt->execute();
                                        $result = $stmt->fetch(PDO::FETCH_ASSOC);

                                        // Mostrar el número de rutas
                                        echo $result['totalRoutes'];
                                    } catch (Exception $e) {
                                        // Manejar errores
                                        echo "Error";
                                    }
                                    ?>          
                                </p> <!-- Aquí se muestra la cantidad de rutas -->
                            </div>
                        </div>
                    </div>

                    <!-- Contenedor de Horarios -->
                    <div class="col-md-3 mb-4">
                        <div class="card text-white bg-warning">
                            <div class="card-body text-center">
                                <h5 class="card-title">Horarios</h5>
                                <span class="material-icons">event_note</span> 
                                <p class="card-text" id="schedule-count">
                                <?php
                                    // Incluir la conexión a la base de datos
                                    require_once '../../config/conexion.php';
                                    try {
                                        // Consulta para contar las rutas no eliminadas
                                        $sql = "SELECT COUNT(*) as totalHorarios FROM Schedule";
                                        $stmt = $pdo->prepare($sql);
                                        $stmt->execute();
                                        $result = $stmt->fetch(PDO::FETCH_ASSOC);

                                        // Mostrar el número de rutas
                                        echo $result['totalHorarios'];
                                    } catch (Exception $e) {
                                        // Manejar errores
                                        echo "Error";
                                    }
                                    ?>   
                                </p> <!-- Aquí se muestra la cantidad de horarios -->
                            </div>
                        </div>
                    </div>

                    <!-- Contenedor de Notificaciones -->
                    <div class="col-md-3 mb-4">
                        <div class="card text-white bg-info">
                            <div class="card-body text-center">
                                <h5 class="card-title">Notificaciones</h5>
                                <span class="material-icons">bus_alert</span>
                                <p class="card-text" id="notification-count">
                                <?php
                                    // Incluir la conexión a la base de datos
                                    require_once '../../config/conexion.php';
                                    try {
                                        // Consulta para contar las rutas no eliminadas
                                        $sql = "SELECT COUNT(*) as totalNoti FROM Notification";
                                        $stmt = $pdo->prepare($sql);
                                        $stmt->execute();
                                        $result = $stmt->fetch(PDO::FETCH_ASSOC);

                                        // Mostrar el número de rutas
                                        echo $result['totalNoti'];
                                    } catch (Exception $e) {
                                        // Manejar errores
                                        echo "Error";
                                    }
                                    ?>  
                                </p> <!-- Aquí se muestra la cantidad de notificaciones -->
                            </div>
                        </div>
                    </div>
                    <h3 class="mt-4">Usuarios Registrados</h3>
                    <table class="table table-bordered mt-3">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require_once '../../config/conexion.php';

                        try {
                            // Consulta para obtener los usuarios
                            $sql = "SELECT IdUser, Name, Email FROM Users WHERE IsDeleted = 0";
                            $stmt = $pdo->prepare($sql);
                            $stmt->execute();
                            $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            // Iterar sobre los usuarios y generar las filas de la tabla
                            foreach ($usuarios as $index => $usuario) {
                                echo "<tr>";
                                echo "<td>" . ($index + 1) . "</td>"; // Número de fila
                                echo "<td>" . htmlspecialchars($usuario['Name']) . "</td>"; // Nombre del usuario
                                echo "<td>" . htmlspecialchars($usuario['Email']) . "</td>"; // Email del usuario
                                echo "</tr>";
                            }
                        } catch (Exception $e) {
                            // Manejar errores
                            echo "<tr><td colspan='3'>Error al obtener los usuarios: " . $e->getMessage() . "</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>

                </div>
                </div>
                <div id="buses" class="section" style="display: none; padding: 20px;">
                    <h3>Agregar Buses</h3>
                    <form id="bus-form">
                        <div class="mb-3">
                            <label for="bus-licencia" class="form-label">Licencia</label>
                            <input type="text" class="form-control" id="bus-licencia" required>
                        </div>
                        <div class="mb-3">
                            <label for="bus-capacidad" class="form-label">Capacidad</label>
                            <input type="text" class="form-control" id="bus-capacidad" required>
                        </div>
                        <button type="submit" class="btn btn-success">Agregar Bus</button>
                    </form>
                    <br></br>
                    <hr>
                    <br></br>
                    <h3>Lista de Buses</h3>
                    <table id="bus-table" class="table table-bordered mt-3">
                        <thead>
                            <tr>
                                <th>Licencia</th>
                                <th>Capacidad</th>
                                <th>Acciones</th> 
                            </tr>
                        </thead>
                        <tbody>
                           
                        </tbody>
                    </table>
                </div>
                <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel">Editar Bus</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="editBusForm">
                                <input type="hidden" id="bus-id">
                                <div class="mb-3">
                                    <label for="bus-licencia1" class="form-label">Licencia</label>
                                    <input type="text" class="form-control" id="bus-licencia1" required>
                                </div>
                                <div class="mb-3">
                                    <label for="bus-capacidad1" class="form-label">Capacidad</label>
                                    <input type="number" class="form-control" id="bus-capacidad1" required>
                                </div>
                                <button type="submit" class="btn btn-success">Actualizar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

                <div id="rutas" class="section" style="display: none; padding: 20px;">
                    <h3>Agregar Rutas</h3>
                    <form id = "ruta-form">
                        <div class="mb-3">
                            <label for="route-name" class="form-label">Nombre de la Ruta</label>
                            <input type="text" class="form-control" id="route-name" required>
                        </div>
                        <div class="mb-3">
                            <label for="route-start" class="form-label">Punto de Inicio</label>
                            <input type="text" class="form-control" id="route-start" required>
                        </div>
                        <div class="mb-3">
                            <label for="route-end" class="form-label">Punto de Llegada</label>
                            <input type="text" class="form-control" id="route-end" required>
                        </div>
                        <div class="mb-3">
                            <label for="duracion" class="form-label">Duración</label>
                            <input type="time" class="form-control" id="duracion" required>
                        </div>
                        <button type="submit" class="btn btn-success">Agregar Ruta</button>
                    </form>
                    <br></br>
                    <hr>
                    <br></br>
                    <h3>Lista de Rutas</h3>
                    <table id="ruta-table" class="table table-bordered mt-3">
                        <thead>
                            <tr>
                                <th>Ruta</th>
                                <th>Inicio</th>
                                <th>Llegada</th> 
                                <th>Duración</th>
                                <th>Acciones</th>  
                            </tr>
                        </thead>
                        <tbody>
                           
                        </tbody>
                    </table>
                    <div class="modal fade" id="editModal1" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel">Editar Ruta</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="editRutaForm">
                                    <input type="hidden" id="ruta-id">
                                    <div class="mb-3">
                                        <label for="ruta" class="form-label">Ruta</label>
                                        <input type="text" class="form-control" id="ruta" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="origen" class="form-label">Origen</label>
                                        <input type="text" class="form-control" id="origen" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="destino" class="form-label">Destino</label>
                                        <input type="text" class="form-control" id="destino" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="duracion1" class="form-label">Duración</label>
                                        <input type="time" class="form-control" id="duracion1" required>
                                    </div>
                                    <button type="submit" class="btn btn-success">Actualizar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>

                <div id="horarios" class="section" style="display: none; padding: 20px;">
                    <h3>Agregar Horarios</h3>
                    <form id = "horario-form">
                        <div class="mb-3">
                            <label for="routeHorario" class="form-label">Ruta</label>
                            <select class="form-select" id="routeHorario">

                            <?php
                                require_once '../../config/conexion.php';

                                try {
                                    // Consultar las rutas en la base de datos
                                    $sql = "SELECT * FROM Routes";
                                    $stmt = $pdo->prepare($sql);
                                    $stmt->execute();
                                    $routes = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                    // Iterar y generar las opciones del select
                                    foreach ($routes as $route) {
                                        echo "<option value=\"{$route['IdRoute']}\">{$route['RouteName']}</option>";
                                    }
                                } catch (Exception $e) {
                                    // Manejar errores
                                    echo "<option disabled>Error al cargar rutas</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="departure-time" class="form-label">Hora de Salida</label>
                            <input type="time" class="form-control" id="departure-time" required>
                        </div>
                        <div class="mb-3">
                            <label for="arrival-time" class="form-label">Hora de Llegada</label>
                            <input type="time" class="form-control" id="arrival-time" required>
                        </div>
                        <div class="mb-3">
                            <label for="frecuencia" class="form-label">Frecuencia</label>
                            <input type="number" class="form-control" id="frecuencia" required>
                        </div>
                        <button type="submit" class="btn btn-success">Agregar Horario</button>
                    </form>
                    <br></br>
                    <hr>
                    <br></br>
                    <h3>Lista de Horarios</h3>
                    <table id="horario-table" class="table table-bordered mt-3">
                        <thead>
                            <tr>
                                <th>Ruta</th>
                                <th>Hora de Salida</th>
                                <th>Hora de llegada</th> 
                                <th>Frecuencia</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                           
                        </tbody>
                    </table>
                    <div class="modal fade" id="editModal2" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel">Editar Horario</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="editHorarioForm">
                                    <input type="hidden" id="horario-id">
                                    <div class="mb-3">
                                        <label for="ruta1" class="form-label">Ruta</label>
                                        <input type="text" class="form-control" id="ruta1" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="salida1" class="form-label">Salida</label>
                                        <input type="text" class="form-control" id="salida1" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="llegada1" class="form-label">Llegada</label>
                                        <input type="text" class="form-control" id="llegada1" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="frecuencia1" class="form-label">Frecuencia</label>
                                        <input type="number" class="form-control" id="frecuencia1" required>
                                    </div>
                                    <button type="submit" class="btn btn-success">Actualizar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>


                <div id="notificaciones" class="section" style="display: none; padding: 20px;">
                    <h3>Agregar Notificaciones</h3>
                    <form id = "notificacion-form">
                        <div class="mb-3">
                        <label for="notificaciones" class="form-label">Horario de la notificación</label>
                        <select class="form-select" id="notificacionSelect">

                        <?php
                            require_once '../../config/conexion.php';

                            try {
                                // Consultar las rutas en la base de datos
                                $sql = "SELECT * FROM Schedule	";
                                $stmt = $pdo->prepare($sql);
                                $stmt->execute();
                                $routes = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                // Iterar y generar las opciones del select
                                foreach ($routes as $route) {
                                    echo "<option value=\"{$route['IDSchedule']}\">{$route['IDSchedule']}</option>";
                                }
                            } catch (Exception $e) {
                                // Manejar errores
                                echo "<option disabled>Error al cargar rutas</option>";
                            }
                            ?>
                        </select>
                        </div>
                        <div class="mb-3">
                            <label for="notification-message" class="form-label">Mensaje</label>
                            <textarea class="form-control" id="notification-message" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="fechaNoti" class="form-label">Fecha</label>
                            <input type = "date" class="form-control" id="fechaNoti" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-success">Enviar Notificación</button>
                    </form>
                    <br></br>
                    <hr>
                    <br></br>
                    <h3>Lista de Notificaciones</h3>
                    <table id="notificacion-table" class="table table-bordered mt-3">
                        <thead>
                            <tr>
                                <th>Notificación</th>
                                <th>Mensaje</th>
                                <th>Fecha</th> 
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                           
                        </tbody>
                    </table>
                    <div class="modal fade" id="editModal3" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel">Editar Notificación</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="editNotiForm">
                                    <input type="hidden" id="noti-id">
                                    <div class="mb-3">
                                        <label for="horNoti" class="form-label">Horario de notificación</label>
                                        <input type="text" class="form-control" id="horNoti" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="mensaje1" class="form-label">Mensaje</label>
                                        <input type="text" class="form-control" id="mensaje1" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="fechaNoti1" class="form-label">Fecha notificación</label>
                                        <input type="date" class="form-control" id="fechaNoti1" required>
                                    </div>
                                    <button type="submit" class="btn btn-success">Actualizar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                <div id="usuarios" class="section" style="display: none; padding: 20px;">
                    <h3>Lista de Usuarios</h3>
                    <table id="usuario-table" class="table table-bordered mt-3">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Email</th> 
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                           
                        </tbody>
                    </table>
                    <div class="modal fade" id="editModal4" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel">Editar Usuarios</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="editUsuarioForm">
                                    <input type="hidden" id="user-id">
                                    <div class="mb-3">
                                        <label for="nomUser" class="form-label">Nombre</label>
                                        <input type="text" class="form-control" id="nomUser" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="apellUser" class="form-label">Apellido</label>
                                        <input type="text" class="form-control" id="apellUser" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="emailUser" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="emailUser" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="userRole" class="form-label">Rol de Usuario</label>
                                        <select class="form-select" id="userRole" name="userRole" required>
                                            <option value="" disabled selected>Seleccione un rol</option>
                                            <option value="1">Administrador</option>
                                            <option value="2">Usuario</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-success">Actualizar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../controllers/js/scriptDash.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
