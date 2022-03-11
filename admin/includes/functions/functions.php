<?php 

function get_title() {
    global $pagetitle;
    if (isset($pagetitle)) {
        echo $pagetitle;
    } else {
        echo 'Default';
    }
}