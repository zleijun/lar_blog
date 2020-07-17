<?php
//公共函数,任何地方都可调用

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/**
 * phpEmail 发送邮件（此处邮箱地址为配置）
 * @param  [type] $email   [接收人地址]
 * @param  [type] $content [邮件内容]
 * @param  [string] $subtitle [邮件主题]
 * @param  string $file    [附件地址]
 * @return [type]          [description]
 */
function phpEmail($email,$content,$subtitle){
    $mail = new PHPMailer(true);
    return False;
	try {
	    //邮箱服务器配置
    	//debug开启2,关闭0
	    $mail->SMTPDebug = 0;
	    $mail->isSMTP();

	    //设置编码
	    $mail->CharSet = 'utf-8';
	    //邮箱服务器地址
	    $mail->Host = '';
	    //权限
	    $mail->SMTPAuth = true;
	    //发送人邮箱
	    $mail->Username = '';
	    //发送人密码
	    $mail->Password = '';
	    //安全验证方式'ssl'或者'tls'
	    $mail->SMTPSecure = 'ssl';
	    //端口
	    $mail->Port = 465;
	    //发送人地址 以及昵称,可发送给多人
	    $mail->setFrom('leruge@163.com', 'LaravelStudent');
	    $mail->addAddress($email, '发送人昵称');
	    // $mail->addAddress('ellen@example.com');

	    //回复地址
	    // $mail->addReplyTo('info@example.com', 'Information');
	    //抄送
	    // $mail->addCC('cc@example.com');
	    // $mail->addBCC('bcc@example.com');

	    //附近
	    // $mail->addAttachment('/var/tmp/file.tar.gz');
	    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');

	    //内容格式
	    $mail->isHTML(true);
	    $mail->Subject = $subtitle;
	    $mail->Body    = $content;

	    //不支持HTML用此方法发送
	    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

	    return $mail->send();
	} catch (Exception $e) {
	    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
	    return False;
	}
}


//字符串替换，用于此前段模板分页
function strTostr($data){

	return str_replace('span', 'a', $data);
}