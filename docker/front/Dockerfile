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
