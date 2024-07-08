//counter.cpp
#include "counter.h"

volatile int lapCounter = 0;
const int induct = 15;  // Ajusta el pin según tu configuración
volatile bool lastSensorState = false;
QueueHandle_t lapQueue;

void IRAM_ATTR onLapDetected() {
    // Enviar un mensaje a la cola para indicar que se detectó una vuelta
    int lapDetected = 1;
    xQueueSendFromISR(lapQueue, &lapDetected, NULL);
}

void initializeCounter() {
    pinMode(induct, INPUT);
    lapQueue = xQueueCreate(10, sizeof(int));  // Crear una cola con tamaño 10
    attachInterrupt(digitalPinToInterrupt(induct), onLapDetected, RISING);
}
