// counter.cpp
#include "counter.h"

volatile int lapCounter = 0;
const int induct = 15;  // Ajusta el pin según tu configuración
volatile bool lastSensorState = false;
QueueHandle_t lapQueue;

void IRAM_ATTR onLapDetected() {
    static unsigned long lastInterruptTime = 0;
    unsigned long interruptTime = millis();
    
    // Ignorar si la interrupción ocurre dentro de los primeros 50 ms
    if (interruptTime - lastInterruptTime > 50) {
        int lapDetected = 1;
        xQueueSendFromISR(lapQueue, &lapDetected, NULL);
    }
    lastInterruptTime = interruptTime;
}


void initializeCounter() {
    pinMode(induct, INPUT_PULLUP);
    lapQueue = xQueueCreate(10, sizeof(int));  // Crear una cola con tamaño 10
    attachInterrupt(digitalPinToInterrupt(induct), onLapDetected, RISING);
}
