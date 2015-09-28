<?php
/**
 * �ʼ����ͺ���
 */
function sendMail($to, $subject, $content) {
    vendor('PHPMailer.PHPMailerAutoload');
    $mail = new PHPMailer();
    // װ���ʼ�������
    if (C('MAIL_SMTP')) {
        $mail->IsSMTP();
    }
    $mail->Host = C('MAIL_HOST');
    $mail->SMTPAuth = C('MAIL_SMTPAUTH');
    $mail->Username = C('MAIL_USERNAME');
    $mail->Password = C('MAIL_PASSWORD');
    $mail->SMTPSecure = C('MAIL_SECURE');
    $mail->CharSet = C('MAIL_CHARSET');
    // װ���ʼ�ͷ��Ϣ
    $mail->From = C('MAIL_USERNAME');
    $mail->AddAddress($to);
    $mail->FromName = '������Ц԰';
    $mail->IsHTML(C('MAIL_ISHTML'));
    // װ���ʼ�������Ϣ
    $mail->Subject = $subject;
    $mail->Body = $content;
    // �����ʼ�
    if (!$mail->Send()) {
        return false;
    } else {
        return true;
    }
}
?>