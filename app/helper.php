<?php

function default_ret_array()
{
    $response = array();
    $response['status'] = FALSE;
    $response['msg'] = "unkown result";
    $response['ret_data'] = array();
    return $response;
}


function rate_converter($rate, $language_id)
{
    if ($rate >= 4) {
        return $language_id == '2' ? ['text' => 'ممتاز', 'no' => 1] : ['text' => 'Excellent', 'no' => 1];
    } elseif ($rate >= 3) {
        return $language_id == '2' ? ['text' => 'جيد جدا', 'no' => 2] : ['text' => 'Very Good', 'no' => 2];
    } else {
        return $language_id == '2' ? ['text' => 'جيد', 'no' => 3] : ['text' => 'Good', 'no' => 3];
    }
}
