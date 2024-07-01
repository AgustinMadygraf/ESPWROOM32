//counter.cpp
#include "counter.h"

// Variable global para almacenar el conteo de vueltas
volatile int lapCounter = 0;

// Pin del sensor inductivo
const int induct = 2; 

// Estado anterior del sensor
volatile bool lastSensorState = LOW;

/**
 * Función de interrupción para detectar el flanco ascendente del sensor inductivo.
 * Esta función se llama automáticamente cuando hay un cambio en el pin del sensor.
 */
void IRAM_ATTR onLapDetected() {
    bool currentState = digitalRead(induct);
    // Incrementar el contador de vueltas solo en el flanco ascendente
    if (currentState == HIGH && lastSensorState == LOW) {
        lapCounter++;
    }
    lastSensorState = currentState;
}

/**
 * Función para inicializar el sensor inductivo.
 * Configura el pin del sensor y la interrupción para detectar cambios de estado.
 */
void initializeCounter() {
    // Configurar el pin del sensor inductivo como entrada con pull-up interno
    pinMode(induct, INPUT_PULLUP);
    // Adjuntar la interrupción al pin del sensor para detectar cambios de estado
    attachInterrupt(digitalPinToInterrupt(induct), onLapDetected, CHANGE);
    // Inicializar el estado previo del sensor
    lastSensorState = digitalRead(induct);
}
