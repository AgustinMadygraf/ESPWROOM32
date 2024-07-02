// interface.h
#ifndef INTERFACE_H
#define INTERFACE_H

#include <LiquidCrystal_I2C.h>
#include <WebServer.h>

extern LiquidCrystal_I2C lcd;
extern WebServer server;

void initializeLCD();
void updateLCDBot(float peso);
void updateLCDTop(String texto_LCD);
void sendServerResponse(String response_text);

#endif
