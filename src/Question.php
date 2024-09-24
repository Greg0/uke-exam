<?php

declare(strict_types=1);

namespace Greg0\UkeExam;


final readonly class Question
{
    public function __construct(
        public string $id,
        public string $group,
        public string $title,
        public array $availableAnswers,
        public string $correctAnswers,
        public string $hint
    )
    {
    }
}
