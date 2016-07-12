import json
import serial
import time
from datetime import datetime
ser = serial.Serial('/dev/ttyUSB0', 9600, timeout=0)
# Import de la librairie MySQL
import MySQLdb
# DB Connexion
db = MySQLdb.connect("localhost","root","-P3gaze-","meteo" )
# prepare a cursor object using cursor() method
cursor = db.cursor()

def envoiBdd():
	try:		
		pression =""
		luminosite = ""
		humidite = ""
		photoresistance =""
		detectionEau = ""
		mesureBruit = ""
		temperatureExterieure = ""
		temperatureInterieure = ""
		
		print("----------------------------------")	
		while(pression == "" or luminosite ==""  or humidite =="" or photoresistance == "" or detectionEau == "" or mesureBruit == "" or temperatureExterieure == "" or temperatureInterieure == ""):	
			ID = ser.readline()
			if(ID[0:2] == "C1"):
				pression = ser.readline()
				pression = int(pression)
				pression = pression + 42
				print("Pression:")
				print(pression)
			elif(ID[0:2] == "C2"):
				luminosite = ser.readline()
				luminosite = float(luminosite)
				print("luminosite:")
				print(luminosite)
			elif(ID[0:2] == "E2"):
				print("erreur luminosite")
				luminosite = 0
			elif(ID[0:2] == "C3"):
				humidite = ser.readline()
				humidite = float(humidite)
				if(humidite > 99.9):
					humidite = float(99.9)
				print("humidite:")
				print(humidite)
			elif(ID[0:2] == "C4"):
				photoresistance = ser.readline()
				photoresistance = int(photoresistance)
				print("photoresistance :")
				print(photoresistance)
			elif(ID[0:2] == "C5"):
				detectionEau = ser.readline()
				detectionEau = int(detectionEau)
				print("detection eau :")
				print(detectionEau)
			elif(ID[0:2] == "C6"):
				mesureBruit = ser.readline()
				mesureBruit = int(mesureBruit)
				print("mesure bruit :")
				print(mesureBruit)
			elif(ID[0:2] == "C7"):
				temperatureExterieure = ser.readline()
				temperatureExterieure = float(temperatureExterieure)
				print("temperature Exterieure :")
				print(temperatureExterieure)
			elif(ID[0:2] == "C8"):
				temperatureInterieure = ser.readline()
				temperatureInterieure = float(temperatureInterieure)
				print("temperature interieure")
				print(temperatureInterieure)
			time.sleep(0.1)
		temps = datetime.now()
		print('---- PREPARATION ENVOI BDD ----')
		while(temps.minute != 5 and temps.minute != 10 and temps.minute != 15 and temps.minute != 20 and temps.minute != 25 and temps.minute != 30 and temps.minute !=35 and temps.minute !=40 and temps.minute != 45 and temps.minute !=50 and temps.minute !=55 and temps.minute !=0):
			temps = datetime.now()	
		cursor.execute("INSERT INTO infometeo(pression,luminosite,humidite,photoresistance,detectionEau,mesureBruit,temperatureExterieure,temperatureInterieure) VALUES(%s,%s,%s,%s,%s,%s,%s,%s)",[pression,luminosite,humidite,photoresistance,detectionEau,mesureBruit,temperatureExterieure,temperatureInterieure])
		db.commit()
		temps = datetime.now()
		print(temps)
		print ("-----------------")
		print("Envoi BDD confirme")
		print ("-----------------")
		print("");
		time.sleep(0.1)
	except:
		print("erreur bdd")

def sauvegardeJson():
	try:
		pression =""
		luminosite = ""
		humidite = ""
		photoresistance =""
		detectionEau = ""
		mesureBruit = ""
		temperatureExterieure = ""
		temperatureInterieure = ""
		
		print("----------------------------------")	
		while(pression == "" or luminosite == "" or humidite =="" or photoresistance == "" or detectionEau == "" or mesureBruit == "" or temperatureExterieure == "" or temperatureInterieure == ""):	
			ID = ser.readline()
			if(ID[0:2] == "C1"):
				pression = ser.readline()
				pression = int(pression)
				pression = pression + 42
			elif(ID[0:2] == "C2"):
				luminosite = ser.readline()
				luminosite = float(luminosite)
			elif(ID[0:2] == "E2"):
				luminosite = 0
			elif(ID[0:2] == "C3"):
				humidite = ser.readline()
				humidite = float(humidite)
			elif(ID[0:2] == "C4"):
				photoresistance = ser.readline()
				photoresistance = int(photoresistance)
			elif(ID[0:2] == "C5"):
				detectionEau = ser.readline()
				detectionEau = int(detectionEau)
			elif(ID[0:2] == "C6"):
				mesureBruit = ser.readline()
				mesureBruit = int(mesureBruit)
			elif(ID[0:2] == "C7"):
				temperatureExterieure = ser.readline()
				temperatureExterieure = float(temperatureExterieure)
			elif(ID[0:2] == "C8"):
				temperatureInterieure = ser.readline()
				temperatureInterieure = float(temperatureInterieure)
			time.sleep(0.1)
		#Envoi dans le fichier Json
		print("a")
		read = open("/var/www/html/json/controleObservatoire.json", "r")
		print("b")
		data = json.load(read)
		print("c")
		data['meteoInstantanee']['detectionEau'] = detectionEau
		data['meteoInstantanee']['humidite'] = humidite
		data['meteoInstantanee']['luminosite'] = luminosite
		data['meteoInstantanee']['pression'] = pression
		data['meteoInstantanee']['photoresistance'] = photoresistance
		data['meteoInstantanee']['temperatureInterieure'] = temperatureInterieure
		data['meteoInstantanee']['mesureBruit'] = mesureBruit
		data['meteoInstantanee']['temperatureExterieure'] = temperatureExterieure
		read.close()
		print("d")
		write = open("../json/controleObservatoire.json", "w")
		print("e")
		json.dump(data, write, indent=4, sort_keys=True)
		print("f")
		write.close()
		
		print json.dumps(data['meteoInstantanee'], indent=4, sort_keys=True)

		print("----------------------------------------")	
		print("Envoi donnees Instantanees Json effectue")	
		print("----------------------------------------")	
		
	except:
		print('Data could not be read')
				
while 1:
	temps = datetime.now()
	sauvegardeJson()
	print(temps)
	if(temps.minute == 4 or temps.minute == 9 or temps.minute == 14 or temps.minute == 19 or temps.minute == 24 or temps.minute == 29 or temps.minute == 34 or temps.minute == 39 or temps.minute == 44 or temps.minute == 49 or temps.minute == 54 or temps.minute == 59):
		if(temps.second > 30):
			envoiBdd()
			time.sleep(15)
	time.sleep(5)
