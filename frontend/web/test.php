<?php

$result='';
//$string='+380979671748';
$string='380979671748';
//$pattern='/^\+[0-9]{2}[\(]{*}[0-9]{3}[\) ]{*}[0-9]{3}[-]{*}[0-9]{2}[-]{*}[0-9]{2}$/';
$pattern='/^[\+]*[0-9]{2}[\(]*[0-9]{3}[\)]*[ ]*[0-9]{3}[-]*[0-9]{2}[-]*[0-9]{2}$/';

preg_match_all($pattern,$string,$result);
var_dump($result);