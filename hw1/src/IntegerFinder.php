<?php declare(strict_types=1);

namespace App;

class IntegerFinder 
{
    public function findIntegerInArray(array $nums, int $target): int 
    {
        // since nums is sorted, if the target is out of range, return -1 immediately
        // I did not use reset() or end() since it moves the pointer, resulting in longer execution
        if ($target < $nums[array_key_first($nums)] || $target >  $nums[array_key_last($nums)]) {
            return -1;
        }
        // Use binary search since nums is sorted
        $left = 0;
        $right = count($nums) - 1;

        while ($left <= $right) {
            $mid = (int)floor(($left + $right) / 2);

            if ($nums[$mid] === $target) {
                // first element is target
                if ($mid === 0) {
                    return $mid;
                }
                // if the element before $mid is also target, keep moving $mid leftward to find the first one
                if ($nums[$mid - 1] !== $target) {
                    return $mid;
                } else {
                    $right = $mid;
                }
            }
            elseif ($nums[$mid] < $target) {
                $left = $mid + 1;
            } else {
                $right = $mid - 1;
            }
        }
        return -1;
    }
}
