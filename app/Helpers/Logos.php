<?php
function logo($brand){
    $e = explode('/', $brand);
    return end($e);
}
function status($status){
    if ($status == 1)
        return 'Active';
    else
        return 'InActive';
}
