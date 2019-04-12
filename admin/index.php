<?php

require ('xcrud/xcrud.php');
include_once("xcrud/functions.php");
require ('html/pagedata.php');
islogin();
$page = (isset($_GET['page']) && isset($pagedata[$_GET['page']])) ? $_GET['page'] : 'default';
extract($pagedata[$page]);
$file = dirname(__file__) . '/pages/' . $filename;
$code = file_get_contents($file);
include ('html/template.php');
