<?php
declare(strict_types=1);

namespace Test\Runner;


use PHPUnit\Framework\TestCase;
use PsalmFormatter\Runner\Runner;

class RunnerTest extends TestCase
{
    public function testBypass(): void
    {
        $bypass = true;
        $args = [];

        $runner = new Runner($bypass, $args);

        $command = '';
        $result = $runner->run(function ($cmd, &$exit_code) use (&$command){
            $command = $cmd;
            $exit_code = 100;
            return 'res';
        });

        $this->assertEquals(true, $result->bypass);
        $this->assertStringNotContainsString('--output-format=json', $command, 'Do not modify args on bypass');

    }

    public function testBasic(): void
    {
        $bypass = false;
        $args = [];

        $runner = new Runner($bypass, $args);

        $command = '';
        $result = $runner->run(function ($cmd, &$exit_code) use (&$command){
            $command = $cmd;
            $exit_code = 100;
            return 'res';
        });

        $this->assertEquals('res', $result->data);
        $this->assertEquals(false, $result->bypass);
        $this->assertEquals(100, $result->exit_code);

        $this->assertStringContainsString('vendor'.DIRECTORY_SEPARATOR.'bin'.DIRECTORY_SEPARATOR.'psalm', $command);
        $this->assertStringContainsString('--output-format=json', $command);
    }

    public function testArgumentPassing(): void
    {
        $bypass = false;
        $args = ['--shepherd', '--long-progress'];

        $runner = new Runner($bypass, $args);

        $command = '';
        $result = $runner->run(function ($cmd, &$exit_code) use (&$command){
            $command = $cmd;
            $exit_code = 100;
            return 'res';
        });

        $this->assertEquals('res', $result->data);
        $this->assertEquals(false, $result->bypass);
        $this->assertEquals(100, $result->exit_code);

        $this->assertStringContainsString('--shepherd', $command);
        $this->assertStringContainsString('--long-progress', $command);
    }
}