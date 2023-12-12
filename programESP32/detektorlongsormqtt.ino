
//#include <WiFi.h>  // Untuk ESP32
#include <ESP8266WiFi.h> // Untuk ESP8266
//menghubungkan wifi
#include <ESP8266WebServer.h>
#include "HTML.h"
#include <MQTT.h>
#include <NusabotSimpleTimer.h>
#include <Wire.h>
#include <LiquidCrystal_I2C.h>
#include <Adafruit_MPU6050.h>
Adafruit_Sensor *mpu_temp, *mpu_accel, *mpu_gyro;
LiquidCrystal_I2C dis(0x27, 16, 2);
Adafruit_MPU6050 mpu;
const char *ssid = "ITSNU Pekalongan";
const char *password = "12345678";

String ssidNew = "", passNew;

ESP8266WebServer server(80);
WiFiClient net;
MQTTClient client;
NusabotSimpleTimer timer;
String pesan, data, data2, data3, data4;
int soil;
int value;
int value2;
int sudut;
int kel;
String level;
void handleRoot() {
  server.send(200, "text/html", index_html);
}

void handleForm() {
  ssidNew = server.arg("ssidNew");
  passNew = server.arg("passNew");

  server.send(200, "text/html", sukses_html);
  delay(2000);    // Agar perangkat dapat mengirimkan data sebelum disconnect

  WiFi.softAPdisconnect(true);

  WiFi.mode(WIFI_STA);
  WiFi.begin(ssidNew, passNew);

  // Tunggu sampai terhubung
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.println(ESP.getChipId());
  }

  Serial.println("");
  Serial.println("Terhubung Ke Jaringan");
    Serial.print("Menghubungkan ke Broker");
  while (!client.connect("wokwi", "privateghofinda", "Jqi8J4DAALtisiMk")) {
    Serial.print(".");
    delay(1000);
  }
  Serial.println("Terhubung ke Broker");
  client.subscribe("nusabot/#");
}

void subscribe(String &topic, String &payload) {
  if (topic == "nusabot/dapur/lampu") {
    if (payload == "true") {
      digitalWrite(25, 1);
      Serial.println("Lampu Menyala");
    } else {
      digitalWrite(25, 0);
      Serial.println("Lampu Mati");
    }
  }
}

