<?php
    $xtp = new XTemplate("views/career.html");

    if(isset($_GET['id'])) $id = $_GET['id'];
    else $f->redir('orientation');
    $sql =  "SELECT * FROM tblcareer WHERE career_id = $id";
    $tbl = $db->fetchAll($sql);
    foreach($tbl as $r){
        $xtp->assign('LIST',$r);
    }
    $xtp->parse('LIST');
    $acontent = $xtp->text('LIST');