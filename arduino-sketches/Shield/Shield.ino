#include <SPI.h>
#include <Ethernet.h>

#define sensorPin A5

byte mac[] = { 0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED}; 

IPAddress ip(192, 168, 88, 253);

EthernetClient client;

char server[] = "192.168.88.254";

String postData;
String postVariable = "lpg=";


String postData2;
String postVariable2 = "& co=";

String postData3;
String postVariable3 = "& smoke=";

String review;

//WiFiClient client;

void setup() {

  Serial.begin(9600);

  while (!Serial) {
    ;
  }


  Serial.println("Initialize Ethernet with DHCP:");
  if (Ethernet.begin(mac) == 0) {
    Serial.println("Failed to configure Ethernet using DHCP");

    if (Ethernet.hardwareStatus() == EthernetNoHardware) {
      Serial.println("Ethernet shield was not found.  Sorry, can't run without hardware. :(");
      while (true) {
        delay(1); // do nothing, no point running without Ethernet hardware
      }
    }
    if (Ethernet.linkStatus() == LinkOFF) {
      Serial.println("Ethernet cable is not connected.");
    }
    Ethernet.begin(mac, ip);
  }
  Serial.println("Connecting.....");

  delay(1000);

  IPAddress ip = Ethernet.localIP();
  Serial.print("IP Address: ");
  Serial.println(ip);
  }
 

void loop() {
  int reading = analogRead(sensorPin);
  float voltage = reading * 5.0;
  voltage /= 1024.0;
  float lpg_ = (voltage - 0.5) * 100 ;
  float co_ = (lpg_ * 9.0 / 5.0) + 32.0;
  float smoke_ = (smoke_ * 9.0 / 5.0) + 32.0;

  postData = postVariable + co_;
  postData2 = postVariable2 + lpg_;
  postData3 = postVariable3 + smoke_;
  review = (postVariable+co_ + postVariable2 + lpg_ + postVariable3 +smoke_);
if (co_ >= 80){
  if (client.connect(server, 80)) {
    client.println("POST /Mining-site-safety-system/API/apiScript.php HTTP/1.1");
    client.println("Host: 192.168.88.254");
    client.println("Content-Type: application/x-www-form-urlencoded");
    client.print("Content-Length: ");
    client.println(review.length());
    client.println();
    client.print(review);
    delay (500);
   
    delay (500);
    Serial.println("Data Sent");
    Serial.println(postData);

    Serial.println("Data Sent");
    Serial.println(postData2);
    
    Serial.println("Data Sent");
    Serial.println(postData3);

    while(client.connected()){
      if(client.available()){
        char c = client.read();
        Serial.print(c);
      }
    }

delay(1000);
  }

  if (client.connected()) {
    client.stop();
  }

  delay(6000);
}

  delay(3000);
}
