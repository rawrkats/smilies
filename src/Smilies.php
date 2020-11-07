<?php

namespace Rawrkats\Smilies;

use Rawrkats\Smilies\Parser\SmiliesParser;

final class Smilies
{
    private $SmiliesParser;
    const CASE_SENSITIVE = 0;

    public function __construct()
    {
        $patterns = \App\Models\Smilies::all();
        $this->SmiliesParser = new SmiliesParser($patterns);
    }

    public function only($only = null)
    {
        $this->SmiliesParser->only($only);
        return $this;
    }

    public function except($except = null)
    {
        $this->SmiliesParser->except($except);
        return $this;
    }

    public function convertToSmilie(string $text, $caseSensitive = null): string
    {
        return $this->SmiliesParser->parse($text, $caseSensitive);
    }

    public function addParser(string $name, string $pattern, string $replace, string $content)
    {
        $this->SmiliesParser->addParser($name, $pattern, $replace, $content);
        return $this;
    }
}
