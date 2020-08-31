<?php
declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

$vendorBin = 'vendor'.DIRECTORY_SEPARATOR.'bin';

if (strpos(getcwd(), $vendorBin) !== false) {
    $command = 'psalm --output-format=json';
} else {
    $command = $vendorBin.DIRECTORY_SEPARATOR.'psalm --output-format=json';
}

$output = system($command);

$issues = ConsoleLinkWrapper\IssueFactory::fromJsonOutput($output);
echo (new \ConsoleLinkWrapper\ConsoleReport())->create($issues);