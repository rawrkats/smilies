<?php

namespace Rawrkats\Smilies\Parser;

final class SmiliesParser extends Parser
{
    protected $parsers = [];

    public function __construct($patterns) {
        $parser_array = [];
        foreach($patterns as $pattern) {
            $parser_array[$pattern->title] = [
                'pattern' => "/$pattern->smilietext/",
                'replace' => $pattern->smiliepath
            ];
        }
        $this->parsers = $parser_array;
    }


    public function parse(string $source, $caseInsensitive = null): string
    {
        $caseInsensitive = $caseInsensitive === self::CASE_INSENSITIVE ? true : false;

        foreach ($this->parsers as $name => $parser) {
            $pattern = ($caseInsensitive) ? $parser['pattern'] . 'i' : $parser['pattern'];

            $source = $this->searchAndReplace($pattern, $parser['replace'], $source);
        }

        return $source;
    }
}
