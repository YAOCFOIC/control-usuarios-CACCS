groups
cat /etc/group
ip  add
docker images
ls
cd /home
ls
cd polipruebas/
exit
ls
cd /
ls
sudo su
sudo apt-get install docker docker-compose containerd vim -y
sudo apt-get install docker.io docker-compose containerd vim -y
sudo usermod -aG docker polipruebas
newgrp docker
exit
ls
cd /
ls
docker ps
docker ps -a
cd ~
ls
touch Dockerfile
nano Dockerfile 
touch index.html
nano index.html 
ls
rm -rf index.html 
ls
cat index.html 
nano Dockerfile 
docker build -t paginainicial .
docker images
docker run -d -p 80:80 paginainicial paginainicial
dockerps
docker ps
docker exec -it paginainicial /bin/bash
docker ps
docker run -d -p 8080:80 paginainicial
docker stop paginainicial
docker run -d -p 80:80 paginainicial
docker ps
docker stop wonderful_kepler
docker ps
docker exec -it paginainicial /bin/bash
docker exec -it flamboyant_moore /bin/bash
docker stop flamboyant_moore 
docker run -d -p 80:80 paginainicial
docker ps
docker exec -it amazing_satoshi /bin/bash
docker ps
docker stop amazing_satoshi
docker image
docker images
docker run -d -p 80:80 paginainicial sitepage
docker run -d -p 80:80 paginainicial
docker ps
docker exec -it trusting_joliot /bin/bash
docker ps
docker images
docker exec -it httpd /bin/bash
docker images
docker ps
docker commit trusting_joliot ajusteimg:1.0
docker ps
docker stop trusting_joliot
docker run -d -p 80:80 paginainicial
docker ps
docker exec -it admiring_villani /bin/bash
docker images
docker run -d -p 80:80 ajusteimg
docker ps
docker stop admiring_villani
docker run -d -p 80:80 ajusteimg
docker login run -d -p 80:80 ajusteimg
docker login ajusteimg
docker rm ajusteimg
docker remove ajusteimg
docker rmi ajusteimg
docker images -f dangling=true
docker images -f dangling=false
docker images -a
docker rmi a08dc605dcdb
docker images -a
docker rmi 48808263981a
docker ps
docker rmi b33e5af6ad35
docker images -a
docker rmi $(docker images -a -q)
docker ps -a
docker rm 0dc7519e5694 ID_or_Name
docker rm 0dc7519e5694 d641ae7023b0
docker rm 0dc7519e5694
docker ps -a
docker rm 4cfa0d803672
docker rm 112c405479d3
docker rm ca6a2d76cf6c
docker rm 7c9c337fce96
docker rm 2e01bbeffa7b
docker ps
docker images -a
docker rmi $(docker images -a -q)
docker images -a

ls -l
docker build -t paginaincial .

