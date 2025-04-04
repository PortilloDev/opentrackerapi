FROM node:18-alpine

WORKDIR /var/www/html

# Configurar npm para usar el registro público
RUN npm config set registry https://registry.npmjs.org/

# Instalar dependencias globales (sin actualizar npm)
# Eliminamos la actualización de npm que estaba causando problemas
# RUN npm install -g npm@latest

CMD ["tail", "-f", "/dev/null"]