<?php

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



