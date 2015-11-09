<?php

namespace SURFnet\SslLabs\Service;

class GradeComparatorService
{
    /**
     * @param string $grade
     * @param string $passingGrade
     * @return bool
     */
    public function isHigherThan($grade, $passingGrade)
    {
        return $this->gradeToNumber($grade) >= $this->gradeToNumber($passingGrade);
    }

    /**
     * Convert a letter grade to a number for comparison.
     *
     * @param string $grade
     * @return int Number from 0 to 12
     */
    private function gradeToNumber($grade)
    {
        $letter = substr($grade, 0, 1);

        switch ($letter) {
            case 'A':
                $number = 11;
                break;

            case 'B':
                $number = 8;
                break;

            case 'C':
                $number = 5;
                break;

            case 'D':
                $number = 2;
                break;

            default:
                return 0;
        }

        if (strlen($grade) === 1) {
            return $number;
        }

        $modifier = substr($grade, 1, 2);

        if ($modifier === '-') {
            return $number - 1;
        }

        if ($modifier === '+') {
            return $number + 1;
        }

        return $number;
    }
}
