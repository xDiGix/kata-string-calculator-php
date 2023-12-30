php := docker run --rm --interactive --tty --volume "$(CURDIR)":/app -w /app php8.2 php
ptest := ./vendor/bin/phpunit --testdox --colors=always

test:
	${php} ${ptest}

coverage:
	${php} -dxdebug.mode=coverage ${ptest} --coverage-html coverage
.PHONY: coverage