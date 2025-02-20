<?php
    require_once '../auth/check_auth.php'; // Ensure auth is checked first
    if ($_SESSION['role'] !== 'admin') {
        header('Location: /bolt/auth/restricted.php'); // Redirect if not admin
        exit;
    }
    require_once '../config/database.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $role = $_POST['role'] ?? 'user'; // Default role to 'user' if not selected

    if (empty($username) || empty($password)) {
        $error = 'Por favor, complete todos los campos.';
    } elseif (strlen($password) < 6) {
        $error = 'La contraseña debe tener al menos 6 caracteres.';
    } else {
        try {
            // Verificar si el usuario ya existe
            $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
            $stmt->execute([$username]);
            if ($stmt->fetch()) {
                $error = 'El nombre de usuario ya está en uso.';
                error_log("Registration error: Username already in use - Username: " . $username); // Log username reuse attempt
            } else {
                // Hash de la contraseña
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                // Insertar nuevo usuario
                $stmt = $pdo->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
                $stmt->execute([$username, $hashedPassword, $role]);

                if ($stmt->rowCount() > 0) {
                    error_log("Registration successful - Username: " . $username); // Log successful registration
                    header('Location: login.php?registration_success=1'); // Redirigir a la página de inicio de sesión con mensaje de éxito
                    exit;
                } else {
                    $error = 'Error al registrar el usuario.'; // General error if insert fails
                    error_log("Registration error: Insert query failed - Username: " . $username); // Log insert failure
                }
            }
        } catch (PDOException $e) {
            error_log('Error PDO al registrar usuario: ' . $e->getMessage() . " - Username: " . $username); // Log PDO exception with username
            $error = 'Error al registrar el usuario. Por favor, intente de nuevo más tarde.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registrarse - Sistema de Gestión</title>
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    </head>
    <body class="bg-gray-100 min-h-screen flex items-center justify-center">
        <div class="max-w-md w-full mx-4">
            <div class="bg-white rounded-lg shadow-xl p-8">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold text-gray-800">Registrarse</h2>
                    <p class="text-gray-600 mt-2">Cree una nueva cuenta</p>
                </div>

                <?php if ($error): ?>
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline"><?php echo htmlspecialchars($error); ?></span>
                    </div>
                <?php endif; ?>

                <form method="POST" class="space-y-6">
                    <div>
                        <label for="username" class="block text-sm font-medium text-gray-700">Usuario</label>
                        <input type="text" id="username" name="username" required
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
                        <input type="password" id="password" name="password" required
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label for="role" class="block text-sm font-medium text-gray-700">Rol</label>
                        <select id="role" name="role" required
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            <option value="user">Usuario Común</option>
                            <option value="admin">Administrador</option>
                        </select>
                    </div>

                    <div>
                        <button type="submit"
                                class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Registrarse
                        </button>
                    </div>
                    <div class="text-sm text-gray-500">
                        ¿Ya tiene una cuenta?
                        <a href="login.php" class="font-medium text-blue-600 hover:text-blue-500">
                            Iniciar Sesión
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </body>
    </html>
