<?php
declare(strict_types=1);

namespace Test\Runner;


use PHPUnit\Framework\TestCase;
use PsalmFormatter\Runner\Runner;

class RunnerTest extends TestCase
{
    function testBypass(): void
    {
        $bypass = true;
        $cwd = '/home/user/project';
        $args = [];

        $runner = new Runner($cwd, $bypass, $args);

        $command = '';
        $result = $runner->run(function ($cmd, &$exit_code) use (&$command){
            $command = $cmd;
            $exit_code = 100;
            return 'res';
        });

        $this->assertEquals(true, $result->bypass);
        $this->assertStringNotContainsString('--output-format=json', $command, 'Do not modify args on bypass');

    }

    function testFromBinRun(): void
    {
        $bypass = false;
        $cwd = implode(DIRECTORY_SEPARATOR, ['home', 'user', 'project', 'vendor', 'bin']);
        $args = [];

        $runner = new Runner($cwd, $bypass, $args);

        $command = '';
        $result = $runner->run(function ($cmd, &$exit_code) use (&$command){
            $command = $cmd;
            $exit_code = 100;
            return 'res';
        });

        $this->assertStringNotContainsString('vendor'.DIRECTORY_SEPARATOR.'bin', $command);
    }

    function testBasic(): void
    {
        $bypass = false;
        $cwd = '/home/user/project';
        $args = [];

        $runner = new Runner($cwd, $bypass, $args);

        $command = '';
        $result = $runner->run(function ($cmd, &$exit_code) use (&$command){
            $command = $cmd;
            $exit_code = 100;
            return 'res';
        });

        $this->assertEquals('res', $result->data);
        $this->assertEquals(false, $result->bypass);
        $this->assertEquals(100, $result->exit_code);

        $this->assertStringContainsString('vendor'.DIRECTORY_SEPARATOR.'bin', $command);
        $this->assertStringContainsString('--output-format=json', $command);
    }
}