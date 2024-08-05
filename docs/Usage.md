# Usage

## Introducción

Este documento proporciona instrucciones sobre cómo utilizar el proyecto ESP32 para la adquisición automática de datos. El proyecto mide el peso de la materia prima y cuenta las vueltas de un rodillo, además de permitir el control de un motor mediante peticiones HTTP.

## Acceso a la Interfaz Web

1. **Conecta el ESP32 a la Red WiFi**:
   - Asegúrate de que el ESP32 esté conectado a la red WiFi configurada en el archivo `wifi_config.h`.

2. **Encuentra la Dirección IP del ESP32**:
   - Una vez que el ESP32 esté conectado a la red WiFi, busca la dirección IP asignada. Esto se puede hacer verificando la salida del monitor serie del Arduino IDE o utilizando una herramienta de escaneo de red.

3. **Accede a la Página Web del ESP32**:
   - Abre un navegador web y navega a la dirección IP del ESP32, por ejemplo: `http://192.168.0.184`.
   - La interfaz web mostrará la medición actual del peso y el contador de vueltas del rodillo.

## Medición del Peso

- La página web mostrará el peso medido en tiempo real utilizando el módulo HX711.
- Asegúrate de que el sensor de peso esté correctamente conectado y calibrado.

## Conteo de Vueltas

- El sensor inductivo cuenta las vueltas del rodillo y muestra el valor en la página web.
- Verifica que el sensor esté correctamente instalado y funcionando.

## Control del Motor

Puedes controlar el motor utilizando peticiones HTTP. A continuación se detallan los comandos disponibles:

1. **Avanzar Motor**:
   - Envía una petición HTTP a: `http://192.168.0.184/ena_f`
   - Esto hará que el motor avance en una dirección específica.

2. **Reversar Motor**:
   - Envía una petición HTTP a: `http://192.168.0.184/ena_r`
   - Esto hará que el motor avance en la dirección opuesta.

## Ejemplo de Uso

### Paso 1: Conectar a la Red WiFi
```plaintext
Conecta el ESP32 a la red WiFi configurada y anota la dirección IP asignada.
```

### Paso 2: Acceder a la Página Web
```plaintext
Abre un navegador web y navega a la dirección IP del ESP32, por ejemplo: http://192.168.0.184.
```

### Paso 3: Monitorear Datos en Tiempo Real
```plaintext
Observa las mediciones de peso y el contador de vueltas en la interfaz web.
```

### Paso 4: Controlar el Motor
```plaintext
Envía una petición HTTP a http://192.168.0.184/ena_f para avanzar el motor.
Envía una petición HTTP a http://192.168.0.184/ena_r para reversar el motor.
```

## Solución de Problemas

- **No se puede acceder a la interfaz web**:
  - Verifica la conexión del ESP32 a la red WiFi.
  - Asegúrate de que la dirección IP sea correcta.
  - Revisa las conexiones de hardware.

- **Lecturas de peso incorrectas**:
  - Asegúrate de que el sensor de peso esté correctamente calibrado y conectado.

- **El motor no responde a los comandos HTTP**:
  - Verifica las conexiones del motor.
  - Asegúrate de que las peticiones HTTP se estén enviando correctamente.