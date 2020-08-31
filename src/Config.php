<?php
declare(strict_types=1);

namespace PsalmFormatter;


class Config
{
    public bool $bypass;
    public bool $showSnippet;
    public bool $monochrome;

    public function __construct(bool $bypass, bool $showSnippet, bool $monochrome)
    {
        $this->bypass = $bypass;
        $this->showSnippet = $showSnippet;
        $this->monochrome = $monochrome;
    }

    public static function fromOptions(array $options): Config
    {
        $monochrome = isset($options['m']) || isset($options['monochrome']);
        $bypass = ($options['output-format'] ?? 'console') !== 'console';

        $showSnippet = true;
        if(isset($options['show-snippet']) && $options['show-snippet'] !== false && $options['show-snippet'] !== 'true') {
            $showSnippet = false;
        }

        return new Config($bypass, $showSnippet, $monochrome);
    }
}