<?php

$f = fopen('cbs.csv', 'r');
$db = new SQLite3('cbs.db');
$db->exec('CREATE TABLE "cbs" ("zipcodehousenumber" TEXT PRIMARY KEY, "neighbourhood" INT, "residentialarea" INT, "municipality" INT)');
$stmt = $db->prepare('INSERT INTO "cbs" ("zipcodehousenumber", "neighbourhood", "residentialarea", "municipality") VALUES (?, ?, ?, ?)');
$stmt->bindParam(1, $zipcodehousenumber, SQLITE3_TEXT);
$stmt->bindParam(2, $neighbourhood, SQLITE3_INTEGER);
$stmt->bindParam(3, $residentialarea, SQLITE3_INTEGER);
$stmt->bindParam(4, $municipality, SQLITE3_INTEGER);
$db->exec('BEGIN TRANSACTION');
while ($row = fgetcsv($f, 0, ';')) {
    list($zipcode, $housenumber, $neighbourhood, $residentialarea, $municipality) = $row;
    $zipcodehousenumber = $zipcode . $housenumber;
    $stmt->execute();
}
$db->exec('CREATE INDEX idx_cbs_zipcodehousenumber ON cbs("zipcodehousenumber");');
$db->exec('CREATE INDEX idx_cbs_neighbourhood ON cbs("neighbourhood");');
$db->exec('CREATE INDEX idx_cbs_residentialarea ON cbs("residentialarea");');
$db->exec('COMMIT');