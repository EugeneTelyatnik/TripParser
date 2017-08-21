**Trip Parser**

Parsing different formats of trips.

For now available XML decoder and CSV encoder. So you can convert trips from XML to CSV format.


**TODO: Add validation for decoders**


**Input format:**

https://drive.google.com/file/d/0B5KcqJSuemo9eGxMU3JiTERUMWs/view?usp=sharing


**Output format:**

Title|Code|Duration|Inclusions|MinPrice

Anzac & Egypt Combo Tour|AE-19|18|The tour price cover the following services: Accommodation; 5, 4 and 3 star hotels|1427.20


**Output comments:**

- "Title" is a string, with html entities (like `&amp;`) converted back to symbols
- "Code" is a string
- "Duration" is an integer
- "Inclusions" is a string (just simple text: without html tags, double or triple spaces; with html entities converted back to symbols)
- "MinPrice" is a float with 2 digits after the decimal point; it's the minimal EUR value among all tour departures, taking into account the discount, if presented (for example, if the price is 1724 and the discount is "15%", then the departure price evaluates to 1465.40).


**Installation**

- Run `composer install`

**How to use**

- Run `php index.php` or open /index.php in browser

**Unit tests**

- Run `phpunit`

