build: 
	- docker-compose build
start: 
	- docker-compose up -d
stop: 
	- docker-compose stop
clean: 
	- docker rm -f $(docker ps -a -q) && docker volume rm $(docker volume ls -q)