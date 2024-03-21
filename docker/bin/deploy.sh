#!/bin/bash

# Construir la imagen Docker
docker-compose -f docker-compose.yml build
# Iniciar los contenedores
docker-compose -f docker-compose.yml up -d