<?php

class Algorithm {
	private function partition(&$array, $low, $high) {
		$temp = $array[$low] ;
        $array[$low] = $array[floor(($low + $high) / 2)] ;
        $array[floor(($low + $high) / 2)] = $temp ;

        $pivot = $array[$low] ;
        $last_small = $low ;

        for( $i = $low + 1; $i <= $high; $i ++ ) {
            if( $array[$i] < $pivot ) {
                $last_small = $last_small + 1 ;
                $temp = $array[$last_small] ;
                $array[$last_small] = $array[$i] ;
                $array[$i] = $temp ;
            }
        }

        $temp = $array[$last_small] ;
	    $array[$last_small] = $array[$low] ;
	    $array[$low] = $temp ;

	    return $last_small ;
	}

	public function quickSort(&$src, $low, $high) {
		if( $low < $high ) {
            $pivot_position = $this->partition($src, $low, $high);
            $this->quickSort($src, $low, $pivot_position - 1);
            $this->quickSort($src, $pivot_position + 1, $high);
        }
	}
}

?>