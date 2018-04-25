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

use Atico\SpreadsheetTranslator\Core\Exporter\ExporterConfigurationInterface;

interface YmlExporterConfigurationInterface extends ExporterConfigurationInterface
{
    public function getNameSeparator();
}