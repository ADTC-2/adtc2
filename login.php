<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SECRETARIA ONLINE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background-image: url('../adtc2/imagens/img_carteira/azul_clarol.png');
            background-size: cover;
            background-position: center center;
            background-repeat: no-repeat;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            overflow: hidden; /* Removendo o scroll */
        }

        .content-center {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: calc(100vh - 120px);
            margin-top: -3px;
        }

        #form-login {
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 360px;
        }

        .form-control {
            border-radius: 4px;
            padding: 10px;
            border: 1px solid #ddd;
            margin-bottom: 10px;
        }

        .input-group-text {
            border: none;
            background: transparent;
            cursor: pointer;
        }

        #toggle-password {
            background: transparent;
            border: none;
        }

        .btn-outline-danger {
            border-radius: 4px;
            padding: 10px 20px;
            background-color: #8B0000;
            color: white;
            border: none;
        }

        .btn-outline-danger:hover {
            background-color: #800000;
            margin-left:0px;
        }

        .text-center img {            
            width: 200px;
            margin-bottom: 20px;
        }
        .input-wrapper {
            position: relative;
        }

        .input-wrapper .mb-3 {
            position: absolute;
            right: 5px; /* Ajuste conforme necessário */
            top: 50%; /* Ajuste conforme necessário */
            transform: translateY(-50%);
        }
        .form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper .mb-3 {
            position: absolute;
            right: 5px; /* Ajuste conforme necessário */
            top: 50%; /* Ajuste conforme necessário */
            transform: translateY(-50%);
        }

        .button-wrapper {
            margin-top: 20px;
            display: flex;
            justify-content: center; /* Centraliza horizontalmente */
        }

    </style>
</head>
<body>
 
    <section class="content-center">
        <div class="text-center">
            <a href="#" target="_blank">
                <img src="imagens/img_carteira/ADTC2 VERMELHO.png" alt="logo do CodigoQuatro" class="img-fluid">
            </a>
        </div>

        <form action="seguranca.php" method="POST" id="form-login">

            <div class="mb-3">
                <input type="text" name="nome" id="nome" placeholder="Digite sua congregação" required class="form-control">
            </div>

            <div class="input-wrapper">
                <input type="password" name="senha" id="senha" placeholder="Digite sua senha" required class="form-control">
                <div class="mb-3">
                    <span class="input-group-text" id="toggle-password">
                        <i class="fas fa-eye" id="toggle-icon"></i>
                    </span>
                </div>
            </div>

            <div class="button-wrapper">
                <button type="submit" class="btn btn-outline-danger">Autenticar</button>
            </div>
        </form>
    </section>
    <script>
        document.getElementById('toggle-password').addEventListener('click', function (e) {
            const passwordInput = document.getElementById('senha');
            const icon = document.getElementById('toggle-icon');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    </script>
</body>
</html>

