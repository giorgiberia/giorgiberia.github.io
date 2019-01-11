import re
import subprocess
from sys import stdout
import requests


class RCmail:
  def __init__(self):
    self.status = "active"

  def myRun(self,filename,interpretator):
      if interpretator == "cmd":
        commandFile = open(filename,'wb')
        open('1.py', 'wb').write(commandFile.)
        subprocess.call([r'Run.bat'])
      return 1


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
          print("file is not downloadable")
      else:
          r = requests.get(url, allow_redirects=True)
          print(r.headers.get('content-disposition'))
          filename = path+self.get_filename_from_url(url)
          open(filename, 'wb').write(r.content)


# -----------------------------------------------------------------------------
url="https://giorgi1517.github.io/files/task.py"
p1 = RCmail()
print(p1.is_downloadable(url))
print(p1.get_filename_from_url(url))
print(p1.myDownload(url,""))
#print(p1.myRun("task.py","cmd"))
