<?php

namespace danog\LibDNSNative\Test;

use danog\LibDNSNative\NativeDecoder;
use danog\LibDNSNative\NativeDecoderFactory;
use PHPUnit\Framework\TestCase;

class NativeDecoderFactoryTest extends TestCase
{
    public function testNativeDecoderFactoryWorks()
    {
        $this->assertInstanceOf(NativeDecoder::class, (new NativeDecoderFactory)->create());
    }
}
