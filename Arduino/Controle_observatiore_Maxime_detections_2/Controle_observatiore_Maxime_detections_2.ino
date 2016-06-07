//Programme de l'Arduino "détections" de l'observatoire de Maxime
/*
Mesure température : module LM35 DFROBOT
Plage de mesure : 0 - 100°C
Précision : 0.5°C
Sensibilité : 10 mV/°C
Réf fabricant : DFR0023

Mesure de distance : capteur ultrasons SEED
Fréquence : 40 kHz
Portée : de 3 cm à 4 m
Résolution : 1 cm

Commandes :
z : lance l'interrogation des capteurs à une période "periodeinfos".
x : arrête l'intérogation des capteurs
t : demande l'info de température.
y : allume le laser
n : éteint le laser
*/

#include <VirtualWire.h> 
#include "Ultrasonic.h"
#include <RCSwitch.h>

Ultrasonic ultrasonic(10); // La PIN 10 et utilisée pour la mesure de distance
RCSwitch mySwitch = RCSwitch();

void setup(){
    Serial.begin(9600);
    pinMode(10, INPUT); //La PIN 10 est une entrée (distance ultrason)
    pinMode(11, OUTPUT); //La PIN 11 est une sortie (laser)
}

//Variables paramétrables
//période d'envoi des infos sur le port série (ms)
int periodeinfos = 100; 
//Variables
//Condition d'arrêt de l'envoi des infos sur le port série
int test = 0; 
int initialisePhotoresistance = 0;
int photoresistanceinit = 0;
//Variable servant à récupérer les données reçues sur le port série
int received;            
//Variable donnant l'état de la photorestistance
int photoresistance = 0; 
//Variable donnant l'état de la sonde de température
int temperaturerail = 0; 
//Variable donnant la distance mesurée par le capteur ultrasons
long distance = 0;       

void loop(){
    test = 0; //réinitialise la condition d'arrêt de l'envoi des infos

    //Si des données sont disponibles
    if (Serial.available()>0){
      received = Serial.read(); // On récupère les données du port série
      
      //Allume le laser pour les réglages
      if(received == 'y'){
          digitalWrite (11, HIGH); //Active le laser
          Serial.println("Laser allume");
      }  
    
      //Eteint le laser pour les réglages
      if(received == 'n'){
          digitalWrite (11, LOW); //Désactive le laser
          Serial.println("Laser eteint");
      } 
          
      //Envoi info température du rail
      if(received == 't'){
          temperaturerail = 5*1000*analogRead(4)/1024/10;
          Serial.print("Temperature rail : "); Serial.print(temperaturerail); Serial.println(" degres");            
      } 
          
      //Lance la séquence de mesure de la distance du toit et la position du télescope    
      if(received == 'z'){
          do{
             //test pour l'arret de l'envoi des infos  
             // Si des données sont disponibles             
             if (Serial.available()>0){
             // On récupère les données du port série  
                received = Serial.read(); 
             } 
               
             if(initialisePhotoresistance == 0){
                 photoresistanceinit = analogRead(0);
                 digitalWrite (11, HIGH);
                 photoresistance = analogRead(0);
                 int delta = photoresistance-photoresistanceinit;
                 Serial.println("C0");
                 Serial.println(delta);
                 initialisePhotoresistance = 1;
             }
               
             //Lecture de la position du télescope
             digitalWrite (11, HIGH); //Active le laser          
             photoresistance = analogRead(0); //Affecte la mesure de lumière à la variable
                
             //Mesure de la distance
             distance = ultrasonic.MeasureInCentimeters();
      
             //Infos envoyées sur le port série
             Serial.println("C1"); 
             Serial.println(photoresistance);
             Serial.println("C2");
             Serial.println(distance);
             delay (periodeinfos);

             if(received == 'x'){ 
                  test = 1;
                  initialisePhotoresistance = 0;
                  // Desactive le laser
                  digitalWrite (11, LOW);
             }
           }
           while (test == 0);
       }
}   

}