docker run -d -p 80:80 paginainicial
docker images -a
docker run -d -p 80:80 paginaincial
docker images
docker images -a
docker rmi bab40d5c9114
docker ps
docker ps -a
docker stop laughing_edison
docker rmi bab40d5c9114
$ docker rm $(docker ps -a -q -f status=exited)
docker rm $(docker ps -a -q -f status=exited)
docker ps -a
docker images -a
docker rm bab40d5c9114
docker rmi bab40d5c9114
docker ps -a
docker images -a
docker rmi 0208f149a449
docker images -a
ls}
ls
docker build -t paginaconstruccion .
docker images
cp Dockerfile Dockerfile1
ls
nano Dockerfile1 
rm -rf Dockerfile1 
ls
docker run -d -p 33060:3306 --name mysql-db -e MYSQL_ROOT_PASSWORD=Integracion2025*
docker run -d -p 33060:3306 --name mysql-db -e MYSQL_ROOT_PASSWORD=secret mysql
docker images
docker rmi 2c849dee4ca9
docker images -a
docker ps -a
docker stop mysql-db
docker rmi 2c849dee4ca9
docker ps -a
docker rm mysql-db
docker images -a
docker rmi 2c849dee4ca9
docker images -a
docker run -d -p 33060:3306 --name mysql-db -e MYSQL_ROOT_PASSWORD=integracion2025*
docker run -d -p 33060:3306 --name mysql-db -e MYSQL_ROOT_PASSWORD=integracion2025
docker run -d -p 33060:3306 --name mysql-db -e MYSQL_ROOT_PASSWORD=integracion
docker run -d -p 33060:3306 --name mysql-db -e MYSQL_ROOT_PASSWORD=integracion 2025
docker run -d -p 33060:3306 --name mysql-db -e MYSQL_ROOT_PASSWORD=secret
docker run -d -p 33060:3306 --name mysql-db -e MYSQL_ROOT_PASSWORD=secret mysql
docker images -a
$ docker exec -it mysql-db mysql -p
docker exec -it mysql-db mysql -p
docker rm -f mysql-db
docker volume prune
docker images -a
docker volume create mysql-db-data
docker volume ls
docker run -d -p 33060:3306 --name mysql-db  -e MYSQL_ROOT_PASSWORD=integracion2025 --mount src=mysql-db-data,dst=/var/lib/mysql mysql
docker ps
$ docker exec -it mysql-db mysql -p
docker exec -it mysql-db mysql -p
docker rm -f mysql-db
docker run -d -p 33060:3306 --name mysql-db  -e MYSQL_ROOT_PASSWORD=integracion2025 --mount src=mysql-db-data,dst=/var/lib/mysql mysql
$ docker exec -it mysql-db mysql -p
docker exec -it mysql-db mysql -p
$ docker ps
docker ps
docker exec -it mysql-db mysql -p
docker ps
mysql-db | grep IPAddress
docker inspect mysql-db | grep IPAddress
docker exec -it mysql-db bash
sudo ufw status verbose~
sudo ufw status verbose
docker ps
$ docker rm mysql-db
docker rm mysql-db
docker rm -f mysql-db
docker run -d -p 3306:3306 --name mysql-db  -e MYSQL_ROOT_PASSWORD=integracion2025 --mount src=mysql-db-data,dst=/var/lib/mysql mysql
docker ps
docker exec -it mysql-db bash
exit
docker images
docker ps -a
docker run -d -p 80:80 paginaconstruccion --name sitepage
docker run -d -p 80:80 paginaconstruccion
docker ps -a
docker ps
docker exec -it mysql-db
docker exec -it mysql-db bash
docker exec -it mysql-db
docker exec -it mysql-db mysql -p
docker ps
sudo apt update upgrade -y
sudo apt update -y && sudo apt upgrade -y
sudo apt install nodejs npm python3 python3-pip -y
curl -fsSL https://pkg.jenkins.io/debian/jenkins.io-2023.key | sudo tee /usr/share/keyrings/jenkins-keyring.asc > /dev/null 
echo deb [signed-by=/usr/share/keyrings/jenkins-keyring.asc] https://pkg.jenkins.io/debian binary/ | sudo tee /etc/apt/sources.list.d/jenkins.list > /dev/null 
sudo apt install openjdk-17-jdk
java -version
sudo wget -O /usr/share/keyrings/jenkins-keyring.asc https://pkg.jenkins.io/debian-stable/jenkins.io-2023.key 
sudo sh -c 'echo deb [signed-by=/usr/share/keyrings/jenkins-keyring.asc] https://pkg.jenkins.io/debian binary/ > /etc/apt/sources.list.d/jenkins.list
sudo apt update
sudo apt install jenkins
sudo sh -c 'echo deb [signed-by=/usr/share/keyrings/jenkins-keyring.asc] https://pkg.jenkins.io/debian binary/ > /etc/apt/sources.list.d/jenkins.list
;
sudo apt update

sudo apt install jenkins

sudo systemctl start jenkins

sudo systemctl enable jenkins

