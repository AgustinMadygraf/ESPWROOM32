//counter.cpp
#include "counter.h"
#include <ArduinoLog.h>
#include "interface.h"

// Variable global para almacenar el conteo de vueltas
volatile int lapCounter = 0;

// Pin del sensor inductivo
const int induct = 15; 

// Estado anterior del sensor
volatile bool lastSensorState = LOW;

/**
 * Función de interrupción para detectar el flanco ascendente del sensor inductivo.
 * Esta función se llama automáticamente cuando hay un cambio en el pin del sensor.
 */
//void IRAM_ATTR onLapDetected() {
void onLapDetected() {

    bool currentState = digitalRead(induct);
    // Incrementar el contador de vueltas solo en el flanco ascendente
    if (currentState == LOW && lastSensorState == HIGH ) {
        lapCounter++;
        Log.info("Cambio de estado detectado\n");
        Log.info("Contador: %d\n", lapCounter);
        String lcd_display_text = "Contador: " + String(lapCounter) + "   ";
        updateLCDTop(lcd_display_text);
        String response_text = "Contador: " + String(lapCounter);
        sendServerResponse(response_text);
    }
    lastSensorState = currentState;
}

/**
 * Función para inicializar el sensor inductivo.
 * Configura el pin del sensor y la interrupción para detectar cambios de estado.
 */
void initializeCounter() {
    // Configurar el pin del sensor inductivo como entrada con pull-up interno
    pinMode(induct, INPUT);
    // Adjuntar la interrupción al pin del sensor para detectar cambios de estado
    //attachInterrupt(digitalPinToInterrupt(induct), onLapDetected, CHANGE);
    // Inicializar el estado previo del sensor
    lastSensorState = digitalRead(induct);
}
