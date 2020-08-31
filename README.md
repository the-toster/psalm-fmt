# Psalm wrapper for PhpStorm
Add links to files into issues report 

### How it works
It just run `psalm --output-format=json` and then turn into slightly modified console format, so PhpStorm can recognize issues filenames as links. 

### Limitation & TODO
- this version is not pass any additional arguments to `psalm`. Just call `psalm --output-format=json`.
- isn't suppress json output
- isn't show stats

###Installation
```shell script
composer install the-toster/psalm-fmt
```

Will create `vendor/bin/psalm-fmt`

### Usage
```shell script
psalm-fmt
```