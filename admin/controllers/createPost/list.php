<?php
    $xtp = new XTemplate("views/createPost/list.html");
    $do_save        = 1;
    $arrFileType    = array('png','jpg','gif','svg','jpeg');
    $urlServerImg   = 'assets/admin/post';
    $urlCus         = 'assets/img/post';
    $maxSize        = 100000000; // max = 10 mb;

    if($_POST){
        $post_active      = $_POST['post_active'];
        $img              = $_FILES['post_img'];
        $post_img         =  $f->uploadFile($img,$urlServerImg,$urlCus,$arrFileType, $maxSize);

        $post_title       = $_POST['post_title'];
        $post_content     = $_POST['post_content'];

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
            $sql = "INSERT INTO tblposts(post_active, post_img, post_title, post_content) VALUES ($post_active,'$post_img','$post_title','$post_content')";
            if($db->executeSQL($sql)){
                $f->redir("../../createPost/list/");
            }
        }    
    }
    $tbl = $db->fetchAll("SELECT post_id
                            , post_img
                            , post_title
                            , post_active
                            , SUBSTRING(post_content, 1, 100) as post_content
                        FROM  tblposts ");
                         
    $status = '';
    foreach($tbl as $r){
        $xtp->assign('POST',$r);
        $xtp->parse('LIST.POST');
    }
    $xtp->parse('LIST');
    $acontent = $xtp->text('LIST');