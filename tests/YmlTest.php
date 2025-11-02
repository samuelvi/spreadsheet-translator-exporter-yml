<?php

declare(strict_types=1);

namespace Atico\SpreadsheetTranslator\Exporter\Yml\Tests;

use Atico\SpreadsheetTranslator\Core\Configuration\Configuration;
use Atico\SpreadsheetTranslator\Exporter\Yml\Yml;
use PHPUnit\Framework\TestCase;

class YmlTest extends TestCase
{
    public function testGetFormat(): void
    {
        $config = [
            'spreadsheet_translator' => [
                'exporter' => [
                    'destination_folder' => '/tmp',
                    'domain' => 'messages',
                ],
            ],
        ];
        $configuration = new Configuration($config, 'exporter');
        $ymlExporter = new Yml($configuration);
        $this->assertSame('yml', $ymlExporter->getFormat());
    }
}
