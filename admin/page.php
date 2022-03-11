<?php


$do  ="";

if  (isset($_GET['do']))  {
    $do = $_GET['do'];
} else  {
    $do  =  'Manage';
}


if ($do  == 'Manage') {
    echo 'wlcm  to  manage  category';
} elseif ($do == 'add') {
    echo  'wlm  to add category';
} elseif ($do == 'insert') {
    echo  'wlm  to insert category';
}  elseif ($do == 'add') {
    echo  'wlm  to add category';
}  else {
    echo  'there is no  page with this  name';
}  

?>