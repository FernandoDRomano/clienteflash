<?php 

//Iniciar sessiones si no están iniciadas
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

header("Access-Control-Allow-Origin: *");
	
// Bootstrap central: carga Composer + .env y promueve variables (ver Config/bootstrap.php)
require_once __DIR__ . '/../../Config/bootstrap.php';

use Models\CartaDocumento;
use Models\PerfilCliente;

//Obtener datos de la request
$request = file_get_contents("php://input");
$request = json_decode($request, true);

$clienteId = $request['clientId'] ?? null;
$userId = $request['userId'] ?? null;
$perfilUsuario = $request['perfilId'] ?? null;
$fechaDesde = $request['fechaDesde'] ?? null;
$fechaHasta = $request['fechaHasta'] ?? null;
$usuarioCD = $request['usuarioCD'] ?? null;
$estadoCD = $request['estadoCD'] ?? null;

//Validar que el usuario tenga permisos para realizar esta acción
if (!in_array($perfilUsuario, [PerfilCliente::ADMINISTRADOR, PerfilCliente::AUTORIZADOR, PerfilCliente::IMPRIMIDOR])) {
    http_response_code(403);
    echo json_encode([
        "status" => "error",
        "message" => "No tiene permisos para realizar esta acción."
    ]);
    exit();
}

$cd = new CartaDocumento();
$data = $cd->filtrar([
    'cliente_id' => $clienteId,
    'user_id' => $usuarioCD,
    'estado' => $estadoCD,
    'fecha_desde' => $fechaDesde,
    'fecha_hasta' => $fechaHasta
]);

if (!$data) {
    http_response_code(404);
    echo json_encode([
        "status" => "error",
        "message" => "No se encontraron cartas documentos con los filtros proporcionados."
    ]);
    exit();
}

echo json_encode([
    "status" => "success",
    "data" => $data,
    "message" => "Cartas documentos obtenidas correctamente."
]);