sudo systemctl status jenkin
git -version
git version
git config --global user.name "Carlos Bernal"
git config --global user.email "canbere@gmail.com"
git config --list
mkdir prueba1
cd prueba1/
git init
echo control-usuarios-CACCS > README.md
ls
cat README.md 
cd ..
ls
rmdir -f prueba1/
rmdir prueba1/
rmdir -rf prueba1/
man rm dir
rm -r prueba1/
ls
docker network create red_docker
docker ps
docker ps -a
docker rmi 1a62d52b34bd
docker images -a
docker ps -a
docker stop vibrant_chandrasekhar
docker stop mysql-db
docker ps -a
docker run --name vibrant_chandrasekhar --network red_docker paginaconstruccion
docker run --network red_docker paginaconstruccion
docker ps -a
docker rmi 2379276e72e1
docker stop 2379276e72e1
docker stop 1a62d52b34bd
docker stop 905d9a9ee4ec
docker stop d5c5171b86bc
docker ps -a
docker rmi 1a62d52b34bd
docker stop 1a62d52b34bd
docker ps -a
docker ps
docker system prune
docker images -a
docker ps
docker image -a
docker images -a
docker network
docker network ls
docker network red_docker
docker network create red_docker
docker network ls
docker run -d -p 80:80 --name website --network red_docker paginaconstruccion
docker ps
docker run -d -p 3306:3306 --name mysql-db  --network red_docker -e MYSQL_ROOT_PASSWORD=integracion2025 --mount src=mysql-db-data,dst=/var/lib/mysql mysql
docker ps
docker inspect website
docker inspect mysql
docker exec -it mysql-db mysql -p
docker ps
ping mysql
ping mysql-db
ping paginaconstruccion
ping website
docker exec -it mysql-db /bin/bash
docker exec -it mysql-db sh
docker inspect website
docker inspect mysql-db
docker exec -it mysql-db /bin/bash
docker exec -it mysql-db sh
docker inspect mysql-db
docker inspect website
docker exec -it mysql-db /bin/bash
docker inspect red_docker
docker exec -it mysql-db /bin/bash
docker exec -it mysql-db
docker exec -it mysql-db mysql -p
docker 
cat Dockerfile_DB 
docker images
docker save -o img_paginaprincipal.tar.gz paginaconstruccion:latest
docker save -o img_basedatos.tar.gz mysql:latest
ls
git init
git clone https://github.com/YAOCFOIC/control-usuarios-CACCS.git
ls
mv Dockerfile Dockerfile_DB img_basedatos.tar.gz img_paginaprincipal.tar.gz  index.html pngwing.com.png control-usuarios-CACCS/
ls
cd control-usuarios-CACCS/
git add .
git commit -m "Archivos con toda la información de Docker creado y sus respectivas imágenes"
git push origin master
git push -u origin master
git push origin master
git config --global user.name "carlosbernal8130"
git config --global user.email "canbere@gmail.com"
git push origin master
git init
git add Dockerfile Dockerfile_DB index.html pngwing.com.png
git commit -m "Archivos con toda la información de Docker creado y sus respectivas imágenes"
git push origin master
ls
ls -l
rm -rf img_basedatos.tar.gz img_paginaprincipal.tar.gz 
git init
git add .
git push origin master
ls -l


