<?php
declare(strict_types=1);

namespace Test;


use PHPUnit\Framework\TestCase;
use PsalmFormatter\Config;

class ConfigTest extends TestCase
{
    public function testFromEmptyOptions()
    {
        $config = Config::fromOptions([]);

        $this->assertEquals(false, $config->bypass, 'Bypass is off when options empty');
        $this->assertEquals(false, $config->monochrome, 'Monochrone is off when options empty');
        $this->assertEquals(true, $config->showSnippet, 'ShowSnippet is on when options empty');
    }
}