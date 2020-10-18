<?php
    $xtp = new XTemplate("views/createPost/edit.html");
    if($_GET['id']){
        $id = $_GET['id'];
    }
    $do_save = 1;
    $arrFileType = array('png','jpg','gif','svg','jpeg');
    $urlServer = 'assets/admin/post';
    $urlServer_copy = 'assets/img/post';
    $maxSize    = 100000000;    
    $tbl = $db->fetchAll("SELECT * FROM  tblposts WHERE post_id = $id");
    foreach($tbl as $r){
        $xtp->assign('EDIT',$r);
    }
    
    if($_POST){
        $isActive  = $_POST['post_active'];
        $title = $_POST['post_title'];
        $content = $_POST['post_content'];
        $img = $_FILES['upload_file_added'];
        $post_img =$f->uploadFile($img,$urlServer,$urlServer_copy,$arrFileType,$maxSize);
        if($img['name'] != ''){
            $sql = "UPDATE tblposts SET 
                post_img = '{$post_img}'
                WHERE post_id = '{$id}'
            ";
            $db->executeSQL($sql);
        }
        $post_name_err_mess = $post_price_err_mess = $post_img_err_mess = '';
        
        if($post_img=='102'){
            echo ($file['size']);
            $do_save=0;
        }
        if($do_save == 1){
            $sql1="UPDATE tblposts SET 
                post_active = {$isActive},
                post_title = '{$title}',
                post_content = '{$content}'
                WHERE post_id = '{$id}'
            ";
            if($db->executeSQL($sql1)){
                $f->redir("../../createPost/list/");
            }
        }

    }


    $xtp->parse('EDIT');
    $acontent = $xtp->text('EDIT');


?>