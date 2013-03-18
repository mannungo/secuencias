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
	$ps = array_combine( array_keys( $matriz_tmp ), $ps );
	foreach( $ps as $l2 => $p ) {
		$matriz[$l1.'/'.$l2] = intval( $p );
		$matriz[ ( $l1 == '-' ? '' : $l1 ).'/'.( $l2 == '-' ? '' : $l2 ) ] = intval( $p );
	}
}
$matriz['/'] = 0;

$puntajes = array();
$muestra = array_shift( $secuencias );
foreach( $secuencias as $i => $s ) {
	alinear( $muestra, $s );
	$puntajes[$i] = $matriz[ min( $muestra, $s ).'/'.max( $muestra, $s ) ];
}
arsort( $puntajes );
$culpable = key( $puntajes );

if( $argv[2] ) print_a( $muestra, $secuencias, $matriz, $cont, $puntajes );

print 'El culpable es el sospechoso numero '.( $culpable + 1).' ('.$secuencias[$culpable].').';
exit;


function alinear( $s1, $s2, $dir = 0 ) { // la funcion que hace la magia
	global $matriz, $cont, $sol;
	$cont++;

	if( strcmp( $s1, $s2 ) > 0 ) { // para que siempre $s1 < $s2
		$tmp = $s1; $s1 = $s2; $s2 = $tmp;
		$dir *= -1; // supongo que puntaje( X-/-Y ) <= puntaje( X/Y ) para todos X, Y
	}

	$k = $s1.'/'.$s2;
	if( strlen( $k ) > 32 ) $k = md5( $k );

	$suma = $matriz[$k];

	if( ! isset( $suma ) ) {

		while( $s1 && $s2 && $s1[0] == $s2[0] ) { // si primeros caracteres son iguales, avanzo
			$suma += $matriz[ $s1[0].'/'.$s2[0] ];
			$s1 = substr( $s1, 1 );
			$s2 = substr( $s2, 1 );
		}

		if( $s1 == '' ) {
			for( $i = 0; $i < strlen( $s2 ); $i++ ) $suma += $matriz[ $s2[$i].'/' ];

		} else {
			$rec = array();
			if( $dir != 1 ) $rec[0] = $matriz[ $s1[0].'/' ] + alinear( substr( $s1, 1 ), $s2, -1 );
			if( $dir != -1 ) $rec[1] = $matriz[ '/'.$s2[0] ] + alinear( $s1, substr( $s2, 1 ), 1 );
			$rec[2] = $matriz[ $s1[0].'/'.$s2[0] ] + alinear( substr( $s1, 1 ), substr( $s2, 1 ), 0 );
			arsort( $rec);

			$suma += max( $rec );
		}

		if( mem_uso() < 0.9 ) $matriz[$k] = $suma;
	}

	return $suma;
}


function print_a( $a ) { // solo para debuguear
   print print_r( func_num_args() > 1 ? func_get_args() : $a, TRUE )."\n\n";
}


function mem_uso() {
	global $mem_total;
	if( ! $mem_total ) $mem_total = 1000000*intval( ini_get( 'memory_limit' ) );
	if( ! $mem_total ) return 1;
	return memory_get_usage() / $mem_total;
}




