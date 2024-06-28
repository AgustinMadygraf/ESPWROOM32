#include <WiFi.h>
#include <LiquidCrystal_I2C.h>

LiquidCrystal_I2C lcd(0x27, 16, 2);

void setup() {
  // Iniciar la comunicación serial a 115200 baudios
  Serial.begin(115200);

  // Inicializar el LCD
  lcd.init();
  lcd.backlight();
  lcd.setCursor(0, 0);
  lcd.print("Conectando");
  lcd.setCursor(0, 1);
  lcd.print("a Wifi ...");

  // Conectar a la red WiFi
  connectToWiFi();
}

void loop() {
  // Obtener y mostrar la dirección IP cada 5 segundos
  printIPAddress();
  delay(5000);
}

void connectToWiFi() {
  // Configurar el SSID y la contraseña de tu red WiFi
  const char* ssid = "aula tecnica";
  const char* password = "Madygraf32";

  Serial.print("Conectando a ");
  Serial.println(ssid);

  WiFi.begin(ssid, password);

  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }

  Serial.println("");
  Serial.println("Conectado a la red WiFi");
  Serial.println("Dirección IP: ");
  Serial.println(WiFi.localIP());

  lcd.setCursor(0, 0);
  lcd.print("WiFi Conectado");
  lcd.setCursor(0, 1);
  lcd.print(WiFi.localIP());
}

void printIPAddress() {
  static IPAddress previousIP;
  IPAddress currentIP = WiFi.localIP();

  if (currentIP != previousIP) {
    lcd.setCursor(0, 1);
    lcd.print("                "); // Limpiar línea anterior
    lcd.setCursor(0, 1);
    lcd.print(currentIP.toString().c_str()); // Mostrar la dirección IP en el LCD
    previousIP = currentIP;

    Serial.print("Dirección IP: ");
    Serial.println(currentIP); // Mostrar la dirección IP en el monitor serial
  }
}
