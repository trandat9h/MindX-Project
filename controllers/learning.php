<?php
   $xtp = new XTemplate("views/learning.html");
   $sql =  "SELECT * FROM tblposts WHERE type_id = 2";
   $tbl = $db->fetchAll($sql);
   foreach($tbl as $r){
       $xtp->assign('BOOK',$r);
       $xtp->parse('LEARN.BOOK');
   }

   $sql =  "SELECT * FROM tblposts WHERE type_id = 3";
   $tbl = $db->fetchAll($sql);
   foreach($tbl as $r){
       $xtp->assign('TUTOR',$r);
       $xtp->parse('LEARN.TUTOR');
   }
   $xtp->parse('LEARN');
   $acontent = $xtp->text('LEARN');