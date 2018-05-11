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
    public static $characters = [
        'a' => '.',
        'b' => '!',
        'c' => '@',
        'd' => '£',
        'e' => '#',
        'f' => '$',
        'g' => '%',
        'h' => '^',
        'i' => '&',
        'j' => '*',
        'k' => '(',
        'l' => ')',
        'm' => '-',
        'n' => '_',
        'o' => '=',
        'p' => '+',
        'q' => '[',
        'r' => '{',
        's' => '}',
        't' => ']',
        'u' => ':',
        'v' => ';',
        'w' => '?',
        'x' => '|',
        'y' => '<',
        'z' => '>'
    ];

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
     * Method maskBadWords()
     * ---------------------------------
     *
     * This method will replace any bad words found within an array with a masked word of the same string length
     *
     * @param $string
     * @return mixed
     */
    public static function maskBadWords($string)
    {
        $bad_words = self::getBadWords($string);

        foreach ($bad_words as $word) {
            $masked_word = self::makeWordMask($word);
            $string = str_replace($word, $masked_word, $string);
        }

        return $string;
    }

    /**
     * Method makeWordMask()
     * ---------------------------------
     *
     * This method will replace the word passed with random characters from the array
     *
     * @param $word
     * @return string
     */
    public static function makeWordMask($word)
    {
        $str_len = strlen($word);
        $x = 1;
        $mask = '';

        while ($x <= $str_len) {
            $n = array_rand(self::$characters);
            $mask = $mask . self::$characters[$n];
            $x++;
        }

        return $mask;
    }

    public static function unMaskBadWords($string)
    {
        $words = explode(' ', $string);

        $new_string = [];
        foreach ($words as $word) {
            $letters = str_split($word);

            $new_string[] = !array_diff_key(array_flip($letters), self::$characters) ? self::unMaskWord($word) : $word;
            print_r($new_string);
            exit;
        }

        return implode($new_string);
    }

    public static function unMaskWord($word)
    {
        $letters = str_split($word);

        $new_word = [];
        foreach ($letters as $letter) {
            $new_word[] = array_search($letter, self::$characters);
        }

        return $new_word;
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
        $clean_string = str_replace(self::$characters, '', strtolower($string));
        return explode(' ', $clean_string);
    }
}