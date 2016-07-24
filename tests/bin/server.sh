#!/usr/bin/env bash

DIR="$( cd -P "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
WEB_HOST="127.0.0.1"
WEB_PORT="8081"
WEB_ROOT="$DIR/../../public_html"
WEB_PATH="$WEB_ROOT/index.php"

cd $DIR

php -S "$WEB_HOST:$WEB_PORT" -t "$WEB_ROOT" "$WEB_PATH"&

echo "Waiting until PHP webserver is ready on port $WEB_PORT"
while [[ -z `curl -s "http://$WEB_HOST:$WEB_PORT" ` ]]
do
    echo -n "."
    sleep 2s
done

echo "PHP webserver is up"
