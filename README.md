# Alfa Test Exercise

## Instructions

To avoid permission issues between the host machine and the container, you have to get your user and group id with the following commands: `id -u` and `id -g`.

Make a copy of `.env.example` into `.env` in the `docker` folder and update with the upper values:

```bash
cp docker/.env.example docker/.env
```

If you have make on your computer simply run the following commands in the project root:

```bash
make build # This builds the docker image
make install # This starts a container and runs the composer install in it
```

After that the next commands are available:

```bash
make run-original # This executes the original run.php
make run-solution # This one runs the solution
make test # Running PHPUnit tests
make cs # Checking code style (PHPCS)
```

In case you don't have make on your computer, you have to manually build the image and run install with docker:

```bash
docker compose -f docker/docker-compose.yaml build app
docker compose -f docker/docker-compose.yaml run --rm app install
```

After that you can run composer commands by replacing make with docker compose command. E.g.:

```bash
docker compose -f docker/docker-compose.yaml run --rm app run-solution
```

## Reports

Coverage reports are available at the following links:

- [PHPUnit Code Coverage Report (HTML)](https://lawaron.github.io/alfa-solution/reports/coverage/index.html)
- [Mutation Tests Report (HTML)](https://lawaron.github.io/alfa-solution/reports/mutation-report.html#mutant)
