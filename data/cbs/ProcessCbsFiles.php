#!/usr/bin/env php
<?php

require_once '../../vendor/autoload.php';

use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Helper\ProgressBar;

new Dotenv()->load('../../.env');

$output = new ConsoleOutput();

$output->writeln($_ENV['DATABASE_URL']);

$files = scandir(__DIR__);

/*
 * Find all zip files from CBS
 * Download latest zip file from and put it in this directory
 * https://www.cbs.nl/nl-nl/zoeken?q="voor+postcode+huisnummer"
 */
$cbsZipFiles = [];
foreach ($files as $file) {
    if (preg_match('/^20[0-9]{2}-[a-z0-9_\-]*\.zip$/', $file)) {
        $cbsZipFiles[] = $file;
    }
}

// Find the most recent zip file base on the year as the first part of the filename
rsort($cbsZipFiles);
$cbsZipFile = $cbsZipFiles[0];

// Create a directory to extract the zip file to
$extractedDir = __DIR__ . '/extracted';
mkdir($extractedDir);

// Extract the zip file
$zip = new ZipArchive();
$zip->open(__DIR__ . '/' . $cbsZipFile);
$zip->extractTo($extractedDir);
$zip->close();

// List the CSV files in the extracted directory
$municipalitiesCsvFile = null;
$residentialAreasCsvFile = null;
$neighbourhoodsCsvFile = null;
$zipcodeAndHouseNumberFile = null;
$csvFiles = glob($extractedDir . '/*.csv');
foreach ($csvFiles as &$csvFile) {
    $csvFile = str_replace($extractedDir . '/', '', $csvFile);
    if (preg_match('/^gem.*\.csv$/', $csvFile)) {
        $municipalitiesCsvFile = $csvFile;
    }
    if (preg_match('/^wijk.*\.csv$/', $csvFile)) {
        $residentialAreasCsvFile = $csvFile;
    }
    if (preg_match('/^buurt.*\.csv$/', $csvFile)) {
        $neighbourhoodsCsvFile = $csvFile;
    }
    if (preg_match('/^pc.*\.csv$/', $csvFile)) {
        $zipcodeAndHouseNumberFile = $csvFile;
    }
}

// Process the municipalities CSV files
$output->writeln('Processing municipalities CSV files...');
$municipalitiesCsvFileHandler = fopen($extractedDir . '/' . $municipalitiesCsvFile, 'r');
$municipalitiesCsvFileLineCount = 0;
while(!feof($municipalitiesCsvFileHandler)){
    $line = fgets($municipalitiesCsvFileHandler);
    $municipalitiesCsvFileLineCount++;
}
fclose($municipalitiesCsvFileHandler);

$municipalitiesCsvFileHandler = fopen($extractedDir . '/' . $municipalitiesCsvFile, 'r');
$municipalitiesCsvFileProgressBar = new ProgressBar($output, $municipalitiesCsvFileLineCount);
$municipalitiesCsvFileProgressBar->start();
while ($row = fgetcsv($municipalitiesCsvFileHandler, 0, ';')) {
    $municipalitiesCsvFileProgressBar->advance();
}
$municipalitiesCsvFileProgressBar->finish();
$output->writeln('');
fclose($municipalitiesCsvFileHandler);

// Process the residential areas CSV files
$output->writeln('Processing residential areas CSV files...');
$residentialAreasCsvFileHandler = fopen($extractedDir . '/' . $residentialAreasCsvFile, 'r');
$residentialAreasCsvFileLineCount = 0;
while(!feof($residentialAreasCsvFileHandler)){
    $line = fgets($residentialAreasCsvFileHandler);
    $residentialAreasCsvFileLineCount++;
}
fclose($residentialAreasCsvFileHandler);

$residentialAreasCsvFileHandler = fopen($extractedDir . '/' . $residentialAreasCsvFile, 'r');
$residentialAreasCsvFileProgressBar = new ProgressBar($output, $municipalitiesCsvFileLineCount);
$residentialAreasCsvFileProgressBar->start();
while ($row = fgetcsv($residentialAreasCsvFileHandler, 0, ';')) {
    $residentialAreasCsvFileProgressBar->advance();
}
$residentialAreasCsvFileProgressBar->finish();
$output->writeln('');
fclose($residentialAreasCsvFileHandler);

