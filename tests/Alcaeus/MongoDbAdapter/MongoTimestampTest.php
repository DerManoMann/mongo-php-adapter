<?php

namespace Alcaeus\MongoDbAdapter\Tests;

/**
 * @author alcaeus <alcaeus@alcaeus.org>
 */
class MongoTimestampTest extends TestCase
{
    public function testCreate()
    {
        $timestamp = new \MongoTimestamp(1234567890, 987654321);
        $this->assertAttributeSame(1234567890, 'sec', $timestamp);
        $this->assertAttributeSame(987654321, 'inc', $timestamp);

        $this->assertSame('1234567890', (string) $timestamp);

        $bsonTimestamp = $timestamp->toBSONType();
        $this->assertInstanceOf('MongoDB\BSON\Timestamp', $bsonTimestamp);
        $this->assertSame('[1234567890:987654321]', (string) $bsonTimestamp);
    }

    public function testCreateWithGlobalInc()
    {
        $timestamp1 = new \MongoTimestamp(1234567890);
        $timestamp2 = new \MongoTimestamp(1234567890);

        $this->assertAttributeSame(0, 'inc', $timestamp1);
        $this->assertAttributeSame(1, 'inc', $timestamp2);
    }

    public function testCreateWithBsonTimestamp()
    {
        $bsonTimestamp = new \MongoDB\BSON\Timestamp(1234567890, 987654321);
        $timestamp = new \MongoTimestamp($bsonTimestamp);

        $this->assertAttributeSame(1234567890, 'sec', $timestamp);
        $this->assertAttributeSame(987654321, 'inc', $timestamp);
    }
}
