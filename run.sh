#/bin/sh

docker build -t uke-exam .
docker run -dp 127.0.0.1:8000:8000 uke-exam
