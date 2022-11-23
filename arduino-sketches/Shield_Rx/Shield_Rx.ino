#include <SPI.h>
#include <Ethernet.h>

#include <RH_ASK.h>
#include <SPI.h>

RH_ASK driver (2000, 8, 9, 7);

//RH_ASK(uint16_t speed = 2000, uint8_t rxPin = 8, uint8_t txPin = 9, uint8_t pttPin = 7, bool pttInverted = false);

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

float lpg_, co_, smoke_;

String review;

void setup() {

  Serial.begin(9600);
   if (!driver.init())
         Serial.println("init failed");

  while (!Serial) {
    ;
  }


  Serial.println("Initialize Ethernet");
  if (Ethernet.begin(mac) == 0) {
    Serial.println("Failed to configure Ethernet");

    if (Ethernet.hardwareStatus() == EthernetNoHardware) {
      Serial.println("Ethernet shield was not found.  Sorry, can't run without hardware. :(");
      while (true) {
        delay(1);
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

    co_ = 0;
    smoke_ = 0;
    lpg_ = 0;
   uint16_t data, data_2, data_3;
    uint8_t datalen = sizeof(data);

    uint8_t datalen_2 = sizeof(data_2);

    uint8_t datalen_3 = sizeof(data_3);
    
    if (driver.recv((uint8_t *)&data, &datalen))
    {
      Serial.println(data);  
      lpg_ = data ;       
    }

        if (driver.recv((uint8_t *)&data_2, &datalen_2))
    {    
      Serial.println(data_2); 
      co_ = data_2;        
    }

            if (driver.recv((uint8_t *)&data_3, &datalen_3))
    {     
      Serial.println(data_3);  
      smoke_ = data_3;       
    }

  postData = postVariable + co_;
  postData2 = postVariable2 + lpg_;
  postData3 = postVariable3 + smoke_;
  review = (postVariable+co_ + postVariable2 + lpg_ + postVariable3 +smoke_);
  if (co_ >0 || lpg_ >0 || smoke_ >0){
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
    }

    if (client.connected()) {
      client.stop();
    }
 }
}
