#!/usr/bin/env sh

#
# JBZoo SSmaker-Server
#
# This file is part of the JBZoo CCK package.
# For the full copyright and license information, please view the LICENSE
# file that was distributed with this source code.
#
# @package   SSmaker-Server
# @license   MIT
# @copyright Copyright (C) JBZoo.com,  All rights reserved.
# @link      https://github.com/JBZoo/SSmaker-Server
#

DIR="$( cd -P "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
WEB_HOST="127.0.0.1"
WEB_PORT="8081"
WEB_ROOT="$DIR/../../public_html"
WEB_PATH="$WEB_ROOT/index.php"

echo $DIR
echo $WEB_ROOT
echo $WEB_PATH
cd $DIR

php -S "$WEB_HOST:$WEB_PORT" -t "$WEB_ROOT" "$WEB_PATH" &

sleep 3s

echo "Waiting until PHP webserver is ready on port 8081"
while [[ -z `curl -s "http://$WEB_HOST:$WEB_PORT" ` ]]
do
    sleep 1s
done

echo "Webserver $WEB_HOST:$WEB_PORT started!"
