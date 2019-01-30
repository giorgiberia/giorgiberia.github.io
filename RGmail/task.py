import os

res=os.listdir()

f=open("res.txt","w+")
f.write("tqveni taski gaeshva shedegia "+str(res))
f.close()
