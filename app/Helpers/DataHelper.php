<?php

namespace App\Helpers;

//use Carbon\Carbon as Date;
use Jenssegers\Date\Date;

class DataHelper {
	// ******************** FUNCTIONS ******************************
	static public function getTimestamp( $value ) {
		return strtotime( $value );
	}

	static public function now() {
		return Date::now()->format( 'H:i - d/m/Y' );
	}

	static public function getPercent2Float( $value ) {
		return floatval( str_replace( ',', '.', $value ) );
	}

	static public function getReal2Float( $value ) {
        if(is_float($value)) return $value;
		return ( ( $value == '' ) || ( $value == null ) ) ? 0 : floatval( str_replace( ',', '.', str_replace( '.', '', $value ) ) );
	}

	static public function getFloat2Currency( $value ) {
		return 'R$ ' . self::getFloat2Real( $value );
	}

	static public function getFloat2Percent( $value ) {
		return self::getFloat2Real( $value ) . '%';
	}

	static public function getFloat2Percent3( $value ) {
		return self::getFloat2Real( $value ,3) . '%';
	}

	static public function getFloat2Weigth( $value ) {
		return self::getFloat2Real( $value ) . ' kg';
	}

	static public function getFloat2Length( $value ) {
		return self::getFloat2Real( $value ) . ' m³';
	}

	static public function getFloat2Real( $value , $decimals = 2) {
		return number_format( $value, $decimals, ',', '.' );
	}

	static public function getFullPrettyDateTime( $value ) {
		return ( $value != null ) ? Date::createFromFormat( 'Y-m-d H:i:s', $value )->format( 'd/m/Y H:i:s' ) : $value;
	}

	static public function getDateFromDateTime( $value ) {
		return ( $value != null ) ? Date::createFromFormat( 'Y-m-d H:i:s', $value )->format( 'd/m/Y' ) : $value;
	}

	static public function getPrettyDateTime( $value ) {
		return ( $value != null ) ? Date::createFromFormat( 'Y-m-d H:i:s', $value )->format( 'H:i - d/m/Y' ) : $value;
	}
	static public function getHumanDateTime( $value ) {
		return ( $value != null ) ? Date::createFromFormat( 'Y-m-d H:i:s', $value )->diffForHumans() : $value;
	}

	static public function getMonthYearFromMonthPretty( $value )
    {
		Date::setLocale( 'pt_BR' );
		return ( $value != null ) ? Date::createFromFormat( 'm/Y', $value )->format( 'mY' ) : $value;
	}

	static public function getMonthYearToMonthPretty( $value )
    {
		Date::setLocale( 'pt_BR' );
		return ( $value != null ) ? Date::createFromFormat( 'mY', $value )->format( 'm/Y' ) : $value;
	}

	static public function getMonthYearToTimestamp( $value )
    {
		Date::setLocale( 'pt_BR' );
		return ( $value != null ) ? Date::createFromFormat( 'mY', $value )->timestamp : $value;
	}

	static public function getPrettyDateTimeToMonth( $value )
    {
		Date::setLocale( 'pt_BR' );
		return ( $value != null ) ? Date::createFromFormat( 'Y-m-d H:i:s', $value )->format( 'F/Y' ) : $value;
	}

	static public function getPrettyDate( $value ) {
		return ( $value != null ) ? Date::createFromFormat( 'Y-m-d', $value )->format( 'd/m/Y' ) : $value;
	}

    static public function setDateTime( $value )
    {
//        $value = str_replace('/','',$value);;
	    $value = preg_replace('/[^0-9]/', '', $value);
        $value = (strlen($value) == 12) ? $value : NULL;
        return ( ( $value != null ) && ( $value != '' ) ) ? Date::createFromFormat( 'HidmY', self::getOnlyNumbers( $value ) )->format( 'Y-m-d H:i:s' ) : null;
    }

	static public function getPrettyToCorrectDate( $value ) {
		return ( $value != null ) ? Date::createFromFormat( 'd/m/Y', $value )->format( 'Y-m-d' ) : $value;
	}

	static public function getPrettyToCorrectDateTime( $value ) {
		return ( $value != null ) ? Date::createFromFormat( 'd/m/Y', $value )->format( 'Y-m-d H:i:s' ) : $value;
	}

	static public function setDate( $value ) {
		$value = preg_replace('/[^0-9]/', '', $value);
	    $value = (strlen($value) == 8) ? $value : NULL;
		return ( ( $value != null ) && ( $value != '' ) ) ? Date::createFromFormat( 'dmY', self::getOnlyNumbers( $value ) )->format( 'Y-m-d' ) : null;
	}

	static public function getOnlyNumbers( $value ) {
		return ( $value != null ) ? preg_replace( "/[^0-9]/", "", $value ) : $value;
	}

	static public function getOnlyValues( $value ) {
		return ( $value != null ) ? preg_replace( "/[^0-9-.-,]/", "", $value ) : $value;
	}

