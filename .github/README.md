# Maribel Hearn's Web Portal

This website provides a collection of conveninent Web pages that is primarily targetted at the Touhou gameplay community, such as the current world records, patch and tool downloads, and explanations of community jargon.
It also hosts a tool to create Touhou tier lists, as well as an English translation of the results of the annual Japanese Touhou popularity poll.

## How to run

Prerequisites:
* PHP (version 8 or newer)

Required PHP modules:
* curl
* gettext
* mbstring
* sqlite3

First, clone the repository in whatever way you prefer and navigate to its directory.
```
git clone https://github.com/MaribelHearn/maribelhearn.com.git
cd maribelhearn.com
```
Then, run the PHP development server from the directory you cloned to.
```
php -S 127.0.0.1:8000
```
Connect to `http://127.0.0.1:8000` using your browser. You can also specify a port other than 8000.
If you want, you can use a Web server such as [Apache](https://apache.org/) or [Nginx](https://nginx.org/) to host the site.
