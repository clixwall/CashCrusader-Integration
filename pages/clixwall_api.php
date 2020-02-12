<?php
/**
 * Copyright PolarWeb Ltd 2015
 *
 * Version 20150926
 */


if ($_REQUEST['pwd'] !== 'ENTER YOUR SECRET PASSWORD HERE') {
    die('Security error: invalid password');
}

require 'setup.php';

list ($banner_ads) = mysql_fetch_row(mysql_query('SELECT COUNT(*) FROM '.mysql_prefix.'rotating_ads WHERE runad > 0 AND image_url != ""'));
list ($txt_ads) = mysql_fetch_row(mysql_query('SELECT COUNT(*) FROM '.mysql_prefix.'rotating_ads WHERE runad > 0 AND text_ad != ""'));

$data = array(
    'members' => (int) activeusercount,
    'ptc' => (int) ptcads,
    'banner' => $banner_ads,
    'text' => $txt_ads,
    'paid' => (float) beenpaid_total,
    'script' => 'CashCrusader'
);

echo json_encode($data);
