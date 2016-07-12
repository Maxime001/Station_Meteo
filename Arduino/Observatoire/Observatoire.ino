/*
 * 
 */
// Variables à paramétrer
long            dureetoit = 105;    // duree d'ouverture/fermeture du
                    // toit (s)
int             periodeinfos = 2;   // periodicite d'envoi d'infos (s)
int             dureesirene = 2;    // duree d'attente avant de
                    // desactiver l'alarme si la
                    // sirène hurle (s)

// Variables utilisees dans le programme
int             received;   // Variable servant à récupérer les
                // données reçues sur le port série
int             sirenehurle = 0;    // variable d'état de la sirène
int             alarmeactive = 0;   // variable d'état de l'alarme
                    // activee
int             detectobstacletoit = 0; // variable de detection
                    // d'obstacle devant le toit
long            compteurinfos = 0;  // variable pour chronometrer la
                    // periodicite des infos
int             compteursirene = 0; // variable pour chronometrer le
                    // temps d'activation de la
                    // sirène
int             infono = 0; // variable de sélection de l'info à
                // envoyer
int             infotoitouvert = 0; // etat du contact toit ouvert
int             infotoitferme = 0;  // etat du contact toit ferme 
long            imoteur = 0;    // valeur du courant consommé par le
                // moteur du toit
long            entreeanaimoteur = 0;   // valeur de l'entrée analogique
                    // de la mesure du courant
                    // consommé par le moteur
long            entreeanaimoteurmax = 0;    // valeur max de l'entrée 
                        // analogique de la mesure 
                        // du courant consommé
                        // par le moteur

// Variables utilisees pour l'alarme
int             outPin = 12;    // Pin de sortie signal RF
int             l = 635;    // durée état long (microsecondes)
int             c = 227;    // durée état court (microsecondes)
int             etathaut = LOW; // valeur de l'état haut
int             etatbas = HIGH; // valeur de l'état bas


void setup() {
    Serial.begin(9600);     // set up Serial library at 9600 bps

    pinMode(2, OUTPUT);     // Relai reserve
    digitalWrite(2, HIGH);  // Désactive le relai
    pinMode(3, OUTPUT);     // ouverture toit
    digitalWrite(3, HIGH);  // Désactive le relai
    pinMode(4, OUTPUT);     // Fermeture du toit
    digitalWrite(4, HIGH);  // Désactive le relai
    pinMode(5, OUTPUT);     // Tension du telescope
    digitalWrite(5, HIGH);  // Désactive le relai
    pinMode(6, OUTPUT);     // Tension résistance chauffante
    digitalWrite(6, HIGH);  // Désactive le relai
    pinMode(7, OUTPUT);     // Tension ventilation
    digitalWrite(7, HIGH);  // Désactive le relai
    pinMode(8, OUTPUT);     // Choix grande vitesse ouverture toit
    digitalWrite(8, HIGH);  // Désactive le relai
    pinMode(9, OUTPUT);     // Marche/arrêt de la commande du toit
    digitalWrite(9, HIGH);  // Désactive le relai

    pinMode(10, INPUT);     // Info toit ouvert
    pinMode(11, INPUT);     // Info toit fermé
    pinMode(outPin, OUTPUT);    // Commande alarme 
}

