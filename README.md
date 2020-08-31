[![Build Status](https://img.shields.io/travis/the-toster/psalm-fmt.svg?style=flat-square)](https://travis-ci.org/the-toster/psalm-fmt)
![Psalm coverage](https://shepherd.dev/github/the-toster/psalm-fmt/coverage.svg)

# Psalm wrapper for PhpStorm
Add links to files into issues report 

### How it works
It just runs `psalm --output-format=json` and then turn into slightly modified console format, so PhpStorm can recognize issues filenames as links. 
It also passes additional arguments, so you can use it as `vendor/bin/psalm-fmt file.php`.

### Features
- respects `-m` or `--monochrome` flag
- respects `--show-snippet[=true]`
- bypass output if given `--output-format` is not `console` 

### Limitation & TODO
- isn't suppress json output
- isn't show stats and other details given by console format

### Installation
```shell script
composer install the-toster/psalm-fmt
```
Will create `vendor/bin/psalm-fmt`

### Usage
```shell script
vendor/bin/psalm-fmt
```