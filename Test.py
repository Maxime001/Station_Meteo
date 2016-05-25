import serial
from serial import *
import time
from datetime import datetime
ser = serial.Serial('/dev/ttyUSB0', 9600, timeout=0)

# Script de contrôle de l'observatoire
# a : Alarme ON
# b : Alarme OFF
# c : Ouvre toit
# d : Ferme toit
# e : Tension télescope ON
# f : Tension télescope OFF
# g : Tension Resitance ON
# h : Tension Reisstance OFF
# i : Tension PC ON 
# j : Tension PC OFF

while 1:
	commande = "d"
	ser.flush()
	commande = str(commande)
	print ("Python value sent: ")
	print (commande)
	ser.write(commande)

	time.sleep(0.5)
