<?php

$a = 1;

// True because $a is empty
if (empty($a)) {
    echo "Variable 'a' is empty.<br>";
}

// True because $a is set
if (isset($a)) {
    echo "Variable 'a' is set";
}
?>