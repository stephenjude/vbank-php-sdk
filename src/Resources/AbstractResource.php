<?php

namespace VBank\SDK\Resources;

use VBank\SDK\VBank;

#[\AllowDynamicProperties]
abstract class AbstractResource
{
    /**
     * Create a new resource instance.
     */
    public function __construct(public array $attributes, protected ?VBank $vbank = null)
    {
        $this->fill();
    }

    /**
     * Fill the resource with the array of attributes.
     */
    protected function fill(): void
    {
        foreach ($this->attributes as $key => $value) {
            $key = $this->camelCase($key);

            $this->{$key} = $value;
        }
    }

    /**
     * Convert the key name to camel case.
     */
    protected function camelCase(string $key): string
    {
        $parts = explode('_', $key);

        foreach ($parts as $i => $part) {
            if ($i !== 0) {
                $parts[$i] = ucfirst($part);
            }
        }

        return str_replace(' ', '', implode(' ', $parts));
    }

    /**
     * Transform the items of the collection to the given class.
     */
    protected function transformCollection(array $collection, string $class, array $extraData = []): array
    {
        return array_map(function ($data) use ($class, $extraData) {
            return new $class($data + $extraData, $this->vbank);
        }, $collection);
    }

    /**
     * Transform the collection of tags to a string.
     */
    protected function transformTags(array $tags, ?string $separator = null): string
    {
        $separator = $separator ?: ', ';

        return implode($separator, array_column($tags ?? [], 'name'));
    }
}
