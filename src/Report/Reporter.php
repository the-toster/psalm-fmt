<?php
declare(strict_types=1);

namespace PsalmFormatter\Report;


use Psalm\Internal\Analyzer\IssueData;
use PsalmFormatter\Config;

class Reporter
{
    /** @var IssueData[] */
    private array $issues;
    private Config $config;

    /** @param IssueData[] $issues */
    public function __construct(array $issues, Config $config)
    {
        $this->issues = $issues;
        $this->config = $config;
    }

    public function report(): string
    {
        $data = '';
        $data .= (new \PsalmFormatter\Report\ConsoleReport(!$this->config->monochrome, $this->config->showSnippet))->create($this->issues);

        $issuesNumber = count($this->issues);
        $data .= (new \PsalmFormatter\Report\SummaryReport($this->config->monochrome))->create($issuesNumber);

        return $data;
    }

}