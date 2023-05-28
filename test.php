<?php
// Combine arrays (Keys & values)

$b = ['apple', 'apple', 'apple', 'apple'];
$a = range(0,count($b)-1);
$c = array_combine($a, $b);

$keys =  array_keys($c);
echo $keys
'</pre>';

?>