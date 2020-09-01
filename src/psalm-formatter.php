<?php
declare(strict_types=1);

$options = getopt('m', ['monochrome', 'output-format', 'show-snippet']);
$config = \PsalmFormatter\Config::fromOptions($options);

$runResult = (new \PsalmFormatter\Runner\Runner(
    $config->bypass,
    array_slice($argv, 1)
))->run();

if ($runResult->bypass) {
    exit($runResult->exit_code);
}

try {
    $issues = \PsalmFormatter\IssueFactory::fromJsonOutput((string)$runResult->data);
} catch (JsonException $exception) {
    echo "Unexpected psalm output, JsonException: {$exception->getMessage()}\n\n";
    exit(1);
}

$report = new \PsalmFormatter\Report\Reporter($issues, $config);
echo $report->report();

exit($runResult->exit_code);