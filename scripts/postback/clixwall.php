<?php
/**
 * Copyright PolarWeb Ltd 2015
 *
 * Version 20150923
 */

$secret_password = 'ENTER YOUR SECRET PASSWORD HERE';
$credit_upline = false;
$transaction_description = 'Clixwall earnings';

//------------------------------
// CashCrusader framework
//------------------------------
chdir('..');
require 'functions.inc.php';

global $commissions_accounting_table;

//------------------------------
// Security
//------------------------------
if ($_REQUEST['pwd'] !== $secret_password) {
    die('Security error: invalid password');
}

//------------------------------
// Interpret postback input
//------------------------------
$username = preg_replace("([^a-zA-Z0-9])", "", $_REQUEST['u']);

if (! is_numeric($_REQUEST['c'])) {
    die('Security error: invalid credit amount');
}

$amount = $_REQUEST['c'] * 100000;
$type = ($_REQUEST['t'] == 1 ? 'cash' : 'points');

// A chargeback?
if ($_REQUEST['s'] == 2) {
    $amount *= -1;
}

if ($type == 'cash') {
    $amount *= admin_cash_factor;
}

//------------------------------
// Update reward into the database
//------------------------------
$amount = number_format($amount, 0, '', ''); // Circumvent PHP5 bug http://bugs.php.net/bug.php?id=43053

if ($credit_upline) {
    creditulclicks($username, $amount, $type);
}

$sql = sprintf('UPDATE `%s` SET amount=amount%+d WHERE type="%s" AND username="%s" AND description="%s" LIMIT 1',
            $commissions_accounting_table,
            $amount,
            $type,
            $username,
            mysql_real_escape_string($transaction_description)
        );


@mysql_query($sql);

if (mysql_affected_rows() > 0) {
    die('Done');
}

//------------------------------
// The clixwall transaction does not exist, create a new transaction
//------------------------------
$sql = sprintf('INSERT INTO `%s` SET transid="%s", username = "%s", unixtime=0, description="%s", amount=%+d, type="%s"',
    $commissions_accounting_table,
    maketransid($username),
    $username,
    mysql_real_escape_string($transaction_description),
    $amount,
    $type
);
@mysql_query($sql);

echo 'Done';
