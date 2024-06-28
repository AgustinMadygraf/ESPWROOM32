#include "hardware_control.h"

HX711 balanza;
int DT_hx711 = 4; // Ajustar según el hardware
int CLK_hx711 = 5; // Ajustar según el hardware
long scaleFactor = 2280; // Ajustar según el hardware
int zero = 0;

void initializeScaleSensor() {
    balanza.begin(DT_hx711, CLK_hx711);
    balanza.set_scale(scaleFactor);
    balanza.tare(); // Poner la balanza en cero
}

float getWeight() {
    return balanza.get_units(10);
}

void tareScale(int zero_button_state, int last_zero_button_state) {
    if (zero_button_state == HIGH && last_zero_button_state == LOW) {
        balanza.tare();
    }
}
