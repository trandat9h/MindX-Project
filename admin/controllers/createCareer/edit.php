<?php
    $xtp = new XTemplate("views/createCareer/edit.html");
    if($_GET['id']){
        $id = $_GET['id'];
    }
    $do_save        = 1;
    $arrFileType    = array('png','jpg','gif','svg','jpeg');
    $urlServerImg   = 'assets/admin/career';
    $urlCus         = 'assets/img/career';
    $maxSize        = 100000000; // max = 10 mb; 
    $tbl = $db->fetchAll("SELECT * FROM  tblcareer WHERE career_id = $id");

    foreach($tbl as $r){
        $xtp->assign('EDIT',$r);
    }
    
    if($_POST){
        $career_name      = $_POST['career_name'];
        $img              = $_FILES['upload_file_added'];
        $career_img         =  $f->uploadFile($img,$urlServerImg,$urlCus,$arrFileType, $maxSize);
        
        if($img['name'] != ''){
            $sql = "UPDATE tblcareer SET 
               career_img = '{$career_img}'
                WHERE career_id = '{$id}'
            ";
            $db->executeSQL($sql);
        }
        if($do_save == 1){
            $sql1="UPDATE tblcareer SET 
                career_name = '$career_name'
                WHERE career_id = {$id}
            ";
            echo $sql1;

            if($db->executeSQL($sql1)){
                $f->redir("../../createCareer/list/");
            }
        }

    }


    $xtp->parse('EDIT');
    $acontent = $xtp->text('EDIT');


?>