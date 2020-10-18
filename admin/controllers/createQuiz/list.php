<?php
    $xtp = new XTemplate("views/createQuiz/list.html");

    if($_POST){
        $question       = $_POST['quiz_question'];
        $quiz_A         = $_POST['quiz_A'];
        $quiz_B         = $_POST['quiz_B'];
        $quiz_C         = $_POST['quiz_C'];
        $quiz_D         = $_POST['quiz_D'];
        $quiz_answer    = $_POST['quiz_answer'];

        $sql = "INSERT INTO tblquiz(quiz_question, quiz_A, quiz_B, quiz_C, quiz_D, quiz_answer) VALUES ('$question','$quiz_A','$quiz_B','$quiz_C','$quiz_D' ,'$quiz_answer')";
        $db->executeSQL($sql);
    }
    $sql = "SELECT * FROM tblquiz";
    $tbl = $db->fetchAll($sql);    
    foreach($tbl as $r){
        $xtp->assign('LIST',$r);
        $xtp->parse('QUIZ.LIST');
    }
    $xtp->parse('QUIZ');
    $acontent = $xtp->text('QUIZ');