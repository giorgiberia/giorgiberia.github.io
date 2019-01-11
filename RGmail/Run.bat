@ECHO OFF

START "" "1.py"

:LOOP
tasklist | find /i "py.exe" >nul 2>&1
IF ERRORLEVEL 1 (
  GOTO CONTINUE
) ELSE (
  ECHO task is still running
  Timeout /T 5 /Nobreak
  GOTO LOOP
)
 
:CONTINUE
Start "send" /B 2.py
exit