// Process the neighbourhoods CSV files
$output->writeln('Processing neighbourhoods CSV files...');
$neighbourhoodsCsvFileHandler = fopen($extractedDir . '/' . $neighbourhoodsCsvFile, 'r');
$neighbourhoodsCsvFileLineCount = 0;
while(!feof($neighbourhoodsCsvFileHandler)){
    $line = fgets($neighbourhoodsCsvFileHandler);
    $neighbourhoodsCsvFileLineCount++;
}
fclose($neighbourhoodsCsvFileHandler);

$neighbourhoodsCsvFileHandler = fopen($extractedDir . '/' . $neighbourhoodsCsvFile, 'r');
$neighbourhoodsCsvFileProgressBar = new ProgressBar($output, $municipalitiesCsvFileLineCount);
$neighbourhoodsCsvFileProgressBar->start();
while ($row = fgetcsv($neighbourhoodsCsvFileHandler, 0, ';')) {
    $neighbourhoodsCsvFileProgressBar->advance();
}
$neighbourhoodsCsvFileProgressBar->finish();
$output->writeln('');
fclose($neighbourhoodsCsvFileHandler);

// Convert the CSV file to SQLite
$output->writeln('Converting zipcode and house number CSV file to SQLite DB...');
if (file_exists('cbs.db')) {
    unlink('cbs.db');
}
$db = new SQLite3('cbs.db');
$db->exec('CREATE TABLE "cbs" ("zipcodehousenumber" TEXT PRIMARY KEY, "neighbourhood" INT, "residentialarea" INT, "municipality" INT)');
$stmt = $db->prepare('INSERT INTO "cbs" ("zipcodehousenumber", "neighbourhood", "residentialarea", "municipality") VALUES (?, ?, ?, ?)');
$stmt->bindParam(1, $zipcodehousenumber);
$stmt->bindParam(2, $neighbourhood, SQLITE3_INTEGER);
$stmt->bindParam(3, $residentialArea, SQLITE3_INTEGER);
$stmt->bindParam(4, $municipality, SQLITE3_INTEGER);
$db->exec('BEGIN TRANSACTION');

$zipcodeAndHouseNumberFileHandler = fopen($extractedDir . '/' . $zipcodeAndHouseNumberFile, 'r');
$zipcodeAndHouseNumberFileLineCount = 0;
while(!feof($zipcodeAndHouseNumberFileHandler)){
    $line = fgets($zipcodeAndHouseNumberFileHandler);
    $zipcodeAndHouseNumberFileLineCount++;
}
fclose($zipcodeAndHouseNumberFileHandler);

$zipcodeAndHouseNumberFileHandler = fopen($extractedDir . '/' . $zipcodeAndHouseNumberFile, 'r');
$zipcodeAndHouseNumberFileProgressBar = new ProgressBar($output, $zipcodeAndHouseNumberFileLineCount);
$zipcodeAndHouseNumberFileProgressBar->start();
while ($row = fgetcsv($zipcodeAndHouseNumberFileHandler, 0, ';')) {
    list($zipcode, $houseNumber, $neighbourhood, $residentialArea, $municipality) = $row;
    $zipcodehousenumber = $zipcode . $houseNumber;
    $stmt->execute();
    $zipcodeAndHouseNumberFileProgressBar->advance();
}
$zipcodeAndHouseNumberFileProgressBar->finish();
$output->writeln('');
fclose($zipcodeAndHouseNumberFileHandler);

$db->exec('CREATE INDEX idx_cbs_zipcodehousenumber ON cbs("zipcodehousenumber");');
$db->exec('CREATE INDEX idx_cbs_neighbourhood ON cbs("neighbourhood");');
$db->exec('CREATE INDEX idx_cbs_residentialarea ON cbs("residentialarea");');
$db->exec('COMMIT');

delTree($extractedDir);

function delTree($dir): bool
{
    $files = array_diff(scandir($dir), array('.','..'));
    foreach ($files as $file) {
         (is_dir("$dir/$file")) ? delTree("$dir/$file") : unlink("$dir/$file");

    }
    return rmdir($dir);
}
