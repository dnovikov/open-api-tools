<?php

namespace Dnovikov\OpenApiTools\Services;

use cebe\openapi\spec\OpenApi;
use cebe\openapi\Writer;


class SortOpenApi
{
    private string $inputFilename;

    private string $outputFilename;


    public function setInputFilename(string $inputFilename): self
    {
        $this->inputFilename = realpath($inputFilename);

        return $this;
    }

    public function setOutputFilename(string $outputFilename): self
    {
        $this->outputFilename = $outputFilename;

        return $this;
    }

    public function convert(): void
    {
        $json = json_decode(file_get_contents($this->inputFilename), true);

        uksort($json['paths'], function ($a, $b) {
            $a = str_replace(['-'], '~', $a);
            $b = str_replace(['-'], '~', $b);

            return strcmp($a, $b);
        });

        uasort($json['tags'], function ($a, $b) {
            $a['name'] = str_replace(['-'], '~', $a['name']);
            $b['name'] = str_replace(['-'], '~', $b['name']);

            return strcmp($a['name'], $b['name']);
        });

        ksort($json['components']['schemas'], SORT_STRING);

        $openapi = new OpenApi($json);

        $json = Writer::writeToJson($openapi);

        file_put_contents($this->outputFilename, $json);
    }
}
