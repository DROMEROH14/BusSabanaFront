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
    <title>Portal Buses</title>
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
                
                <!-- Menú de navegación -->
                <div class="menu-item" onclick="showSection('inicio')">
                    <span class="material-icons">home</span> Inicio
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
                <div class="menu-item mt-4" onclick="logout()">
                    <span class="material-icons">logout</span>  Cerrar sesión
                </div>
            </div>

            <!-- Contenido principal -->
            <div class="col-md-9 col-lg-10">
                <div id="inicio" class="section" style="display: block; padding: 20px;">
                <h3>Resumen de estado de Rutas</h3>
                    <table id="inicio-table" class="table table-bordered mt-3">
                        <thead>
                            <tr>
                                <th>Ruta</th>
                                <th>Origen</th>
                                <th>Destino</th> 
                                <th>Hora Salida</th>
                                <th>Notificacion</th>
                            </tr>
                        </thead>
                        <tbody>
                           
                        </tbody>
                    </table>
                </div>

                <div id="rutas" class="section" style="display: none; padding: 20px;">
                <h3>Lista de Rutas</h3>
                    <table id="ruta-table" class="table table-bordered mt-3">
                        <thead>
                            <tr>
                                <th>Ruta</th>
                                <th>Inicio</th>
                                <th>Llegada</th> 
                                <th>Duración</th>
                            </tr>
                        </thead>
                        <tbody>
                           
                        </tbody>
                    </table>
                </div>

                <div id="horarios" class="section" style="display: none; padding: 20px;">
                <h3>Lista de Horarios</h3>
                    <table id="horario-table" class="table table-bordered mt-3">
                        <thead>
                            <tr>
                                <th>Ruta</th>
                                <th>Hora de Salida</th>
                                <th>Hora de llegada</th> 
                                <th>Frecuencia</th>
                            </tr>
                        </thead>
                        <tbody>
                           
                        </tbody>
                    </table>
                </div>

                <div id="notificaciones" class="section" style="display: none; padding: 20px;">
                <h3>Lista de Notificaciones</h3>
                    <table id="notificacion-table" class="table table-bordered mt-3">
                        <thead>
                            <tr>
                                <th>Notificación</th>
                                <th>Mensaje</th>
                                <th>Fecha</th> 
                            </tr>
                        </thead>
                        <tbody>
                           
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../controllers/js/scriptDash1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
