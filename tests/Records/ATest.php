<?php

namespace Spatie\Dns\Test\Records;

use PHPUnit\Framework\TestCase;
use Spatie\Dns\Records\A;

class ATest extends TestCase
{
    /** @test */
    public function it_can_parse_string(): void
    {
        $record = A::parse('spatie.be.              900     IN      A       138.197.187.74');

        static::assertSame('spatie.be', $record->host());
        static::assertSame(900, $record->ttl());
        static::assertSame('IN', $record->class());
        static::assertSame('A', $record->type());
        static::assertSame('138.197.187.74', $record->ip());
    }

    /** @test */
    public function it_can_make_from_array(): void
    {
        $record = A::make([
            'host' => 'spatie.be',
            'class' => 'IN',
            'ttl' => 900,
            'type' => 'A',
            'ip' => '138.197.187.74',
        ]);

        static::assertSame('spatie.be', $record->host());
        static::assertSame(900, $record->ttl());
        static::assertSame('IN', $record->class());
        static::assertSame('A', $record->type());
        static::assertSame('138.197.187.74', $record->ip());
    }

    /** @test */
    public function it_can_transform_to_string(): void
    {
        $record = A::parse('spatie.be.              900     IN      A       138.197.187.74');

        static::assertSame("spatie.be.\t\t900\tIN\tA\t138.197.187.74", strval($record));
    }
}
