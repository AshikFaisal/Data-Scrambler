<?php

function displayKey($key) {
    printf("value = '%s' ", $key);
}

function scrambleData($originalData, $value) {
    $originalKey = 'abcdefghijklmnopqrstuvwxyz1234567890';
    $data = '';
    $length = strlen($originalData);
    for($i = 0; $i < $length; $i++) {
        $currentChar = $originalData[$i];
        $position = strpos($originalKey , $currentChar);
        if($position !== false) {
            $data .= $value[$position];
        }else {
            $data .= $currentChar;
        }
    }
    return $data;
}

function decodeData($originalData, $value) {
    $originalKey = 'abcdefghijklmnopqrstuvwxyz1234567890';
    $data = '';
    $length = strlen($originalData);
    for($i = 0; $i < $length; $i++) {
        $currentChar = $originalData[$i];
        $position = strpos($value , $currentChar);
        if($position !== false) {
            $data .= $originalKey[$position];
        }else {
            $data .= $currentChar;
        }
    }
    return $data;
}
