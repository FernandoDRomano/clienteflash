<?php
session_start();

date_default_timezone_set("America/Argentina/Tucuman");

ini_set('display_errors', 0); // Desactivar para evitar que se imprima antes de headers
ini_set('display_startup_errors', 0);
error_reporting(E_ERROR | E_WARNING); // Solo errores críticos, no notices

require_once("FuncionesGenerales.php");

// Registrar autoload para cargar clases en namespace (Models, Config, etc.)
require_once(__DIR__ . '/../Config/Autoload.php');
// Cambiar directorio de trabajo a la raíz del proyecto para que el autoload
// busque archivos relativos a la raíz (Models/Log.php, etc.).
chdir(__DIR__ . '/..');
Config\Autoload::run();

use Models\Log;

$logModel = new Log();

// Leer input: soportar JSON (fetch) o form-urlencoded (POST tradicional)
$raw = file_get_contents('php://input');
$data = json_decode($raw, true);
if (json_last_error() === JSON_ERROR_NONE && is_array($data)) {
    $newPassword = $data['newPassword'] ?? '';
    $confirmPassword = $data['confirmPassword'] ?? '';
    $inputSelector = $data['selector'] ?? null;
    $inputValidator = $data['validator'] ?? null;
} else {
    $newPassword = $_POST['newPassword'] ?? '';
    $confirmPassword = $_POST['confirmPassword'] ?? '';
    $inputSelector = $_POST['selector'] ?? null;
    $inputValidator = $_POST['validator'] ?? null;
}

// Preferir selector desde sesión, si existe; si no usar el enviado por el cliente
$selector = $_SESSION['password_reset_selector'] ?? $inputSelector;
$validator = $_SESSION['password_reset_validator'] ?? $inputValidator;

// Si no hay selector/validator -> acceso inválido
if(empty($selector) || empty($validator)){
    echo json_encode(['success' => false, 'message' => 'Acceso inválido: token ausente']); exit;
}

// Revalidar el token en BD por seguridad (evitar depender exclusivamente de la sesión)
$row = $logModel->BuscarTokenDeRecuperacion($selector);
if(!$row){
    echo json_encode(['success' => false, 'message' => 'Token inválido']); exit;
}

// Comprobar expiración
if(isset($row['expires_at']) && strtotime($row['expires_at']) < time()){
    echo json_encode(['success' => false, 'message' => 'Token expirado']); exit;
}

// Comprobar used (si existe campo used en tabla)
if(isset($row['used']) && intval($row['used']) === 1){
    echo json_encode(['success' => false, 'message' => 'Token ya utilizado']); exit;
}

// Verificar validator contra token_hash
$token_hash_saved = $row['token_hash'] ?? '';
if(!hash_equals($token_hash_saved, hash('sha256', $validator))){
    echo json_encode(['success' => false, 'message' => 'Token inválido']); exit;
}

// Obtener cliente_id desde el registro (sobrescribe session si hubiera)
$cliente_id = $row['cliente_id'] ?? ($_SESSION['password_reset_cliente_id'] ?? null);
if(!$cliente_id){
    echo json_encode(['success' => false, 'message' => 'Cliente no encontrado']); exit;
}

// Validaciones
if($newPassword !== $confirmPassword){
    echo json_encode(['success' => false, 'message' => 'Las contraseñas no son iguales']); exit;
}

if(strlen($newPassword) < 8){
    echo json_encode(['success' => false, 'message' => 'La contraseña debe tener al menos 8 caracteres']); exit;
}

// Actualizar en BD (usar tu modelo)
$logModel->ActualizarPasswordCliente($cliente_id, $newPassword);
$logModel->MarcarTokenComoUsado($selector);

unset($_SESSION['password_reset_validated']);
unset($_SESSION['password_reset_cliente_id']);
unset($_SESSION['password_reset_selector']);

echo json_encode(['success' => true, 'message' => 'Contraseña actualizada. En unos segundos serás redirigido al inicio de sesión.']);
exit;
