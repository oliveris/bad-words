<?php

namespace BadWords;

class BadWords
{
    /**
     * List of the bad words to filter against
     * @var array
     */
    public static $filter_list = [
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
     * This empty array can be set using the setReplacementWords() method
     * @var array
     */
    public static $replacement_words = [];

    /**
     * List characters to remove from the string
     * @var array
     */
    public static $bad_characters = ['.','!','@','£','#','$','%','^','&','*','(',')','-','_','=','+','[','{','}',']',':',';','""',"'",'|',',','>','<','.','?'];

    /**
     * Method checkString()
     * ---------------------------------
     *
     * Detects bad words from string
     *
     * @param $string
     * @return bool
     */
    public static function checkForBadWords($string)
    {
        $found_badwords = [];
        foreach (self::cleanStringToArray($string) as $word) {
            in_array($word, self::$filter_list) ? array_push($found_badwords, $word) : '';
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
    public static function getBadWords($string)
    {
        $found_badwords = [];
        foreach (self::cleanStringToArray($string) as $word) {
            in_array($word, self::$filter_list) ? array_push($found_badwords, $word) : '';
        }
        return $found_badwords;
    }

    /**
     * Method setReplacementWords()
     * ---------------------------------
     *
     * This method expects an array of words that will be used to replace any bad words that are found in an array
     *
     * @param array $replacement_words
     */
    public static function setReplacementWords(array $replacement_words)
    {
        self::$replacement_words = $replacement_words;
    }

    /**
     * Method replaceBadWords()
     * ---------------------------------
     *
     * Will replace any of the bad words found in a string with set replacement words
     *
     * @param $string
     * @return mixed
     */
    public static function replaceBadWords($string)
    {
        $bad_words = self::getBadWords($string);

        foreach ($bad_words as $word) {
            $n = array_rand(self::$replacement_words);
            $string = str_replace($word, self::$replacement_words[$n], $string);
        }

        return $string;
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
    private static function cleanStringToArray($string)
    {
        $clean_string = str_replace(self::$bad_characters, '', strtolower($string));
        return explode(' ', $clean_string);
    }
}