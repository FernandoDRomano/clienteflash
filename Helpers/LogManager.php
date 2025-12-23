<?php

namespace Helpers;

class LogManager {
    
    private $logPath;
    private $filePermissions = 0640; // Por defecto: rw-r----- (seguro para producción)
    private $timezone = 'America/Argentina/Tucuman'; // Zona horaria por defecto
    private $logLevels = [
        'DEBUG' => 1,
        'INFO' => 2,
        'NOTICE' => 3,
        'WARNING' => 4,
        'ERROR' => 5,
        'CRITICAL' => 6,
        'ALERT' => 7,
        'EMERGENCY' => 8
    ];
    
    public function __construct($customPath = null) {
        $this->logPath = $customPath ?? __DIR__ . '/../logs/';
        
        // Establecer zona horaria
        date_default_timezone_set($this->timezone);
        
        // Detectar entorno: usar permisos más permisivos solo en desarrollo
        $isDevelopment = getenv('APP_ENV') === 'development' || 
                         getenv('APP_ENV') === 'local' ||
                         !getenv('APP_ENV'); // Si no hay APP_ENV, asumir desarrollo
        
        // En desarrollo: 0666 (rw-rw-rw-) para comodidad
        // En producción: 0640 (rw-r-----) para seguridad
        $this->filePermissions = $isDevelopment ? 0666 : 0640;
        
        // Crear carpeta de logs si no existe
        if (!is_dir($this->logPath)) {
            mkdir($this->logPath, 0755, true);
        }
    }
    
    /**
     * Escribe un mensaje en el log
     * @param string $level Nivel del log (DEBUG, INFO, WARNING, ERROR, etc.)
     * @param string $title Título del mensaje
     * @param string $message Mensaje detallado
     * @param array $context Datos adicionales opcionales
     * @return bool
     */
    public function log($level, $title, $message, $context = []) {
        $level = strtoupper($level);
        
        if (!isset($this->logLevels[$level])) {
            $level = 'INFO';
        }
        
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $filename = $this->logPath . $date . '.log';
        
        // Obtener información de dónde se llamó el log
        $caller = $this->getCaller();
        
        // Formatear el mensaje
        $logEntry = $this->formatLogEntry($level, $time, $title, $message, $context, $caller);
        
        // Escribir en el archivo con bloqueo para evitar problemas de concurrencia
        return $this->writeToFile($filename, $logEntry);
    }
    
    /**
     * Obtiene información del archivo y línea que llamó al log
     */
    private function getCaller() {
        $backtrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 4);
        
        // Buscar el primer caller que no sea de esta clase
        foreach ($backtrace as $trace) {
            if (isset($trace['file']) && isset($trace['line'])) {
                // Ignorar llamadas desde esta misma clase (LogManager)
                if (strpos($trace['file'], 'LogManager.php') === false) {
                    return [
                        'file' => $trace['file'],
                        'line' => $trace['line']
                    ];
                }
            }
        }
        
