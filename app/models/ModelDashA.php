<?php
require '../../config/conexion.php';
$input = json_decode(file_get_contents('php://input'), true);

if ($input['action'] == 'busesAgre') {
    $licencia = $input['licencia'];
    $capacidad = $input['capacidad'];

    if (empty($licencia) || empty($capacidad)) {
        echo json_encode(['success' => false, 'message' => 'Faltan datos']);
        exit;
    }

    try {
        $sql = "INSERT INTO `Bus`(`LicensePlate`, `Capacity`, `IsDeleted`) 
                VALUES (:licencia, :capacidad, 0)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':licencia', $licencia);
        $stmt->bindParam(':capacidad', $capacidad);
        $stmt->execute();

        echo json_encode(['success' => true, 'message' => 'Registro exitoso']);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Error en la base de datos: ' . $e->getMessage()]);
    }
}

if ($input['action'] == 'getBuses') {
    try {
        $sql = "SELECT * FROM `Bus`"; // Filtrar por buses no eliminados
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        $buses = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($buses);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Error al obtener los buses: ' . $e->getMessage()]);
    }
}

if ($input['action'] == 'busesUpdate') {
    $id = $input['id'];
    $licencia = $input['licencia'];
    $capacidad = $input['capacidad'];

    if (empty($licencia) || empty($capacidad)) {
        echo json_encode(['success' => false, 'message' => 'Faltan datos']);
        exit;
    }

    try {
        $sql = "UPDATE `Bus` SET `LicensePlate` = :licencia, `Capacity` = :capacidad WHERE `IdBus` = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':licencia', $licencia);
        $stmt->bindParam(':capacidad', $capacidad);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        echo json_encode(['success' => true, 'message' => 'Datos actualizados con éxito']);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Error en la base de datos: ' . $e->getMessage()]);
    }
}

if ($input['action'] == 'rutasAgre') {
    $nombre = $input['nombre'];
    $inicio = $input['inicio'];
    $fin = $input['fin'];
    $duracion = $input['duracion'];

    if (empty($nombre) || empty($inicio) || empty($fin) || empty($duracion)) {
        echo json_encode(['success' => false, 'message' => 'Faltan datos']);
        exit;
    }

    try {
        $sql = "INSERT INTO `Routes`(`RouteName`, `Origin`, `Destination`, `EstimatedDuration`, `IsDeleted`) 
        VALUES (:nombre, :inicio, :fin, :duracion, 0)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':inicio', $inicio);
        $stmt->bindParam(':fin', $fin);
        $stmt->bindParam(':duracion', $duracion);
        $stmt->execute();

        echo json_encode(['success' => true, 'message' => 'Registro exitoso']);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Error en la base de datos: ' . $e->getMessage()]);
    }
}

if ($input['action'] == 'getRutas') {
    try {
        $sql = "SELECT * FROM `Routes`"; // Filtrar por buses no eliminados
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        $rutas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($rutas);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Error al obtener los buses: ' . $e->getMessage()]);
    }
}

if ($input['action'] == 'rutasUpdate') {
    $id = $input['id'];
    $nombre = $input['nombre'];
    $origen = $input['origen'];
    $destino = $input['destino'];
    $duracion1 = $input['duracion1'];

    try {
        $sql = "UPDATE `Routes` SET `RouteName` = :nombre, `Origin` = :origen, `Destination` = :destino, `EstimatedDuration` = :duracion1
         WHERE `IdRoute` = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':origen', $origen);
        $stmt->bindParam(':destino', $destino);
        $stmt->bindParam(':duracion1', $duracion1);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        echo json_encode(['success' => true, 'message' => 'Datos actualizados con éxito']);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Error en la base de datos: ' . $e->getMessage()]);
    }
}

