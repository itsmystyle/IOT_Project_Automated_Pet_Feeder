#include <LWiFi.h>
#include <LWiFiClient.h>
#include <Servo.h>
#include <Grove_LED_Bar.h>  

#define WIFI_AP "GG"
#define WIFI_PWD "19961115"
#define WIFI_AUTH LWIFI_WPA
#define DEVICEID "iotprototype1"
#define SITE_URL "s103062161.web.2y.idv.tw"

LWiFiClient Clients;
Servo myServo;
unsigned long lastConnectionTime = 0;
const unsigned long postingInterval = 1L * 1100L;
int wifi_connected = -1;
char switch_char;

const int low = 50;
const int high = 15;

Grove_LED_Bar bar(7, 6, 0);

void setup() {
  // put your setup code here, to run once:
  Serial.begin(9600);
  LWiFi.begin();
  bar.begin();
  bar.setLevel(2);
  
  myServo.attach(3);
  myServo.write(low);

  switch_char = '@';
  
  Serial.println("Connecting to AP...");
  while(!LWiFi.connect(WIFI_AP, LWiFiLoginInfo(WIFI_AUTH, WIFI_PWD))){
    bar.setLevel(2);
    Serial.println("Failed to connect to AP, reconnecting in a second...");
    delay(1000);
  }
}

void loop() {
  
  // put your main code here, to run repeatedly:
  if(Clients.available()){
    char c =  Clients.read();
    Serial.print(c);

    if(c == '#' || c == '@'){
      if(c != switch_char){
        myServo.write(high);
        delay(200);
        myServo.write(low);
        
        switch_char = c;
      }
    }
  }

  if(millis() - lastConnectionTime > postingInterval){
    httpRequest();
  }
}

void httpRequest(){
  Clients.stop();
  Serial.println();
  Serial.println();

  Serial.println("Connecting to Site...");
  if(Clients.connect(SITE_URL, 80)){
    bar.setLevel(10);
    Serial.println("Connected to Site, sending http request.");
    Clients.print("GET /InternetOfThing_Priend/");
    Clients.print(DEVICEID);
    Clients.println("/switch.txt HTTP/1.1");
    Clients.print("Host: ");
    Clients.println(SITE_URL);
    Clients.println("Connection:close");
    Clients.println();

    lastConnectionTime = millis();
  }else{
    bar.setLevel(2);
    Serial.println("Connection failed. Try to reconnect in a second.");
  }
}

