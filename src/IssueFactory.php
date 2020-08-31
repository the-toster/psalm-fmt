<?php
declare(strict_types=1);

namespace PsalmFormatter;


use Psalm\Internal\Analyzer\IssueData;

class IssueFactory
{
    /**
     * @param string $json
     * @return IssueData[]
     */
    public static function fromJsonOutput(string $json): array
    {
        /** @var array<\stdClass> $data */
        $data = json_decode($json, false, 512, JSON_THROW_ON_ERROR);
        $issues = [];
        foreach ($data as $i) {
            $issues[] = self::fromStdClass($i);
        }
        return $issues;
    }

    public static function fromStdClass(\stdClass $i): IssueData
    {
        return new \Psalm\Internal\Analyzer\IssueData(
            $i->severity,
            $i->line_from,
            $i->line_to,
            $i->type,
            $i->message,
            $i->file_name,
            $i->file_path,
            $i->snippet,
            $i->selected_text,
            $i->from,
            $i->to,
            $i->snippet_from,
            $i->snippet_to,
            $i->column_from,
            $i->column_to,
            $i->shortcode,
            $i->error_level,
            $i->taint_trace
        );
    }
}