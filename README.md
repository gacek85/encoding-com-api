Encoding.com API Driver
---

Simple **PHP** wrapper for dealing with **[Encoding.com API](http://api.encoding.com/)**.

###Available requests:

- `AddMedia` - Add new media to user's queue. Creates new items in a queue according to formats specified in the XML/JSON API request.

- `GetMediaInfo` - Returns video parameters of the specified media when available.

- `GetMediaInfoEx` - Returns extended video parameters of the specified media when available.


###Available formats:

- **XML** - use `Gacek85\EncodingCom\Formatter\JsonFormatter` class

- **JSON** - use `Gacek85\EncodingCom\Formatter\XMLFormatter` class


###Usage

``` php
<?php

use Gacek85\EncodingCom\Encoding;
use Gacek85\EncodingCom\Request\CurlRequestCall;
use Gacek85\EncodingCom\Result\XMLParser;
use Gacek85\EncodingCom\Formatter\XMLFormatter;
use Gacek85\EncodingCom\Request\AddMedia;

$requestCall = new CurlRequestCall();
$parser = new XMLParser(); // Use Gacek85\EncodingCom\Result\JsonParser for JSON calls
$formatter = new XMLFormatter(); // Use Gacek85\EncodingCom\Formatter\JsonFormatter for JSON calls
$encoding = new Encoding(
	$encoding_user_id,
	$encoding_secret,
	$requestCall,
	$parser
);

/* @var $result \Gacek85\EncodingCom\Result\ResultInterface */
$result = $encoding
		->reset()
        ->request(new AddMedia([
        	// AddMedia request parameters see http://api.encoding.com/#ActionList
        ]))
        ->getResult();

if ($result->isValid()) {
	$response = $result->getResponse();
} else {
	$errorsArray = $result->getErrors();
}
```
