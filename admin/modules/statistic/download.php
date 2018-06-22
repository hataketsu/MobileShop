<?php
 header("Cache-Control: no-store, no-cache");
    header("Content-Type: text/csv; charset=utf-8");
    header("Content-Disposition: attachment; filename=".$_GET['filename']);
    readfile('data.csv');
