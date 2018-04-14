<?php

namespace App\Formatter;

class FormatField
{

    private $format;
    private $output_key;

    public function __construct($format, $output_key)
    {
        $this->format = $format;
        $this->output_key = $output_key;
    }

    public function requiresInterpolation()
    {
        return str_contains($this->format, '{');
    }

    public function isNull()
    {
        return (empty($this->format));
    }

    public function format($data)
    {
        if ($this->isNull()) {
            return [ $this->output_key => null ];
        }

        if ($this->requiresInterpolation()) {
            preg_match_all('/(?<={)[0-9a-zA-Z\'"#,\-\/_ .@]+(?=})/', $this->format, $matches);
            $parsed = preg_replace('/{[0-9a-zA-Z\'"#,\-\/_ .@]+}/', '%s', $this->format);

            $results = collect($matches[0])->map(function ($match) use ($data) {
                return $data[$match];
            })->all();

            return [ $this->output_key => sprintf($parsed, ...$results) ];
        }

        return [ $this->output_key => $data[$this->format] ];
    }

}
