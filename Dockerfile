# Dockerfile para entorno de desarrollo PHP 7.4 + Apache
FROM php:7.4-apache

# Copiar archivos del proyecto al contenedor
RUN apt-get update \
	&& apt-get install -y libpng-dev libjpeg-dev libfreetype6-dev libzip-dev libonig-dev libxml2-dev libcurl4-openssl-dev libicu-dev libxslt1-dev \
	&& docker-php-ext-install pdo_mysql mysqli gd mbstring zip curl xml intl bcmath \
	&& apt-get clean && rm -rf /var/lib/apt/lists/*
COPY . /var/www/html

# Establecer el directorio de trabajo
WORKDIR /var/www/html

# Configurar permisos
RUN chown -R www-data:www-data /var/www/html

# Habilitar AllowOverride All para .htaccess
RUN sed -i 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf

# Habilitar mod_rewrite para soporte de .htaccess
RUN a2enmod rewrite

# Exponer el puerto 80
EXPOSE 80
