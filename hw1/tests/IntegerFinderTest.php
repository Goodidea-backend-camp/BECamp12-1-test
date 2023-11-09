<?php declare(strict_types=1);
use App\IntegerFinder;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class IntegerFinderTest extends Testcase 
{
    public static function findProvider(): array 
    {
        // use a big array [0, 1, ... , 10000000] as an edge case to ensure the execution time wouldn't be too long
        $bigArray = range(0, 10000000);

        // every sub-array in the provider array is a test case
        // sub-array: [nums array, target value, expected answer]
        return [
            'found' => [[-1,0,3,5,9,12], 9, 4],
            'not found' => [[-1,0,3,5,9,12], 10, -1],
            'target smaller than first element' => [[-1,0,3,5,9,12], -2, -1],
            'target bigger than last element' => [[-1,0,3,5,9,12], 13, -1],
            'repeating target' => [[1, 5, 5, 5, 5], 5, 1],
            'all same target' => [[5, 5, 5, 5, 5], 5, 0],
            'big array' => [$bigArray, 9999999, 9999999]    
        ];
    }

    #[DataProvider('findProvider')]
    public function testFindIntegerInArray(array $nums, int $target, int $expected): void 
    {
        $finder = new IntegerFinder();

        // count elapsed time by recording timestamp before and after executing the method
        $start = microtime(true);
        $result =  $finder->findIntegerInArray($nums, $target);
        $timeElapsed = microtime(true) - $start;

        // result should be same as the expected value
        $this->assertSame($expected, $result);
        // execution time should be less than 5ms
        $this->assertLessThan(0.005, $timeElapsed);
    }

}