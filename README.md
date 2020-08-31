# Psalm wrapper for PhpStorm
Add links to files into issues report 

### How it works
It just run `psalm --output-format=json` and then turn into slightly modified console format, so PhpStorm can recognize issues filenames as links. 

###Installation
```shell script
composer install the-toster/psalm-fmt
```

Will create `vendor/bin/psalm-fmt`

### Usage
```shell script
psalm-fmt
```