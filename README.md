# ClienteFlash

Portal web para gestión de cartas documentos y piezas postales. Sistema dual con acceso diferenciado para clientes SISPO y usuarios internos de Correo Flash.

## 📋 Descripción

ClienteFlash es una plataforma web dividida en dos grandes áreas:

### **Portal de Clientes SISPO**
- Carga y gestión de cartas documentos
- Búsqueda de piezas y consulta de estados
- Sistema de autorización por perfiles
- Generación de PDFs de las cartas documentos
  
### **Herramientas Internas**
- Asignación de códigos de barra a cartas documentos
- Impresión masiva de documentos
- Control de piezas y gestión postal
- Panel de administración
- Etc.

---

## 🛠️ Tecnologías

| Tecnología | Versión | Propósito |
|------------|---------|-----------|
| **PHP** | 7.4 | Lenguaje backend |
| **Apache** | 2.4 | Servidor web |
| **MySQL** | 5.7+ | Base de datos |
| **Docker** | 20.10+ | Contenedorización |
| **Composer** | 2.x | Gestor de dependencias PHP |
| **PHPMailer** | 6.x | Envío de correos electrónicos |
| **jsPDF** | - | Generación de PDFs cliente-side |
| **jQuery** | 3.3.1 | Framework JavaScript |
| **Bootstrap** | - | Framework CSS |

### **Extensiones PHP requeridas:**
- `pdo_mysql`, `mysqli` - Conexión a MySQL
- `gd`, `mbstring` - Procesamiento de imágenes y cadenas
- `zip`, `curl` - Archivos y peticiones HTTP
- `xml`, `intl`, `bcmath` - Procesamiento XML y matemáticas

---

## 📦 Requisitos Previos

- **Docker** y **Docker Compose**
- **Git**
- **PHP 7.4** (local, opcional para desarrollo sin Docker)
- **Composer** (para gestión de dependencias)

---

## 🚀 Instalación con Docker

### **1. Clonar el repositorio**

```bash
git clone https://github.com/FernandoDRomano/clienteflash.git
cd clienteflash.sppflash.com.ar
```

### **2. Instalar dependencias PHP**

```bash
composer install
```

### **3. Configurar variables de entorno**

Copiar el archivo de ejemplo y configurar:

```bash
cp .env.example .env
```

Editar `.env` con las credenciales correctas:

```dotenv
# Entorno
APP_ENV=development
APP_DEBUG=true
APP_URL=http://localhost:8101

# Base de datos principal (ClienteFlash)
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sispoc5_correoflash
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña

# Base de datos SISPO (Gestión Postal)
DB_HOST_SISPO=sispo.com.ar
DB_PORT_SISPO=3306
DB_DATABASE_SISPO=sispoc5_gestionpostal
DB_USERNAME_SISPO=tu_usuario
DB_PASSWORD_SISPO=tu_contraseña

# SMTP
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=correo.flash.mail@gmail.com
MAIL_PASSWORD=tu_contraseña_de_aplicacion
MAIL_ENCRYPTION=tls
MAIL_FROM="Correo Flash"

# Correo de desarrollo (recibe todas las notificaciones en dev)
MAIL_RECEPCION_DESARROLLO="desarrollo2@correoflash.com"

# Sesiones
SESSION_SAVE_PATH=tmp
```

### **4. Crear directorio de logs**

```bash
mkdir -p logs
chmod 755 logs
```

### **5. Configurar permisos para Docker**

Es necesario dar permisos de escritura a las siguientes carpetas:

```bash
# Logs de la aplicación
chmod 777 logs/

# Firmas digitales de clientes (uploads)
mkdir -p XMLHttpRequest/FirmasDeClientes/uploads
chmod 777 XMLHttpRequest/FirmasDeClientes/uploads/
```

> **Nota:** Estos permisos son necesarios porque el contenedor Docker ejecuta Apache con un usuario diferente (www-data) que necesita escribir en estos directorios.

### **6. Levantar el contenedor**

```bash
docker-compose up -d
```

### **7. Verificar que el contenedor está corriendo**

```bash
docker ps
```

Deberías ver el contenedor `clienteflash_web` corriendo en el puerto `8101`.

### **8. Acceder a la aplicación**

Abrir en el navegador: **http://localhost:8101**

---

## 🗂️ Estructura del Proyecto

