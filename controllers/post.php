<?php
    $xtp = new XTemplate("views/post.html");
    if(isset($_GET['id'])) $id = $_GET['id'];
    else $f->redir('home');
    $sql =  "SELECT * FROM tblposts WHERE post_id = $id";
    $tbl = $db->fetchAll($sql);
    foreach($tbl as $r){
        $xtp->assign('LIST',$r);
    }
    $xtp->parse('LIST');
    $acontent = $xtp->text('LIST');