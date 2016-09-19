#include <SPI.h>
#include <Ethernet.h>
byte mac[] = {
    0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED
};

IPAddress ip(192, 168, 0, 103);
int pin = 0; // analog pin
int tempc = 0, tempf = 0; // temperature variables
int samples[8]; // variables to make a better precision
int maxi = -100, mini = 100; // to start max/min temperature
int i;
char server[] = "www.2dbay.com";
EthernetClient client;
void setup()
{
    Serial.begin(9600); 
    Ethernet.begin(mac, ip);
}
void loop(){
    for (i = 0; i <= 7; i++) { // gets 8 samples of temperature
        samples[i] = (5.0 * analogRead(pin) * 100.0) / 1024.0;
        tempc = tempc + samples[i];
        delay(1000);
    }
    tempc = tempc / 8.0; // better precision
    tempf = (tempc * 9) / 5 + 32; // converts to fahrenheit
    if (tempc > maxi) {
        maxi = tempc;
    } // set max temperature
    if (tempc < mini) {
        mini = tempc;
    } // set min temperature
    Serial.print(tempc, DEC);
    Serial.print(" Celsius, ");
    Serial.print(tempf, DEC);
    Serial.print(" fahrenheit -> ");
    Serial.print(maxi, DEC);
    Serial.print(" Max, ");
    Serial.print(mini, DEC);
    Serial.println(" Min");
    if (client.connect(server, 80)) {
        client.print("GET /write_data.php?"); 
        client.print("value="); 
        client.print(tempc); 
        client.println(" HTTP/1.1"); 
        client.println("Host: www.2dbay.com"); 
        client.println("Connection: close"); 
        client.println(); 
        client.println(); 
        client.stop(); 
        Serial.println("--> data sent\n");
    }
    else {
        Serial.println("--> connection failed\n");
    }
    tempc = 0;
    delay(60000); // delay before loop
}