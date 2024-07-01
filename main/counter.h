//counter.h
#ifndef COUNTER_H
#define COUNTER_H

#include <Arduino.h>

// Declaración de la variable global para el conteo de vueltas
extern volatile int lapCounter;

// Declaración del pin del sensor inductivo
extern const int induct;

// Declaración de la variable para el estado anterior del sensor
extern volatile bool lastSensorState;

/**
 * Función de interrupción para detectar el flanco ascendente del sensor inductivo.
 */
void IRAM_ATTR onLapDetected();

/**
 * Función para inicializar el sensor inductivo.
 */
void initializeCounter();

#endif
