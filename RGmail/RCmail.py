import re
import os
import subprocess
from sys import stdout
import requests
from github import Github
from datetime import datetime
import os
import smtplib
from email.mime.image import MIMEImage
from email.mime.multipart import MIMEMultipart
from email.mime.text import MIMEText



class RCmail:
  def __init__(self):
    self.status = "active"

  def myRun(self,filename,interpretator):
      if interpretator == "cmd":
        with open(filename,"rb") as f:
            with open("1.py", "wb") as f1:
                for line in f:
                    f1.write(line)
        subprocess.call([r'Run.bat'])
          #linux

        f=open("res.txt","w+")
        f.write("tqveni taski gaeshva")
        f.close()

      return 1

  def send_conf_email(self,reason="",link=""):
      msg = MIMEMultipart()
      if reason == "error":
          msg['Subject'] = 'Task Has not been completed'
          msg['From'] = 'beria.giorgi1@gmail.com'
          msg['To'] = 'beria.giorgi1@gmail.com'
          text=MIMEText("Your download link was not correct. Please check it again")
          msg.attach(text)
          s = smtplib.SMTP_SSL("smtp.gmail.com", 465)
          s.ehlo()
          s.login("beria.giorgi1@gmail.com", "zmuki.1256")
          s.sendmail("beria.giorgi1@gmail.com",'beria.giorgi1@gmail.com', msg.as_string())
          s.quit()
      else:
          msg['Subject'] = 'Task Has successfully completed'
          msg['From'] = 'beria.giorgi1@gmail.com'
          msg['To'] = 'beria.giorgi1@gmail.com'
          text = MIMEText("Your task successfully completed. To See result please click "+link)
          msg.attach(text)
          s = smtplib.SMTP_SSL("smtp.gmail.com", 465)
          s.ehlo()
          s.login("beria.giorgi1@gmail.com", "zmuki.1256")
          s.sendmail("beria.giorgi1@gmail.com",'beria.giorgi1@gmail.com', msg.as_string())
          s.quit()



  def My_upload(self,pc_name):
      g = Github("giorgi1517","zmuki1256")
      name=pc_name+"*"+str(datetime.now().date())+"__"+str(datetime.now().time().hour)+str(datetime.now().time().minute)+".txt"
      repo = g.get_repo("giorgi1517/giorgi1517.github.io")
      os.rename('res.txt',name)
      with open(name, 'r') as myfile:
        data=myfile.read().replace('\n', '')
      repo.create_file(name, "Result_of_task", data, branch="master")
      os.remove(name)
      link="<a href=\""+"https://giorgi1517.github.io/"+name+"\">here.</a>"
      self.send_conf_email(link)

      #
      # repo = g.get_repo("giorgi1517/giorgi1517.github.io")
      # contents = repo.get_contents("")
      # for content_file in contents:
      #     print(content_file)



  def is_downloadable(self,url):
      h = requests.head(url, allow_redirects=True)
      header = h.headers
      content_type = header.get('content-type')
      if 'text' in content_type.lower():
          return False
      if 'html' in content_type.lower():
          return False
      return True



  def get_filename_from_url(self,url):
      return url.rsplit('/', 1)[1]


  def myDownload(self,url,path):
      if self.is_downloadable(url)!= True:
         self.send_conf_email("error")
          #aq chavwero pasuxis failshi chawera da gagzavna
      else:
          r = requests.get(url, allow_redirects=True)
          print(r.headers.get('content-disposition'))
          filename = path+self.get_filename_from_url(url)
          open(filename,'wb').write(r.content)


#-----------------------------------------------------------------------------
url="https://giorgi1517.github.io/task.py"
p1 = RCmail()
print(p1.is_downloadable(url))
print(p1.get_filename_from_url(url))
print(p1.myDownload(url,""))
print(p1.myRun("task.py","cmd"))
