<?php 

//Iniciar sessiones si no están iniciadas
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

header("Access-Control-Allow-Origin: *");
	
// Bootstrap central: carga Composer + .env y promueve variables (ver Config/bootstrap.php)
require_once __DIR__ . '/../../Config/bootstrap.php';
use Exception;
use Models\PerfilCliente;
use Models\CartaDocumento;
use Models\CartaDocumentoEstado;
use Helpers\LogManager;

$log = new LogManager();

//Obtener datos de la request
$request = file_get_contents("php://input");
$request = json_decode($request, true);

$log->info("AjaxDescargarCartaDocumento", "Request recibida", $request);

$clienteId = $request['clientId'] ?? null;
$userId = $request['userId'] ?? null;
$perfilUsuario = $request['perfilId'] ?? null;
$cartaDocumentoId = $request['cartaDocumentoId'] ?? null;

//Validar que el usuario tenga permisos para realizar esta acción
if (!in_array($perfilUsuario, [PerfilCliente::ADMINISTRADOR, PerfilCliente::AUTORIZADOR])) {
    http_response_code(403);
    echo json_encode([
        "status" => "error",
        "message" => "No tiene permisos para realizar esta acción."
    ]);
    exit();
}

try {
    $cartaDocumento = new CartaDocumento();
    $data = $cartaDocumento->obtenerPorId($cartaDocumentoId);

    if (!$data) {
        $log->error("CartaDocumento",  "Carta documento no encontrada: ID {$cartaDocumentoId}", [
            'cartaDocumentoId' => $cartaDocumentoId
        ]);

        http_response_code(404);
        echo json_encode([
            "status" => "error",
            "message" => "Carta documento no encontrada."
        ]);
        exit();
    }

    if ($data['estado'] != CartaDocumentoEstado::AUTORIZADO) {
        $log->error("CartaDocumento",  "Carta documento no autorizada: ID {$cartaDocumentoId}", [
            'cartaDocumentoId' => $cartaDocumentoId,
            'estado' => $data['estado']
        ]);

        http_response_code(403);
        echo json_encode([
            "status" => "error",
            "message" => "La carta documento debe estar autorizada para descargar el PDF."
        ]);
        exit();
    }

    echo json_encode([
        "status" => "success",
        "data" => $data,
        "message" => "Carta documento autorizada para generar PDF."
    ]);
} catch (Exception $e) {
    $log->exception("Error al descargar carta documento ID {$cartaDocumentoId} por usuario ID {$userId}: ", $e->getMessage());
    http_response_code(500);
    echo json_encode([
        "status" => "error",
        "data" => null,
        "message" => "Ocurrio un error al descargar la carta documento. Intente nuevamente m&aacute;s tarde."
    ]);
}