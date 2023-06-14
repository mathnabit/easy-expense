<?php

declare(strict_types=1);

/* Logic Code */

/* scan and return transaction files from directory */
function getTransactionFiles(string $dirPath):array 
{
    $files = [];

    foreach (scandir($dirPath) as $file) {
        if (is_dir($file)) {
            continue;
        }
        $files[] = $dirPath.$file;
    }

    return $files;
}

/* read each file and extract transactions from it */
function getTransaction(string $fileName):array
{
    // verify existence of file
    if (! file_exists($fileName)) {
        trigger_error("File $fileName doesn't exist", E_USER_ERROR);
    }

    $file = fopen($fileName, 'r');
    // read the first line (to discard it) that it's a header, not a transaction
    fgetcsv($file);

    $transactions = [];
    // read line by line from the file with fgetcsv function
    while (($transaction = fgetcsv($file)) !== false) {
        $transactions[] = formatTransaction($transaction);
    }

    return $transactions;
}

/* Format transaction amount */
function formatTransaction(array $transactionRow): array
{
    [$date, $checkNumber, $description, $amount] = $transactionRow;

    $amount = (float) str_replace(['$',','], '', $amount);   
    
    return [
        'date' => $date,
        'checkNumber' => $checkNumber,
        'description' => $description,
        'amount' => $amount
    ];
}
