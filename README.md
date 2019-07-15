# LibDNSNative

[![Build Status](https://img.shields.io/travis/danog/libdnsnative/master.svg?style=flat-square)](https://travis-ci.org/danog/libdnsnative)
![License](https://img.shields.io/badge/license-MIT-blue.svg?style=flat-square)


Encoder/decoder for the raw format of [PHP's dns_get_record function](https://www.php.net/manual/en/function.dns-get-record.php) based on [libdns](https://github.com/DaveRandom/LibDNS/): allows usage of the function to fetch **all kinds of DNS records**, not just the ones supported by the `DNS_` constants.  

The API consists of a `NativeEncoderFactory` that creates `NativeEncoder` objects, that can encode libdns `Message` objects to a list of parameters that that must be passed to the `dns_get_record` function.

The `NativeDecoderFactory` creates `NativeDecoder` objects, that accept the results of the `dns_get_record` function and decode them back to `Message` objects.  

## Installation

```
composer require danog/libdns-native
```

## Usage

```php
<?php

require 'vendor/autoload.php';

use danog\LibDNSNative\NativeEncoderFactory;
use danog\LibDNSNative\NativeDecoderFactory;
use LibDNS\Records\QuestionFactory;
use LibDNS\Records\ResourceQTypes;
use LibDNS\Messages\MessageFactory;
use LibDNS\Messages\MessageTypes;

$question = (new QuestionFactory)->create(ResourceQTypes::DNSKEY);
$question->setName('daniil.it');

$message = (new MessageFactory)->create(MessageTypes::QUERY);
$records = $message->getQuestionRecords();
$records->add($question);

$encoder = (new NativeEncoderFactory)->create();
$question = $encoder->encode($message);

$result = dns_get_record(...$question);

$decoder = (new NativeDecoderFactory)->create();
$result = $decoder->decode($result, ...$question);
```