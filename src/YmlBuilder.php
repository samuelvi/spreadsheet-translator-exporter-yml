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
    function __construct(private $data, private $nameSeparator)
    {
    }

    function buildDocument(): string
    {
        // First, build a tree structure
        $tree = [];
        foreach ($this->data as $name => $value) {
            $keys = explode($this->nameSeparator, (string) $name);
            $current = &$tree;

            foreach ($keys as $index => $key) {
                $isLastKey = (count($keys) === $index + 1);

                if ($isLastKey) {
                    $current[$key] = $value;
                } else {
                    if (!isset($current[$key])) {
                        $current[$key] = [];
                    }
                    $current = &$current[$key];
                }
            }
        }

        // Then render the tree as YAML
        return $this->renderTree($tree, 0);
    }

    private function renderTree(array $tree, int|float $level): string
    {
        $rows = [];
        $padding = str_pad('', $level * 4);

        foreach ($tree as $key => $value) {
            if (is_array($value)) {
                $rows[] = sprintf('%s%s:', $padding, $key);
                $rows[] = $this->renderTree($value, $level + 1);
            } else {
                $rows[] = sprintf('%s%s: >', $padding, $key);
                $valuePadding = str_pad('', ($level + 1) * 4);
                $rows[] = sprintf('%s%s', $valuePadding, str_replace(PHP_EOL, PHP_EOL . $valuePadding, addslashes((string) $value)));
            }
        }

        return implode(PHP_EOL, $rows);
    }
}
