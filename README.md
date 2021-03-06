# Bad Words 
Filters through text and cleans the input of bad words found.

### Usage
<p>Pull in the composer package by running the command below:</p>

```
composer require oliveris/bad-words
```

<p>Import the BadWords namespace into the class (autoloading)</p>

```
use BadWords\BadWords;
```

## Examples

### Checking if there are bad words in a string
<p>Below is an example that returns a bool value if a bad word was detected within the given string.</p>

```
BadWords::checkForBadWords($test_string)
```

### Checking if there are bad words found within a string
<p>Below is an example that returns an array value of bad words was detected within the given string.</p>

```
BadWords::getBadWords($test_string)
```

### Replacing any bad words found within a string
<p>Below is an example that returns a clean string, it replaces any bad words found within a string with random words that the user has set.</p>

```
BadWords::setReplacementWords([
    'hello',
    'world',
    'tree',
    'desk',
    'computer'
]);

BadWords::replaceBadWords($test_string);
```

### Replacing any bad words found within a string with a mask of characters
<p>Below is an example that returns a clean string, it replaces any bad words found with a mask the same length as the bad words.</p>

```
BadWords::maskBadWords($test_string)
```

### Unmasking the masked words
<p>Below is an example that returns the string in its original unmasked form.</p>

```
BadWords::unMaskBadWords($masked_string);
```

### Set the filter words (will replace the preset)

```
BadWords::setFilterWords([
    'moody',
    'fat',
    'cunt'
]);
```

### Add to the array of filter words

```
BadWords::addToFilterWords([
    'bollocks',
    'shit',
    'slag'
]);
```

### License

BadWords is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).