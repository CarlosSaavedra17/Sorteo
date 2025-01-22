<?php
// Verificar que la solicitud sea POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Capturar los datos del formulario
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // Validar que todos los datos requeridos estén presentes
    if (empty($name) || empty($email) || empty($password)) {
        http_response_code(400); // Código de error para solicitud incorrecta
        echo json_encode(['status' => 'error', 'message' => 'Faltan datos obligatorios.']);
        exit();
    }

    // Crear el comando para ejecutar el script Python
    $command = escapeshellcmd("python ../mail2.py '$name' '$email' '$password'");
    $output = shell_exec($command);

    // Verificar si el comando se ejecutó correctamente
    if ($output) {
        // Respuesta de éxito para AJAX
        echo json_encode(['status' => 'success', 'message' => 'Correo enviado exitosamente.']);
    } else {
        http_response_code(500); // Código de error del servidor
        echo json_encode(['status' => 'error', 'message' => 'Error al ejecutar el script.']);
    }
} else {
    // Respuesta si no se usa el método POST
    http_response_code(405); // Código de método no permitido
    echo json_encode(['status' => 'error', 'message' => 'Metodo no permitido.']);
}
?>

