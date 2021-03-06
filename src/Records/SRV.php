<?php

namespace Spatie\Dns\Records;

/**
 * @method int pri()
 * @method int weight()
 * @method string target()
 * @method int port()
 */
class SRV extends Record
{
    protected int $pri;
    protected int $weight;
    protected string $target;
    protected int $port;

    public static function parse(string $line): self
    {
        $attributes = static::lineToArray($line, 8);

        return static::make([
            'host' => $attributes[0],
            'ttl' => $attributes[1],
            'class' => $attributes[2],
            'type' => $attributes[3],
            'pri' => $attributes[4],
            'weight' => $attributes[5],
            'port' => $attributes[6],
            'target' => $attributes[7],
        ]);
    }

    public function __toString(): string
    {
        return sprintf(
            "%s.\t\t%d\t%s\t%s\t%d\t%d\t%d\t%s.",
            $this->host,
            $this->ttl,
            $this->class,
            $this->type,
            $this->pri,
            $this->weight,
            $this->port,
            $this->target
        );
    }

    protected function castPri($value): int
    {
        return $this->prepareInt($value);
    }

    protected function castWeight($value): int
    {
        return $this->prepareInt($value);
    }

    protected function castPort($value): int
    {
        return $this->prepareInt($value);
    }

    protected function castTarget(string $value): string
    {
        return $this->prepareDomain($value);
    }
}
