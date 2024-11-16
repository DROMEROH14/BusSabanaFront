<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login y Registro</title>
    <!-- Agregar Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=home" />
    
</head>
<body>
    <div class="container-fluid h-100">
        <div class="row h-100">
            <!-- Lado derecho con imagen -->
            <div class="col-md-6 d-flex justify-content-center align-items-center">
                <img src="../app/controllers/img/Designer.jpeg" alt="Imagen">
            </div>
            <!-- Lado izquierdo con el formulario -->
            <div class="col-md-6 d-flex justify-content-center align-items-center bg-light">
                <div class="w-75">
                    <h2 class="text-center mb-4" id="form-title">Iniciar sesión</h2>
                    <!-- Formulario de Login / Registro -->
                    <form id="login-form">
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo electrónico</label>
                            <input type="email" class="form-control" id="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="password" required>
                        </div>
                        <div class="mb-3 text-center">
                            <button type="submit" class="btn btn-primary w-100">Iniciar sesión</button>
                        </div>
                        <div class="text-center">
                            <p class="mb-0">¿No tienes una cuenta? <a href="#" id="register-link">Registrarse</a></p>
                        </div>
                    </form>

                    <!-- Formulario de Registro -->
                    <form id="register-form" class="d-none">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="apellido" class="form-label">Apellido</label>
                            <input type="text" class="form-control" id="apellido" required>
                        </div>
                        <div class="mb-3">
                            <label for="reg-email" class="form-label">Correo electrónico</label>
                            <input type="email" class="form-control" id="reg-email" required>
                        </div>
                        <div class="mb-3">
                            <label for="reg-password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="reg-password" required>
                        </div>
                        <div class="mb-3">
                            <label for="reg-confirm-password" class="form-label">Confirmar contraseña</label>
                            <input type="password" class="form-control" id="reg-confirm-password" required>
                        </div>
                        <div class="mb-3 text-center">
                            <button type="submit" class="btn btn-success w-100">Registrarse</button>
                        </div>
                        <div class="text-center">
                            <p class="mb-0">¿Ya tienes una cuenta? <a href="#" id="login-link">Iniciar sesión</a></p>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../app/controllers/js/script.js?v=2"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>
</html>
