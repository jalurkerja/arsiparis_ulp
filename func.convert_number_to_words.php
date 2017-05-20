<?php
function convert_number_to_words($number,$numdecimal = 0) {
	$number = number_format(($number * 1),$numdecimal,".","");
	
    $hyphen      = ' ';
    $conjunction = ' ';
    $separator   = ', ';
    $negative    = 'min ';
    $decimal     = ' koma ';
    $dictionary  = array(
        0                   => 'nol',
        1                   => 'satu',
        2                   => 'dua',
        3                   => 'tiga',
        4                   => 'empat',
        5                   => 'lima',
        6                   => 'enam',
        7                   => 'tujuh',
        8                   => 'delapan',
        9                   => 'sembilan',
        10                  => 'sepuluh',
        11                  => 'sebelas',
        12                  => 'dua belas',
        13                  => 'tiga belas',
        14                  => 'empat belas',
        15                  => 'lima belas',
        16                  => 'enam belas',
        17                  => 'tujuh belas',
        18                  => 'delapan belas',
        19                  => 'sembilan belas',
        20                  => 'dua puluh',
        30                  => 'tiga puluh',
        40                  => 'empat puluh',
        50                  => 'lima puluh',
        60                  => 'enam puluh',
        70                  => 'tujuh puluh',
        80                  => 'delapan puluh',
        90                  => 'sembilan puluh',
        100                 => 'ratus',
        1000                => 'ribu',
        1000000             => 'juta',
        1000000000          => 'miliyar',
        1000000000000       => 'triliun',
        1000000000000000    => 'quatriliun',
        1000000000000000000 => 'quintriliun'
    );

    if (!is_numeric($number)) {
        return false;
    }

    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
        );
        return false;
    }

    if ($number < 0) {
        return $negative . convert_number_to_words(abs($number));
    }

    $string = $fraction = null;

    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }

    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens   = ((int) ($number / 10)) * 10;
            $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds  = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . convert_number_to_words($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= convert_number_to_words($remainder);
            }
            break;
    }

    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string) $fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words);
    }
	$arr1 = array("satu ratus","satu ribu","satu juta","satu miliyar","satu triliun","satu quatriliun","satu quintriliun");
	$arr2 = array("seratus","seribu","sejuta","semiliyar","setriliun","sequatriliun","sequintriliun");
    return str_replace($arr1,$arr2,$string);
}
?>