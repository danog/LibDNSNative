<?php

namespace danog\LibDNSNative\Test;

use danog\LibDNSNative\NativeEncoder;
use danog\LibDNSNative\NativeEncoderFactory;
use PHPUnit\Framework\TestCase;

class NativeEncoderFactoryTest extends TestCase
{
    public function testNativeEncoderFactoryWorks()
    {
        $this->assertInstanceOf(NativeEncoder::class, (new NativeEncoderFactory)->create());
    }
}
