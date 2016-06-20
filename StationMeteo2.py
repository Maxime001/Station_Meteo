import json
import serial
import time
from datetime import datetime
ser = serial.Serial('COM5', 9600, timeout=0)
# Import de la librairie MySQL
import MySQLdb
# DB Connexion
db = MySQLdb.connect("localhost","root","","meteo" )
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
		while(pression == "" or luminosite == "" or humidite =="" or photoresistance == "" or detectionEau == "" or mesureBruit == "" or temperatureExterieure == "" or temperatureInterieure == ""):	
			ID = ser.readline()
			if(ID[0:2] == "C1"):
				pression = ser.readline()
				pression = int(pression)
			elif(ID[0:2] == "C2"):
				luminosite = ser.readline()
				luminosite = float(luminosite)
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
		temps = datetime.now()
		while(temps.minute != 5 and temps.minute != 10 and temps.minute != 15 and temps.minute != 20 and temps.minute != 25 and temps.minute != 30 and temps.minute !=35 and temps.minute !=40 and temps.minute != 45 and temps.minute !=50 and temps.minute !=55 and temps.minute !=0):
			temps = datetime.now()
			print(temps.minute)	
		cursor.execute("INSERT INTO infometeo(pression,luminosite,humidite,photoresistance,detectionEau,mesureBruit,temperatureExterieure,temperatureInterieure) VALUES(%s,%s,%s,%s,%s,%s,%s,%s)",[pression,luminosite,humidite,photoresistance,detectionEau,mesureBruit,temperatureExterieure,temperatureInterieure])
		db.commit()
		print("");
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
			elif(ID[0:2] == "C2"):
				luminosite = ser.readline()
				luminosite = float(luminosite)
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
			time.sleep(0.01)
		#Envoi dans le fichier Json
		read = open("../json/controleObservatoire.json", "r")
		
		data = json.load(read)
		data['meteoInstantanee']['detectionEau'] = detectionEau
		data['meteoInstantanee']['humidite'] = humidite
		data['meteoInstantanee']['luminosite'] = luminosite
		data['meteoInstantanee']['pression'] = pression
		data['meteoInstantanee']['photoresistance'] = photoresistance
		data['meteoInstantanee']['temperatureInterieure'] = temperatureInterieure
		data['meteoInstantanee']['mesureBruit'] = mesureBruit
		data['meteoInstantanee']['temperatureExterieure'] = temperatureExterieure
		read.close()
		write = open("../json/controleObservatoire.json", "w")
		json.dump(data, write, indent=4, sort_keys=True)
		write.close()
		
		print json.dumps(data['meteoInstantanee'], indent=4, sort_keys=True)

		print("----------------------------------------")	
		print("Envoi donnees Instantanees Json effectue")	
		print("----------------------------------------")	
		
	except ser.SerialTimeoutException :
		print('Data could not be read')
		time.sleep(1)

		
while 1:
		temps = datetime.now()
		sauvegardeJson()
		#print(temps.minute)
		#print(temps.second)
		
		if(temps.minute == 4 or temps.minute == 9 or temps.minute == 14 or temps.minute == 19 or temps.minute == 24 or temps.minute == 29 or temps.minute == 34 or temps.minute == 39 or temps.minute == 44 or temps.minute == 49 or temps.minute == 54 or temps.minute == 59):
			if(temps.second > 45):
				envoiBdd()
				time.sleep(15)
		