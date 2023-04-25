import mysql.connector
import pywhatkit
import keyboard as k

conn=mysql.connector.connect(host='localhost', user='root', password='', db='carpoolcrew')
if conn.is_connected():
    phonenum = '+917349353427'
    pywhatkit.sendwhatmsg_instantly(phonenum, 'Welcome to Akele beCar')
    k.press_and_release('enter')

