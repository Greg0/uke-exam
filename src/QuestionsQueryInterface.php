<?php

namespace Greg0\UkeExam;

interface QuestionsQueryInterface
{
    /**
     * @return iterable<Question>
     */
    public function findAll(string $name): iterable;
}
