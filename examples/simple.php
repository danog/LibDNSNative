<?php
use danog\LibDNSNative\NativeDecoderFactory;
use danog\LibDNSNative\NativeEncoderFactory;
use LibDNS\Messages\MessageFactory;
use LibDNS\Messages\MessageTypes;
use LibDNS\Records\QuestionFactory;
use LibDNS\Records\ResourceQTypes;

require 'vendor/autoload.php';

$question = (new QuestionFactory)->create(ResourceQTypes::DNSKEY);
$question->setName('daniil.it');

$message = (new MessageFactory)->create(MessageTypes::QUERY);
$records = $message->getQuestionRecords();
$records->add($question);

$encoder = (new NativeEncoderFactory)->create();
$question = $encoder->encode($message);

$result = \dns_get_record(...$question);

$decoder = (new NativeDecoderFactory)->create();
$result = $decoder->decode($result, ...$question);

\var_dump($result);
