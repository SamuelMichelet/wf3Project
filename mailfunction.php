<?php

function sendMail($destinataire,$content,$object){
    $mail = $destinataire; // destinataire du mail
            $crlf = "\r\n";
            $message_txt = $content;  // contenu du mail en texte simple
            $message_html = $content; // contenu du mail en html
            $boundary = "-----=".md5(rand());
            $sujet = $object;   // sujet du mail
            $header = "From: \"Nom Prénom\"<moi@exemple.com>".$crlf;    // expediteur
            $header.= "Reply-to: \"Nom Prénom\" <moi@exemple.com>".$crlf;   // personne en retour de mail
            $header.= "MIME-Version: 1.0".$crlf;
            $header.= "Content-Type: multipart/alternative;".$crlf." boundary=\"$boundary\"".$crlf;
            $message = $crlf."--".$boundary.$crlf;
            $message.= "Content-Type: text/plain; charset=\"UTF-8\"".$crlf;
            $message.= "Content-Transfer-Encoding: 8bit".$crlf;
            $message.= $crlf.$message_txt.$crlf;
            $message.= $crlf."--".$boundary.$crlf;
            $message.= "Content-Type: text/html; charset=\"UTF-8\"".$crlf;
            $message.= "Content-Transfer-Encoding: 8bit".$crlf;
            $message.= $crlf.$message_html.$crlf;
            $message.= $crlf."--".$boundary."--".$crlf;
            $message.= $crlf."--".$boundary."--".$crlf;
            mail($mail,$sujet,$message,$header); 
}

