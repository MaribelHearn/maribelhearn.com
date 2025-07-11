# Maribel Hearn's Web Portal
This website provides a collection of conveninent Web pages that is primarily targetted at the Touhou gameplay community, such as the current world records, patch and tool downloads, and explanations of community jargon.
It also hosts a tool to create Touhou tier lists, as well as an English translation of the results of the annual Japanese Touhou popularity poll.

## How to run
First, clone the repository in whatever way you prefer and navigate to its directory.
```
git clone https://github.com/MaribelHearn/maribelhearn.com.git
cd maribelhearn.com
```
Use the Dockerfile provided in the repository to build a [Docker image](https://docs.docker.com/). This website uses PHP-FPM, so a separate container should be run for that as well.

In the repository's parent directory, you may use a Docker Compose file:
```YAML
maribelhearn:
  image: maribelhearn
  container_name: maribelhearn
  restart: 'unless-stopped'
  volumes:
    - ./maribelhearn.com:/var/www/maribelhearn.com
    - ./mh_backend/static:/var/www/maribelhearn.com/static:ro
    - ./mh_backend/media:/var/www/maribelhearn.com/media:ro
  ports:
    - <your_port_here>:80
  env_file:
    - ./maribelhearn.com/.env.prod
php:
  image: bitnami/php-fpm
  ports:
    - 9000:9000
  volumes:
    - ./maribelhearn.com:/var/www/maribelhearn.com
```

This assumes you are also running the [backend](https://github.com/MaribelHearn/maribelhearn_backend), which is necessary for the WR and LNN data.
The backend also comes with a Dockerfile to run it as a container.

Copy the environment file from `.env.template` and name it for example `.env.dev` or `.env.prod`.
In it, you should specify the address PHP-FPM is run at (usually your device's local IP address).

In the PHP-FPM container, enable the `gettext` module. Install the `locales` package and enable every locale listed in the `locale` directory in this repository, such as `en_GB.UTF-8 UTF-8`.

## Running without Docker
Prerequisites:
* PHP (version 8 or newer)

Required PHP modules:
* curl
* gettext
* mbstring
* sqlite3

Use a Web server such as [Apache](https://apache.org/) or [Nginx](https://nginx.org/) to host the site.
Apache is assumed, for the purpose of the Docker image.

The `apache.conf` file contains the Apache virtual host used for the site. It assumes it is running behind a reverse proxy.
If you are not using a reverse proxy, remove the `LogFormat` line from `apache.conf` and replace `custom` with `common` for the `CustomLog`.

For translations to work, you need to enable every locale listed in the `locale` directory in this repository, such as `en_GB.UTF-8 UTF-8`.

## Development
Once you have cloned the repository, run the PHP development server from the directory you cloned to.
See the prerequisites listed in the previous section for required installations.
```
php -S 127.0.0.1:8000 router.php
```
Connect to `http://127.0.0.1:8000` using your browser. You can also specify a port other than 8000.
Specifying router.php is optional, but if you omit it, you cannot access the admin panel through /admin.

To update the translations after the locale files have been altered, restart the PHP development server.