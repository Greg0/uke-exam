<?php

declare(strict_types=1);

namespace Greg0\UkeExam;


use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

final readonly class CacheableQuestionsQuery implements QuestionsQueryInterface
{

    public function __construct(
        private QuestionsQueryInterface $parentQuery,
        private CacheInterface $cache
    )
    {
    }

    public function findAll(string $name): iterable
    {
        return $this->cache->get('questions-'.$name, function (ItemInterface $item) use ($name) {
            $item->expiresAfter(600);

            return iterator_to_array($this->parentQuery->findAll($name));
        });
    }
}
