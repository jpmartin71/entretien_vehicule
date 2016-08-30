<?php

include_once './model/traitement_operation.php';

$listes_operations=get_operations();
/*foreach ($listes_operations as $operation) 
{
	echo "$operation: ";print_r($operation);echo "<br>";
}
echo "$listes_operations: ";print_r($listes_operations);echo "<br>";*/

include_once './view/traitement_operation.php';