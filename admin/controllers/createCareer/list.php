<?php
    $xtp = new XTemplate("views/createCareer/list.html");

    $do_save        = 1;
    $arrFileType    = array('png','jpg','gif','svg','jpeg');
    $urlServerImg   = 'assets/admin/career';
    $urlCus         = 'assets/img/career';
    $maxSize        = 100000000; // max = 10 mb;

    if($_POST){
        $career_name      = $_POST['career_name'];
        $img              = $_FILES['career_img'];
        $post_img         =  $f->uploadFile($img,$urlServerImg,$urlCus,$arrFileType, $maxSize);

        if($post_img == '101'){
            $img_err_mess = 'File type not allow';
            $xtp->assign('img_err_mess',$img_err_mess);
            $do_save = 0;
        }
        if($post_img == '102'){
            $img_err_mess = 'File size is too big';
            $xtp->assign('img_err_mess',$img_err_mess);
            $do_save = 0;
        }
        if($do_save == 1){
            $sql = "INSERT INTO tblcareer(career_name, career_img) VALUES ('$career_name','$post_img')";
            if($db->executeSQL($sql)){
                $f->redir("../../createCareer/list/");
            }
        }    
    }
    $tbl = $db->fetchAll("SELECT * FROM  tblcareer");
                         
    $status = '';
    foreach($tbl as $r){
        $xtp->assign('LIST',$r);
        $xtp->parse('CAREER.LIST');
    }
    $xtp->parse('CAREER');
    $acontent = $xtp->text('CAREER');