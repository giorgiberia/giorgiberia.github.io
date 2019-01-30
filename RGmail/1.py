import pyautogui
pic = pyautogui.screenshot()
pic.save('Screenshot.png')


f=open("res.txt","w+")
f.write("tqveni taski gaeshva")
f.close()
