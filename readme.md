# Proyecto ESP32 para Adquisición Automática de Datos

## Descripción del Proyecto

Este proyecto tiene como objetivo tomar datos de una máquina de producción, específicamente el peso de la materia prima (bobinas de papel) que ingresa a la máquina y los metros de papel que utiliza. Además, el sistema puede actuar sobre un centrador de banda para mejorar la calidad del proceso productivo.

## Características Principales

- **Medición del Peso**: Utiliza un módulo HX711 para medir el peso de la materia prima y mostrarlo en una página web accesible desde la IP del ESPWROOM32.
- **Conteo de Vueltas**: Un sensor inductivo cuenta las vueltas del rodillo, lo cual también se muestra en la página web.
- **Control del Motor**: A través de peticiones HTTP como "192.168.0.184/ena_f" o "192.168.0.184/ena_r", se puede actuar sobre un motor para modificar la posición en el proceso productivo.

## Funcionalidades del Software

1. **Medición y Visualización del Peso**:
   - Muestra el peso en tiempo real en la página web.
2. **Conteo y Visualización de Vueltas**:
   - Muestra el conteo de vueltas del rodillo en la página web.
3. **Control del Motor a través de Peticiones HTTP**:
   - Permite controlar el motor utilizando comandos HTTP para ajustar el centrador de banda.

## Instalación y Configuración

Los pasos detallados para la instalación y configuración inicial del proyecto se encuentran en el archivo [docs/Installation.md](docs/Installation.md).