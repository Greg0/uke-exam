#/bin/sh

docker run --rm --interactive --tty \
  -p 8088:8000 \
    --name uke-exam \
  --volume $PWD:/var/www \
  greg0/php-runtime-env:php8.2 composer start
