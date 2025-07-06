# Maribel Hearn's Web Portal
This website provides a collection of conveninent Web pages that is primarily targetted at the Touhou gameplay community, such as the current world records, patch and tool downloads, and explanations of community jargon.
It also hosts a tool to create Touhou tier lists, as well as an English translation of the results of the annual Japanese Touhou popularity poll.

## How to run
First, clone the repository in whatever way you prefer and navigate to its directory.
```
git clone https://github.com/MaribelHearn/maribelhearn.com.git
cd maribelhearn.com
```
Use the Dockerfile provided in the repository to build a [Docker image](https://docs.docker.com/).

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
```

This assumes you are also running the [backend](https://github.com/MaribelHearn/maribelhearn_backend), which is necessary for the WR and LNN data.
The backend also comes with a Dockerfile to run it as a container.

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

## Development
Once you have cloned the repository, run the PHP development server from the directory you cloned to.
See the prerequisites listed in the previous section for required installations.
```
php -S 127.0.0.1:8000 router.php
```
Connect to `http://127.0.0.1:8000` using your browser. You can also specify a port other than 8000.
Specifying router.php is optional, but if you omit it, you cannot access the admin panel through /admin.

To update the translations after the locale files have been altered, restart the PHP development server.