<?php
declare(strict_types=1);

namespace PsalmFormatter\Runner;


class Runner
{
    private const COMMAND = 'vendor' . DIRECTORY_SEPARATOR . 'bin' . DIRECTORY_SEPARATOR . 'psalm';

    private bool $bypass;

    /** @var array<string> $arguments */
    private array $arguments;

    /** @param array<string> $arguments */
    public function __construct(bool $bypass, array $arguments)
    {
        $this->bypass = $bypass;
        $this->arguments = $arguments;
    }

    public function run(?callable $runFunction = null): RunResult
    {
        $arguments = array_filter($this->arguments, fn($item) => strpos($item, '--output-format') !== 0);
        if (!$this->bypass) {
            $arguments[] = '--output-format=json';
        }

        $command = self::COMMAND .' '.implode(' ', $arguments);
        $exit_code = 0;
        if (is_null($runFunction)) {
            $result = system($command, $exit_code);
        } else {
            /** @var string $result */
            $result = $runFunction($command, $exit_code);
        }

        if ($result === false) {
            throw new \RuntimeException('Error while executing command: ' . $command);
        }

        return new RunResult($this->bypass, $result, $exit_code);
    }

}