
.PHONY: install update rector rector-dry-run test

install:
	composer install

update:
	composer update

rector:
	vendor/bin/rector process src

rector-dry-run:
	vendor/bin/rector process src --dry-run

test:
	vendor/bin/phpunit
