<?php
    $xtp = new XTemplate("views/home.html");
    $sql =  "SELECT * FROM tblposts WHERE type_id = 1";
    $tbl = $db->fetchAll($sql);
    foreach($tbl as $r){
        $xtp->assign('LIST',$r);
        $xtp->parse('HOME.LIST');
    }
    $xtp->parse('HOME');
    $acontent = $xtp->text('HOME');