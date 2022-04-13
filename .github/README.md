# Maribel Hearn's Web Portal
This website provides a collection of conveninent Web pages that is primarily targetted at the Touhou gameplay community, such as the current world records, patch and tool downloads, and explanations of community jargon.
It also hosts a tool to create Touhou tier lists, as well as an English translation of the results of the annual Japanese Touhou popularity poll.

## How to run
Prerequisites:
* PHP (version 8 or newer)
* gettext module

First, clone the repository in whatever way you prefer and navigate to its directory.
```
git clone https://github.com/MaribelHearn/maribelhearn.com.git
cd maribelhearn.com
```
Then, run the PHP development server from the directory you cloned to.
```
php -S 127.0.0.1:8000
```
You can also specify a port other than 8000.

## Troubleshooting
```
[500]: GET / - Uncaught Error: Call to undefined function bindtextdomain()
```
This error means that the PHP gettext module is not enabled. To enable it, open up your `php.ini` file and search for "gettext". You should find the following line:
```
;extension=gettext
```
Uncomment it by removing the semicolon at the front, then save the file. PHP will detect the change and run the gettext module.