git init
git add Dockerfile
git commit -m "Archivos docker pagina inicial"
git init
git add .
git commit -m "Archivos con toda la información de Docker creado y sus respectivas imágenes"
git push origin master
git init
git add Dockerfile Dockerfile_DB
git commit -m "Archivos con toda la información de Docker creado"
git push
ls
git stop
git --help
github restore
git restore
curl -s https://packagecloud.io/install/repositories/github/git-lfs/script.deb.sh | sudo bash
sudo apt-get install git-lfs
git lfs install
docker save img_basedatos.tar.gz mysql
docker save -o img_basedatos.tar.gz mysql
docker save -o img_site.tar.gz paginaconstruccion
ls
git lfs track "*.tar.gz"
git add .gitattributes
git commit -m "Configure Git LFS for .tar.gz files"
git rm --cached img_paginaprincipal.tar.gz
git rm --cached img_basedatos.tar.gz
git add img_paginaprincipal.tar.gz
git add img_basedatos.tar.gz
git add img_site.tar.gz 
git commit -m "Add large image backups using Git LFS"
git push origin main
git rm --cached
git rm --cached img_basedatos.tar.gz 
git rm --cached img_site.tar.gz 
ls
rm -rf img_basedatos.tar.gz img_site.tar.gz
ls
git rm --cached Dockerfile
git rm --cached Dockerfile_DB 
git rm --cached index.html 
git rm --cached pngwing.com.png 
ls
git add Dockerfile
git add Dockerfile_DB 
git commit -m "Archivos con toda la información de Docker creado"
git push origin main
git push origin master
docker save -o img_basedatos.tar.gz mysql
docker save -o img_site.tar.gz paginaconstruccion
docker inspect red_docker
cat Dockerfile
cat Dockerfile_DB 
git init
clone https://github.com/YAOCFOIC/control-usuarios-CACCS.git
gitclone https://github.com/YAOCFOIC/control-usuarios-CACCS.git
git clone https://github.com/YAOCFOIC/control-usuarios-CACCS.git
git pull
git pull https://github.com/YAOCFOIC/control-usuarios-CACCS.git main
git pull origin main 
git pull origin master
git pull https://github.com/YAOCFOIC/control-usuarios-CACCS.git master
ls
cd control-usuarios-CACCS/
ls
git pull https://github.com/YAOCFOIC/control-usuarios-CACCS.git master
ls
ls -l
cd ..
ls -l
cat index.html 
images
docker images
ls
cat config.php 
ls
docker ps -a
docker images -a
docker stop website
docker stop mysql-db
docker rm a1c6f23307cc
docker rmi a1c6f23307cc
docker ps 
docker ps -a
docker stop b44ab2bef99d
docker stop 88fbecca0b99
docker ps -a
docker stop $(docker ps -a -q)
docker rm $(docker ps -a -q)
docker rm $(docker ps -a -f status=exited -q)
docker image prune
docker system prune
docker system prune -a
docker-compose up -d
docker ps -a
docker images -a
docker-compose down -v
docker system prune -a
docker-compose up -d
docker system prune -a
cat docker-compose.yml 
cd gestor/
cat Dockerfile 
nano Dockerfile 
docker-compose up -d
docker ps -a
docker network ls
docker network inspect polipruebas_gestor_network 
history | grep 'docker exec' 
docker exec -it gestor_db /bin/bash
ls
nano db.php 
sudo nano db.php 
docker-compose down
docker-compose up -d
docker-compose down
cd ..
docker-compose up -d
docker network inspect polipruebas_gestor_network 
cd gestor/
sudo nano db.php 
cd ..
docker-compose down
docker-compose up -d
docker network inspect polipruebas_gestor_network 
docker-compose down
docker system prune -a
docker prune -a
docker system prune -a
docker-compose up -d
docker network inspect polipruebas_gestor_network 
docker ps
docker system prune -a
docker system prune
docker image prune
docker ps -a
docker stop $(docker ps -a -q)
docker rm $(docker ps -a -q)
docker ps
docker ps -a
docker images -a
docker rmi 983f17402121
docker images -a
docker rmi 616e340baeac
docker images -a
docker ps -a
docker-compose up -d
docker ps -a
history | grep 'docker exec'
docker exec -it gestor_db sh
pg_restore -U postgres -d gestor -v /home/polipruebas/gestor/gestor.sql
docker exec -it gestor_db sh
docker-compose down
ls
cd gestor/
ls
nano db.php 
sudo nano db.php 
docker-compose up -d
cat db.php 
docker ps -a
rm -rf gestor.sql 
sudo rm -rf gestor.sql 
ls
docker-compose down
cd ..
ls -l
chmod ugo+rwx gestor/
sudo chmod ugo+rwx gestor/
ls -l
cd gestor/
cat gestor.sql 
cat gestor.sql
docker-compose down
cd ..
cat docker-compose.yml 
docker system prune -a
docker ps -a
docker images -a
docker-compose up -d
docker ps -a
docker system prune
docker system prune -a
- ./gestor/gestor.sql:/docker-entrypoint-initdb.d/gestor.sql
docker stop $(docker ps -a -q)
docker rm $(docker ps -a -q)
docker rm $(docker ps -a -f status=exited -q)
docker images -f dangling=true -q | xargs docker rmi
docker image prune
cat docker-compose.yml 
docker-compose up -d
docker-compose down
docker-compose up -d
docker image prune -a
docker-compose down
docker image prune -a
docker ps prune -a
docker ps -a
docker-compose up -d
docker ps -a
docker-compose down
docker image prune -a
docker system prune -a
docker ps -a
docker images .a
docker images -a
docker-compose up -d
docker ps -a
docker-compose up -d
docker-compose down
docker-compose up -d
docker ps -a
docker exec -ti ci_jenkins bash
git init
ls
cd control-usuarios-CACCS/
ls
cd ..
rm -rf control-usuarios-CACCS/
git init
ls
ls -l
ls -la
cd .git
ls
cd..
cd ..
ls
git add .
git status
git commit -m "Implementación de Jenkins e implementación de docker-compost"
git push origin master
git remote -v
git remote add origin https://github.com/YAOCFOIC/control-usuarios-CACCS.git
git push origin master
ls -l
ls
cat Jenkinsfile 
ls
docker ps -a
docker-compose up -d
cat Jenkinsfile 
git commit -m "Actualización de archivo Jenkinsfile"
git add Jenkinsfile
git commit -m "Actualización de archivo Jenkinsfile"
history | grep git
git push origin master
nano Jenkinsfile 
git add Jenkinsfile
git commit -m "Actualización de archivo Jenkinsfile con nombre de proyecto"
git push origin master
docker exec -it ci_jenkins  bash
cat Jenkinsfile 
ls -R /home/polipruebas/gestor
git add Jenkinsfile app.py test_app.py 

