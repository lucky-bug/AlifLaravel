<?php

namespace App\Http\Services;

class AlifService
{
    /**
     * @var FileIOService
     */
    private $fileIOService;

    public function __construct(
        FileIOService $fileIOService
    ) {
        $this->fileIOService = $fileIOService;
    }

    public function solve(string $filename, string $operand): array
    {
        $data = explode("\n", $this->fileIOService->readFromFile($filename));
        $positiveResults = [];
        $negativeResults = [];

        foreach ($data as $row) {
            $values = explode(' ', $row);

            if (count($values) === 2) {
                switch ($operand) {
                    case "addition":
                        $result = (double)$values[0] + (double)$values[1];
                        break;
                    case "subtraction":
                        $result = (double)$values[0] - (double)$values[1];
                        break;
                    case "multiplication":
                        $result = (double)$values[0] * (double)$values[1];
                        break;
                    case "division":
                        $result = (double)$values[0] / (double)$values[1];
                        break;
                    default:
                        echo "Wrong operation selected!" . PHP_EOL;
                        exit();
                }

                if ($result >= 0) {
                    $positiveResults[] = $result;
                } else {
                    $negativeResults[] = $result;
                }
            }
        }

        return [
            'positive' => $positiveResults,
            'negative' => $negativeResults,
        ];
    }
}
