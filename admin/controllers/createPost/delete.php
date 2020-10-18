<?php
    $id = $_GET['id'];
    $sql1 = "DELETE FROM tblposts WHERE post_id IN ($id) ;
    ";
    $db->executeSQL($sql1);
    $f->redir("../../createPost/list/");