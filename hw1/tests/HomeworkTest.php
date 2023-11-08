<?php declare(strict_types=1);
use App\Homework;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class HomeworkTest extends Testcase 
{
    public static function solveProvider(): array 
    {
        // use a big array to ensure the execution time wouldn't be too long
        // $bigArray consists of 9999998 of 0 and 2 of 9999999 at the end(since it should be sorted)
        $bigArray = array_fill(1, 9999999, 0);
        $bigArray[9999999] = $bigArray[10000000] = 9999999;

        // every sub-array in the provider array is a test case
        // sub-array: [nums array, target value, expected answer]
        return [
            [[-1,0,3,5,9,12], 9, 4],
            [[-1,0,3,5,9,12], 10, -1],
            [$bigArray, 9999999, 9999999]
        ];
    }

    #[DataProvider('solveProvider')]
    public function testSolve(array $nums, int $target, int $expected): void 
    {
        $hw = new Homework();

        // count elapsed time by recording timestamp before and after executing the method
        $start = microtime(true);
        $result =  $hw->solve($nums, $target);
        $time_elapsed_secs = microtime(true) - $start;

        // result should be same as the expected value
        $this->assertSame($expected, $result);
        // execution time should be less than 5ms
        $this->assertLessThan(0.005, $time_elapsed_secs);
    }

}