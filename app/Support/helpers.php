<?php


function prva_rola($rola){
    if ( count( Auth::user()->getRoleNames() ) == 0  ){   // ak uzivatel nema rolu prirad rolu manager
        Auth::user()->assignRole($rola);  //Auth::user()->removeRole('manager');  // odstrani rolu
    }
}

function body_class() {
    return Route::currentRouteName();
}

function body_class2() {
	return Request::segment(1);
}


function setBodyId() {

    $path = $_SERVER['REQUEST_URI'];

    if(!isset($bodyId)) {

		if(eregi('^/about/', $path) == 1) {

			$bodyId = 'about';

		} elseif(eregi('^/archive/', $path) == 1) {

			$bodyId = 'archive';

		} elseif(eregi('^/contact/', $path) == 1) {

			$bodyId = 'contact';

		} elseif(eregi('^/business/', $path) == 1) {

			$bodyId = 'business';

		} elseif(eregi('^/pleasure/', $path) == 1) {

			$bodyId = 'pleasure';

		} elseif ($path == '') {

			$bodyId = 'home';

		} else {

			$bodyId = 'default';
		}
	}
	return $bodyId;
}




/* short text */
if ( !function_exists('short_text') ){
    function short_text($text,$max) {
        if( strlen($text) > $max){                          // ak je string dlhsi
            $orez = substr($text,0,$max);                   // orezeme string
            $exp = (explode(' ', $orez));                   // explodneme do pola
            $orez2 = array_splice($exp, count($exp) - 1);   // vymazeme posledne pole
            $spolu = join( ' ', $exp) ;                     // spat na string
            return  $spolu;
        }
        else return $text;
    }
}

/* format date */
if ( !function_exists('convertDate') ){
    function convertDate ( $date, $format = 'd-m-Y') {
        return date($format, strtotime($date));
    }
}







