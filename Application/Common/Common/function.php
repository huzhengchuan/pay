<?php
/**
 * 邮件发送函数
 */
function sendMail($to, $subject, $content) {
    vendor('PHPMailer.PHPMailerAutoload');
    $mail = new PHPMailer();
    // 装配邮件服务器
    if (C('MAIL_SMTP')) {
        $mail->IsSMTP();
    }
    $mail->Host = C('MAIL_HOST');
    $mail->SMTPAuth = C('MAIL_SMTPAUTH');
    $mail->Username = C('MAIL_USERNAME');
    $mail->Password = C('MAIL_PASSWORD');
    $mail->SMTPSecure = C('MAIL_SECURE');
    $mail->CharSet = C('MAIL_CHARSET');
    // 装配邮件头信息
    $mail->From = C('MAIL_USERNAME');
    $mail->AddAddress($to);
    $mail->FromName = '憨豆儿笑园';
    $mail->IsHTML(C('MAIL_ISHTML'));
    // 装配邮件正文信息
    $mail->Subject = $subject;
    $mail->Body = $content;
    // 发送邮件
    if (!$mail->Send()) {
        return false;
    } else {
        return true;
    }
}
?>