        return ['file' => 'unknown', 'line' => 0];
    }
    
    /**
     * Formatea la entrada del log
     */
    private function formatLogEntry($level, $time, $title, $message, $context, $caller) {
        $entry = "[{$time}] [{$level}] {$title}" . PHP_EOL;
        $entry .= "Archivo: {$caller['file']}:{$caller['line']}" . PHP_EOL;
        $entry .= "Mensaje: {$message}" . PHP_EOL;
        
        if (!empty($context)) {
            $entry .= "Contexto: " . json_encode($context, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) . PHP_EOL;
        }
        
        $entry .= str_repeat('-', 80) . PHP_EOL;
        
        return $entry;
    }
    
    /**
     * Escribe en el archivo de log con bloqueo
     */
    private function writeToFile($filename, $content) {
        $isNewFile = !file_exists($filename);
        
        $fp = fopen($filename, 'a');
        if ($fp) {
            if (flock($fp, LOCK_EX)) {
                fwrite($fp, $content);
                flock($fp, LOCK_UN);
            }
            fclose($fp);
            
            // Si es un archivo nuevo, establecer permisos según el entorno
            if ($isNewFile) {
                chmod($filename, $this->filePermissions);
            }
            
            return true;
        }
        return false;
    }
    
    /**
     * Establece la zona horaria para los logs
     * @param string $timezone Zona horaria (ej: 'America/Argentina/Tucuman')
     */
    public function setTimezone($timezone) {
        $this->timezone = $timezone;
        date_default_timezone_set($this->timezone);
    }
    
    /**
     * Log nivel DEBUG - Información detallada para debugging
     */
    public function debug($title, $message, $context = []) {
        return $this->log('DEBUG', $title, $message, $context);
    }
    
    /**
     * Log nivel INFO - Eventos informativos generales
     */
    public function info($title, $message, $context = []) {
        return $this->log('INFO', $title, $message, $context);
    }
    
    /**
     * Log nivel NOTICE - Eventos normales pero significativos
     */
    public function notice($title, $message, $context = []) {
        return $this->log('NOTICE', $title, $message, $context);
    }
    
    /**
     * Log nivel WARNING - Advertencias que no son errores
     */
    public function warning($title, $message, $context = []) {
        return $this->log('WARNING', $title, $message, $context);
    }
    
    /**
     * Log nivel ERROR - Errores de ejecución que no requieren acción inmediata
     */
    public function error($title, $message, $context = []) {
        return $this->log('ERROR', $title, $message, $context);
    }
    
    /**
     * Log nivel CRITICAL - Condiciones críticas
     */
    public function critical($title, $message, $context = []) {
        return $this->log('CRITICAL', $title, $message, $context);
    }
    
    /**
     * Log nivel ALERT - Se debe tomar acción inmediata
     */
    public function alert($title, $message, $context = []) {
        return $this->log('ALERT', $title, $message, $context);
    }
    
    /**
     * Log nivel EMERGENCY - Sistema inutilizable
     */
    public function emergency($title, $message, $context = []) {
        return $this->log('EMERGENCY', $title, $message, $context);
    }
    
    /**
     * Log de excepción con stack trace
     */
    public function exception($title, $exception, $context = []) {
        $message = $exception->getMessage();
        $context['file'] = $exception->getFile();
        $context['line'] = $exception->getLine();
        $context['trace'] = $exception->getTraceAsString();
        
        return $this->log('ERROR', $title, $message, $context);
    }
    
    /**
     * Log de query SQL (útil para debugging)
     */
    public function query($title, $sql, $params = [], $executionTime = null) {
        $context = [
            'sql' => $sql,
            'params' => $params
        ];
        
        if ($executionTime !== null) {
            $context['execution_time'] = $executionTime . 'ms';
        }
        
        return $this->log('DEBUG', $title, 'SQL Query ejecutada', $context);
    }
    
    /**
     * Log de solicitud HTTP
     */
    public function httpRequest($title, $method, $url, $data = [], $response = null) {
        $context = [
            'method' => $method,
            'url' => $url,
            'data' => $data
        ];
        
        if ($response !== null) {
            $context['response'] = $response;
        }
        
        return $this->log('INFO', $title, 'HTTP Request', $context);
    }
    
    /**
     * Limpia logs antiguos
     * @param int $days Días de antigüedad para eliminar
     */
    public function cleanOldLogs($days = 30) {
        $files = glob($this->logPath . '*.log');
        $now = time();
        $deleted = 0;
        
        foreach ($files as $file) {
            if (is_file($file)) {
                if ($now - filemtime($file) >= 60 * 60 * 24 * $days) {
                    unlink($file);
                    $deleted++;
                }
            }
        }
        
        return $deleted;
    }
    
    /**
     * Obtiene logs del día actual
     */
    public function getTodayLogs() {
        $date = date('Y-m-d');
        $filename = $this->logPath . $date . '.log';
        
        if (file_exists($filename)) {
            return file_get_contents($filename);
        }
        
        return null;
    }
    
    /**
     * Obtiene logs de una fecha específica
     */
    public function getLogsByDate($date) {
        $filename = $this->logPath . $date . '.log';
        
        if (file_exists($filename)) {
            return file_get_contents($filename);
        }
        
        return null;
    }
}