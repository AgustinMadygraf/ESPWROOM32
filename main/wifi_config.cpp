// wifi_config.cpp
#include "wifi_config.h"

WebServer server(80);

const char* ssid = "automatizacion_plus";
const char* password = "Madygraf32";

IPAddress local_IP(192, 168, 10, 184);
IPAddress gateway(192, 168, 10, 1);
IPAddress subnet(255, 255, 255, 0);
IPAddress primaryDNS(10, 176, 60, 15);
IPAddress secondaryDNS(10, 176, 60, 79);

void initializeWebServer() {
    if (!WiFi.config(local_IP, gateway, subnet, primaryDNS, secondaryDNS)) {
        Log.error("Falló la configuración de IP estática\n");
    }

    WiFi.begin(ssid, password);

    while (WiFi.status() != WL_CONNECTED) {
        delay(500);
        Log.verbose(".");
    }
    Log.info("WiFi connected\n");

    Log.info("IP address: %s\n", WiFi.localIP().toString().c_str());
    server.on("/", handleRootRequest);
    server.on("/ena_f", handleMotorForward);
    server.on("/ena_r", handleMotorReverse);
    server.begin();
    Log.info("HTTP server started\n");
}
