<?php

namespace Service;

// Cargar PHPMailer
require_once __DIR__ . '/../PHPMailer/Exception.php';
require_once __DIR__ . '/../PHPMailer/PHPMailer.php';
require_once __DIR__ . '/../PHPMailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Helpers\LogManager;

/**
 * Servicio de envío de emails
 * 
 * Centraliza toda la lógica de envío de correos usando PHPMailer
 * Integrado con LogManager para trazabilidad
 */
class EmailService {

    private $log;
    private $smtpHost;
    private $smtpPort;
    private $smtpUsername;
    private $smtpPassword;
    private $smtpEncryption;
    private $fromEmail;
    private $fromName;

    /**
     * Constructor - Carga configuración SMTP desde variables de entorno
     */
    public function __construct() {
        $this->log = new LogManager();
        
        // Cargar configuración desde .env
        $this->smtpHost = getenv('MAIL_HOST');
        $this->smtpPort = getenv('MAIL_PORT');
        $this->smtpUsername = getenv('MAIL_USERNAME');
        $this->smtpPassword = getenv('MAIL_PASSWORD');
        $this->smtpEncryption = getenv('MAIL_ENCRYPTION');
        $this->fromEmail = getenv('MAIL_USERNAME');
        $this->fromName = getenv('MAIL_FROM') ?: 'Correo Flash';
    }

    /**
     * Enviar email
     * 
     * @param string|array $to Destinatario(s) - string separado por comas o array
     * @param string $subject Asunto del email
     * @param string $body Cuerpo del mensaje (puede ser HTML)
     * @param array $options Opciones adicionales: cc, bcc, attachments, isHtml, replyTo
     * @return bool True si se envió correctamente
     * @throws Exception Si hay error en el envío
     */
    public function send($to, $subject, $body, $options = []) {
        try {
            $mail = new PHPMailer(true);

            // Configuración del servidor SMTP
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = $this->smtpEncryption;
            $mail->Host = $this->smtpHost;
            $mail->Port = $this->smtpPort;
            $mail->Username = $this->smtpUsername;
            $mail->Password = $this->smtpPassword;
            $mail->CharSet = 'UTF-8';
            $mail->Timeout = 10;

            // Remitente
            $mail->setFrom($this->fromEmail, $this->fromName);

            // ReplyTo (opcional)
            if (isset($options['replyTo'])) {
                $replyToEmail = is_array($options['replyTo']) ? $options['replyTo'][0] : $options['replyTo'];
                $replyToName = is_array($options['replyTo']) && isset($options['replyTo'][1]) ? $options['replyTo'][1] : '';
                $mail->addReplyTo($replyToEmail, $replyToName);
            }

            // Destinatarios principales
            $this->addRecipients($mail, $to, 'to');

            // CC (con copia)
            if (isset($options['cc'])) {
                $this->addRecipients($mail, $options['cc'], 'cc');
            }

            // BCC (con copia oculta)
            if (isset($options['bcc'])) {
                $this->addRecipients($mail, $options['bcc'], 'bcc');
            }

            // Archivos adjuntos
            if (isset($options['attachments']) && is_array($options['attachments'])) {
                foreach ($options['attachments'] as $attachment) {
                    if (is_array($attachment)) {
                        // Formato: ['path' => '...', 'name' => '...']
                        $mail->addAttachment($attachment['path'], $attachment['name'] ?? '');
                    } else {
                        // Solo ruta
                        $mail->addAttachment($attachment);
                    }
                }
            }

            // Contenido
            $isHtml = $options['isHtml'] ?? true;
            $mail->isHTML($isHtml);
            $mail->Subject = html_entity_decode($subject);
            $mail->Body = html_entity_decode($body);

            // Versión texto plano (opcional)
            if ($isHtml && isset($options['altBody'])) {
                $mail->AltBody = $options['altBody'];
            }

            // Enviar
            $mail->send();

            // Log de éxito
            $this->log->info('EmailService', 'Email enviado correctamente', [
                'to' => $to,
                'subject' => $subject,
                'cc' => $options['cc'] ?? null,
                'bcc' => $options['bcc'] ?? null,
                'attachments_count' => isset($options['attachments']) ? count($options['attachments']) : 0
            ]);

            return true;

        } catch (Exception $e) {
            // Log de error
            $this->log->exception('Error al enviar email', $e, [
                'to' => $to,
                'subject' => $subject,
                'error_message' => $e->getMessage()
            ]);

            throw $e;
        }
    }

    /**
     * Agregar destinatarios al objeto PHPMailer
     * 
     * @param PHPMailer $mail Instancia de PHPMailer
     * @param string|array $recipients Destinatarios
     * @param string $type Tipo: 'to', 'cc', 'bcc'
     */
    private function addRecipients($mail, $recipients, $type = 'to') {
        // Convertir a array si es string separado por comas
        if (is_string($recipients)) {
            $recipients = explode(',', $recipients);
        }

        // Asegurar que es array
        if (!is_array($recipients)) {
            $recipients = [$recipients];
        }

        // Agregar cada destinatario
        foreach ($recipients as $recipient) {
            $recipient = trim($recipient);
            if (!empty($recipient)) {
                switch ($type) {
                    case 'cc':
                        $mail->addCC($recipient);
                        break;
                    case 'bcc':
                        $mail->addBCC($recipient);
                        break;
                    case 'to':
                    default:
                        $mail->addAddress($recipient);
                        break;
                }
            }
        }
    }

}
