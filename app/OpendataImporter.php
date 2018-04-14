<?php

namespace App;

use App\Formatter\FormatField;

class OpendataImporter
{

    public static function translateRecordFormat($opendata, $format) : array
    {
        $results = [];

        foreach ($opendata as $record) {
            $formatted_record = [];

            foreach ($format as $formatter) {
                /** @var FormatField $formatter */
                $formatted_record = array_merge($formatted_record, $formatter->format($record));
            }

            $results[] = $formatted_record;
        }

        return $results;
    }

}