if ($input['action'] == 'horarioAgre') {
    $routeHorario = $input['routeHorario'];
    $salida = $input['salida'];
    $llegada = $input['llegada'];
    $frecuencia = $input['frecuencia'];

    try {
        $sql = "INSERT INTO `Schedule`(`FkIDRoute`, `DepartureTime`, `ArrivalTime`, `Frequency`, `IsDeleted`)  
        VALUES (:routeHorario, :salida, :llegada, :frecuencia, 0)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':routeHorario', $routeHorario);
        $stmt->bindParam(':salida', $salida);
        $stmt->bindParam(':llegada', $llegada);
        $stmt->bindParam(':frecuencia', $frecuencia);
        $stmt->execute();

        echo json_encode(['success' => true, 'message' => 'Registro exitoso']);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Error en la base de datos: ' . $e->getMessage()]);
    }
}

if ($input['action'] == 'getHorarios') {
    try {
        $sql = "SELECT * FROM `Schedule`"; // Filtrar por buses no eliminados
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        $horarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($horarios);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Error al obtener los horarios: ' . $e->getMessage()]);
    }
}

if ($input['action'] == 'horarioUpdate') {
    $id = $input['id'];
    $fkRuta = $input['fkRuta'];
    $salida = $input['salida'];
    $llegada = $input['llegada'];
    $frecuencia = $input['frecuencia'];

    try {
        $sql = "UPDATE `Schedule` SET `FkIDRoute` = :fkRuta, `DepartureTime` = :salida, `ArrivalTime` = :llegada, `Frequency` = :frecuencia
         WHERE `IDSchedule` = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':fkRuta', $fkRuta);
        $stmt->bindParam(':salida', $salida);
        $stmt->bindParam(':llegada', $llegada);
        $stmt->bindParam(':frecuencia', $frecuencia);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        echo json_encode(['success' => true, 'message' => 'Datos actualizados con éxito']);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Error en la base de datos: ' . $e->getMessage()]);
    }
}

if ($input['action'] == 'notiAgre') {
    $notificacionSelect = $input['notificacionSelect'];
    $mensaje = $input['mensaje'];
    $fechaNoti = $input['fechaNoti'];

    try {
        $sql = "INSERT INTO `Notification`(`FkIdSchedule`, `Message`, `DateTime`, `IsDeleted`) 
        VALUES (:notificacionSelect, :mensaje, :fechaNoti, 0)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':notificacionSelect', $notificacionSelect);
        $stmt->bindParam(':mensaje', $mensaje);
        $stmt->bindParam(':fechaNoti', $fechaNoti);
        $stmt->execute();

        echo json_encode(['success' => true, 'message' => 'Registro exitoso']);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Error en la base de datos: ' . $e->getMessage()]);
    }
}

if ($input['action'] == 'getNoti') {
    try {
        $sql = "SELECT * FROM `Notification`"; // Filtrar por buses no eliminados
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        $notis = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($notis);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Error al obtener las notificaciones: ' . $e->getMessage()]);
    }
}

if ($input['action'] == 'notiUpdate') {
    $id = $input['id'];
    $hora = $input['hora'];
    $mensaje = $input['mensaje'];
    $time1 = $input['time'];

    try {
        $sql = "UPDATE `Notification` SET `FkIdSchedule` = :hora, `Message` = :mensaje, `DateTime` = :time1
         WHERE `IDNotification` = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':hora', $hora);
        $stmt->bindParam(':mensaje', $mensaje);
        $stmt->bindParam(':time1', $time1);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        echo json_encode(['success' => true, 'message' => 'Datos actualizados con éxito']);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Error en la base de datos: ' . $e->getMessage()]);
    }
}

if ($input['action'] == 'getUser') {
    try {
        $sql = "SELECT * FROM `Users`"; // Filtrar por buses no eliminados
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($users);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Error al obtener los usuarios: ' . $e->getMessage()]);
    }
}

if ($input['action'] == 'UsersUpdate') {
    $id = $input['id'];
    $name = $input['name'];
    $apellido = $input['apellido'];
    $tipo = $input['tipo'];
    $email = $input['email'];

    try {
        $sql = "UPDATE `Users` SET `FKIdUserType` = :tipo, `Name` = :name, `LastName` = :apellido, `Email` = :email, ModifiedDate = NOW()
         WHERE `IdUser` = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':tipo', $tipo);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':apellido', $apellido);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        echo json_encode(['success' => true, 'message' => 'Datos actualizados con éxito']);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Error en la base de datos: ' . $e->getMessage()]);
    }
}
?>