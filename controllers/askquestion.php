<?php
    $xtp = new XTemplate("views/askquestion.html");
    if($_POST){
        $title = $_POST['ques_title'];
        $text = $_POST['ques_text'];
        $email = $_SESSION['user_email'];
        $sql = "SELECT user_id FROM tblusers WHERE user_email = '$email'";
        $id = ($db->fetchAll($sql))[0]['user_id'];
        $sql = "INSERT INTO tblquestion(ques_title,ques_text,user_id) VALUES ('$title','$text',$id)";
        $db->executeSQL($sql);
    }
    
  
    $xtp->parse('ASK');
    $acontent = $xtp->text('ASK');