<?php

namespace Tests\Feature;

use App\Formatter\FormatField;
use App\OpendataImporter;
use Tests\TestCase;

class TranslatesDataToFormatTest extends TestCase
{

    /**
     * @test
     */
    public function it_can_translate_a_format_including_interpolation()
    {
        $data = [
            [
                'one' => 'first',
                'two' => 'second',
                'matching' => 'same',
                'matched_interpolated' => 'eggs'
            ]
        ];

        $formatFields = [
            new FormatField("{one} {two}", "interpolated"),
            new FormatField("matching", "matching"),
            new FormatField("{matched_interpolated}", "matched_interpolated"),
            new FormatField("", "null_1"),
            new FormatField(null, "null_2"),
        ];

        $expected = [
            [
                'interpolated' => 'first second',
                'matching' => 'same',
                'matched_interpolated' => 'eggs',
                "null_1" => null,
                "null_2" => null,
            ]
        ];

        $this->assertEquals($expected, OpendataImporter::translateRecordFormat($data, $formatFields));
    }

}
