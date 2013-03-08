<?php

$file = file( $argv[1], FILE_IGNORE_NEW_LINES );

$cont = 0;
$matriz_tmp = array();
$secuencias = array();
foreach( $file as $line ) {
	$line = trim( $line );
	if( $line[0] == '#' ) continue;
	if( $cont < 5 ) {
		$matriz_tmp[ $line[0] ] = explode( ',', substr( $line, 2 ) );
	} else {
		$secuencias[ $line[0] ] = substr( $line, 2 );
	}
	$cont++;
}
$matriz = array();
foreach( $matriz_tmp as $l1 => $ps ) {
	if( $l1 == '-' ) $l1 = '';
	$ps = array_combine( array_keys( $matriz_tmp ), $ps );
	foreach( $ps as $l2 => $p ) {
		if( $l2 == '-' ) $l2 = '';
		$matriz[$l1.'/'.$l2] = intval( $p );
	}
}
$matriz['/'] = 0;

$puntajes = array();
$muestra = array_shift( $secuencias );
$cont = 0;

foreach( $secuencias as $i => $s ) {
	alinear( $muestra, $s );
	$puntajes[$i] = $matriz[ min( $muestra, $s ).'/'.max( $muestra, $s ) ];
}
arsort( $puntajes );
$culpable = key( $puntajes );

if( $argv[2] ) print_a( $muestra, $secuencias, $matriz, $cont, $puntajes );

print 'El culpable es el sospechoso numero '.( $culpable + 1).' ('.$secuencias[$culpable].').';
exit;

function alinear( $s1, $s2 ) {
	global $matriz, $cont;
	$cont++;

	if( strcmp( $s1, $s2 ) > 0 ) { // para que siempre $s1 < $s2
		$tmp = $s1; $s1 = $s2; $s2 = $tmp;
	}

	$k = $s1.'/'.$s2;
	if( ! isset( $matriz[$k] ) ) {
		$matriz[$k] = 0;
		if( $s1 == '' ) {
			for( $i = 0; $i < strlen( $s2 ); $i++ ) $matriz[$k] += $matriz[ $s2[$i].'/' ];

		} else {
			while( $s1 && $s2 && $s1[0] == $s2[0] ) { // sin son iguales, avanzo
				$matriz[$k] += $matriz[ $s1[0].'/'.$s2[0] ];
				$s1 = substr( $s1, 1 );
				$s2 = substr( $s2, 1 );
			}

			if( ! $s1 || ! $s2 ) {
				$matriz[$k] += alinear( $s1, $s2 );

			} else {
				$matriz[$k] += max(
					$matriz[ $s1[0].'/' ] + alinear( substr( $s1, 1 ), $s2 ),
					$matriz[ '/'.$s2[0] ] + alinear( $s1, substr( $s2, 1 ) ),
					$matriz[ $s1[0].'/'.$s2[0] ] + alinear( substr( $s1, 1 ), substr( $s2, 1 ) )
				);
			}
		}
	}

	return $matriz[$k];
}



function print_a( $a ) {
   $id = 'debug_'.md5( rand() );
   if( func_num_args() > 1 ) $a = func_get_args();
   print print_r( $a, TRUE )."\n\n";
}


