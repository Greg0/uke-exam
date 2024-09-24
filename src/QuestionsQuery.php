<?php

declare(strict_types=1);

namespace Greg0\UkeExam;


use OpenSpout\Reader\XLSX\Reader;

final readonly class QuestionsQuery implements QuestionsQueryInterface
{
    private Reader $reader;

    public function __construct(
        private string $fileName
    )
    {
        $this->reader = new Reader();
    }

    /**
     * @return iterable<Question>
     */
    public function findAll(string $name): iterable
    {
        $this->reader->open($this->fileName);

        $group = '';
        foreach ($this->reader->getSheetIterator() as $sheet) {
            if ($sheet->getName() === $name) {
                foreach ($sheet->getRowIterator() as $rowIndex => $row) {
                    if ($rowIndex === 1) {
                        continue;
                    }

                    if (empty($row->getCellAtIndex(2)?->getValue())) {
                        $group = $row->getCellAtIndex(1)?->getValue();
                        continue;
                    }

                    yield new Question(
                        $row->getCellAtIndex(0)?->getValue(),
                        $group,
                        $row->getCellAtIndex(1)?->getValue(),
                        array_combine(
                            range('a', 'c'),
                            [
                                $row->getCellAtIndex(2)?->getValue(),
                                $row->getCellAtIndex(3)?->getValue(),
                                $row->getCellAtIndex(4)?->getValue(),
                            ]
                        ),
                        $row->getCellAtIndex(5)?->getValue(),
                        $row->getCellAtIndex(6)?->getValue()
                    );
                }
            }
        }
    }
}
