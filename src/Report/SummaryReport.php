<?php
declare(strict_types=1);

namespace PsalmFormatter\Report;


class SummaryReport
{
    private bool $monochrome;

    public function __construct(bool $monochrome)
    {
        $this->monochrome = $monochrome;
    }

    public function create(int $issuesNumber): string
    {
        if($this->monochrome) {
            $data = $this->planeText($issuesNumber);
        } else {
            $data = $this->colorText($issuesNumber);
        }
        return $this->template($data);
    }

    private function template(string $data): string
    {
        return "\n------------------------------\n"
            . $data
            . "\n------------------------------\n\n";
    }

    private function planeText(int $issuesNumber): string
    {
        if($issuesNumber > 0) {
            return "$issuesNumber errors found";
        } else {
            return "No errors found";
        }
    }

    private function colorText(int $issuesNumber): string
    {
        if($issuesNumber > 0) {
            return "\e[0;31m$issuesNumber\e[0m errors found";
        } else {
            return "\e[0;32mNo errors found\e[0m";
        }
    }
}