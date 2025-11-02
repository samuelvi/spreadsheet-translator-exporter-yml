<?php

declare(strict_types=1);

namespace Atico\SpreadsheetTranslator\Exporter\Yml\Tests;

use Atico\SpreadsheetTranslator\Exporter\Yml\YmlBuilder;
use PHPUnit\Framework\TestCase;

class YmlBuilderTest extends TestCase
{
    public function testBuildDocument(): void
    {
        $data = [
            'foo.bar' => 'baz',
            'foo.qux' => 'quux',
            'hello' => 'world',
        ];

        $builder = new YmlBuilder($data, '.');
        $expected = <<<'EOT'
foo:
    bar: >
        baz
    qux: >
        quux
hello: >
    world
EOT;
        $this->assertSame($expected, $builder->buildDocument());
    }
}
