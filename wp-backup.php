<?php

$wpdir = '.';
$backupdir = 'wp-backups';

$wpconfigfile = implode(DIRECTORY_SEPARATOR, [$wpdir, 'wp-config.php']);

if (!file_exists($wpconfigfile)) {
    die(sprintf('Cannot find Wordpress config file "%s"', $wpconfigfile));
}
require_once $wpconfigfile;

if (!file_exists($backupdir)) {
    if (!mkdir($backupdir)) {
        die(sprintf('Cannot create backup directory "%s"', $backupdir));
    }
}

$filename = sprintf('%s/%s-backup_%s.sql.gz', $backupdir, DB_NAME, date('Y-m-d_H-i-s'));
$cmd = sprintf('mysqldump -h %s -u %s -p%s --no-tablespaces %s | gzip > %s', DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, $filename);
exec($cmd, $output, $result);

exit;
