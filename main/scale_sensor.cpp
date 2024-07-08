// scale_sensor.cpp
#include "hardware_control.h"

HX711 balanza;
int DT_hx711 = 4;
int CLK_hx711 = 5;
long scaleFactor;
int zero = 12;
int calibracion = 14;

void initializeScaleSensor() {
    balanza.begin(DT_hx711, CLK_hx711);
    EEPROM.get(0, scaleFactor);
    pinMode(zero, INPUT);
    pinMode(calibracion, INPUT);
    balanza.set_scale(scaleFactor);
    balanza.tare(20);
}

float getWeight() {
    return balanza.get_units(10);
}

void tareScale(int zero_button_state, int last_zero_button_state) {
    if (zero_button_state != last_zero_button_state) {
        if (zero_button_state == LOW) {
            balanza.tare(10);
        }
    }
}

void funcion_calibrar (int calibrar_button_state, int last_calibrar_button_state) {
    if (calibrar_button_state != last_calibrar_button_state) {
        if (calibrar_button_state == LOW) {
            balanza.set_scale();
            scaleFactor = balanza.get_scale();
            EEPROM.put(0, scaleFactor);
        }
    }
}