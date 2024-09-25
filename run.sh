#/bin/sh

docker build -t uke-exam .
docker run --name uke-exam -dp 8000:8000 uke-exam
