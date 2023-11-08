<?php declare(strict_types=1);

namespace App;

class Homework 
{
    public function solve(array $nums, int $target): int 
    {
        // Use binary search since nums is sorted
        $left = 0;
        $right = count($nums) - 1;

        while ($left <= $right) {
            $mid = (int)floor(($left + $right) / 2);
            if ($nums[$mid] === $target) {
                return $mid;
            }
            if ($nums[$mid] < $target) {
                $left = $mid + 1;
            } else {
                $right = $mid - 1;
            }
        }
        return -1;
    }
}
