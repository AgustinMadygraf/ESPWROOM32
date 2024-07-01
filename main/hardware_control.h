// hardware_control.h
#ifndef HARDWARE_CONTROL_H
#define HARDWARE_CONTROL_H

#include <Arduino.h>
#include "HX711.h"
#include <EEPROM.h>

// Motor control
void setup_motor(int pinOutput_ENA, int pinOutput_DIR, int pinOutput_PUL);
void runMotor(int pinOutput_ENA, int pinOutput_DIR, int pinOutput_PUL, int direction);

// Scale sensor
extern HX711 balanza;
extern int DT_hx711;
extern int CLK_hx711;
extern long scaleFactor;
extern int zero;

void initializeScaleSensor();
float getWeight();
void tareScale(int zero_button_state, int last_zero_button_state);

extern volatile int lapCounter;
extern int sensorPin;
void IRAM_ATTR onLapDetected();

#endif
