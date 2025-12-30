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
use Helpers\LogManager;
use Service\InsertarPiezaGestionPostal;

$log = new LogManager();

//Obtener datos de la request
$request = file_get_contents("php://input");
$request = json_decode($request, true);

$log->info("AjaxAutorizarCartaDocumento", "Request recibida", $request);

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

    // Preparar datos para insertar pieza en Gestión Postal
    $codigo_postal = $data['destinatario_cp'];
    $provincia = !empty($data['destinatario_provincia']) ? $data['destinatario_provincia'] : $data['destinatario_provincia_nombre'];
    $localidad_ciudad = !empty($data['destinatario_localidad']) ? $data['destinatario_localidad'] : $data['destinatario_localidad_nombre'];
    $calle = $data['destinatario_calle'];
    $numero = $data['destinatario_numero'];
    $piso = $data['destinatario_piso'];
    $depto = $data['destinatario_departamento'];

    $destinatario = $data['destinatario_apellido'] . " " . $data['destinatario_nombre'];
    
    $domicilio = $calle . " " . $numero;
    if($piso != "") $domicilio .= " Piso: " . $piso;
    if($depto != "") $domicilio .= " Depto: " . $depto;

    $data = [
        'clienteId' => $clienteId,
        'codigo_externo' => '',
        'destinatario' => $destinatario,
        'domicilio' => $domicilio,
        'codigo_postal' => $codigo_postal,
        'localidad' => $localidad_ciudad,
        'remitenteNombre' => $data['remitente_nombre'],
        'remitenteApellido' => $data['remitente_apellido'],
        'remitenteCP' => $data['remitente_cp'],
        'remitenteProvincia' => $data['remitente_provincia'],
        'remitenteLocalidad' => $data['remitente_localidad'],
        'remitenteCalle' => $data['remitente_calle'],
        'remitenteNumero' => $data['remitente_numero'],
        'remitentePiso' => $data['remitente_piso'],
        'remitenteDepartamento' => $data['remitente_departamento'],
        'destinatarioNombre' => $data['destinatario_nombre'],
        'destinatarioApellido' => $data['destinatario_apellido'],
        'destinatarioCP' => $data['destinatario_cp'],
        'destinatarioProvincia' => $data['destinatario_provincia'],
        'destinatarioLocalidad' => $data['destinatario_localidad'],
        'destinatarioCalle' => $data['destinatario_calle'],
        'destinatarioNumero' => $data['destinatario_numero'],
        'destinatarioPiso' => $data['destinatario_piso'],
        'destinatarioDepartamento' => $data['destinatario_departamento'],
        'destinatarioEmail' => $data['destinatario_email'],
        'destinatarioCelular' => $data['destinatario_celular'],
        'apoderadoNombre' => $data['firmante_nombre'],
        'apoderadoApellido' => $data['firmante_apellido'],
        'apoderadoTipoDocumento' => $data['firmante_tipo_documento'],
        'apoderadoDocumento' => $data['firmante_documento'],
        'apoderadoFirma' => $data['firma_cliente'],
        'formulario' => $data['contenido']
    ];

    $log->info("AjaxAutorizarCartaDocumento", "Datos preparados para insertar pieza en Gestión Postal", $data);

    // Insertar Pieza en Gestión Postal
    $insertarPiezaService = new InsertarPiezaGestionPostal();
    $resultGestionPostal = $insertarPiezaService->ejecutar($data);

    // Autorizar carta documento
    $cartaDocumento->autorizar($cartaDocumentoId, $userId);

    $log->info("AjaxAutorizarCartaDocumento", "Carta documento autorizada", [
        'cartaDocumentoId' => $cartaDocumentoId,
        'userId' => $userId
    ]);

    echo json_encode([
        "status" => "success",
        "data" => $resultGestionPostal,
        "message" => "Carta documento autorizada correctamente."
    ]);
} catch (Exception $e) {
    $log->exception("Error al autorizar carta documento ID {$cartaDocumentoId} por usuario ID {$userId}: ", $e->getMessage());
    http_response_code(500);
    echo json_encode([
        "status" => "error",
        "data" => null,
        "message" => "Ocurrio un error al autorizar la carta documento. Intente nuevamente m&aacute;s tarde."
    ]);
}