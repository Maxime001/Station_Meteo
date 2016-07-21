/*
D6 : Pluviometre : contact tous les 0,2794 mm d'eau)
D7 : Anemometre : 1 impulsion (conact) par seconde : 2,4 km/h
A0 : Girouette.
*/
 
void setup(){
  Serial.begin(9600);
  pinMode(6, INPUT);
  pinMode(7, INPUT);
}   

//variable lecture digitale pluviometre
int pluie = 0; 
//variable lecture digitale anemometre
int vent = 0; 
//variable lecture analogique girouette
int girouette = 0; 


//variable calcul pluviometrie moyenne
float pluviometre = 0; 
//variable calcul vitesse du vent moyenne
float impulsionvent = 0;
float envoiVent;
//texte pour l'orientation de la girouette
char* orientation = "AA"; 

int highVent = 0;
int highPluie = 0;

int compteurEnvoi = 0;
int nouveauCompteur = 0;
int compteurVent = 0;
int compteurPluie = 0;
int compteurDureePluie = 0;
int compteurDureeVent = 0;
float impulsionPluie = 0;

// Nombre de seconde pour le calcul moyen du vent
// Précision : 
// 24 secondes : 0.1 m/s
// 6 secondes : 0.4 m/s
// 3 secondes : 0.8m/s
// 1 seconde : 2.4m/s
float nombreSecondeCalculVent = 24;

// Nombre de seconde pour le calcul moyen de la pluie
// Précision : 
// 10  secondes : 100.5 mm/h
// 30 secondes : 33.5 mm/h
// 60 secondes : 16.7 mm/h
// 300 secondes : 3.3mm/h
// 600 secondes : 1.67mm/h
float nombreSecondeCalculPluie = 600;


// Nombre de seconde entre chaque envoi au port USB
int nombreSecondeAvantEnvoiArduino = 5;


void loop(){
  //lecture état pluviometre
  pluie = digitalRead(6); 
  //lecture état anemometre
  vent = digitalRead(7); 
  //lecture position girouette
  girouette = analogRead(A0);

  // Réglage délais avant calcul des vitesses
  compteurDureeVent = millis()/(nombreSecondeCalculVent*1000);
  compteurEnvoi = millis()/(nombreSecondeAvantEnvoiArduino*1000);  
  compteurDureePluie = millis()/(nombreSecondeCalculPluie*1000);
  

  // Toute les x sec : calcul du vent avant envoi 
  if(compteurDureeVent != compteurVent){
  impulsionvent = float(impulsionvent);
  envoiVent =  2.4 * (impulsionvent/nombreSecondeCalculVent);
  // Remise a 0 vitesse vent 
  impulsionvent = 0;
  
  compteurVent = compteurDureeVent;
  }
  
    // Calcul de la pluie
  if(compteurDureePluie != compteurPluie){
    // Calcul
    pluviometre = ((impulsionPluie*3600)/nombreSecondeCalculPluie)*0.2794;
     Serial.println("C13 : Pluviometre (mm/h) envoi 10 minutes");
     Serial.println(pluviometre);
     
    // Remise a 0 compteur
    impulsionPluie = 0;
    // Rajout 10 minutes au compteur
    compteurPluie = compteurDureePluie;   
  }
  
  
  // Toute les 5 sec : envois infos port USB
  if(compteurEnvoi != nouveauCompteur){
    
  Serial.println("C10 : Pluviometre (mm/h) ");
  Serial.println(pluviometre);

  Serial.println("C11 : Anemometre (km/h) ");
  Serial.println(envoiVent);

  Serial.println("C12 : Girouette : ");
  Serial.println(orientation);

  nouveauCompteur = compteurEnvoi;
  }

    
  // Compteur impulsion pluie 
  if (pluie == HIGH && highPluie == 0){
    impulsionPluie = impulsionPluie + 1;
    highPluie = 1;
  }
  if (pluie == LOW && highPluie == 1){
    highPluie = 0;
  }

  // Compteur impulsion vent
  if (vent == HIGH && highVent == 0){    
    impulsionvent = impulsionvent + 1;    
    highVent = 1; 
  }
  if (vent == LOW && highVent == 1){
    highVent = 0;
  }

  //Girouette : le Nord nord est est en fait le nord est
  if ( girouette > 30 && girouette < 75)  {  orientation = "E";  }
  if ( girouette > 75 && girouette < 88)  {  orientation = "NE";  }
  if ( girouette > 88 && girouette < 109)  {  orientation = "ENE";  }
  if ( girouette > 109 && girouette < 155)  {  orientation = "SE";  }  
  if ( girouette > 155 && girouette < 214)  {  orientation = "ESE";  }
  if ( girouette > 214 && girouette < 265)  {  orientation = "S";  }
  if ( girouette > 265 && girouette < 346)  {  orientation = "SSE";  }
  if ( girouette > 346 && girouette < 433)  {  orientation = "N";  }  
  if ( girouette > 433 && girouette  < 530)  {  orientation = "NNE";  }
  if ( girouette > 530 && girouette  < 615)  {  orientation = "SO";  }
  if ( girouette > 615 && girouette < 666)  {  orientation = "SSO";  }
  if ( girouette > 666 && girouette  < 744)  {  orientation = "NO";  }  
  if ( girouette > 744 && girouette < 806)  {  orientation = "NNO";  }
  if ( girouette > 806 && girouette < 886)  {  orientation = "O";  }
  if ( girouette > 886 && girouette < 962)  {  orientation = "OSO";  }
  if ( girouette > 962 && girouette < 1023)  {  orientation = "ONO";  } 
  /*
  if ( girouette > 30 && girouette < 75)  {  orientation = "ESE";  }
  if ( girouette > 75 && girouette < 88)  {  orientation = "ENE";  }
  if ( girouette > 88 && girouette < 109)  {  orientation = "E";  }
  if ( girouette > 109 && girouette < 155)  {  orientation = "SSE";  }  
  if ( girouette > 155 && girouette < 214)  {  orientation = "SE";  }
  if ( girouette > 214 && girouette < 265)  {  orientation = "SSO";  }
  if ( girouette > 265 && girouette < 346)  {  orientation = "S";  }
  if ( girouette > 346 && girouette < 433)  {  orientation = "NNE";  }  
  if ( girouette > 433 && girouette  < 530)  {  orientation = "NE";  }
  if ( girouette > 530 && girouette  < 615)  {  orientation = "OSO";  }
  if ( girouette > 615 && girouette < 666)  {  orientation = "SO";  }
  if ( girouette > 666 && girouette  < 744)  {  orientation = "NNO";  }  
  if ( girouette > 744 && girouette < 806)  {  orientation = "N";  }
  if ( girouette > 806 && girouette < 886)  {  orientation = "ONO";  }
  if ( girouette > 886 && girouette < 962)  {  orientation = "O";  }
  if ( girouette > 962 && girouette < 1023)  {  orientation = "NO";  }    
  */




}
