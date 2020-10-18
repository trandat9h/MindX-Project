<?php
    $xtp = new XTemplate('views/sendMail/send.html');
    include("../libs/PHPMailer-master/src/Exception.php");
    include("../libs/PHPMailer-master/src/OAuth.php");
    include("../libs/PHPMailer-master/src/PHPMailer.php");
    include("../libs/PHPMailer-master/src/POP3.php");
    include("../libs/PHPMailer-master/src/SMTP.php");

            
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    $sql = "SELECT user_email FROM tblusers";
    $cus = $db->fetchAll($sql);
    $cusQuantity = count($cus);
    
    $sql = "SELECT post_title FROM tblposts";
    $tbl = $db->fetchAll($sql);
    $slBox = $db->getSB_value('post_title',$tbl,'post_title','Choose a post to send emails');
    $i = 0;
    $form = '';
    if($_POST){
        $title = $_POST['post_title'];
        $sql = "SELECT * FROM tblposts WHERE post_title = '$title'";
        $tbl = $db->fetchAll($sql);
        $form .= $tbl[0]['post_title'] . '' . $tbl[0]['post_content'] ;
        while($i < $cusQuantity){
            $mail = new PHPMailer;
            $mail->IsSMTP(); 
            $mail->SMTPDebug = false; 
            $mail->SMTPAuth = true; 
            $mail->SMTPSecure = 'tls';
            $mail->Host = "smtp.gmail.com";
            $mail->Port = "587"; 
            $mail->IsHTML(true);
            $mail->Username = "vinegarfoodrestaurant@gmail.com";
            $mail->Password = "71doicung";
            $mail->setFrom('vinegarfoodrestaurant@gmail.com', 'Vinegar Food Restaurant');
            $mail->addAddress($cus[$i]['user_email']);
            $mail->Subject = 'Hi ' . $cus[$i]['user_email'];
            $mail->Body = $form;
            if(!$mail->send()) {
                echo "Mailer Error: " . $mail->ErrorInfo;
            } 
            else {
                echo "Message sent!"; 
            }
            $i++;
        }
        
    }
    $xtp->assign('slBox',$slBox);
    $xtp->parse('MAIL');
    $acontent = $xtp->text('MAIL');