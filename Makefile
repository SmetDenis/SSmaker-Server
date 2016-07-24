.PHONY: build test

build:
	composer self-update --no-interaction
	composer update --optimize-autoloader --no-interaction

test: server
	./vendor/bin/phpunit

test-all: build test
	composer validate --no-interaction
	./vendor/bin/phpmd ./src text ./vendor/jbzoo/misc/phpmd/jbzoo.xml --verbose
	./vendor/bin/phpcs ./src --extensions=php --standard=./vendor/jbzoo/misc/phpcs/JBZoo/ruleset.xml --report=full
	./vendor/bin/phpcpd ./src --verbose
	./vendor/bin/phploc ./src --verbose

server
	./tests/bin/server.sh

coveralls
	./vendor/bin/coveralls --verbose
