<?php

/*
 * This file is part of the Atico/SpreadsheetTranslator package.
 *
 * (c) Samuel Vicent <samuelvicent@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Atico\SpreadsheetTranslator\Exporter\Yml;

use Atico\SpreadsheetTranslator\Core\Exporter\ExportContentInterface;
use Atico\SpreadsheetTranslator\Core\Exporter\ExporterInterface;
use Atico\SpreadsheetTranslator\Core\Exporter\AbstractExporter;

class Yml extends AbstractExporter implements ExporterInterface
{
    function __construct($configuration)
    {
        $this->configuration = new YmlExporterConfigurationManager($configuration);
    }

    public function getFormat()
    {
        return 'yml';
    }

    protected function buildContent(ExportContentInterface $exportContent)
    {
        $xliffBuilder = new YmlBuilder(
            $exportContent->getTranslations(),
            $this->configuration->getNameSeparator()
        );
        return $xliffBuilder->buildDocument();
    }
}