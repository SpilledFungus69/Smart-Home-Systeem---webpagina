#!/usr/bin python3.11
import RPi.GPIO as GPIO
import os

def setupGPIO():
	GPIO.setmode(GPIO.BCM)
	GPIO.setwarnings(False)
	GPIO.setup(18, GPIO.OUT)
	
def controlLED():
	try:
		GPIO.output(18, GPIO.LOW)
		
	except KeyboardInterrupt:
		GPIO.cleanup()
		print("")

setupGPIO()

controlLED()
			
