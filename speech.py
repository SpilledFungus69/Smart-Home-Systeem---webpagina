#import the speech recognition needed.
import speech_recognition as sr

r = sr.Recognizer()

while True:
     from commands import *
     try: 
          print("say something")
          #recognizes talking and makes it text.
          with sr.Microphone() as source:
               audio = r.listen(source)
               text = r.recognize_google(audio)
               text = text.lower()
               # prints what day it is what month it is 
               print(text)
               if "what's the time" in text:
                    tellTime()


               # if statements for opening andclosing the curtains, if you say close and curtains in the same sentence you it will print closing the curtains
               elif "close the curtains" in text:
                    print("closing curtains")

               elif "open the curtains" in text:
                    print("opening the curtains")
               

     #reloads the recognizer if there is a error (for example if you dont speak).
     except:
          r = sr.Recognizer()
          continue


