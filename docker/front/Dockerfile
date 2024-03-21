####### FROM node:18

# Establece el directorio de trabajo dentro del contenedor
####### WORKDIR /app

# Copia los archivos de configuración de la aplicación
####### COPY ./front/package*.json ./
####### RUN npm install

# Copia el resto de los archivos de la aplicación
####### COPY ./front .

# Compila la aplicación Angular
####### RUN npm run build --prod


### RUN mkdir /usr/src/app && mkdir /usr/src/app/front
 
### WORKDIR /usr/src/app/front
# RUN npm cache clean 
### RUN npm install -g @angular/cli@16.2.12

### COPY ./front .

# Etapa de construcción
FROM node:18 AS builder

WORKDIR /app

COPY ./front/package*.json ./
RUN npm install

COPY ./front .
RUN npm run build --prod

# Etapa de producción
FROM nginx:alpine

# Copiar archivos estáticos de Angular al directorio de archivos de Nginx
COPY --from=builder /app/dist/library_admin_front /usr/share/nginx/html

# Opcional: Configuración adicional de Nginx si es necesario


