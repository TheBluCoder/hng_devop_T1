<?php
header('Content-Type: application/json');

const BAD_REQUEST_CODE = 400;
const MIN_PRIME = 2; // Minimum number that can be prime
const PERFECT_NUMBER_MIN = 1; // Perfect numbers must be positive

$num = $_GET['number'] ?? null;

if (isset($num) && is_numeric($num)) {
    $num = (int) $num;

    $response = [
        'number' => $num,
        'is_prime' => isPrime($num),
        'is_perfect' => isPerfect($num),
        'properties' => getProperties($num),
        'digit_sum' => digitSum($num),
        'fun_fact' => getFunFact($num),
    ];

    echo json_encode($response);
} else {
    http_response_code(BAD_REQUEST_CODE);
    echo json_encode(['number' => $num, "error" => true]);
}

/**
 * Check if a number is prime.
 */
function isPrime(int $num): bool
{
    if ($num < MIN_PRIME) return false;
    if ($num % 2 === 0) return $num === MIN_PRIME; // 2 is the only even prime number

    $sqrtNum = (int) sqrt(abs($num)); // Use absolute value for negative numbers
    for ($i = 3; $i <= $sqrtNum; $i += 2) { // Skip even numbers
        if ($num % $i === 0) return false;
    }
    return true;
}

/**
 * Check if a number is a perfect number.
 */
function isPerfect(int $num): bool
{
    if ($num < PERFECT_NUMBER_MIN) return false;

    $sum = 1;
    $sqrtNum = (int) sqrt($num);

    for ($i = 2; $i <= $sqrtNum; $i++) {
        if ($num % $i === 0) {
            $sum += $i;
            $pairDivisor = $num / $i;
            if ($i !== $pairDivisor) { // Avoid adding square roots twice
                $sum += $pairDivisor;
            }
        }
    }
    return $sum === $num;
}

/**
 * Compute the sum of digits of a number.
 */
function digitSum(int $num): int
{
    $sum = 0;
    $num = abs($num); // Ignore sign

    while ($num > 0) {
        $sum += $num % 10;
        $num = intdiv($num, 10);
    }

    return $sum;
}

/**
 * Get properties of a number: parity (odd/even) and whether it's an Armstrong number.
 */
function getProperties(int $num): array
{
    $parity = ($num % 2 === 0) ? "even" : "odd";

    // Check if the number is an Armstrong number
    $absoluteNum = abs($num);
    $length = strlen((string) $absoluteNum);
    $sum = 0;
    $temp = $absoluteNum;

    while ($temp > 0) {
        $digit = $temp % 10;
        $sum += pow($digit, $length);
        $temp = intdiv($temp, 10);
    }

    $armstrong = ($sum === $absoluteNum) ? "armstrong" : null;

    return $armstrong ? [$armstrong, $parity] : [$parity];
}

/**
 * Fetch a fun fact about a number from the Numbers API.
 */
function getFunFact(int $num): string
{
    $apiUrl = "http://numbersapi.com/{$num}/math";
    $response = file_get_contents($apiUrl);

    if ($response === false) {
        return "No fact available";
    }

    return $response;

}