```
clienteflash.sppflash.com.ar/
├── Config/                  # Configuración del sistema
│   ├── bootstrap.php        # Carga de Composer + .env
│   ├── Autoload.php         
│   ├── Enrutador.php        
│   └── Request.php          
│
├── Controllers/             # Controladores MVC
│   ├── logController.php    # Autenticación y sesiones
│   ├── apiController.php    
│   └── ...
│
├── Models/                  # Modelos de datos
│   ├── Conexion.php         # Conexión BD principal
│   ├── ConexionSispo.php    # Conexión BD SISPO
│   ├── Log.php              # Modelo de autenticación
│   ├── PerfilCliente.php    # Constantes de perfiles
│   └── ...
│
├── Views/                   # Vistas HTML/PHP
│
├── Helpers/                 # Utilidades reutilizables
│   └── LogManager.php       # Sistema de logs centralizado
│
├── Service/                 # Servicios de negocio
│   ├── EmailService.php     # Envío de correos centralizado
│   └── InsertarPiezaGestionPostal.php
│
├── Js/                      # JavaScript del cliente
│   └── Solicitudesdelcliente/
│       └── AjaxCartadocumento.js  # Generación de PDFs
│
├── XMLHttpRequest/          # Scripts AJAX del backend
│
├── logs/                    # Archivos de log (auto-generados)
│   └── YYYY-MM-DD.log
│
├── tmp/                     # Sesiones PHP temporales
│
├── .env                     # Variables de entorno (NO versionar)
├── .env.example             # Plantilla de variables
├── docker-compose.yml       # Configuración Docker
├── Dockerfile               # Imagen Docker personalizada
└── composer.json            # Dependencias PHP
```

---

## 🏗️ Arquitectura y Flujo de Trabajo

ClienteFlash utiliza una **arquitectura MVC personalizada** con enrutamiento basado en URL. El sistema sigue un patrón consistente en toda la aplicación:

### **Flujo de Solicitud**

**URL:** `http://localhost:8101/pedidodeenvio/cartadocumento`

```
┌─────────────────────────────────────────────────────────────┐
│ 1. ENRUTADOR (Config/Enrutador.php)                        │
│    Analiza URL: /pedidodeenvio/cartadocumento              │
│    - Controlador: pedidodeenvio                             │
│    - Método: cartadocumento()                               │
└─────────────────────────────────────────────────────────────┘
                            ↓
┌─────────────────────────────────────────────────────────────┐
│ 2. CONTROLADOR                                              │
│    Controllers/pedidodeenvioController.php                  │
│    - Método: cartadocumento()                               │
│    - Procesa lógica de negocio                              │
│    - Llama a modelos si es necesario                        │
└─────────────────────────────────────────────────────────────┘
                            ↓
┌─────────────────────────────────────────────────────────────┐
│ 3. VISTA                                                    │
│    Views/pedidodeenvio/cartadocumento.php                   │
│    - Renderiza HTML                                         │
│    - Carga JavaScript correspondiente                       │
└─────────────────────────────────────────────────────────────┘
                            ↓
┌─────────────────────────────────────────────────────────────┐
│ 4. JAVASCRIPT                                               │
│    Js/Pedidodeenvio/AjaxCartaDocumento.js                   │
│    - Maneja interacciones del cliente                       │
│    - Envía peticiones AJAX                                  │
└─────────────────────────────────────────────────────────────┘
                            ↓
┌─────────────────────────────────────────────────────────────┐
│ 5. BACKEND AJAX                                             │
│    XMLHttpRequest/PedidoDeEnvio/ajax....php                 │
│    - Procesa peticiones AJAX                                │
│    - Retorna JSON/respuestas                                │
└─────────────────────────────────────────────────────────────┘
```

### **Convenciones de Nomenclatura**

| Componente | Ubicación | Nomenclatura |
|------------|-----------|--------------|
| **URL** | `/seccion/accion` | Minúsculas |
| **Controlador** | `Controllers/seccionController.php` | CamelCase + "Controller" |
| **Método** | `public function accion()` | CamelCase |
| **Vista** | `Views/seccion/accion.php` | Minúsculas |
| **JavaScript** | `Js/Seccion/AjaxAccion.js` | PascalCase + "Ajax" |
| **AJAX Backend** | `XMLHttpRequest/Seccion/ajax*.php` | PascalCase + "ajax" |

### **Ejemplo Completo**

Para la URL `http://localhost:8101/pedidodeenvio/cartadocumento`:

```php
// Controllers/pedidodeenvioController.php
<?php namespace Controllers;

class pedidodeenvioController {
    public function cartadocumento() {
        // Lógica del controlador
        // Carga la vista automáticamente
    }
}
?>
```

