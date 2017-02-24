# Les donnees sont donnees par les arduinos a intervalle de 3 secondes
import re
import json
import serial
import time
from datetime import datetime
# Connexion station meteo
ser = serial.Serial('/dev/ttyUSB3', 9600, timeout=0)

# Import de la librairie MySQL
import MySQLdb
# DB Connexion
db = MySQLdb.connect("localhost","root","root","meteo" )
# prepare a cursor object using cursor() method
cursor = db.cursor()

anemometre = ""
pluviometre = ""

def envoiBdd():
	try:		
		pression =""
		luminosite = ""
		humidite = ""
		detectionEau = ""
		temperatureExterieure = ""
		temperatureInterieure = ""
		girouette = ""
		global anemometre
		global pluviometre
		print("----------------------------------")	
		while(anemometre == "" or pression == "" or luminosite == "" or humidite =="" or detectionEau == "" or temperatureExterieure == "" or temperatureInterieure == "" or girouette == ""):	
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
			elif(ID[0:2] == "C5"):
				detectionEau = ser.readline()
				detectionEau = int(detectionEau)
			elif(ID[0:2] == "C7"):
				temperatureExterieure = ser.readline()
				temperatureExterieure = float(temperatureExterieure)
			elif(ID[0:2] == "C8"):
				temperatureInterieure = ser.readline()
				temperatureInterieure = float(temperatureInterieure)
			elif(ID[0:2] == "CA"):
				girouette = ser.readline()
				girouette = re.sub(" ","",girouette)
				girouette = re.sub("\n","",girouette)
				girouette = re.sub("\r","",girouette)
				
			elif(ID[0:2] == "CB"):
				pluviometre = ser.readline()
				pluviometre = float(pluviometre)
				print("nouvelle valeur pluie bdd")
				print(pluviometre)
				print("----------------------------------------------")
				print("oooooooooooooooooooooooooooooooooooooo")
			elif(ID[0:2] == "CC"):
				anemometre = ser.readline()
				anemometre = float(anemometre)
				
			time.sleep(0.1)
		temps = datetime.now()
		print('---- PREPARATION ENVOI BDD ----')
		#while(temps.minute % float(5) != 0):
		while(temps.minute != 5 and temps.minute != 10 and temps.minute != 15 and temps.minute != 20 and temps.minute != 25 and temps.minute != 30 and temps.minute !=35 and temps.minute !=40 and temps.minute != 45 and temps.minute !=50 and temps.minute !=55 and temps.minute !=0):
			temps = datetime.now()
			Date = time.strftime('%Y-%m-%d %H:%M:00')	
		cursor.execute("INSERT INTO infometeo(Date,pression,luminosite,humidite,detectionEau,temperatureExterieure,temperatureInterieure,girouette,anemometre) VALUES(%s,%s,%s,%s,%s,%s,%s,%s,%s)",[Date,pression,luminosite,humidite,detectionEau,temperatureExterieure,temperatureInterieure,girouette,anemometre])
		db.commit()
		id = cursor.lastrowid
		#Envoi pluviometre
		if(temps.minute == 0 or temps.minute == 10 or temps.minute == 20 or temps.minute == 30 or temps.minute == 40 or temps.minute == 50):
			print("envoi pluviometre")
			if(pluviometre == ""):
				pluviometre = 999999
			cursor.execute("INSERT INTO infopluviometre(ID,pluviometre) VALUES(%s,%s)",[id,pluviometre])
			db.commit()
			pluviometre = ""
		
		temps = datetime.now()
		print(temps)
		print ("-----------------")
		print("Envoi BDD confirme")
		print ("-----------------")
		print("");
		
		# reinitialisation anemometre
		anemometre = ""
		
		time.sleep(0.1)
	except Exception as e:
		print("erreur bdd")
		print e.message, e.args

def sauvegardeJson():
	try:
		pression =""
		luminosite = ""
		humidite = ""
		detectionEau = ""
		temperatureExterieure = ""
		temperatureInterieure = ""
		girouette = ""
		
		print("----------------------------------")	
		while(pression == "" or luminosite == "" or humidite =="" or detectionEau == "" or temperatureExterieure == "" or temperatureInterieure == "" or girouette == ""):	
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
			elif(ID[0:2] == "C5"):
				detectionEau = ser.readline()
				detectionEau = int(detectionEau)
			elif(ID[0:2] == "C7"):
				temperatureExterieure = ser.readline()
				temperatureExterieure = float(temperatureExterieure)
			elif(ID[0:2] == "C8"):
				temperatureInterieure = ser.readline()
				temperatureInterieure = float(temperatureInterieure)
			elif(ID[0:2] == "CA"):
				girouette = ser.readline()
				girouette = re.sub(" ","",girouette)
				girouette = re.sub("\n","",girouette)
				girouette = re.sub("\r","",girouette)
			elif(ID[0:2] == "CB"):
				global pluviometre
				pluviometre = ser.readline()
				pluviometre = float(pluviometre)
				print("----------------------------------------------------")
				print(pluviometre)
				print("nouvelle valeur pluie json")
			elif(ID[0:2] == "CC"):
				global anemometre
				anemometre = ser.readline()
				anemometre = float(anemometre)
				
			time.sleep(0.1)
		#Envoi dans le fichier Json
		read = open("/var/www/html/json/controleObservatoire.json", "r")
		data = json.load(read)
		data['meteoInstantanee']['detectionEau'] = detectionEau
		data['meteoInstantanee']['humidite'] = humidite
		data['meteoInstantanee']['luminosite'] = luminosite
		data['meteoInstantanee']['pression'] = pression
		data['meteoInstantanee']['temperatureInterieure'] = temperatureInterieure
		data['meteoInstantanee']['temperatureExterieure'] = temperatureExterieure
		
		# Donnees GPA
		if(anemometre != ""):
			data['gpa']['anemometre'] = anemometre	
		if(pluviometre != ""):
			data['gpa']['pluviometre'] = pluviometre
		
	
		data['gpa']['girouette'] = girouette
		read.close()
		write = open("../json/controleObservatoire.json", "w")
		json.dump(data, write, indent=4, sort_keys=True)
		write.close()
		
		print json.dumps(data['meteoInstantanee'], indent=4, sort_keys=True)
		print json.dumps(data['gpa'], indent=4, sort_keys=True)
		print("----------------------------------------")	
		print("Envoi donnees Instantanees Json effectue")	
		print("----------------------------------------")	
		
	except Exception as e:
		print e.message, e.args
		print('Data could not be read')
				
while 1:
	temps = datetime.now()
	sauvegardeJson()
	temps = datetime.now()
	print(temps)
	#if(temps.minute + float(1) %  5 == 0):
	if(temps.minute == 4 or temps.minute == 9 or temps.minute == 14 or temps.minute == 19 or temps.minute == 24 or temps.minute == 29 or temps.minute == 34 or temps.minute == 39 or temps.minute == 44 or temps.minute == 49 or temps.minute == 54 or temps.minute == 59):
		if(temps.second > 30):
			print("envoibdd")
			envoiBdd()
			time.sleep(15)
	time.sleep(5)
	#envoiBdd()