	static public function getOnlyNumbersLetters( $value ) {
		return ( $value != null ) ? preg_replace( "/[^a-zA-Z0-9-]/", "", $value ) : $value;
	}
	static public function removeAccents( $value ) {
		return ( $value != null ) ? preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"),$value): $value;
	}

	static public function getShortName( $value ) {
		$value = explode( ' ', $value );

		return ( count( $value ) > 1 ) ? ( $value[0] . " " . end( $value ) ) : $value[0];
	}

	static public function removeAllWhiteSpaces( $value ) {
		$str = str_replace(array(" ", "\t", "\n"), "", $value);
		return urldecode(str_replace("%C2%A0", "", urlencode($str)));
	}

	static public function mask( $val, $mask ) {
		if ( $val != null || $val != "" ) {
			$maskared = '';
			$k        = 0;
			for ( $i = 0; $i <= strlen( $mask ) - 1; $i ++ ) {
				if ( $mask[ $i ] == '#' ) {
					if ( isset( $val[ $k ] ) ) {
						$maskared .= $val[ $k ++ ];
					}
				} else {
					if ( isset( $mask[ $i ] ) ) {
						$maskared .= $mask[ $i ];
					}
				}
			}
		} else {
			$maskared = null;
		}

		return $maskared;
	}


		/**
		 * Friendly UTF-8 URL for all languages
		 *
		 * @param $string
		 * @param string $separator
		 * @return mixed|string
			 */
	static public function slugify($string, $separator = '-')
	{
	    // Remove accents
	    $string = remove_accents($string);

	    // Slug
	    $string = mb_strtolower($string);
	    $string = @trim($string);
	    $replace = "/(\\s|\\" . $separator . ")+/mu";
	    $subst = $separator;
	    $string = preg_replace($replace, $subst, $string);

	    // Remove unwanted punctuation, convert some to '-'
	    $punc_table = array(
	        // remove
	        "'" => '',
	        '"' => '',
	        '`' => '',
	        '=' => '',
	        '+' => '',
	        '*' => '',
	        '&' => '',
	        '^' => '',
	        '' => '',
	        '%' => '',
	        '$' => '',
	        '#' => '',
	        '@' => '',
	        '!' => '',
	        '<' => '',
	        '>' => '',
	        '?' => '',
	        // convert to minus
	        '[' => '-',
	        ']' => '-',
	        '{' => '-',
	        '}' => '-',
	        '(' => '-',
	        ')' => '-',
	        ' ' => '-',
	        ',' => '-',
	        ';' => '-',
	        ':' => '-',
	        '/' => '-',
	        '.' => '',
	        '|' => '-'
	    );
	    $string = str_replace(array_keys($punc_table), array_values($punc_table), $string);

	    // Clean up multiple '-' characters
	    $string = preg_replace('/-{2,}/', '-', $string);

	    // Remove trailing '-' character if string not just '-'
	    if ($string != '-') {
	        $string = rtrim($string, '-');
	    }

	//$string = rawurlencode($string);

		return $string;
	}

	static public function NewGuid($size = 5) {
		$s = strtoupper(md5(uniqid(rand(),true)));
		$guidText = substr($s,0,8);
		if($size > 1) $guidText .= '-' . substr($s,8,4) . '-';
		if($size > 2) $guidText .= substr($s,12,4). '-';
		if($size > 3) $guidText .= substr($s,16,4) . '-';
		if($size > 4) $guidText .= substr($s,20);

		return $guidText;
	}

	static public function calculateModulo11($value)
	{
		$dv = NULL;
		if ($value != NULL) {
			$sz = strlen($value);
			if ($sz > 0) {
				$sum = 0;
				foreach (range($sz + 1, 2) as $i => $number) {
					$calc = ($value[$i] * $number);
					$sum += $calc;
				}
				$dv = ($sum % 11); //dígito verificador
				if ($dv > 10) $dv = 0;
			}
		}
//        dd($dv);
		return ($dv >= 10) ? 0 : $dv;

	}

    static public function selectDefaultReturn( $id, $data ) {
        $retorno = null;
        if ( count( $data ) > 0 ) {
            foreach ( $data as $i => $dt ) {
                $retorno[] = array( 'id' => $dt->$id, 'text' => $dt->getName(), 'data' => $dt );
            }
        }
        echo json_encode( $retorno );
    }

    static public function selectDBReturn(array $fields, $data ) {
        $retorno = null;
        if ( count( $data ) > 0 ) {
            foreach ( $data as $i => $dt ) {

                $re = array();
                $re['id'] = $dt->id;
                foreach ( $fields as $field ) {
                    $re['text'][] = $dt->$field;
                }
                $re['text'] = implode(' - ', $re['text']);
                $retorno[] = $re;
            }
        }
        echo json_encode( $retorno );
    }
	static public function getFullToDate( $value ) {
		return ( $value != null ) ? Date::createFromFormat( 'Y-m-d H:i:s', $value )->format( 'd/m/Y' ) : $value;
	}
	static public function getPrettyToSlimDate( $value ) {
		return ( $value != null ) ? Date::createFromFormat( 'Y-m-d H:i:s', $value )->format( 'dmY' ) : $value;
	}

}
