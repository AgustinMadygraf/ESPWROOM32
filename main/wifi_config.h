// wifi_config.h
#ifndef WIFI_CONFIG_H
#define WIFI_CONFIG_H

#include <WiFi.h>
#include <WebServer.h>
#include <ArduinoLog.h>

extern WebServer server;

void initializeWebServer();
void handleRootRequest();
void handleMotorForward();
void handleMotorReverse();

#endif
