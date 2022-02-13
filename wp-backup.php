<?php
require_once 'public_html/wp-config.php';


$filename = sprintf( 'wp-backups/%s-backup_%s.sql.gz', DB_NAME, date( 'Y-m-d_H-i-s') );
$cmd = sprintf( 'mysqldump -h %s -u %s -p%s --no-tablespaces %s | gzip > %s', DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, $filename );
@exec($cmd, $output, $result);
