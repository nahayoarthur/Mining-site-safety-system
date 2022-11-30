  #include <Wire.h> 
  #include <RH_ASK.h>
  #include <MQ2.h>
  #include <SPI.h>
  #include "DHT.h"
  #define DHTPIN 2
  #define DHTTYPE DHT11
  RH_ASK driver;
  DHT dht(DHTPIN, DHTTYPE);
int Analog_Input = A5;
int lpg, co, smoke;
float temp;
int buzzer = 5;

MQ2 mq2(Analog_Input);

void setup(){
  Serial.begin(9600);
  Serial.println(F("DHTxx test!"));
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
  
  if (t > 30.0){
    tone(buzzer, 1000, 200);
    uint16_t data_4 = t;
    driver.send((uint8_t *)&data_4, sizeof(data_4));
    driver.waitPacketSent();
  }else{
    noTone(buzzer);
  }
  
  //smoke = values[0];

  if (lpg > 10 && co > 10 && smoke > 10)
  {
    
  tone(buzzer, 1000, 200);
  Serial.print("LPG:");
  Serial.print(lpg);
  Serial.print(" CO:");
  Serial.print(co);
  Serial.print(" SMOKE:");
  Serial.print((smoke*100)/1000000);
  Serial.print(" %");
  Serial.print("\n");
    uint16_t data[3];
    data[0] = lpg;
    data[1] = co;
    data[2]  = ((smoke*100)/1000000);

    
    driver.send((uint8_t *)&data, sizeof(data));
    
    driver.waitPacketSent();
  
  }else{
  noTone(buzzer);
  }
}
