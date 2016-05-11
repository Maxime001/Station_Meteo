import serial
from serial import *
import time
from datetime import datetime
ser = serial.Serial('/dev/ttyUSB0', 9600, timeout=0)

while 1:
	setTempCar1 = "d"
	ser.flush()
	setTemp1 = str(setTempCar1)
	print ("Python value sent: ")
	print (setTemp1)
	ser.write(setTemp1)
	ser.write(setTemp1)
	ser.write(setTemp1)

	time.sleep(0.5)
