# Command dp, version 0.1

Search file duplicates

### Usage: dp [OPTIONS...] [ARGUMENTS...]

### Arguments:
  ```<dir>```    Directory for search

### Options:
  - [-h|--help]         Show help
  - [-r|--recursive]    Search duplicates recursively (in all subdirectories)
  - [-V|--version]      Show version




----------------

## Building app

 > composer install

To run app:
 > php src/app.php ```<dir>``` [-o output.txt] [-r]


## Build as phar

You should install box phar compiler using following command

 > composer bin box require --dev humbug/box

And compile app

 > vendor/bin/box compile

 After that you can run app using **bin/dp** or copy **dp** executable to any location (**/usr/local/bin** for example)

## Build as dotnet-executable

At first you shoul install dotnet-core runtime from this page

 - https://dotnet.microsoft.com/download

After installing .net core install PeachPie templates for .net

 > dotnet new -i Peachpie.Templates::*

Done!

Now you can run app using .net runtime:
 > dotnet run

Or build app for your platform
 > dotnet build --runtime ```<you-platform>```

Main platforms:
 - osx-x64
 - win-x64
 - linux-x64

More info about runtimes you can find here: https://docs.microsoft.com/ru-ru/dotnet/core/rid-catalog
