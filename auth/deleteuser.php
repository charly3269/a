    <?php
    session_start();
    require_once '../auth/check_auth.php';
    require_once '../config/database.php';

    // Fetch all users
    $stmt = $pdo->query("SELECT id, username, created_at FROM users");
    $users = $stmt->fetchAll();

    $error = '';
    $success = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_user_id'])) {
        $userIdToDelete = $_POST['delete_user_id'];

        // Prevent deleting the admin user (or currently logged-in user) - IMPORTANT SECURITY CHECK
        if ($userIdToDelete == 1 || $userIdToDelete == $_SESSION['user_id']) {
            $error = 'No se puede eliminar el usuario administrador o el usuario actual.';
        } else {
            try {
                $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
                $stmt->execute([$userIdToDelete]);
                if ($stmt->rowCount() > 0) {
                    $success = 'Usuario eliminado correctamente.';
                    // Refresh user list after deletion
                    $stmt = $pdo->query("SELECT id, username, created_at FROM users");
                    $users = $stmt->fetchAll();
                } else {
                    $error = 'No se pudo eliminar el usuario.';
                }
            } catch (PDOException $e) {
                error_log('Error al eliminar usuario: ' . $e->getMessage());
                $error = 'Error al eliminar el usuario de la base de datos.';
            }
        }
    }
    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Eliminar Usuario - Sistema de Gestión</title>
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        <link href="/bolt/assets/css/styles.css" rel="stylesheet">
    </head>
    <body class="bg-gray-100">
        <?php include '../includes/header.php'; ?>
                    <?php include 'adduser_modal.php'; ?>
        <div class="container mx-auto px-4 py-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-6">Eliminar Usuario</h1>

            <?php if ($success): ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline"><?php echo htmlspecialchars($success); ?></span>
                </div>
            <?php endif; ?>

            <?php if ($error): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline"><?php echo htmlspecialchars($error); ?></span>
                </div>
            <?php endif; ?>

            <div class="bg-white shadow-xl rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Usuario</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha de Creación</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php foreach ($users as $user): ?>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlspecialchars($user['id']); ?></td>
                            <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlspecialchars($user['username']); ?></td>
                            <td class="px-6 py-4 whitespace-nowrap"><?php echo date('d/m/Y H:i', strtotime($user['created_at'])); ?></td>
                            <td class="px-6 py-4 whitespace-nowrap font-medium">
                                <form method="POST" class="inline-block">
                                    <input type="hidden" name="delete_user_id" value="<?php echo htmlspecialchars($user['id']); ?>">
                                    <button type="submit" class="text-red-600 hover:text-red-900">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php include '../includes/footer.php'; ?>
    </body>
    </html>
