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
