<?php

print <<<EOF
# Matriz
A:5,-1,-2,-1,-3
C:-1,5,-3,-2,-4
G:-2,-3,5,-2,-2
T:-1,-2,-2,5,-1
-:-3,-4,-2,-1,*
# Evidencia

EOF;

$largo = $argv[1] ? intval( $argv[1] ) : 10;
$n_sospechosos = $argv[2] ? intval( $argv[2] ) : 5;

$l = array( 'A', 'T', 'G', 'C' );
for( $j = 0; $j < $n_sospechosos; $j++ ) {
	print $j.':';
	for( $i = 0; $i < $largo; $i++ ) print $l[ rand( 0, 4 ) ];
	print "\n";
}


