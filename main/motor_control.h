// motor_control.h
#ifndef MOTOR_CONTROL_H
#define MOTOR_CONTROL_H

#include <Arduino.h>

void setup_motor(int pinOutput_ENA, int pinOutput_DIR, int pinOutput_PUL);
void runMotor(int pinOutput_ENA, int pinOutput_DIR, int pinOutput_PUL, int direction);

#endif
