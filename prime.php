<?php
$startTime = microtime(true);
$ret['SERVER_ADDR']= $_SERVER['SERVER_ADDR'];
$ret['hostname']= shell_exec('hostname');

function is_prime($number)
{
    // 1 is not prime
    if ( $number == 1 ) {
        return false;
    }
    // 2 is the only even prime number
    if ( $number == 2 ) {
        return true;
    }
    // square root algorithm speeds up testing of bigger prime numbers
    $x = sqrt($number);
    $x = floor($x);
    for ( $i = 2 ; $i <= $x ; ++$i ) {
        if ( $number % $i == 0 ) {
            break;
        }
    }
 
    if( $x == $i-1 ) {
        return true;
    } else {
        return false;
    }
}

// sleep(rand(1,20));

$start = 0;
$end =   1000000;
for($i = $start; $i <= $end; $i++)
{
    if(is_prime($i))
    {
        $ret['primes'][]=$i;
    }
}

echo json_encode($ret);
$logstr="Script took: " . (microtime(true) - $startTime) . " seconds";
file_put_contents("/var/log/loadtest.log", $logstr, FILE_APPEND)