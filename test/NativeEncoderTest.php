<?php

namespace danog\LibDNSNative\Test;

use danog\LibDNSNative\NativeDecoderFactory;
use danog\LibDNSNative\NativeEncoderFactory;
use LibDNS\Messages\MessageTypes;
use PHPUnit\Framework\TestCase;
use LibDNS\Records\ResourceQTypes;

class NativeEncoderTest extends TestCase
{
    /**
     * Test encoding of valid DNS message payloads.
     *
     * @param string $message
     * @return void
     *
     * @dataProvider provideValidNativePayloads
     */
    public function testEncodesValidNativePayloads(string $name, int $type)
    {
        $decoder = (new NativeDecoderFactory)->create();
        $response = $decoder->decode([], $name, $type, [], [], [], 0);
        $response->setType(MessageTypes::QUERY);

        $encoder = (new NativeEncoderFactory)->create();
        $request = $encoder->encode($response);

        $this->assertInternalType('array', $request, "Got a ".\gettype($request)." instead of an array");
        $this->assertCount(5, $request);
        $this->assertInternalType('string', $request[0], "Got a ".\gettype($request[0])." instead of a string");
        $this->assertInternalType('int', $request[1], "Got a ".\gettype($request[1])." instead of an int");
        $this->assertEquals($name, $request[0]);
        $this->assertEquals($type, $request[1]);
        $this->assertEquals($request[1], $response->getQuestionRecords()->getRecordByIndex(0)->getType());
        $this->assertEquals($request[0], \implode('.', $response->getQuestionRecords()->getRecordByIndex(0)->getName()->getLabels()));
    }

    public function provideValidNativePayloads()
    {
        return [
            ['apple.com', ResourceQTypes::A],
            ['amphp.org', ResourceQTypes::A],
            ['tssthacks.daniil.it', ResourceQTypes::CNAME],
            ['daniil.it', ResourceQTypes::MX],
            ['daniil.it', ResourceQTypes::DNSKEY],
        ];
    }
}
