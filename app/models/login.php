<?php

session_start();
require '../../config/conexion.php';
header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);

if (isset($input['action'])) {
    if ($input['action'] == 'login') {
        $email = $input['email'];
        $password = $input['password'];

        $sql = "SELECT * FROM `Users` WHERE `Email` = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        

        if ($user) {
            if (password_verify($password, $user['Password'])) {
                $_SESSION['user_email'] = $user['Email'];
                $_SESSION['user_name'] = $user['Name'];
                $_SESSION['user_type'] = $user['FKIdUserType']; 

                //var_dump($_SESSION);

                if ($user['FKIdUserType'] == 1) {
                    echo json_encode(['success' => true, 'message' => 'Login exitoso', 'userType' => 1]);
                } elseif ($user['FKIdUserType'] == 2) {
                    echo json_encode(['success' => true, 'message' => 'Login exitoso', 'userType' => 2]);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Tipo de usuario no reconocido']);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'Credenciales incorrectas']);
            }
            
        } else {
            echo json_encode(['success' => false, 'message' => 'Usuario no encontrado Registrese']);
        }
    } elseif ($input['action'] == 'register') {
        $email = $input['email'];
        $password1 = password_hash($input['password'], PASSWORD_DEFAULT); 
        $name = $input['name'];
        $apellido = $input['apellido'];

        $sql = "INSERT INTO `Users`(`FKIdUserType`, `Name`, `LastName`, `Email`, `Password`, `DateCreated`, `ModifiedDate`, `IsDeleted`) 
        VALUES (2, :name, :apellido, :email, :password1, NOW(), NOW(), 0)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':apellido', $apellido);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password1', $password1);
        $stmt->execute();
        echo json_encode(['success' => true, 'message' => 'Registro exitoso']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Acción no válida']);
}
?>
