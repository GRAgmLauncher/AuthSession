<?php
require_once('Bootstrap.php');

$Loader = $I->create('\Framework\Loader');

$Users = $Loader->find('\Models\Blog\Blog', 'id', array(4,2,3,1));

?>