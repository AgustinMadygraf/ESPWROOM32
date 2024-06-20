// scale_sensor.h
#include "HX711.h"

HX711 balanza;

void initializeScaleSensor() {
  balanza.begin(DT_hx711, CLK_hx711);
  EEPROM.get(0, scaleFactor);
  pinMode(zero, INPUT);
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
