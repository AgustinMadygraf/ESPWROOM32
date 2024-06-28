#ifndef HARDWARE_CONTROL_H
#define HARDWARE_CONTROL_H

#include <HX711.h>

extern HX711 balanza;
extern int DT_hx711;
extern int CLK_hx711;
extern long scaleFactor;
extern int zero;

void initializeScaleSensor();
float getWeight();
void tareScale(int zero_button_state, int last_zero_button_state);

#endif // HARDWARE_CONTROL_H
