<?php
// Central bootstrap para cargar Composer + .env y promover variables a getenv()
// Uso: require_once __DIR__ . '/Config/bootstrap.php' desde la raíz, o
// require_once __DIR__ . '/../Config/bootstrap.php' desde subdirectorios.

// Evitar duplicados si se incluye varias veces
if (defined('APP_BOOTSTRAP_LOADED')) {
    return;
}
define('APP_BOOTSTRAP_LOADED', true);

// Cargar autoload de Composer si existe
if (file_exists(dirname(__DIR__) . '/vendor/autoload.php')) {
    require_once dirname(__DIR__) . '/vendor/autoload.php';

    // Cargar .env si la librería está disponible
    if (class_exists(\Dotenv\Dotenv::class)) {
        try {
            $dotenv = \Dotenv\Dotenv::createImmutable(dirname(__DIR__));
            $dotenv->safeLoad();
        } catch (Throwable $e) {
            error_log("Error loading .env file: " . $e->getMessage());
        }

        // Promover variables cargadas a putenv() y $_SERVER para que getenv() funcione
        foreach ($_ENV as $k => $v) {
            if ($v === null) continue;
            putenv($k . '=' . $v);
            $_SERVER[$k] = $v;
        }
    }
}

// Fin bootstrap
