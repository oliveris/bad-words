<?php

namespace BadWords;

class BadWords
{
    /**
     * List of the bad words to filter against
     * @var array
     */
    public $filter_list = [
        1 => "fuck",
        2 => "fucker",
        3 => "fucking",
        4 => "shit",
        5 => "shitter",
        6 => "shitting",
        7 => "crap",
        8 => "crappy",
        9 => "crapper",
        10 => "bastard",
        11 => "bitch",
        12 => "bitchy",
        13 => "bitchier",
        14 => "fart",
        15 => "arse",
        16 => "slag",
        17 => "slut",
        18 => "nigger",
        21 => "shithead",
        22 => "wanker"
    ];

    /**
     * List characters to remove from the string
     * @var array
     */
    public $bad_characters = ['.','!','@','£','#','$','%','^','&','*','(',')','-','_','=','+','[','{','}',']',':',';','""',"'",'|',',','>','<','.','?'];

    /**
     * Method checkString()
     * ---------------------------------
     *
     * Detects bad words from string
     *
     * @param $string
     * @return bool
     */
    public function checkForBadWords($string)
    {
        $found_badwords = [];
        foreach ($this->cleanStringToArray($string) as $word) {
            in_array($word, $this->filter_list) ? array_push($found_badwords, $word) : '';
        }
        return empty($found_badwords) ? false : true;
    }

    /**
     * Method getBadWords()
     * ---------------------------------
     *
     * Will process a string and return any bad words found
     *
     * @param $string
     * @return array
     */
    public function getBadWords($string)
    {
        $found_badwords = [];
        foreach ($this->cleanStringToArray($string) as $word) {
            in_array($word, $this->filter_list) ? array_push($found_badwords, $word) : '';
        }
        return $found_badwords;
    }

    /**
     * cleanStringToArray()
     * ---------------------------------
     *
     * Cleans source
     *
     * @param $string
     * @return array
     */
    private function cleanStringToArray($string)
    {
        $clean_string = str_replace($this->bad_characters, '', strtolower($string));
        return explode(' ', $clean_string);
    }
}