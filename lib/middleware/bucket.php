<?php
namespace php_require\hoobr_bucket_tester;

$req = $require("php-http/request");
$res = $require("php-http/response");
$uuid = $require("php-uuid");

/*
    Grab the tracker or set a new one.
*/

$tracker = $req->cookie("hoobrt");

if (!$tracker) {
    $tracker = $uuid->generate(4, 101);
    $res->cookie("hoobrt", $tracker);
}

/*
    Grab the bucket or set a new one.
*/

$bucket = $req->cookie("hoobrb");

if (!$bucket) {
    $bucket = (int)round(crc32($tracker), 0);
    $res->cookie("hoobrb", $bucket);
}

$req->cfg("site/bucket", null);

// $set = 10;
// $a = 0;
// $b = 0;

// for ($i = 0; $i < $set; $i++) {
//     $t = $uuid->generate(4, 101);
//     $t > 0 ? $a++ : $b++;
// }

// var_dump($a, $b);

// var_dump($bucketId);

// class Base_Hasher_Consistent
// {
//     protected $_nodes;

//     public function __construct($nodes=NULL)
//     {
//         $this->_nodes = array();

//         $node_count = count($nodes);
//         $hashes_per_node = (int)(PHP_INT_MAX / $node_count);

//         $old_hash_count = 0;

//         foreach($nodes as $node){
//             if(!($node == $nodes[$node_count-1])){
//                 $this->_nodes[] = array(
//                     'name' => $node,
//                     'begin' => $old_hash_count,
//                     'end' => $old_hash_count + $hashes_per_node - 1
//                 );

//                 $old_hash_count += $hashes_per_node;
//             }else{
//                 $this->_nodes[] = array(
//                     'name' => $node,
//                     'begin' => $old_hash_count,
//                     'end' => PHP_INT_MAX
//                 );
//             }
//         }
//     }

//     public function hashToNode($data_key,$count=0)
//     {
//         $hash_code = (int)abs(crc32($data_key));

//         foreach($this->_nodes as $node){
//             if($hash_code >= $node['begin']){
//                 if($hash_code <= $node['end']){
//                     return($node['name']);
//                 }
//             }
//         }
//     }
// }