#!/bin/bash
set -e

echo ">> Running PHPCS..."
./vendor/bin/phpcs --standard=phpcs.xml.dist --extensions=php src tests

echo ">> Running PHPStan..."
./vendor/bin/phpstan analyse --memory-limit=1G

echo ">> Running PHPUnit..."
./vendor/bin/phpunit --colors=always
