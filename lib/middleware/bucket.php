<?php
namespace php_require\hoobr_bucket_tester;

$req = $require("php-http/request");
$res = $require("php-http/response");
$uuid = $require("php-uuid");

$tracker = $req->cookie("hoobrt");

if (!$tracker) {
    $tracker = $uuid->generate(4, 101);
    $res->cookie("hoobrt", $tracker);
}

/*
    Dirty bucket algo.
*/

$bucketId = round(crc32($tracker) / 100000000);

// var_dump($bucketId);
