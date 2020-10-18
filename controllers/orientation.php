<?php
   $xtp = new XTemplate("views/orientation.html");
   $sql = "SELECT * FROM tblcareer";
   $tbl = $db->fetchAll($sql);
   foreach($tbl as $r){
      $xtp->assign('CARD',$r);
      $xtp->parse('ORI.CARD');
   }
   $xtp->parse('ORI');
   $acontent = $xtp->text('ORI');