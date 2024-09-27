#!/usr/bin python3.11
import RPi.GPIO as GPIO
import os


#!dit zet de gpio pinns op een van de uitgangen van de raspberry pi, die levert dan stroom naar een relay die groot stroom kan regelen

def setupGPIO():
	GPIO.setmode(GPIO.BCM)
	GPIO.setwarnings(False)
	GPIO.setup(19, GPIO.OUT)
	
def controlLED():
	try:
		GPIO.output(19, GPIO.HIGH)
	except KeyboardInterrupt:
		GPIO.cleanup()
		print("")

setupGPIO()

controlLED()
			