<?php
include_once 'functions.php';
$active = select_sql('active');
if ($active == 0) {
    redirect('active.php');
}
