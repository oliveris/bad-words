<?php

include "../vendor/autoload.php";

use BadWords\BadWords;

$test_string = 'Lorem ipsum dolor sit amet, ei fugit velit latine vel. Nominavi shit consequuntur id has, an splendide reprimique sit. Erat dignissim eum no, duo an magna quidam suscipit, vix vidit slag congue reprimique cu. Per id magna recusabo, sea ea ridens constituam, dictas accusamus repudiare cum id. Cu magna causae placerat has, aperiam feugait at per.';

// example that returns a bool value if a bad word is found
if (BadWords::checkForBadWords($test_string)) {
    echo 'Bad words have been found in the string.';
}

echo '<br><hr><br>';

// example that returns an array of the bad words that are found in a string
echo 'Return an array of the bad words found in the string.';
echo '<pre>';
print_r(BadWords::getBadWords($test_string));
echo '</pre>';