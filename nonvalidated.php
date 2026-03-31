<?php
    header("Content-Security-Policy: default-src 'self'; script-src 'self'; style-src 'self' 'unsafe-inline'; img-src 'self' data:; font-src 'self'; connect-src 'self'");
    header("X-Content-Type-Options: nosniff");
    header("X-Frame-Options: DENY");
    header("X-XSS-Protection: 1; mode=block");
    header("Referrer-Policy: strict-origin-when-cross-origin");
    header("Strict-Transport-Security: max-age=31536000; includeSubDomains; preload");
    header("Permissions-Policy: geolocation=(), camera=(), microphone=()");
require_once __DIR__ . "/connection.php";
session_start();
if(isset($_SESSION['emailadm']) && isset($_SESSION['nameadm'])){
    $email = $_SESSION['emailadm'];
    $nome = $_SESSION['nameadm'];
    $sql = "SELECT autenticado FROM adms WHERE email = '$email' AND nome = '$nome' ";
    $result = mysqli_query($conexao, $sql);
    $dados = mysqli_fetch_assoc($result);
    if(!empty($dados)){
        if($dados['autenticado'] == 'sim'){
            header('Location: dashadm.php');
        }
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acesso Pendente - Aguardando Validação</title>
        <link rel="shortcut icon" href="assets/ACELERADOR DO POTENCIAL HUMANO (1).png" type="image">
    <style>
        /* ===== RESET E CONFIGURAÇÕES GLOBAIS ===== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #4169E1 0%, #2a4ba8 100%); /* Azul Royale */
            padding: 20px;
        }

        /* ===== CONTAINER PRINCIPAL ===== */
        .container {
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            padding: 60px 40px;
            max-width: 500px;
            width: 100%;
            text-align: center;
            animation: fadeInUp 0.6s ease-out;
        }

        /* ===== ANIMAÇÃO DE ENTRADA ===== */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ===== ÍCONE DE DESCONEXÃO ===== */
        .icon-wrapper {
            margin-bottom: 30px;
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
                opacity: 1;
            }
            50% {
                transform: scale(1.05);
                opacity: 0.9;
            }
        }

        .icon-svg {
            width: 120px;
            height: 120px;
            margin: 0 auto;
        }

        /* ===== TÍTULO PRINCIPAL ===== */
        .title {
            color: #2a4ba8; /* Azul Royale escuro */
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 16px;
            line-height: 1.3;
        }

        /* ===== MENSAGEM DESCRITIVA ===== */
        .message {
            color: #4a5568;
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 30px;
        }

        /* ===== BADGE DE STATUS ===== */
        .status-badge {
            display: inline-block;
            background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%); /* Amarelo */
            color: #2c3e50;
            padding: 10px 24px;
            border-radius: 25px;
            font-size: 14px;
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(255, 215, 0, 0.4);
        }

        /* ===== INFORMAÇÃO ADICIONAL ===== */
        .info-text {
            margin-top: 30px;
            padding-top: 25px;
            border-top: 1px solid #e2e8f0;
            color: #718096;
            font-size: 14px;
        }

        /* ===== RESPONSIVIDADE MOBILE ===== */
        @media (max-width: 600px) {
            .container {
                padding: 40px 25px;
            }

            .title {
                font-size: 24px;
            }

            .message {
                font-size: 15px;
            }

            .icon-svg {
                width: 100px;
                height: 100px;
            }

            .status-badge {
                font-size: 13px;
                padding: 8px 20px;
            }
        }

        @media (max-width: 400px) {
            .container {
                padding: 30px 20px;
            }

            .title {
                font-size: 22px;
            }

            .icon-svg {
                width: 90px;
                height: 90px;
            }
        }
    </style>
</head>
<body>
    <!-- Container Principal -->
    <div class="container">
        <!-- Ícone de Desconexão (SVG Inline) -->
        <div class="icon-wrapper">
            <svg class="icon-svg" viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                <!-- Círculo de fundo -->
                <circle cx="100" cy="100" r="95" fill="#EBF4FF" stroke="#4169E1" stroke-width="3"/>
                
                <!-- Tomada/Plug desconectado (lado esquerdo) -->
                <rect x="35" y="75" width="45" height="50" rx="8" fill="#4169E1"/>
                <circle cx="50" cy="90" r="6" fill="#ffffff"/>
                <circle cx="65" cy="90" r="6" fill="#ffffff"/>
                <rect x="52" y="105" width="11" height="15" fill="#ffffff"/>
                
                <!-- Tomada/Plug desconectado (lado direito) -->
                <rect x="120" y="75" width="45" height="50" rx="8" fill="#94a3b8"/>
                <circle cx="135" cy="90" r="6" fill="#ffffff"/>
                <circle cx="150" cy="90" r="6" fill="#ffffff"/>
                <rect x="137" y="105" width="11" height="15" fill="#ffffff"/>
                
                <!-- Linha de desconexão (zig-zag) -->
                <path d="M 80 100 L 90 95 L 100 105 L 110 95 L 120 100" 
                      stroke="#FFD700" 
                      stroke-width="4" 
                      stroke-linecap="round" 
                      fill="none"/>
                
                <!-- Ícone de alerta (pequeno triângulo) -->
                <path d="M 100 140 L 90 158 L 110 158 Z" fill="#FFD700"/>
                <text x="100" y="155" text-anchor="middle" font-size="16" font-weight="bold" fill="#2c3e50">!</text>
            </svg>
        </div>

        <!-- Título -->
        <h1 class="title">Seu acesso ainda não foi liberado</h1>

        <!-- Mensagem -->
        <p class="message">
            Aguarde a validação de um administrador para ter acesso completo ao sistema.
        </p>

        <!-- Badge de Status -->
        <div class="status-badge">
            ⏳ Pendente de Aprovação
        </div>

        <!-- Informação Adicional -->
        <p class="info-text">
            Em caso de dúvidas, entre em contato com o suporte.
        </p>
    </div>
</body>
</html>