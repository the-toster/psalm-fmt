<?php
declare(strict_types=1);

require_once 'vendor/autoload.php';
$command = 'vendor\bin\psalm --output-format=json';
$output = system($command);

$issues = ConsoleLinkWrapper\IssueFactory::fromJsonOutput($output);
echo (new \ConsoleLinkWrapper\ConsoleReport())->create($issues);