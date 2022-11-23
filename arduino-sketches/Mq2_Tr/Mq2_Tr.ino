  #include <MQ2.h>
  #include <Wire.h> 
  #include <RH_ASK.h>
  #include <SPI.h>
  RH_ASK driver;
  
int Analog_Input = A5;
int lpg, co, smoke;
int buzzer = 5;
String t;

MQ2 mq2(Analog_Input);

void setup(){
  Serial.begin(9600);
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
  //smoke = values[0];
  smoke = mq2.readSmoke();
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
  delay(1000);
  }
}