void loop() {
    // Lecture des entrées 
    entreeanaimoteur = analogRead(A0);
    sirenehurle = analogRead(A1);
    alarmeactive = analogRead(A2);
    detectobstacletoit = analogRead(A3);
    infotoitouvert = digitalRead(10);
    infotoitferme = digitalRead(11);

    // Mesure de entreeanaimoteurmax
    if (entreeanaimoteur > entreeanaimoteurmax) {
        entreeanaimoteurmax = entreeanaimoteur;
    }

    //Serial.println(alarmeactive);
    // Envoi des info sur le port serie 
    if (compteurinfos < millis()) {
        imoteur = (5000 / 1024) * entreeanaimoteurmax;  // En mA
                            // 5000(mV)*500(rapport 
                            // spires)xtensionsecondaire/500(résistance)
        // Serial.print("Courant moteur : ");
        // Serial.print(imoteur);
        // Serial.println(" mA");
        entreeanaimoteurmax = 0;

        if (sirenehurle > 200) {
            Serial.println("Sirene hurle");
            compteursirene = compteursirene * 1000 + periodeinfos * 1000;
            delay(100);
        }
        if (compteursirene > dureesirene) {
            // desactiveralarme(); //Désactive l'alarme (signal rf)
            compteursirene = 0; // Réinitialise le compteur de la sirène
            delay(100);
        }
        if (sirenehurle < 200) {
            Serial.println("Sirene ok");
            delay(100);
        }
        if (infotoitouvert == HIGH) {
            Serial.println("Toit ouvert");
            delay(100);
        }
        if (infotoitferme == HIGH) {
            Serial.println("Toit ferme");
            delay(100);
        }
        if (alarmeactive < 200) {
            Serial.println("Alarme desactivee");
            delay(100);
        }
        if (alarmeactive > 200) {
            Serial.println("Alarme activee");
            delay(100);
        }
        compteurinfos = compteurinfos + periodeinfos * 1000;
    }

    // Controle de l'observatoire par reception sur le port serie 
    if (Serial.available() > 0) {
        received = Serial.read();

        if (received == 'a') {
       
            activeralarme();    // Active l'alarme (signal rf)
        }

        if (received == 'b') {
            desactiveralarme(); // Désactive l'alarme (signal rf)
        }



            if (received == 'e') {
                digitalWrite(5, LOW);   // Met le télescope sous tension
                Serial.println("Telescope sous tension");
            }

            if (received == 'f') {
                digitalWrite(5, HIGH);  // Met le télescope hors tension
                Serial.println("Telescope hors tension");
            }

            if (received == 'g') {
                digitalWrite(6, LOW);
                Serial.println("Res chauff sous tension");
            }

            if (received == 'h') {
                digitalWrite(6, HIGH);
                Serial.println("Res chauff hors tension");
            }

            if (received == 'i') {
                digitalWrite(7, LOW);   // Met la ventilation sous tension
                Serial.println("Ventilation sous tension");
            }

            if (received == 'j') {
                digitalWrite(7, HIGH);  // Met la ventilation hors tension
                Serial.println("Ventilation hors tension");
            }

            
        if (received == 'c') {
            digitalWrite(9, LOW);   // Mise sous tension du système
                        // de commande du toit 
            digitalWrite(3, LOW);   // Commande l'ouverture du toit
                        // (appuis de dureetoit s) 
            Serial.println("Ouverture du toit");
            for (long i = 0; i < (dureetoit * 1000); i = i + 100) {
                if (Serial.available() > 0) {
                  received = Serial.read();
                    if (received == 'v') {
                        Serial.println("Obstacle !!");
                        digitalWrite(9, HIGH);   // Mise sous tension du système
                        // de commande du toit 
                          digitalWrite(3, HIGH);   // Commande l'ouverture du toit
                        i = dureetoit * 1000; 
                    }
                }
                delay(100);
            }
            digitalWrite(3, HIGH);
            digitalWrite(9, HIGH);
        }

        if (received == 'd') {
            digitalWrite(9, LOW);
            digitalWrite(4, LOW);
            Serial.println("Fermeture du toit");

            for (long i = 0; i < (dureetoit * 1000); i = i + 100) {
                if (Serial.available() > 0) {
                  received = Serial.read();
                    if (received == 'v') {
                        Serial.println("Obstacle !!");
                        digitalWrite(4, HIGH);
                        digitalWrite(9, HIGH);
                        
                        i = dureetoit * 1000;
                    }
                }
                delay(100);
            }
            digitalWrite(4, HIGH);
            digitalWrite(9, HIGH);

            if (received == 'k') {
                digitalWrite(9, LOW);
                digitalWrite(4, LOW);
                Serial.println("Fermeture forcee du toit");
                delay(dureetoit * 1000);
                digitalWrite(4, HIGH);
                digitalWrite(9, HIGH);
            }
            
        }
    }
}
// Fonctions additionnelles
void activeralarme() {
    for (int i = 0; i <= 6; i++) {
        digitalWrite(outPin, etathaut); // signal haut
        delayMicroseconds(6508);    // maintien du signal 
        digitalWrite(outPin, etatbas);  // signal bas
        delayMicroseconds(c);   // maintien du signal 
        digitalWrite(outPin, etathaut); // signal haut
        delayMicroseconds(l);   // maintien du signal 
        digitalWrite(outPin, etatbas);  // signal bas
        delayMicroseconds(l);   // maintien du signal 
        digitalWrite(outPin, etathaut); // signal haut
        delayMicroseconds(c);   // maintien du signal 
        digitalWrite(outPin, etatbas);  // signal bas
        delayMicroseconds(c);   // maintien du signal 
        digitalWrite(outPin, etathaut); // signal haut
        delayMicroseconds(l);   // maintien du signal 
        digitalWrite(outPin, etatbas);  // signal bas
        delayMicroseconds(l);   // maintien du signal 
        digitalWrite(outPin, etathaut); // signal haut
        delayMicroseconds(c);   // maintien du signal 
        digitalWrite(outPin, etatbas);  // signal bas
        delayMicroseconds(c);   // maintien du signal 
        digitalWrite(outPin, etathaut); // signal haut
        delayMicroseconds(l);   // maintien du signal 
        digitalWrite(outPin, etatbas);  // signal bas
        delayMicroseconds(l);   // maintien du signal 
        digitalWrite(outPin, etathaut); // signal haut
        delayMicroseconds(c);   // maintien du signal 
        digitalWrite(outPin, etatbas);  // signal bas
        delayMicroseconds(c);   // maintien du signal 
        digitalWrite(outPin, etathaut); // signal haut
        delayMicroseconds(l);   // maintien du signal 
        digitalWrite(outPin, etatbas);  // signal bas
        delayMicroseconds(l);   // maintien du signal 
        digitalWrite(outPin, etathaut); // signal haut
        delayMicroseconds(c);   // maintien du signal 
        digitalWrite(outPin, etatbas);  // signal bas
        delayMicroseconds(c);   // maintien du signal 
        digitalWrite(outPin, etathaut); // signal haut
        delayMicroseconds(l);   // maintien du signal 
        digitalWrite(outPin, etatbas);  // signal bas
        delayMicroseconds(l);   // maintien du signal 
        digitalWrite(outPin, etathaut); // signal haut
        delayMicroseconds(c);   // maintien du signal 
        digitalWrite(outPin, etatbas);  // signal bas
        delayMicroseconds(l);   // maintien du signal 
        digitalWrite(outPin, etathaut); // signal haut
        delayMicroseconds(c);   // maintien du signal 
        digitalWrite(outPin, etatbas);  // signal bas
        delayMicroseconds(l);   // maintien du signal 
        digitalWrite(outPin, etathaut); // signal haut
        delayMicroseconds(c);   // maintien du signal 
        digitalWrite(outPin, etatbas);  // signal bas
        delayMicroseconds(c);   // maintien du signal 
        digitalWrite(outPin, etathaut); // signal haut
        delayMicroseconds(l);   // maintien du signal 
        digitalWrite(outPin, etatbas);  // signal bas
        delayMicroseconds(l);   // maintien du signal 
        digitalWrite(outPin, etathaut); // signal haut
        delayMicroseconds(c);   // maintien du signal 
        digitalWrite(outPin, etatbas);  // signal bas
        delayMicroseconds(l);   // maintien du signal 
        digitalWrite(outPin, etathaut); // signal haut
        delayMicroseconds(c);   // maintien du signal 
        digitalWrite(outPin, etatbas);  // signal bas
        delayMicroseconds(l);   // maintien du signal 
        digitalWrite(outPin, etathaut); // signal haut
        delayMicroseconds(c);   // maintien du signal 
        digitalWrite(outPin, etatbas);  // signal bas
        delayMicroseconds(l);   // maintien du signal 
        digitalWrite(outPin, etathaut); // signal haut
        delayMicroseconds(c);   // maintien du signal 
        digitalWrite(outPin, etatbas);  // signal bas
        delayMicroseconds(l);   // maintien du signal 
        digitalWrite(outPin, etathaut); // signal haut
        delayMicroseconds(c);   // maintien du signal 
        digitalWrite(outPin, etatbas);  // signal bas
        delayMicroseconds(c);   // maintien du signal 
        digitalWrite(outPin, etathaut); // signal haut
        delayMicroseconds(l);   // maintien du signal 
        digitalWrite(outPin, etatbas);  // signal bas
        delayMicroseconds(c);   // maintien du signal 
        digitalWrite(outPin, etathaut); // signal haut
        delayMicroseconds(l);   // maintien du signal 
        digitalWrite(outPin, etatbas);  // signal bas
        delayMicroseconds(c);   // maintien du signal 
        digitalWrite(outPin, etathaut); // signal haut
        delayMicroseconds(l);   // maintien du signal 
        digitalWrite(outPin, etatbas);  // signal bas
        delayMicroseconds(c);   // maintien du signal 
        digitalWrite(outPin, etathaut); // signal haut
        delayMicroseconds(l);   // maintien du signal 
        digitalWrite(outPin, etatbas);  // signal bas
        delayMicroseconds(c);   // maintien du signal 
        digitalWrite(outPin, etathaut); // signal haut
        delayMicroseconds(l);   // maintien du signal 
        digitalWrite(outPin, etatbas);  // signal bas
        delayMicroseconds(c);   // maintien du signal 
        digitalWrite(outPin, etathaut); // signal haut
        delayMicroseconds(l);   // maintien du signal 
        digitalWrite(outPin, etatbas);  // signal bas
        delayMicroseconds(c);   // maintien du signal 
    }
    digitalWrite(outPin, LOW);  // Etat bas 
}

