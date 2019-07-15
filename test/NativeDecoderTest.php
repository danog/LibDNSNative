<?php

namespace danog\LibDNSNative\Test;

use danog\LibDNSNative\NativeDecoderFactory;
use LibDNS\Messages\Message;
use LibDNS\Messages\MessageTypes;
use LibDNS\Records\ResourceQTypes;
use PHPUnit\Framework\TestCase;

class NativeDecoderTest extends TestCase
{
    /**
     * Test decoding of valid Native DNS payloads.
     *
     * @param string $message
     * @param int $requestId
     * @return void
     *
     * @dataProvider provideValidNativePayloads
     */
    public function testDecodesValidNativePayloads(array $result, string $name, int $type, array $auth = null, array $additional = null)
    {
        $decoder = (new NativeDecoderFactory)->create();
        $response = $decoder->decode($result, $name, $type, $auth, $additional);

        $this->assertInstanceOf(Message::class, $response);
        $this->assertEquals(MessageTypes::RESPONSE, $response->getType());
    }

    public function provideValidNativePayloads()
    {
        return [
            [
                [
                    [
                        'host' => 'daniil.it',
                        'class' => 'IN',
                        'ttl' => 3600,
                        'type' => 48,
                        'data' => \base64_decode('AQADDaCTEREs+ROIGM0v6ulw671NajD2CIwlsyWjmrvFzRGXqgmCg+Wq9CEXfCql1xSZKplX0bzBj5jNcfHxgGtl4Ug='),
                    ],

                    [
                        'host' => 'daniil.it',
                        'class' => 'IN',
                        'ttl' => 3600,
                        'type' => 48,
                        'data' => \base64_decode('AQEDDZnbLMFMq9wz1td9pjovFfcRElhPI06NHcQo456KSpfhqicaVV3JBwHhfipMS28SC3wy1E9KwCvYlM8tS+d3ihk='),
                    ],
                ],
                'daniil.it',
                ResourceQTypes::DNSKEY,
                [
                ],
                null,
            ],

            [

                [

                    [
                        'host' => 'apple.com',
                        'class' => 'IN',
                        'ttl' => 2898,
                        'type' => 1,
                        'data' => \base64_decode('EazgLw=='),
                    ],

                    [
                        'host' => 'apple.com',
                        'class' => 'IN',
                        'ttl' => 2898,
                        'type' => 1,
                        'data' => \base64_decode('EY6gOw=='),
                    ],

                    [
                        'host' => 'apple.com',
                        'class' => 'IN',
                        'ttl' => 2898,
                        'type' => 1,
                        'data' => \base64_decode('EbJgOw=='),
                    ],
                ],
                'apple.com',
                ResourceQTypes::A,
                [
                ],
                null,
            ],

            [

                [

                    [
                        'host' => 'amphp.org',
                        'class' => 'IN',
                        'ttl' => 166,
                        'type' => 1,
                        'data' => \base64_decode('aBgUIg=='),
                    ],

                    [
                        'host' => 'amphp.org',
                        'class' => 'IN',
                        'ttl' => 166,
                        'type' => 1,
                        'data' => \base64_decode('aBgVIg=='),
                    ],
                ],
                'amphp.org',
                ResourceQTypes::A,

                [
                ],
                null,
            ],

            [
                [
                    [
                        'host' => 'tssthacks.daniil.it',
                        'class' => 'IN',
                        'ttl' => 282,
                        'type' => 5,
                        'data' => \base64_decode('A2docwxnb29nbGVob3N0ZWQDY29tAA=='),
                    ],
                ],
                'tssthacks.daniil.it',
                ResourceQTypes::CNAME,
                null,
                null,
            ],
            [
                [
                    [
                        'host' => 'daniil.it',
                        'class' => 'IN',
                        'ttl' => 289,
                        'type' => 15,
                        'data' => \base64_decode('AAoCbXgGeWFuZGV4A25ldAA='),
                    ],
                ],
                'daniil.it',
                ResourceQTypes::MX,
                [
                ],
                null,
            ],
        ];
    }
}