git push origin master
cat docker-compose.yml 
nano docker-compose.yml 
git add Jenkinsfile
git add docker-compose.yml 
git commit -m "Actualización de archivo para pruebas de jenkins"
git push origin master
docker system prune -a
history | grep docker
docker rm $(docker ps -a -q)
docker rm $(docker ps -a -f status=exited -q)
docker rm $(docker ps -a -q)
docker ps -a
docker stop b76aa6501c89
docker stop e574de006a88
docker stop adf6a71ef161
docker rm $(docker ps -a -q)
docker rm $(docker ps -a -f status=exited -q)
docker images -a
docker system prune
docker images prune
docker image prune
docker images -a
docker rm $(docker ps -aq)
docker image prune -a
docker images -a
docker ps -a
docker-compose up -d
docker exec -it ci_jenkins bash
cat Dockerfile
cd gestor/
ls
cat Dockerfile 
cd ..
nano docker-compose.yml 
touch Dockerfile.jenkins
nano Dockerfile.jenkins 
nano docker-compose.yml 
docker-compose down
docker-compose up -d
docker-compose down
docker-compose build
docker-compose up -d
nano Dockerfile.jenkins 
docker-compose build
docker-compose up -d
nano Dockerfile.jenkins 
docker-compose down
docker-compose build
docker-compose up -d
nano Dockerfile.jenkins 
docker-compose down
docker-compose build
docker-compose up -d
docker ps -a
docker image prune -a
docker rm $(docker ps -aq)
docker ps -a
docker stop d71ce8a2adb6
docker stop ff956d4bc2b7
docker stop 78b9a9a93bea
docker rm $(docker ps -aq)
docker ps -a
docker images -a
docker image prune -a
docker images -a
docker-compose up -d
git add .
git commit -m "ajuste para pruebas jenkins"
git push origin master
docker-compose down --remove-orphans
docker ps -a
docker stop gestor_db
docker rm gestor_db
docker-compose down --remove-orphans
docker-compose up -d
docker-compose down --remove-orphans
docker-compose up -d
cat Jenkinsfile 
nano Jenkinsfile 
git add Jenkinsfile 
git commit -m "Ajuste de limpiado en contenedores"
git push origin master
docker ps -a
docker-compose down --remove-orphans
docker-compose up -d
cat Jenkinsfile 
nano Jenkinsfile 
cat Jenkinsfile 
docker-compose down --remove-orphans
docker ps -a}
docker ps -a
docker images -a
docker rm $(docker ps -aq)
docker image prune -a
docker images -a
docker-compose up -d
git add Jenkinsfile 
cat app.py 
git commit -m "Aclaración en cambios de stages"
git push origin master
nano Jenkinsfile 
git add Jenkinsfile 
git commit -m "Aclaración en cambios de stages"
git push origin master
docker ps -a | grep gestor_db
docker rm -f c9558e52a3fc
docker-compose 
cat docker-compose 
cat docker-compose.yml 
nano docker-compose.yml 
git add .
git commit -m "se realiza ajuste en el nombre del contenedor de base de datos para funcionamiento de jenkins"
git push origin master
docker-compose down --remove-orphans
docker rm $(docker ps -aq)
docker images -a
docker-compose up -d
nano docker-compose.yml 
git add .
git commit -m "se realiza ajuste en el nombre del contenedor de jenkins para funcionamiento de jenkins"
git push origin master
nano docker-compose.yml 
git commit -m "se realiza ajuste en el nombre del contenedor web para funcionamiento de jenkins"
git add .
git commit -m "se realiza ajuste en el nombre del contenedor web para funcionamiento de jenkins"
git push origin master
dpoint proyecto_nomina_pipeline-db-1 (...): Bind for 0.0.0.0:5432 failed: port is already allocated
sudo netstat -tulnp | grep 5432
# O para sistemas más modernos:
sudo lsof -i :5432
sudo systemctl stop postgresql
docker ps -a
docker stop polipruebas_db_1
docker rm polipruebas_db_1 
docker stop 12599a983eea
docker rm gestor_web
docker stop polipruebas_db_1
docker ps -a
docker stop ci_jenkins 
docker rm ci_jenkins 
docker ps -a
docker images -a
docker rm $(docker ps -aq)
docker image prune -a
docker-compose up -d
docker ps -a | grep gestor_db
docker rm -f gestor_db
docker ps -a.
docker ps -a
cat Jenkinsfile 
nano Jenkinsfile 
git add .
git commit -m "Ajuste para depurar errores en jenkings"
git push origin master
docker ps -a
cd gestor/
ls
cat db.php 
nano db.php 
sudo nano db.php 
docker-compose down
docker-compose up -d
cd ..
git add .
git commit -m "configuración BD por cambio de nombres de contenedores"
git push origin master
docker-compose down
docker-compose up -d
sudo nano docker-compose.yml 
sudo lsof -i :8080
sudo nano docker-compose.yml 
git add .
git commit -m "configuración puerto jenkings"
git push origin master
docker-compose down
docker-compose up -d 
sudo nano docker-compose.yml 
git add .
git commit -m "configuración puerto jenkings"
git push origin master
sudo nano docker-compose.yml 
cd gestor/
ls
sudo nano db.php 
cd ..
cat Jenkinsfile 
git add .
git commit -m "configuración puerto jenkings"
git push origin master
sudo nano docker-compose.yml 
git add .
git commit -m "configuración puerto jenkings"
git push origin master
docker-compose down
docker-compose up -d
docker ps -a
docker stop polipruebas_db_1
docker stop polipruebas_web_1 
docker ps -a
docker-compose up -d
git pull
git pull origin master
docker-compose down
docker-compose up -d
cd gestor/
cat db.php 
cd ..
git pull origin master
cd gestor/
cat gestor.sql
docker-compose down
cd ..
sudo nano docker-compose.yml 
docker ps -a
docker-compose up -d
git pull origin master
cd gestor/
ls -l
docker-compose down
docker-compose up -d
cd ..
cat docker-compose.yml 
ls
cat nginx.conf 
nano nginx.conf 
docker-compose down
docker-compose up -d
cat nginx.conf 
nao nginx.conf 
nano nginx.conf 
docker-compose up -d
docker-compose down
docker-compose up -d
cat docker-compose.yml 
nano nginx.conf 
docker-compose build
docker-compose down
docker-compose up --build
docker-compose up
docker-compose up -d
nano nginx.conf 
cat docker-compose.yml 
nano nginx.conf 
docker-compose down
docker-compose up -d
dockjer ps -a
docker ps -a
docker exec -it polipruebas_db_1 bash
docker-compose exec web bash
cat docker-compose.yml 
nano docker-compose.yml 
nano nginx.conf 
cd gestor
cat Dockerfile 
cd ..
nano nginx.conf 
docker-compose down
docker-compose up --build -d
docker-compose exec web bash
nano docker-compose.yml 
cd gestor/
cat Dockerfile 
cd ..
ls
cat config.php 
cat nginx.conf 
nano nginx.conf 
nano docker-compose.yml 
nano nginx.conf 
docker-compose down
docker-compose up -d
docker ps -a 
docker-compose logs web
docker-compose exec web bash
cat docker-compose.yml 
cat nginx.conf 
cd gestor/
cat Dockerfile 
cd ..
nano docker-compose.yml 
docker-compose down -v
docker-compose down 
docker-compose up --build -d
nano docker-compose.yml 
docker-compose down 
docker-compose down -v

