# Client Api for send message Text|Viber


[![Latest Stable Version](https://poser.pugx.org/ignatenkovnikita/yii2-digitaldirect-ivr/v/stable)](https://packagist.org/packages/sevenfloor/api-i-digital) [![Total Downloads](https://poser.pugx.org/sevenfloor/api-i-digital/downloads)](https://packagist.org/packages/sevenfloor/api-i-digital) [![Latest Unstable Version](https://poser.pugx.org/sevenfloor/api-i-digital/v/unstable)](https://packagist.org/packages/sevenfloor/api-i-digital) [![License](https://poser.pugx.org/sevenfloor/api-i-digital/license)](https://packagist.org/packages/sevenfloor/api-i-digital)

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
composer require sevenfloor/api-i-digital:dev-master
```

or add

```
"sevenfloor/api-i-digital": "dev-master"
```

to the require section of your `composer.json` file.

Usage
-----

Add this to your main configuration's components array:

```php

'sms' => function () {
    $component = new \sevenfloor\apiidigital\Client('base_uri');
    $component->node_id = 'node_id';
    $component->password = 'password';
    return $component;
},
```
Typical component usage
-----------------------
```php
$sms = \Yii::$app->smsnew;

$body = new \sevenfloor\apiidigital\Body(\sevenfloor\apiidigital\Body::TYPE_TEXT, 'test');

// send message
var_dump($sms->message($body, 'source_name', 'desctination'));
// receive status
var_dump($sms->receive());
```