void publish() {
  client.publish("3013042/longsor/soil", String(kel));// serialnumber=3013042
  Serial.println("Data Dipublish: " + String(kel));
}
void publish2() {
  client.publish("3013042/longsor/mpu", String(sudut));
}
void publish3() {
  client.publish("3013042/longsor/level", level);
}
//void publish4() {
//
//  client.publish("longsor/iot/level", String(sudut));
//}
//void publish5() {
//
//  client.publish("longsor/iot/waktu", String(sudut));
//}
//void connect() { // Menghubungkan ke WiFi dan Broker
//  Serial.print("Menghubungkan ke Broker");
//  while (!client.connect("wokwi", "privateghofinda", "Jqi8J4DAALtisiMk")) {
//    Serial.print(".");
//    delay(1000);
//  }
//  Serial.println("Terhubung ke Broker");
//  client.subscribe("nusabot/#");
//}
void lcd() {
  dis.setCursor(0, 1);
  dis.print("kel=");
  dis.print(kel);
  dis.print("% ");
  dis.setCursor(8, 1);
  dis.print("MPU=");
  dis.print(sudut);
  dis.print("' ");
  dis.setCursor(13, 0);
  dis.print("On ");
  if (kel >= 80 && sudut > 30) {
    level = "BAHAYA";
    dis.setCursor(0, 0);
    dis.print("BAHAYA ");
    digitalWrite(D5, HIGH);// led red
    digitalWrite(D6, LOW);
    digitalWrite(D7, LOW);
    digitalWrite(D8, HIGH);// sirine
    delay(1000);
    digitalWrite(D8, LOW);
    delay(1000);
  } else if (kel >= 80 && sudut > 15 && sudut < 30 ) {
    level = "BAHAYA";
    dis.setCursor(0, 0);
    dis.print("BAHAYA ");
    digitalWrite(D5, HIGH);// led red
    digitalWrite(D6, LOW);
    digitalWrite(D7, LOW);
    digitalWrite(D8, HIGH);// sirine
    delay(1000);
    digitalWrite(D8, LOW);
    delay(1000);
  } else if (kel >= 80 && sudut <= 15 ) {
    level = "WASPADA";
    dis.setCursor(0, 0);
    dis.print("WASPADA");
    digitalWrite(D6, HIGH);//yellow
    digitalWrite(D5, LOW);
    digitalWrite(D7, LOW);
  } else if (kel > 50 && kel < 80 && sudut > 30 ) {
    level = "BAHAYA";
    dis.setCursor(0, 0);
    dis.print("BAHAYA ");
    digitalWrite(D5, HIGH);// led red
    digitalWrite(D6, LOW);
    digitalWrite(D7, LOW);
    digitalWrite(D8, HIGH);// sirine
    delay(1000);
    digitalWrite(D8, LOW);
    delay(1000);
  } else if (kel > 50 && kel < 80 && sudut > 15 && sudut < 30 ) {
    level = "WASPADA";
    dis.setCursor(0, 0);
    dis.print("WASPADA");
    digitalWrite(D6, HIGH);//yellow
    digitalWrite(D5, LOW);
    digitalWrite(D7, LOW);
  } else if (kel > 50 && kel < 80 && sudut <= 15 ) {
    level = "WASPADA";
    dis.setCursor(0, 0);
    dis.print("WASPADA");
    digitalWrite(D6, HIGH);//yellow
    digitalWrite(D5, LOW);
    digitalWrite(D7, LOW);
  } else if (kel <= 50 && sudut > 30 ) {
    level = "BAHAYA";
    dis.setCursor(0, 0);
    dis.print("BAHAYA ");
    digitalWrite(D5, HIGH);// led red
    digitalWrite(D6, LOW);
    digitalWrite(D7, LOW);
    digitalWrite(D8, HIGH);// sirine
    delay(1000);
    digitalWrite(D8, LOW);
    delay(1000);
  } else if (kel <= 50 && sudut > 15 && sudut < 30) {
    level = "WASPADA";
    dis.setCursor(0, 0);
    dis.print("WASPADA");
    digitalWrite(D6, HIGH);//yellow
    digitalWrite(D5, LOW);
    digitalWrite(D7, LOW);
  } else if (kel <= 50 && sudut <= 15) {
    level = "AMAN";
    dis.setCursor(0, 0);
    dis.print("AMAN    ");
    digitalWrite(D7, HIGH);// led green
    digitalWrite(D5, LOW);
    digitalWrite(D6, LOW);
  }
}
void setup() {
  Serial.begin(115200);
  //menghubungkan ke wifi yang disambungkan
  WiFi.softAP(ssid, password);
  IPAddress IP = WiFi.softAPIP();
  Serial.println("");
  Serial.print("IP Address: ");
  Serial.println(IP);

  server.on("/", handleRoot); // Routine untuk menghandle homepage
  server.on("/action_page", handleForm);
  server.begin(); // Mulai server
  //broker mqtt
  client.begin("privateghofinda.cloud.shiftr.io", net);
  dis.begin();
  mpu.begin();
  Wire.endTransmission();
  pinMode(D5, OUTPUT);//led red
  pinMode(D6, OUTPUT);//led yellow
  pinMode(D7, OUTPUT);//led green
  pinMode(D8, OUTPUT);//sirine
  //  digitalWrite(D8, LOW);
  dis.backlight();
  mpu_accel = mpu.getAccelerometerSensor();
  mpu_accel->printSensorDetails();
  //menghubungkan ke broker ketika sudah ada jaringan internetnya
//  connect();
  client.onMessage(subscribe);
  timer.setInterval(2000, publish);
  timer.setInterval(2000, publish2);
  timer.setInterval(2000, publish3);
  timer.setInterval(2000, lcd);
  //  timer.setInterval(5000, publish4);
  //  timer.setInterval(5000, publish5);
}

void loop() {
  if (ssidNew == "") {
    server.handleClient();
  }
  timer.run();
  client.loop();
  soil = analogRead(A0);
  kel = map(soil, 1024, 454, 0, 100  );
  sensors_event_t accel;
  mpu_accel->getEvent(&accel);
  float y = accel.acceleration.y;
  float z = accel.acceleration.z;
  float x = accel.acceleration.x;
  //  float value2 = map(a, -9, 9, 180, 0);
  int value2 = (atan2(y, z) * 180.0) / M_PI;
  int value  = (atan2(x, z) * 180.0) / M_PI;
  if ( value > 5) {
    if (value2 > value) {
      sudut = value2;
    }
    else {
      sudut = value;
    }
  }
  else {
    sudut = value;
  }
}
