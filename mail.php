<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require 'PHPMailerAutoload.php';

// Configurações do destinatário

// Recomendo: coloque a senha em variável de ambiente ou arquivo seguro
$mailUser = 'contato@cloud4me.com.br';
$mailPass = 'Gnoberto01@@';

$mail = new PHPMailer(true);
$mail->CharSet = 'UTF-8';



try {
    // Configurações do servidor SMTP do Zoho
    $mail->isSMTP();
    $mail->Host = 'smtp.zoho.com';
    $mail->SMTPAuth = true;
    $mail->Username = $mailUser;
    $mail->Password = $mailPass;
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    // Remetente e destinatário
    $mail->setFrom($mailUser, 'Site Cloud4me');
    $mail->addAddress($mailUser);

    // Conteúdo do e-mail
    $mail->isHTML(false);
    // Detecta se é o formulário de vaga ou contato
    if(isset($_POST['nome']) && isset($_POST['descricao'])) {
        // Formulário de vaga
        $nome = htmlspecialchars(trim($_POST['nome']));
        $email = isset($_POST['email']) ? htmlspecialchars(trim($_POST['email'])) : '';
        $empresa = isset($_POST['empresa']) ? htmlspecialchars(trim($_POST['empresa'])) : '';
        $descricao = htmlspecialchars(trim($_POST['descricao']));
        $mail->Subject = 'Solicitação de Técnico Dedicado - Cloud4me';
        $body = "Nome: $nome\nE-mail: $email\nEmpresa: $empresa\nDescrição da vaga:\n$descricao";
        $mail->Body = $body;
        if(strlen($nome) < 2) {
            echo json_encode(["status" => "error", "message" => "Nome inválido."]);
            exit;
        }
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(["status" => "error", "message" => "E-mail inválido."]);
            exit;
        }
        if(strlen($descricao) < 5) {
            echo json_encode(["status" => "error", "message" => "Descrição muito curta."]);
            exit;
        }
    } else {
        // Formulário de contato padrão
        $name = isset($_POST['name']) ? htmlspecialchars(trim($_POST['name'])) : '';
        $email = isset($_POST['email']) ? htmlspecialchars(trim($_POST['email'])) : '';
        $empresa = isset($_POST['empresa']) ? htmlspecialchars(trim($_POST['empresa'])) : '';
        $message = isset($_POST['message']) ? htmlspecialchars(trim($_POST['message'])) : '';
        $mail->Subject = 'Novo contato do site Cloud4me';
        $body = "Nome: $name\nE-mail: $email\nEmpresa: $empresa\nMensagem:\n$message";
        $mail->Body = $body;
        if(strlen($name) < 2) {
            echo json_encode(["status" => "error", "message" => "Nome inválido."]);
            exit;
        }
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(["status" => "error", "message" => "E-mail inválido."]);
            exit;
        }
        if(strlen($empresa) < 2) {
            echo json_encode(["status" => "error", "message" => "Empresa obrigatória."]);
            exit;
        }
        if(strlen($message) < 5) {
            echo json_encode(["status" => "error", "message" => "Mensagem muito curta."]);
            exit;
        }
    }

    // Envia o e-mail
    header('Content-Type: application/json');
    $mail->send();

    // Reseta o estado após o envio bem-sucedido
    $_SESSION['form_sent'] = false;

    echo json_encode(["status" => "success", "message" => "Mensagem enviada com sucesso!"]);
} catch (Exception $e) {
    header('Content-Type: application/json');
    echo json_encode(["status" => "error", "message" => "Erro ao enviar: " . $mail->ErrorInfo]);
}
?>
