<?php

namespace Dnovikov\OpenApiTools;

use Dnovikov\OpenApiTools\Services\SortOpenApi;


class App
{
    public static function run(): int
    {
        $converter = new SortOpenApi();

        $converter
            ->setInputFilename('input.json')
            ->setOutputFilename('output.json')
            ->convert();

        return 0;
    }
}
