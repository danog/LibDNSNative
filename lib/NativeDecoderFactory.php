<?php
/**
 * Creates NativeDecoder objects.
 *
 * @author Daniil Gentili <https://daniil.it>, Chris Wright <https://github.com/DaveRandom>
 * @copyright Copyright (c) Chris Wright <https://github.com/DaveRandom>,
 * @license http://www.opensource.org/licenses/mit-license.html MIT License
 */

namespace danog\LibDNSNative;

use LibDNS\Decoder\DecodingContextFactory;
use \LibDNS\Messages\MessageFactory;
use \LibDNS\Packets\PacketFactory;
use \LibDNS\Records\QuestionFactory;
use \LibDNS\Records\RDataBuilder;
use \LibDNS\Records\RDataFactory;
use \LibDNS\Records\RecordCollectionFactory;
use \LibDNS\Records\ResourceBuilder;
use \LibDNS\Records\ResourceFactory;
use \LibDNS\Records\TypeDefinitions\FieldDefinitionFactory;
use \LibDNS\Records\TypeDefinitions\TypeDefinitionFactory;
use \LibDNS\Records\TypeDefinitions\TypeDefinitionManager;
use \LibDNS\Records\Types\TypeBuilder;
use \LibDNS\Records\Types\TypeFactory;
use LibDNS\Decoder\DecoderFactory;
use LibDNS\Encoder\EncodingContextFactory;

/**
 * Creates NativeDecoder objects.
 *
 * @author Daniil Gentili <https://daniil.it>, Chris Wright <https://github.com/DaveRandom>
 */
class NativeDecoderFactory
{
    /**
     * Create a new NativeDecoder object.
     *
     * @param \LibDNS\Records\TypeDefinitions\TypeDefinitionManager $typeDefinitionManager
     * @return NativeDecoder
     */
    public function create(TypeDefinitionManager $typeDefinitionManager = null): NativeDecoder
    {
        $typeBuilder = new TypeBuilder(new TypeFactory);

        return new NativeDecoder(
            new PacketFactory,
            new MessageFactory(new RecordCollectionFactory),
            new QuestionFactory,
            $typeBuilder,
            new EncodingContextFactory,
            new DecoderFactory
        );
    }
}
