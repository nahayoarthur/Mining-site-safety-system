  #include <MQ2.h>
  #include <Wire.h> 
  #include <RH_ASK.h>
  #include <SPI.h>
  #include "DHT.h"
  #define DHTPIN 2
  #define DHTTYPE DHT11
  
  RH_ASK driver;
  DHT dht(DHTPIN, DHTTYPE);
const int BUTTON = 6;
int BUTTONstate = 0;
int Analog_Input = A5;
int lpg, co, smoke;
float temp;
int buzzer = 5;
String t;

MQ2 mq2(Analog_Input);

void setup(){
  Serial.begin(9600);
  Serial.println(F("DHTxx test!"));
  pinMode(BUTTON, INPUT);
  dht.begin();
  mq2.begin();
  pinMode(buzzer, OUTPUT);
  RH_ASK driver;
      if (!driver.init())
         Serial.println("init failed");
}
void loop(){
  float* values= mq2.read(false); //set it false if you don't want to print the values in the Serial
  lpg = values[0];
  lpg = mq2.readLPG();
  co = values[1];
  co = mq2.readCO();
  smoke = mq2.readSmoke();
  float t = dht.readTemperature();
  Serial.println("temp: ");
  Serial.println(t);
  BUTTONstate = digitalRead(BUTTON);

   if (BUTTONstate == HIGH)
  {
    tone(buzzer, 1000, 200);
    Serial.println("Panic!!!");
  } 
  else{
    noTone(buzzer);
  }
  
  if (t > 30.0){
    tone(buzzer, 1000, 200);
    uint16_t data = temp;
    driver.send((uint8_t *)&data, sizeof(data));
    driver.waitPacketSent();
  }else{
    noTone(buzzer);
  }
  
  //smoke = values[0];

  if (lpg < 10 && co < 10 && smoke < 10)
  {
    noTone(buzzer);
  }else{
  tone(buzzer, 1000, 200);
  Serial.print("LPG:");
  Serial.print(lpg);
  Serial.print(" CO:");
  Serial.print(co);
  Serial.print(" SMOKE:");
  Serial.print((smoke*100)/1000000);
  Serial.print(" %");
  Serial.print("\n");

    //const char *msg = "Gas detected";
    uint16_t data = lpg;
    uint16_t data_2 = co;
    uint16_t data_3  = ((smoke*100)/1000000);

    
    driver.send((uint8_t *)&data, sizeof(data));

    driver.send((uint8_t *)&data_2, sizeof(data_2));

    driver.send((uint8_t *)&data_3, sizeof(data_3));
    
    driver.waitPacketSent();
//  delay(1000);
  }
}