void desactiveralarme() {
    for (int i = 0; i <= 6; i++) {
        digitalWrite(outPin, etathaut); // signal haut
        delayMicroseconds(6508);    // maintien du signal 
        digitalWrite(outPin, etatbas);  // signal bas
        delayMicroseconds(c);   // maintien du signal 
        digitalWrite(outPin, etathaut); // signal haut
        delayMicroseconds(l);   // maintien du signal 
        digitalWrite(outPin, etatbas);  // signal bas
        delayMicroseconds(l);   // maintien du signal 
        digitalWrite(outPin, etathaut); // signal haut
        delayMicroseconds(c);   // maintien du signal 
        digitalWrite(outPin, etatbas);  // signal bas
        delayMicroseconds(c);   // maintien du signal 
        digitalWrite(outPin, etathaut); // signal haut
        delayMicroseconds(l);   // maintien du signal 
        digitalWrite(outPin, etatbas);  // signal bas
        delayMicroseconds(l);   // maintien du signal 
        digitalWrite(outPin, etathaut); // signal haut
        delayMicroseconds(c);   // maintien du signal 
        digitalWrite(outPin, etatbas);  // signal bas
        delayMicroseconds(c);   // maintien du signal 
        digitalWrite(outPin, etathaut); // signal haut
        delayMicroseconds(l);   // maintien du signal 
        digitalWrite(outPin, etatbas);  // signal bas
        delayMicroseconds(l);   // maintien du signal 
        digitalWrite(outPin, etathaut); // signal haut
        delayMicroseconds(c);   // maintien du signal 
        digitalWrite(outPin, etatbas);  // signal bas
        delayMicroseconds(c);   // maintien du signal 
        digitalWrite(outPin, etathaut); // signal haut
        delayMicroseconds(l);   // maintien du signal 
        digitalWrite(outPin, etatbas);  // signal bas
        delayMicroseconds(l);   // maintien du signal 
        digitalWrite(outPin, etathaut); // signal haut
        delayMicroseconds(c);   // maintien du signal 
        digitalWrite(outPin, etatbas);  // signal bas
        delayMicroseconds(c);   // maintien du signal 
        digitalWrite(outPin, etathaut); // signal haut
        delayMicroseconds(l);   // maintien du signal 
        digitalWrite(outPin, etatbas);  // signal bas
        delayMicroseconds(l);   // maintien du signal 
        digitalWrite(outPin, etathaut); // signal haut
        delayMicroseconds(c);   // maintien du signal 
        digitalWrite(outPin, etatbas);  // signal bas
        delayMicroseconds(l);   // maintien du signal 
        digitalWrite(outPin, etathaut); // signal haut
        delayMicroseconds(c);   // maintien du signal 
        digitalWrite(outPin, etatbas);  // signal bas
        delayMicroseconds(l);   // maintien du signal 
        digitalWrite(outPin, etathaut); // signal haut
        delayMicroseconds(c);   // maintien du signal 
        digitalWrite(outPin, etatbas);  // signal bas
        delayMicroseconds(c);   // maintien du signal 
        digitalWrite(outPin, etathaut); // signal haut
        delayMicroseconds(l);   // maintien du signal 
        digitalWrite(outPin, etatbas);  // signal bas
        delayMicroseconds(l);   // maintien du signal 
        digitalWrite(outPin, etathaut); // signal haut
        delayMicroseconds(c);   // maintien du signal 
        digitalWrite(outPin, etatbas);  // signal bas
        delayMicroseconds(l);   // maintien du signal 
        digitalWrite(outPin, etathaut); // signal haut
        delayMicroseconds(c);   // maintien du signal 
        digitalWrite(outPin, etatbas);  // signal bas
        delayMicroseconds(l);   // maintien du signal 
        digitalWrite(outPin, etathaut); // signal haut
        delayMicroseconds(c);   // maintien du signal 
        digitalWrite(outPin, etatbas);  // signal bas
        delayMicroseconds(c);   // maintien du signal 
        digitalWrite(outPin, etathaut); // signal haut
        delayMicroseconds(l);   // maintien du signal 
        digitalWrite(outPin, etatbas);  // signal bas
        delayMicroseconds(c);   // maintien du signal 
        digitalWrite(outPin, etathaut); // signal haut
        delayMicroseconds(l);   // maintien du signal 
        digitalWrite(outPin, etatbas);  // signal bas
        delayMicroseconds(l);   // maintien du signal 
        digitalWrite(outPin, etathaut); // signal haut
        delayMicroseconds(c);   // maintien du signal 
        digitalWrite(outPin, etatbas);  // signal bas
        delayMicroseconds(l);   // maintien du signal 
        digitalWrite(outPin, etathaut); // signal haut
        delayMicroseconds(c);   // maintien du signal 
        digitalWrite(outPin, etatbas);  // signal bas
        delayMicroseconds(c);   // maintien du signal 
        digitalWrite(outPin, etathaut); // signal haut
        delayMicroseconds(l);   // maintien du signal 
        digitalWrite(outPin, etatbas);  // signal bas
        delayMicroseconds(c);   // maintien du signal 
        digitalWrite(outPin, etathaut); // signal haut
        delayMicroseconds(l);   // maintien du signal 
        digitalWrite(outPin, etatbas);  // signal bas
        delayMicroseconds(c);   // maintien du signal 
        digitalWrite(outPin, etathaut); // signal haut
        delayMicroseconds(l);   // maintien du signal 
        digitalWrite(outPin, etatbas);  // signal bas
        delayMicroseconds(c);   // maintien du signal 
        digitalWrite(outPin, etathaut); // signal haut
        delayMicroseconds(l);   // maintien du signal 
        digitalWrite(outPin, etatbas);  // signal bas
        delayMicroseconds(c);   // maintien du signal 
    }
    digitalWrite(outPin, LOW);  // Etat bas 
    compteursirene = 0; // reinitialise le compteur de duree
}
