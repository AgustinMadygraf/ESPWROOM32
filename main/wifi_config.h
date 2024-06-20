// wifi_config.h
#include <WiFi.h>
#include <WebServer.h>

// Configura el SSID y la contraseña de tu red WiFi
const char* ssid = "Aula tecnica";
const char* password = "Madygraf32";

// Configura la IP estática
IPAddress local_IP(192, 168, 1, 184);
IPAddress gateway(192, 168, 1, 1);
IPAddress subnet(255, 255, 255, 0);
IPAddress primaryDNS(8, 8, 8, 8);
IPAddress secondaryDNS(8, 8, 4, 4);

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
