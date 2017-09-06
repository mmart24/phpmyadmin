<?php
/* vim: set expandtab sw=4 ts=4 sts=4: */
/**
 * Database import page
 *
 * @package PhpMyAdmin
 */

use PhpMyAdmin\Response;
use PhpMyAdmin\Config\PageSettings;

require_once 'libraries/common.inc.php';

PageSettings::showGroup('Import');

$response = Response::getInstance();
$header   = $response->getHeader();
$scripts  = $header->getScripts();
$scripts->addFile('import.js');

/**
 * Gets tables information and displays top links
 */
require 'libraries/db_common.inc.php';

list(
    $tables,
    $num_tables,
    $total_num_tables,
    $sub_part,
    $is_show_stats,
    $db_is_system_schema,
    $tooltip_truename,
    $tooltip_aliasname,
    $pos
) = PhpMyAdmin\Util::getDbInfo($db, isset($sub_part) ? $sub_part : '');

require 'libraries/display_import.lib.php';
$response = Response::getInstance();
$response->addHTML(
    PMA_getImportDisplay(
        'database', $db, $table, $max_upload_size
    )
);