```php
<!-- Views/pedidodeenvio/cartadocumento.php -->
<h1>Carta Documento</h1>
<script src="/Js/Pedidodeenvio/AjaxCartaDocumento.js"></script>
```

```javascript
// Js/Pedidodeenvio/AjaxCartaDocumento.js
function guardarCartaDocumento() {
    $.ajax({
        url: '/XMLHttpRequest/PedidoDeEnvio/ajaxGuardarCarta.php',
        method: 'POST',
        data: { /* datos */ },
        success: function(response) { /* ... */ }
    });
}
```

```php
// XMLHttpRequest/PedidoDeEnvio/ajaxGuardarCarta.php
<?php
// Procesa la petición AJAX
echo json_encode(['success' => true]);
?>
```

> **Nota:** Este patrón se repite consistentemente en todo el proyecto, facilitando la navegación y el mantenimiento del código.

---

## 🔧 Helpers y Services

### **LogManager** (`Helpers/LogManager.php`)

Sistema centralizado de registro de eventos con niveles de severidad.

**Características:**
- Logs organizados por fecha (`logs/2026-01-09.log`)
- 8 niveles de severidad (DEBUG, INFO, NOTICE, WARNING, ERROR, CRITICAL, ALERT, EMERGENCY)
- Detección automática de archivo/línea donde se llamó el log
- Permisos ajustables según entorno (desarrollo/producción)
- Soporte para contexto adicional (arrays, objetos)

**Uso:**

```php
use Helpers\LogManager;

$logger = new LogManager();

// Log simple
$logger->info("Usuario autenticado", "Login exitoso");

// Log con contexto
$logger->warning("Intento de login fallido", "Credenciales incorrectas", [
    'usuario' => 'juan@example.com',
    'ip' => '192.168.1.100'
]);

// Log de excepción
try {
    // código...
} catch (Exception $e) {
    $logger->exception("Error en proceso", $e);
}
```

**Formato del log:**

```
[14:32:15] [WARNING] Intento de login fallido
Archivo: /var/www/html/Controllers/logController.php:95
Mensaje: Credenciales incorrectas
Contexto:
  - usuario: juan@example.com
  - ip: 192.168.1.100
───────────────────────────────────────────────
```

### **EmailService** (`Service/EmailService.php`)

Servicio centralizado para envío de correos electrónicos.

**Características:**
- Configuración SMTP desde variables de entorno
- Plantillas pre-definidas para notificaciones
- Modo desarrollo: redirige emails a `MAIL_RECEPCION_DESARROLLO`
- Soporte para HTML y adjuntos
- Registro automático de errores en logs

**Funciones principales:**

```php
use Service\EmailService;

$emailService = new EmailService();

// Email personalizado
$emailService->send(
    $para,
    $asunto,
    $mensaje,
    $options = []
);
```

**Ejemplo:**

```php
$emailService->send(
    'cliente@example.com',
    'Carta Documento #12345 Creada',
    '<h1>Su carta documento ha sido registrada</h1><p>Número: 12345</p>'
);
```

---

## 🗄️ Conexiones a Base de Datos

El sistema utiliza **dos bases de datos MySQL** independientes:

### **1. Base de Datos Principal** (`sispoc5_correoflash`)

**Clase:** `Models\Conexion`

**Variables de entorno:**
- `DB_HOST` - Host del servidor (ej: `127.0.0.1`)
- `DB_PORT` - Puerto MySQL (default: `3306`)
- `DB_DATABASE` - Nombre de la BD: `sispoc5_correoflash`
- `DB_USERNAME` - Usuario de conexión
- `DB_PASSWORD` - Contraseña

**Tablas principales:**
- `usuario` - Usuarios internos del sistema
- `cliente` - Clientes SISPO
- `IPIntentosDeLogin` - Control anti-fuerza bruta
- `password_resets` - Tokens de recuperación de contraseña
- `menu`, `menudeusuarios` - Sistema de menús por perfil

**Uso:**

```php
use Models\Conexion;

$con = new Conexion();

// Consulta simple (sin retorno)
$con->consultaSimple("UPDATE tabla SET campo = 'valor' WHERE id = 1");

// Consulta con retorno
$resultado = $con->consultaRetorno("SELECT * FROM usuario WHERE id = 1");
$datos = mysqli_fetch_assoc($resultado);
```

### **2. Base de Datos SISPO** (`sispoc5_gestionpostal`)

**Clase:** `Models\ConexionSispo`

