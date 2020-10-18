<?php
    $id = $_GET['id'];
    $sql1 = "DELETE FROM tblquiz WHERE quiz_id IN ($id) ;
    ";
    $db->executeSQL($sql1);
    $f->redir("../../createQuiz/list/");