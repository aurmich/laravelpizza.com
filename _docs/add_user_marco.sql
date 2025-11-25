GRANT ALL PRIVILEGES ON *.* TO 'marco'@'localhost' IDENTIFIED BY 'marco' WITH GRANT OPTION;
GRANT ALL PRIVILEGES ON *.* TO 'marco'@'%' IDENTIFIED BY 'marco' WITH GRANT OPTION;
GRANT RELOAD,PROCESS ON *.* TO 'marco'@'localhost';
GRANT USAGE ON *.* TO 'marco'@'localhost';
GRANT ALL PRIVILEGES ON *.* TO 'homestead'@'localhost' IDENTIFIED BY 'secret' WITH GRANT OPTION;
GRANT ALL PRIVILEGES ON *.* TO 'homestead'@'%' IDENTIFIED BY 'secret' WITH GRANT OPTION;
GRANT RELOAD,PROCESS ON *.* TO 'homestead'@'localhost';
GRANT USAGE ON *.* TO 'homestead'@'localhost';
flush privileges;
