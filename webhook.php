<?php

$request = json_decode($_REQUEST);

echo print_r($request, true);

//$exec = shell_exec("/bin/sh ./pullcemreact.sh  > /dev/null 2>/dev/null &");
//error_log(print_r($exec, true));
//echo $exec;