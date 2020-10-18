<?php
    $id = $_GET['id'];
    $sql1 = "DELETE FROM tblquestion WHERE ques_id IN ($id) ;
    ";
    $db->executeSQL($sql1);
    $f->redir("../../createQuestion/list/");