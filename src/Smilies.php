<?php

namespace Rawrkats\Smilies;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Rawrkats\Smilies\Parser\SmiliesParser;

final class Smilies
{
    protected $patterns;
    private $SmiliesParser;
    const CASE_SENSITIVE = 0;

    public function __construct()
    {
        $this->patterns = DB::table('smilies')->get();
        $this->SmiliesParser = new SmiliesParser($this->patterns);
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

    public function smilielist() {
        $smilies = $this->patterns;
        $html = ['<div id="smilielist">'];
        foreach ($smilies as $s) {
            $html[] = '<span title="'.$s->title.'"><img data-pattern="'.$s->smilietext.'" src="'. asset($s->smiliepath).'" alt="'.$s->title.'"></span>';
        }
        $html[] = '</div>';
        return implode("\r\n",$html);
    }
}