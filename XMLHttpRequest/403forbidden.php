<?php
	//header('HTTP/1.1 403 Forbidden');
?>
<html>
    <head>
		<link rel="stylesheet" type="text/css" href="Error.css">
        <title>Congratulations! You have been DENIED access</title>
    </head>
    <body>
        <div class="services">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="title">
                            <h1>Error 404</h1>
                            <div class="line"></div>
                            <p>Disculpe, la página <strong><?php //echo("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"); ?></strong> no existe en nuestro sistema.</p>
							<a href="http://misenvios.com.ar:8081/MisEnvios/logueo.php">http://misenvios.com.ar:8081/MisEnvios/logueo.php</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>