nano docker-compose.yml 
ls -l /home/polipruebas/gestor/gestor.sql
docker-compose down -v
docker-compose up --build -d
cd gestor/
nano login.php 
sudo nano login.php 
docker-compose down -v
docker-compose up --build -d
cat docker-compose.yml 
cd ..
cat docker-compose.yml 
cd gestor/
touch Dockerfile.php
nano Dockerfile.php 
cd ..
nano docker-compose.yml 
cd gestor/
nano login.php 
sudo nano login.php 
docker-compose down -v
docker-compose up --build -d
cd ..
sudo nano docker-compose.yml 
docker-compose down -v
nano docker-compose.yml 
docker-compose down
nano docker-compose.yml 
cat docker-compose.yml 
nano docker-compose.yml 
docker-compose down
docker-compose up --build -d
cd gestor/
ls
cat db.php
sudo nano db.php 
cat db.php 
docker-compose down
docker-compose up --build -d
cd ..
docker exec -it mi-postgres bash
docker-compose down -v
docker-compose up --build -d
docker -ps -a
docker ps -a
cd gestor/
cat db.php 
docker-compose down -v
docker-compose up -d
docker ps -a
docker-compose down -v
docker-compose up --build -v
docker-compose up --build -d
docker ps -a
history | grep docker
docker-compose down -v
docker image prune -a
docker-compose up --build -d
docker ps -a
docker logs mi-postgres
sudo nano gestor.sql 
nano gestor.sql 
docker-compose down -v
docker image prune -a
docker-compose up --build -d
docker ps -a
nano gestor.sql 
sudo nano gestor.sql 
docker-compose down -v
docker image prune -a
docker-compose up --build -d
docker ps -a
docker exec -it mi-postgres bash
sudo nano login.php 
docker-compose down -v
docker image prune -a
docker-compose up --build -d
docker ps -a
docker exec -it mi-postgres bash
docker exec -it polipruebas_jenkins_1 bash
cd ..
git add .
git commit -m "Implementación en Docker para login.php"
git push origin master
docker ps -a
cd gestor
nano index.php 
sudo nano index.php 
docker-compose down
docker-compose up -d
git add .
git commit -m "Creación botón cerrar sesion en index.php"
git push origin master
docker ps -a
docker stop mi-postgres
docker rm mi-postgres
cd ..
nano Jenkinsfile 
git add .
git commit -m "Ajuste en pipeline"
git push origin master
nano Jenkinsfile 
git add Jenkinsfile 
git commit -m "Ajuste en pipeline"
git push origin master
docker ps -a
docker-compose up -d
docker ps -a
docker-compose up -d
