<?php

declare(strict_types=1);

namespace App\Endpoint\Web\Response;

abstract class ItemsListResponse implements \JsonSerializable
{
    /**
     * @var iterable|\JsonSerializable[]
     */
    protected iterable $items = [];

    public function jsonSerialize(): array
    {
        return iterator_to_array(
            $this->getIterator()
        );
    }

    protected function getIterator(): \Generator
    {
        foreach ($this->items as $item) {
            yield $item->jsonSerialize();
        }
    }

    protected function addItem(\JsonSerializable $item): void
    {
        $this->items[] = $item;
    }
}
