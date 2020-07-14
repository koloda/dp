# Command dp, version 0.1

Search file duplicates

### Usage: dp [OPTIONS...] [ARGUMENTS...]

### Arguments:
  `<dir>`    Directory for search

### Options:
  - [-h | --help]         Show help
  - [-r | --recursive]    Search duplicates recursively (in all subdirectories)
  - [-V | --version]      Show version

----------------

## Building app

```bash
composer install
```

To run app:

```bash
php src/app.php <dir> [-o output.txt] [-r]
```

## Build as phar

You should install box phar compiler using following command

```bash
composer bin box require --dev humbug/box
```

And compile app

 ```bash
 vendor/bin/box compile
 ```

 After that you can run app using **bin/dp** or copy **dp** executable to any location (**/usr/local/bin** for example)

## Build as dotnet-executable

At first you shoul install dotnet-core runtime from this page

 - https://dotnet.microsoft.com/download

After installing .net core install PeachPie templates for .net

```bash
dotnet new -i Peachpie.Templates::*
```

Done!

Now you can run app using .net runtime:

```bash
 dotnet run
```

Or build app for your platform

```bash
dotnet build --runtime <you-platform>
```

Main platforms:

 - osx-x64
 - win-x64
 - linux-x64

More info about runtimes you can find here: https://docs.microsoft.com/ru-ru/dotnet/core/rid-catalog

# Future plans

 - [ ] Add pissibility to remove duplicates
