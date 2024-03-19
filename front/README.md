# Nombre del Proyecto

Sistema para la gestión de biblioteca

## Requisitos

```bash
Angular CLI: 16.2.12
Node: 18.13.0
Package Manager: npm 8.19.3
```

De preferencia instalar nvm, herramienta para poder variar e instalar node.
- https://github.com/coreybutler/nvm-windows

## Instalación

1. Clona este repositorio.
2. Instala las dependencias del proyecto con npm:
   ```bash
   npm install
   ```
3. Inicia el servidor de desarrollo:
    ```bash
    npm start
    ```

## Producción

1. Para ejecutar en modo de producción
    ```bash
    ng build --configuration=production
    ```
2. Esto será almacenado en la carpeta dist/library_admin_front
3. Luego debería desplegarse al hosting correspondiente todo el contenido
