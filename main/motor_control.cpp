// motor_control.cpp
#include "hardware_control.h"

void setup_motor(int pinOutput_ENA, int pinOutput_DIR, int pinOutput_PUL) {
    pinMode(pinOutput_ENA, OUTPUT);
    pinMode(pinOutput_DIR, OUTPUT);
    pinMode(pinOutput_PUL, OUTPUT);
    digitalWrite(pinOutput_ENA, HIGH);
    digitalWrite(pinOutput_DIR, LOW);
}

void runMotor(int pinOutput_ENA, int pinOutput_DIR, int pinOutput_PUL, int direction) {
    digitalWrite(pinOutput_ENA, LOW);
    digitalWrite(pinOutput_DIR, direction);
    for (int i = 0; i < 20000; i++) {
        digitalWrite(pinOutput_PUL, HIGH);
        delayMicroseconds(15);
        digitalWrite(pinOutput_PUL, LOW);
        delayMicroseconds(15);
    }
}
