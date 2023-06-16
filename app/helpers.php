<?php

declare(strict_types=1);

/* format amount like this -$1500.32 */
function formatAmount(float $amount): string
{
    $isNegative = $amount < 0;
    
    return ($isNegative ? '-' : '') . '$' . number_format(abs($amount), 2);
}

/* format date like this "Jan 4, 2021"  */
function formatDate(string $date): string
{
    return date('M j,Y', strtotime($date));
}