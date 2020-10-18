<?php
   $xtp = new XTemplate("views/tutorial.html");

   if(isset($_GET['id'])) $id = $_GET['id'];
    else $f->redir('learning');

   $sql =  "SELECT * FROM tblposts WHERE post_id = $id";
   $tbl = $db->fetchAll($sql);
   foreach($tbl as $r){
       $xtp->assign('TUTOR',$r);
   }
    $sql =  "SELECT * FROM tblquiz q 
            INNER JOIN tblposts p ON q.post_id = p.post_id";
    $tbl = $db->fetchAll($sql);
    $count = 1;
    foreach($tbl as $r){
        $xtp->assign('count',$count);
        $xtp->assign('QUIZ',$r);
        $xtp->parse('TUTOR.QUIZ');
        $count ++;
    }
    $tick = "<i class='fas fa-check float-right'></i>";
    $incorrect = "<i class='fas fa-times float-right'></i>";
    $checkCorrectString = '';
    $checkCorrectAnswer = '';
    $arrStr = '';
    if($_POST){
        $check = 0;
        $xtp->assign('checked','checked');
        for($i = 1; $i < $count; $i++){
            $id = 'quiz'."".$i; 
            $userAns[$i] = $_POST[$id];
            $arrStr .= $userAns[$i] . ',';
            $sql = "SELECT quiz_answer FROM tblquiz WHERE quiz_id = $i";
            $answer = $db->fetchOne($sql);
            if($userAns[$i] == $answer['quiz_answer']){
                $checkCorrectString .= '1';
                $checkCorrectAnswer .= $i;
                $check++;
            }      
            else $checkCorrectString .= '0';   
        }
        $xtp->assign('arrStr',$arrStr);
        $percent = $check / ($count-1) * 100;
        $xtp->assign('percent',$percent);
    }
    $xtp->assign('checkCorrectString',$checkCorrectString);

    $xtp->parse('TUTOR');
    $acontent = $xtp->text('TUTOR');