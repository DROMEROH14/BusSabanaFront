<?php
require '../../config/conexion.php';
$input = json_decode(file_get_contents('php://input'), true);


if ($input['action'] == 'getRutas') {
    try {
        $sql = "SELECT * FROM `Routes`"; 
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        $rutas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($rutas);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Error al obtener los buses: ' . $e->getMessage()]);
    }
}

if ($input['action'] == 'getHorarios') {
    try {
        $sql = "SELECT * FROM `Schedule`"; 
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        $horarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($horarios);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Error al obtener los horarios: ' . $e->getMessage()]);
    }
}

if ($input['action'] == 'getNoti') {
    try {
        $sql = "SELECT * FROM `Notification`"; 
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        $notis = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($notis);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Error al obtener las notificaciones: ' . $e->getMessage()]);
    }
}

if ($input['action'] == 'getInicio') {
    try {
        $sql = "SELECT 
                    Routes.RouteName AS NombreRuta,
                    Routes.Origin AS Origen,
                    Routes.Destination AS Destino,
                    Schedule.DepartureTime AS HoraSalida,
                    Notification.Message AS MensajeNotificacion
                FROM Routes
                INNER JOIN Schedule ON Routes.IdRoute = Schedule.FkIDRoute
                LEFT JOIN Notification ON Schedule.IDSchedule = Notification.FkIdSchedule;
                "; 
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        $notis = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($notis);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Error al obtener los horarios: ' . $e->getMessage()]);
    }
}