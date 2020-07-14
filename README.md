# Command dp, version 0.1

Search file duplicates and provide functionality to delete them

### Usage: dp [OPTIONS...] [ARGUMENTS...]

### Arguments:
  dir    Directory for search

### Options:
  - [-h|--help]         Show help
  - [-r|--recursive]    Search duplicates recursively (in all subdirectories)
  - [-V|--version]      Show version


To run app:
 - php src/app.php

----------------

#Building app

 - composer install
 - composer bin box require --dev humbug/box
 - vendor/bin/box compile

 After that you can run app using bin/dp or copy dp executable to any location (/esr/local/bin for example)
