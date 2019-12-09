<?php
    // charset
    header('Content-Type: text/html; charset=utf-8');
    setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
    date_default_timezone_set('America/Sao_Paulo');
    // conexao com o bd
    include_once('_assets/_php/conection.php');

    $id = filter_input(INPUT_GET, 'id');
    $name = filter_input(INPUT_GET, 'name');

            $query = mysqli_query($conn, " SELECT 
                img_trash, value
                FROM prod_trash WHERE id_trash = '$id' ");
            // pega a linha
            $linha = mysqli_fetch_assoc($query);

            $img = $linha['img_trash'];
            $value = 120 + $linha['value'];

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>


	<title>ByteTrash</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="description" content="TechTrash, lucre com seu lixo eletrônico.">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="_assets/_img/favicon.png">
	<link rel="apple-touch-icon" href="_assets/_img/favicon_apple.png">
	<meta name="theme-color" content="#008265">
	<!-- scripts -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="_assets/_style/stylesheet.expanded.css">
	<link rel="stylesheet" type="text/css" href="_assets/_style/carousel.css">
	<!-- manifest / sw-->
	<!-- <link rel="manifest" href="manifest.json"> -->
	<!-- <script src="service-worker.js" type="text/javascript"></script> -->
	<!-- A2HS -->
	<!-- <link rel="stylesheet" type="text/css" href="_assets/_style/addtohomescreen.css"> -->
	<style type="text/css">
	.menu_b{
position: fixed;
    z-index: 99999;
    bottom: 0;
}
	.produto_content{
    min-width: 130px;
    max-width: 170px;
	}
	.barra-fixa{
		width: 103%;
	}
		.load{
			display: none;
			background-color: rgba(0,0,0,0.7);
			width: 102%;
			height: 103%;
			position: fixed;
			margin: -10px;
			padding:0;
		    text-align: center;
		    font-family: arial, sans-serif;
		    color: white;
		    font-weight: 400;
		    z-index: 10;
		    padding-top: 80px;
		}
	</style>
</head>
<body class="no_margin bg_body_color2 ">

<div class="load" id="load">
    <img src="_assets/_img/gif.gif" style="width: 190px;">
	<h1 style="margin-bottom: 1px">PROCESSANDO...</h1>
	<small>por favor, aguarde</small>
</div>
    <!-- begin -->
    <header class="barra-fixa">
        <a href="index.html" class="bars">
         <i class="fa fa-bars"></i>
        </a>
      <div class="nome">
          <h3>Olá Douglas</h3>  
      </div>
      <div class="total">
          <p><?php echo $value ?></p>
      </div>
    </header>

    <label>
    <div class="registre">
    		<h3>Registre seu eletrônico</h3>
    		<input type="file" capture="camera" accept="image/*" class="cameraInput" name="cameraInput" style="display:none;"/>
    </div>
    </label>

    <div class="area_produtos">
        <?php if (isset($id)) { ?>
        <div class="produto">
            <div class="produto_content">
                <img style="max-width:70%; border-radius:4px 4px 0 0" src="<?php echo $img ?>" alt="">
                <h3><?php echo $name ?></h3>
            </div>
            <p class="pontos"><?php echo number_format($linha['value'], 0, ',', '.'); ?></p>
        </div>
        <?php } ?>

        <div class="produto">
            <div class="produto_content">
                <img style="max-width:100%; border-radius:4px 4px 0 0" src="_assets/_img/prod01.jpg" alt="">
                <h3>Estabilizador</h3>
            </div>
            <p class="pontos">10</p>
        </div>

        <div class="produto">
            <div class="produto_content">
                <img style="max-width:100%; border-radius:4px 4px 0 0" src="_assets/_img/prod01.jpg" alt="">
                <h3>Estabilizador</h3>
            </div>
            <p class="pontos">10</p>
        </div>

        <div class="produto">
                <div class="produto_content">
                    <img style="max-width:100%; border-radius:4px 4px 0 0" src="_assets/_img/prod01.jpg" alt="">
                    <h3>Estabilizador</h3>
                </div>
                <p class="pontos">10</p>
            </div>
    
            <div class="produto">
                <div class="produto_content">
                    <img style="max-width:100%; border-radius:4px 4px 0 0" src="_assets/_img/prod01.jpg" alt="">
                    <h3>Estabilizador</h3>
                </div>
                <p class="pontos">10</p>
            </div>

            <div class="produto">
                    <div class="produto_content">
                        <img style="max-width:100%; border-radius:4px 4px 0 0" src="_assets/_img/prod01.jpg" alt="">
                        <h3>Estabilizador</h3>
                    </div>
                    <p class="pontos">10</p>
                </div>
                <div class="produto">
                        <div class="produto_content">
                            <img style="max-width:100%; border-radius:4px 4px 0 0" src="_assets/_img/prod01.jpg" alt="">
                            <h3>Estabilizador</h3>
                        </div>
                        <p class="pontos">10</p>
                </div>
    </div>
<footer>
        <div class="mobile-bottom-bar menu_b">
        		
                <a href="#" class="footer-link">
                  <label>
                  <i class="fa fa-picture-o"></i> <span class='footer-text'>Capturar</span>
                  <input type="file" capture="camera" accept="image/*" class="cameraInput" name="cameraInput" style="display:none;"/>
                  </label>
                </a>

                <a href="#" class="footer-link">
                  <i class="fa fa-microchip"></i> <span class='footer-text'>Produtos</span>
                </a>
                <a href="http://54.233.140.55/bytetrash/certificadp.pdf" target="_blank" class="footer-link">
                        <i class="fa fa-file-text"></i> <span class='footer-text'>Certificado</span>
                </a>
                <a href="#" class="footer-link">
                        <i class="fa fa-gg-circle"></i> <span class='footer-text'>Moedas </span>       </a>
         </div>
</footer>
    

<!-- SCRIPT -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js" type="text/javascript"></script>
<script src="_assets/_js/javascript.js" type="text/javascript"></script>