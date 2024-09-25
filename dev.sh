#/bin/sh

docker build -t uke-exam .
docker run --volume $PWD:/var/www --name uke-exam -dp 8000:8000 uke-exam
