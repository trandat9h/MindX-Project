<?php
    $xtp = new XTemplate("views/createPost/edit.html");
    if($_GET['id']){
        $id = $_GET['id'];
    }
    $tbl = $db->fetchAll("SELECT * FROM  tblquiz WHERE quiz_id = $id");
    foreach($tbl as $r){
        $xtp->assign('EDIT',$r);
    }
    
    if($_POST){
        $question       = $_POST['quiz_question'];
        $quiz_A         = $_POST['quiz_A'];
        $quiz_B         = $_POST['quiz_B'];
        $quiz_C         = $_POST['quiz_C'];
        $quiz_D         = $_POST['quiz_D'];
        $quiz_answer    = $_POST['quiz_answer'];

        $sql = "UPDATE tblquiz SET 
            quiz_question = '$question',
            quiz_A        = '$quiz_A',
            quiz_B        = '$quiz_B',
            quiz_C        = '$quiz_C',
            quiz_D        = '$quiz_D',
            quiz_answer   = '$quiz_answer',
            WHERE post_id = '{$id}'
        ";
        if($db->executeSQL($sql1)){
            $f->redir("../../createQuiz/list/");
        }

    }


    $xtp->parse('EDIT');
    $acontent = $xtp->text('EDIT');


?>