**Variables de entorno:**
- `DB_HOST_SISPO` - Host del servidor SISPO
- `DB_PORT_SISPO` - Puerto MySQL
- `DB_DATABASE_SISPO` - Nombre de la BD: `sispoc5_gestionpostal`
- `DB_USERNAME_SISPO` - Usuario de conexión
- `DB_PASSWORD_SISPO` - Contraseña

**Tablas principales:**
- `flash_clientes` - Clientes y estados
- `piezas` - Información de piezas postales
- `estados` - Estados de las piezas

**Uso:**

```php
use Models\ConexionSispo;

$con = new ConexionSispo();
$resultado = $con->consultaRetorno("SELECT * FROM flash_clientes WHERE id = 1");
```

### **Métodos Disponibles en Ambas Clases:**

| Método | Descripción | Retorno |
|--------|-------------|---------|
| `consultaSimple($sql)` | Ejecuta INSERT, UPDATE, DELETE | void |
| `consultaRetorno($sql)` | Ejecuta SELECT | mysqli_result |
| `getConnection()` | Obtiene conexión mysqli | mysqli |
| `escapeString($str)` | Escapa string para SQL | string |

---

## 👥 Perfiles de Usuario para clientes de SISPO

Definidos en `Models/PerfilCliente.php`:

```php
const ADMINISTRADOR = 1;  // Acceso total
const AUTORIZADOR = 2;    // Puede autorizar cartas documentos (insertar en SISPO)
const CREADOR = 3;        // Puede crear cartas documentos (borrador)
const IMPRIMIDOR = 4;     // Puede imprimir cartas documentos
const DEFAULT = 5;        // Visualización básica
```

**Funcionalidades por perfil:**

| Perfil | Crear CD | Autorizar CD | Imprimir | Gestionar |
|--------|----------|--------------|----------|-----------|
| **ADMINISTRADOR** | ✅ | ✅ | ✅ | ✅ |
| **AUTORIZADOR** | ❌ | ✅ | ❌ | ✅ |
| **CREADOR** | ✅ | ❌ | ❌ | ❌ |
| **IMPRIMIDOR** | ❌ | ❌ | ✅ | ❌ |
| **DEFAULT** | ✅ | ❌ | ✅ | ❌ |

---

## 🔐 Autenticación y Seguridad

### **Sistema Dual de Login**

El método `logController::verificar()` implementa dos flujos:

1. **Login de Clientes SISPO:**
   - Verifica en tabla `cliente`
   - Valida con `password_verify()` (bcrypt)
   - Comprueba estado activo en BD SISPO
   - Asigna menús según perfil

2. **Login de Usuarios Internos:**
   - Verifica en tabla `usuario`
   - Implementa protección anti-fuerza bruta
   - Bloqueo temporal por IP + usuario (30 min)
   - Máximo 5 intentos fallidos

### **Protección Anti-Fuerza Bruta**

Implementado en `Models/Log.php`:

- **Bloqueo granular:** Por combinación IP + usuario (no bloquea IPs completas)
- **Límite:** 5 intentos fallidos
- **Duración:** 30 minutos de bloqueo
- **Auto-expiración:** Los intentos se limpian automáticamente
- **Registro:** Logs en `IPIntentosDeLogin`

**Flujo:**

```
Intento 1-4: Login fallido → Registra en BD
Intento 5:   Login fallido → BLOQUEO temporal
Espera 30m:  Intentos expirados → Puede volver a intentar
```

### **Recuperación de Contraseña (Solamente para usuarios de clientes de SISPO)**

Sistema de tokens seguros con hash SHA-256:

1. Usuario solicita recuperación
2. Se genera `selector` y `validator` aleatorios
3. Se guarda hash del validator en BD
4. Se envía link con selector + validator por email
5. Usuario accede al link (válido 1 hora)
6. Sistema valida token con `hash_equals()`
7. Token se marca como usado

---

## 🧪 Credenciales de Prueba

### **Cliente SISPO**
```
Usuario: PRUEBA CD
Contraseña: [Consultar con jefe de sistemas]
```

### **Usuario Interno**
Consultar en la base de datos o con el jefe de sistemas.

---

## 🐛 Troubleshooting

### **Error 500 - Internal Server Error**

**Solución:** Habilitar logs de error de PHP

1. Verificar logs del contenedor:
   ```bash
   docker logs clienteflash_web
   ```

2. Revisar logs de la aplicación:
   ```bash
   tail -f logs/$(date +%Y-%m-%d).log
   ```

3. Verificar permisos:
   ```bash
   chmod 777 logs/
   chmod 666 logs/*.log
   ```

### **Errores de permisos en Docker**

Si el contenedor no puede escribir logs o subir archivos de firmas:

```bash
# Dar permisos completos a logs
chmod 777 logs/

# Dar permisos completos a uploads de firmas
chmod 777 XMLHttpRequest/FirmasDeClientes/uploads/
```

Si el problema persiste, verificar propietario del contenedor:

```bash
# Ver con qué usuario corre Apache en el contenedor
docker exec -it clienteflash_web whoami

# Cambiar propietario si es necesario
docker exec -it clienteflash_web chown -R www-data:www-data /var/www/html/logs
docker exec -it clienteflash_web chown -R www-data:www-data /var/www/html/XMLHttpRequest/FirmasDeClientes/uploads
```

### **Error de conexión a base de datos**

1. Verificar que las variables de entorno están correctas en `.env`
2. Probar conexión desde el contenedor:
   ```bash
   docker exec -it clienteflash_web mysql -h DB_HOST -u DB_USERNAME -p
   ```

### **Sesiones no persisten**

1. Verificar que existe el directorio `tmp/`:
   ```bash
   mkdir -p tmp && chmod 777 tmp
   ```

2. Verificar variable `SESSION_SAVE_PATH` en `.env`

### **Emails no se envían**

1. Verificar credenciales SMTP en `.env`
2. Si usas Gmail, crear [contraseña de aplicación](https://support.google.com/accounts/answer/185833)
3. Revisar logs: `grep "EmailService" logs/*.log`

### **PDF no se genera**

1. Abrir consola del navegador (F12)
2. Revisar errores JavaScript
3. Verificar que las firmas existen en `/XMLHttpRequest/FirmasDeClientes/uploads/`
4. Verificar timeout (30s) en caso de muchas firmas

### **El contenedor no inicia**

1. Verificar que el puerto 8101 no esté en uso:
   ```bash
   lsof -i :8101
   ```

2. Reconstruir imagen:
   ```bash
   docker-compose down
   docker-compose build --no-cache
   docker-compose up -d
   ```

---

## 📝 Desarrollo

### **Agregar nuevos logs**

```php
use Helpers\LogManager;

$logger = new LogManager();
$logger->debug("Título", "Mensaje detallado", ['dato' => 'valor']);
```

### **Enviar emails personalizados**

```php
use Service\EmailService;

$emailService = new EmailService();
$emailService->enviarEmail(
    'destinatario@example.com',
    'Asunto del correo',
    '<p>Contenido HTML</p>'
);
```

### **Crear nueva conexión a BD**

```php
use Models\Conexion;

$con = new Conexion();
$sql = "SELECT * FROM tabla WHERE id = ?";
// Nota: Migrar a prepared statements para mayor seguridad
```

### **Mejores prácticas**

- ✅ Usar `LogManager` para todos los eventos importantes
- ✅ Validar inputs con `filter_input()` o `mysqli_real_escape_string()`
- ✅ Usar `password_hash()` y `password_verify()` para contraseñas
- ✅ Implementar try-catch en operaciones críticas
- ✅ Registrar errores en lugar de mostrarlos al usuario
- ⚠️ **TODO:** Migrar consultas SQL a prepared statements

---

## 📚 Stack Tecnológico Completo

### **Backend**
- PHP 7.4 (Apache 2.4)
- Composer para autoloading PSR-4
- PHPMailer 6.x (SMTP)
- phpdotenv 5.5 (variables de entorno)

### **Frontend**
- jQuery 3.3.1
- Bootstrap
- jsPDF (generación de PDFs)
- JsBarcode (códigos de barra)

### **Base de Datos**
- MySQL 5.7+
- Dos bases de datos independientes
- Charset: UTF-8

### **DevOps**
- Docker + Docker Compose
- Volúmenes persistentes
- Auto-restart

---

## 🔄 Migración y Versionado

### **Versión PHP**

El proyecto usa **PHP 7.4** porque es la última versión disponible en el servidor SISPO de producción. Actualmente se está migrando del servidor `sppflash` a `sispo`.

### **Roadmap**
- ✅ Migración a servidor SISPO
- ✅ Sistema de logs centralizado
- ✅ Protección anti-fuerza bruta mejorada
- ⏳ Migración a PHP 8.x (cuando el servidor lo soporte)
- ⏳ Prepared statements en todas las consultas
- ⏳ Sistema de migraciones de BD

---

## 📞 Soporte

Para consultas técnicas o credenciales de acceso, contactar al **Jefe de Sistemas**.

---

## 📄 Licencia

Propiedad de Correo Flash - Uso interno exclusivo.

---

**Última actualización:** Enero 2026
