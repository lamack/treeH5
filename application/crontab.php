<?php
use think\Db;

$tree = db('trees')->find();
echo 'true';exit;
echo json_encode($tree);
