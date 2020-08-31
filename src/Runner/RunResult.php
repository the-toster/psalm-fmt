<?php
declare(strict_types=1);

namespace PsalmFormatter\Runner;


class RunResult
{
    public bool $bypass;
    public ?string $data;
    public int $exit_code;

    public function __construct(bool $bypass, ?string $data, int $exit_code)
    {
        $this->bypass = $bypass;
        $this->data = $data;
        $this->exit_code = $exit_code;
    }

}