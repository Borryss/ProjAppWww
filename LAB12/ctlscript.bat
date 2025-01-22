@echo off
rem START or STOP Services
rem ----------------------------------
rem Check if argument is STOP or START

if not ""%1"" == ""START"" goto stop

if exist E:\SHARAGA\XAMP\hypersonic\scripts\ctl.bat (start /MIN /B E:\SHARAGA\XAMP\server\hsql-sample-database\scripts\ctl.bat START)
if exist E:\SHARAGA\XAMP\ingres\scripts\ctl.bat (start /MIN /B E:\SHARAGA\XAMP\ingres\scripts\ctl.bat START)
if exist E:\SHARAGA\XAMP\mysql\scripts\ctl.bat (start /MIN /B E:\SHARAGA\XAMP\mysql\scripts\ctl.bat START)
if exist E:\SHARAGA\XAMP\postgresql\scripts\ctl.bat (start /MIN /B E:\SHARAGA\XAMP\postgresql\scripts\ctl.bat START)
if exist E:\SHARAGA\XAMP\apache\scripts\ctl.bat (start /MIN /B E:\SHARAGA\XAMP\apache\scripts\ctl.bat START)
if exist E:\SHARAGA\XAMP\openoffice\scripts\ctl.bat (start /MIN /B E:\SHARAGA\XAMP\openoffice\scripts\ctl.bat START)
if exist E:\SHARAGA\XAMP\apache-tomcat\scripts\ctl.bat (start /MIN /B E:\SHARAGA\XAMP\apache-tomcat\scripts\ctl.bat START)
if exist E:\SHARAGA\XAMP\resin\scripts\ctl.bat (start /MIN /B E:\SHARAGA\XAMP\resin\scripts\ctl.bat START)
if exist E:\SHARAGA\XAMP\jetty\scripts\ctl.bat (start /MIN /B E:\SHARAGA\XAMP\jetty\scripts\ctl.bat START)
if exist E:\SHARAGA\XAMP\subversion\scripts\ctl.bat (start /MIN /B E:\SHARAGA\XAMP\subversion\scripts\ctl.bat START)
rem RUBY_APPLICATION_START
if exist E:\SHARAGA\XAMP\lucene\scripts\ctl.bat (start /MIN /B E:\SHARAGA\XAMP\lucene\scripts\ctl.bat START)
if exist E:\SHARAGA\XAMP\third_application\scripts\ctl.bat (start /MIN /B E:\SHARAGA\XAMP\third_application\scripts\ctl.bat START)
goto end

:stop
echo "Stopping services ..."
if exist E:\SHARAGA\XAMP\third_application\scripts\ctl.bat (start /MIN /B E:\SHARAGA\XAMP\third_application\scripts\ctl.bat STOP)
if exist E:\SHARAGA\XAMP\lucene\scripts\ctl.bat (start /MIN /B E:\SHARAGA\XAMP\lucene\scripts\ctl.bat STOP)
rem RUBY_APPLICATION_STOP
if exist E:\SHARAGA\XAMP\subversion\scripts\ctl.bat (start /MIN /B E:\SHARAGA\XAMP\subversion\scripts\ctl.bat STOP)
if exist E:\SHARAGA\XAMP\jetty\scripts\ctl.bat (start /MIN /B E:\SHARAGA\XAMP\jetty\scripts\ctl.bat STOP)
if exist E:\SHARAGA\XAMP\hypersonic\scripts\ctl.bat (start /MIN /B E:\SHARAGA\XAMP\server\hsql-sample-database\scripts\ctl.bat STOP)
if exist E:\SHARAGA\XAMP\resin\scripts\ctl.bat (start /MIN /B E:\SHARAGA\XAMP\resin\scripts\ctl.bat STOP)
if exist E:\SHARAGA\XAMP\apache-tomcat\scripts\ctl.bat (start /MIN /B /WAIT E:\SHARAGA\XAMP\apache-tomcat\scripts\ctl.bat STOP)
if exist E:\SHARAGA\XAMP\openoffice\scripts\ctl.bat (start /MIN /B E:\SHARAGA\XAMP\openoffice\scripts\ctl.bat STOP)
if exist E:\SHARAGA\XAMP\apache\scripts\ctl.bat (start /MIN /B E:\SHARAGA\XAMP\apache\scripts\ctl.bat STOP)
if exist E:\SHARAGA\XAMP\ingres\scripts\ctl.bat (start /MIN /B E:\SHARAGA\XAMP\ingres\scripts\ctl.bat STOP)
if exist E:\SHARAGA\XAMP\mysql\scripts\ctl.bat (start /MIN /B E:\SHARAGA\XAMP\mysql\scripts\ctl.bat STOP)
if exist E:\SHARAGA\XAMP\postgresql\scripts\ctl.bat (start /MIN /B E:\SHARAGA\XAMP\postgresql\scripts\ctl.bat STOP)

:end

