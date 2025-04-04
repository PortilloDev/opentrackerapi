#!/bin/bash

# Cambiar al directorio de la aplicación
cd /Applications/Projects/backend-php/website || exit

# Instalar dependencias con Composer
echo "Instalando dependencias con Composer..."
composer install --no-interaction --prefer-dist --optimize-autoloader
if [ $? -ne 0 ]; then
    echo "Error al instalar dependencias con Composer."
    exit 1
fi

# Ejecutar migraciones de la base de datos
echo "Ejecutando migraciones de la base de datos..."
php artisan migrate --force
if [ $? -ne 0 ]; then
    echo "Error al ejecutar migraciones."
    exit 1
fi

# Limpiar y cachear la configuración
echo "Limpiando y cacheando la configuración..."
php artisan config:clear
php artisan config:cache
if [ $? -ne 0 ]; then
    echo "Error al limpiar o cachear la configuración."
    exit 1
fi

# Iniciar el trabajador de colas
echo "Iniciando el trabajador de colas..."
php artisan queue:work
if [ $? -ne 0 ]; then
    echo "Error al iniciar el trabajador de colas."
    exit 1
fi

