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

class YmlBuilder
{
    private $data;
    private $nameSeparator;

    function __construct($data, $nameSeparator)
    {
        $this->data = $data;
        $this->nameSeparator = $nameSeparator;
    }

    function buildDocument()
    {
        $rows = array();
        foreach ($this->data as $name => $value) {

            $keys = explode($this->nameSeparator, $name);

            foreach ($keys as $index => $key) {
                $isLastKey = (count($keys) == ($index+1));
                $padding = ($index==0)?'':str_pad(' ', $index*4);
                $rows[] = sprintf('%s%s: %s', $padding, $key, ($isLastKey)?'>':'');
                if ($isLastKey) {
                    $padding = str_pad(' ', ($index+1)*4);
                    $rows[] = sprintf('%s%s', $padding, str_replace(PHP_EOL, PHP_EOL . $padding, addslashes($value)));
                }
            }
        }
        return join(PHP_EOL, $rows);
    }
}