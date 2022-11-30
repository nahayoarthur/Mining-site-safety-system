#include <SPI.h>
#include <Ethernet.h>

#include <RH_ASK.h>
#include <SPI.h>

RH_ASK driver (2000, 7, 6, 5);

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

String postData4;
String postVariable4 = "& temp=";

String postData5;
String postVariable5 = "& panic=";

float lpg_, co_, smoke_,temp_, panic_;

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
    temp_ = 0;
    panic_=0;
   uint16_t data[5];
    uint8_t datalen = sizeof(data);
    
    if (driver.recv((uint8_t *)&data, &datalen))
    {
      Serial.println("RF data recieved");  
      lpg_ = data[1] ;
      co_ = data[0];
      smoke_ = data[2];
      temp_ = data[3]; 
      panic_ = data[4];     
    }

  postData = postVariable + co_;
  postData2 = postVariable2 + lpg_;
  postData3 = postVariable3 + smoke_;
  postData4 = postVariable4 + temp_;
  postData5 = postVariable5 + panic_;
  review = (postVariable+co_ + postVariable2 + lpg_ + postVariable3 +smoke_ + postVariable4 +temp_ + postVariable5 +panic_);
  if (co_ >0 || lpg_ >0 || smoke_ >0 || temp_ > 0 || panic_ > 0){
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

      Serial.println("Data Sent");
      Serial.println(postData4);

      Serial.println("Data Sent");
      Serial.println(postData5);

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
