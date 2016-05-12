    #include <VirtualWire.h> //Librairie pour la com RF
    #include<Wire.h>
    #include <Adafruit_BMP085.h> //Librairie barometre
    #include <Adafruit_Sensor.h>
    #include <Adafruit_TSL2561_U.h> //Librairie capteur de luminosite
    #include "DHT.h" //Librairie hygrometre
    
    Adafruit_BMP085 bmp; //barometre
    Adafruit_TSL2561_Unified tsl = Adafruit_TSL2561_Unified(TSL2561_ADDR_LOW, 12345); //affecte l'id au capteur de luminosite
    #define DHTTYPE DHT22   // DHT 22  (AM2302)
    #define DHTPIN 2 //hygrometre sur D2

     
    //Affichage infos capteur de luminosite
    void displaySensorDetails(){
    sensor_t sensor;
    tsl.getSensor(&sensor);
    }
    
    //Configuration du gain du capteur de luminosite
    void configureSensor(){
        /* You can also manually set the gain or enable auto-gain support */
        // tsl.setGain(TSL2561_GAIN_1X);      /* No gain ... use in bright light to avoid sensor saturation */
        // tsl.setGain(TSL2561_GAIN_16X);     /* 16x gain ... use in low light to boost sensitivity */
        tsl.enableAutoRange(true);            /* Auto-gain ... switches automatically between 1x and 16x */
        
        /* Changing the integration time gives you better sensor resolution (402ms = 16-bit data) */
        //tsl.setIntegrationTime(TSL2561_INTEGRATIONTIME_13MS);      /* fast but low resolution */
        // tsl.setIntegrationTime(TSL2561_INTEGRATIONTIME_101MS);  /* medium resolution and speed   */
         tsl.setIntegrationTime(TSL2561_INTEGRATIONTIME_402MS);  /* 16-bit data but slowest conversions */
    }   
       

  //Configuration de l'hygrometre
  DHT dht(DHTPIN, DHTTYPE);
  
  int photoresistance = 0; // variable photoresistance 
  int niveaueau = 0; //variable detecteur niveau d'eau
  int niveausonore = 0; //variable detecteur de niveau sonore

  const char *message = "Hello 28032016";
  char valeur[15] = { '\0' };
  int mesure = 0;
        
    void setup(){
    Serial.begin(9600);  


    

      
    /*Affichage infos capteur de luminosite*/
    displaySensorDetails();

    /*Configuration du gain et du temps d'integration du capteur de luminosité*/
    configureSensor();    

    //Test hygrometre
    //Serial.println("DHTxx test!");
    dht.begin();       
      }
      
    void loop(){
    
    ///////////////////////Barometre//////////////////////////
    //Test barometre
    if (!bmp.begin()){
      Serial.println("E1 : Erreur lecture barometre + temperature interieure");
      Serial.println("C1 : Pression (ERREUR) :");
      Serial.println(1);
      Serial.println("E1 : Erreur lecture barometre + temperature interieure");
      Serial.println("C8 : Erreur lecture temperature interieure");
      Serial.println(1);
    }
    else{
      Serial.println("C1 : Pression (hPa):");
      Serial.println(bmp.readPressure()/100);

      Serial.println("C8 : Temperature interieure (degre C): ");   
      Serial.println(bmp.readTemperature());  
    }

    //////////////////Capteur de luminosite////////////////////////////
    if(!tsl.begin()){
      /* Probleme de detection du capteur ... il faut tester les branchements */
      Serial.println("E2 : Erreur lecture capteur lumière");
      Serial.println("C2 : Luminosite (ERREUR) :");
      Serial.println(1);
    }
    else{
      /*Nouvel evenement*/ 
      configureSensor();         
      sensors_event_t event;
      tsl.getEvent(&event);
    
      /* Affichage de la mesure en lux*/
      if (event.light){
        if(event.light > 20000){
          Serial.println("E2 : Erreur lecture capteur lumière");
          Serial.println("C2 : Luminosite (ERREUR) :");
          Serial.println(1);
        }
        else{
          Serial.println("C2 : Luminosite (lux): ");          
          Serial.println(event.light);
        }
      }
      else{
        /*Si event.light = 0 lux, le capteur est certainement sature et aucune donnee ne peut etre generee*/
        Serial.println("E2 : Problème lors de la capture, capteur sature");
      }
    }

        ///////////////////////Hygrometre/////////////////////////
    
        // La lecture de l'humidité et de la temperature dure environ 250 ms
        float h = dht.readHumidity();
        float t = dht.readTemperature();

        //Test de validite des donnees. Si ce n'est pas un nombre, il y a un probleme...(isnan = is not a number)
        if (isnan(t) || isnan(h)){
            Serial.println("E1 : Erreur lecture hygrometre");
      Serial.println("C1 : Humidite (ERREUR) : ");
      Serial.println(1);
      Serial.println("C7 : Temperature exterieure (ERREUR) : ");
      Serial.println(1);
        } 
        else{
            Serial.println("C3 : Humidite (%HR): "); 
            Serial.println(h);
            Serial.println("C7 : Temperature exterieure(degre C) : "); 
            Serial.println(t);

        }   
      
    /////////////////////////Photoresistance/////////////////////
    photoresistance = analogRead(A1);

    Serial.println("C4 : Photoresistance : ");
    Serial.println(photoresistance);
  
    //////////////////Detecteur de niveau d'eau/////////////////
    niveaueau = analogRead(A2);
    Serial.println("C5 : Niveau d'eau : ");
    Serial.println(niveaueau); 

    /////////////////Detecteur niveau sonore///////////////////
    niveausonore = analogRead(A3);
    Serial.println("C6 : Niveau sonore : ");
    Serial.println(niveausonore);    

    Serial.println("");     
    Serial.println("------------------------------------"); 
    Serial.println("");  

    delay(5000);
    }

