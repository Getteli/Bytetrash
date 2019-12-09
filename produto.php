<?php
	// charset
	header('Content-Type: text/html; charset=utf-8');
	setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
	date_default_timezone_set('America/Sao_Paulo');
	// conexao com o bd
	include_once('_assets/_php/conection.php');

	$name = filter_input(INPUT_GET, 'name');
	$id = filter_input(INPUT_GET, 'id');


	switch ($name) {
		case 'note':
			// query a ser pesquisada
			$query = mysqli_query($conn, " SELECT 
				img_trash, value
				FROM prod_trash WHERE id_trash = '$id' ");
			// pega a linha
			$linha = mysqli_fetch_assoc($query);

			$img = $linha['img_trash'];
			$nome = 'Notebook';
			$value = $linha['value'];
			break;
		case 'cel':
			// query a ser pesquisada
			$query = mysqli_query($conn, " SELECT 
				img_trash, value
				FROM prod_trash WHERE id_trash = '$id' ");
			// pega a linha
			$linha = mysqli_fetch_assoc($query);

			$img = $linha['img_trash'];
			$nome = 'Celular';
			$value = $linha['value'];
			break;
		case 'placa':
			// query a ser pesquisada
			$query = mysqli_query($conn, " SELECT 
				img_trash, value
				FROM prod_trash WHERE id_trash = '$id' ");
			// pega a linha
			$linha = mysqli_fetch_assoc($query);

			$img = $linha['img_trash'];
			$nome = 'Placa-mãe';
			$value = $linha['value'];
			break;
		default:
			break;
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>byteTrash</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="description" content="description">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="">
	<link rel="apple-touch-icon" href="">
	<meta name="theme-color" content="#009406">
	<link rel="stylesheet" href="_assets/_style/stylesheet.expanded.css">
	<style type="text/css">
		*{
			font-family: arial, sans-serif;
			margin:0;
			padding:0;
		}
		body{
			width: 103%!important;
			overflow-x: hidden;	
		}
		h1, h2{
			text-align: center;
		}
		.top_bar{
		    width: 100%;
		    height: 100px;
		    position: fixed;
		    z-index: 99;
		    background-image: url(_assets/_img/top_bar.png);
		    background-repeat: no-repeat;
		    background-position: top;
		    background-size: 100%;
		}
		.none{
			display: none;
		}
		.btn_b{
			width: 20%;
			height: 65px;
			position: fixed;
		}
		.cont_img{
			width: 100%;
			height: auto;
		}
		.cont_img > img{
			width: 100%;
			height: auto;
		}
		.gray{
			color: #868383;
		    text-align: center;
		    font-size: 25px;
		}
		.result_txt{
			position: absolute;
		    height: 200px;
		    z-index: 9;
		    width: 100%;
		}
		.name{
			margin: 20px 0;
		}
		.coin2{
		    background-image: url(_assets/_img/coin2.png);
		    background-repeat: no-repeat;
		    background-position: center;
		    background-size: 50%;
		    width: 100%;
		    height: 100px;
		    margin-bottom: 22px;
		}
		.coin2 > p{
			text-align: center;
    		font-size: 28px;
    		color: #635e5e;
		    padding-top: 37px;
		    padding-left: 22px;
		}
		.coin3{
		    background-image: url(_assets/_img/coin2.png);
		    background-repeat: no-repeat;
		    background-position: center 80px;
		    background-size: 50%;
		    width: 100%;
		    height: 185px;
		   margin-left: -8px;
		    /* margin-top: 41px; */
		}
		.coin3 > p{
			text-align: center;
    		font-size: 28px;
    		color: #635e5e;
		    padding-top: 123px;
		    padding-left: 22px;
		}
		.continue{
		    background-image: url(_assets/_img/continue.png);
		    background-repeat: no-repeat;
		    /*background-position: center;*/
		    background-position: 80px;
		    background-size: 60%;
		    width: 100%;
		    height: 100px;
		    /*margin-left: 12px;*/
		    background-color: white;
		    border: none;
		}
		.confirm{
		    background-image: url(_assets/_img/confirmar.png);
		    background-repeat: no-repeat;
		    background-position: center;
		    background-position: center;
		    background-size: 69%;
		    width: 100%;
		    height: 100px;
		    /* margin-left: 12px; */
		    background-color: transparent;
		    border: none;
		    z-index: 99999;
		    position: absolute;
		    /* height: 134px; */
		    bottom: 19px;
		}
		.choose, .maps{
		    background-color: #71EFE0;
		    width: 100%;
		    position: absolute;
		    height: 100%;
		}
		.txt_c{
			margin-top: 30%;
			color: white;
			font-weight: 400;
		}
		.txt_c2{
		margin-top: 15%;
		    color: white;
		    font-weight: 400;
		    background-color: #71EFE0;
		    position: fixed;
		    top: 0;
		    z-index: 99999;
		    width: 100%;
		    height: 85px;
		    line-height: 5;
		}
		.txt_c3{
		margin-top: 15%;
		    color: black;
		    font-weight: 400;
		    position: fixed;
		    top: 0;
		    z-index: 99999;
		    width: 100%;
		    height: 85px;
		    line-height: 2;
		}
		.cont_btn{
			display: flex;
		}
		.y{
		    background-image: url(_assets/_img/sim.png);
		    background-repeat: no-repeat;
		    /*background-position: center;*/
		    background-position: center;
		    background-size: 70%;
		    width: 100%;
		    height: 100px;
		    /*margin-left: 12px;*/
		    background-color: transparent;
		    border: none;
		}
		.n{
		    background-image: url(_assets/_img/nao.png);
		    background-repeat: no-repeat;
		    /*background-position: center;*/
		    background-position: center;
		    background-size: 70%;
		    width: 100%;
		    height: 100px;
		    /*margin-left: 12px;*/
		    background-color: transparent;
		    border: none;
		}
		iframe{
	    width: 100%;
	    height: 100%;
	    border: none;
		}
		.prod_c{
			width: 155px;
			margin-top: 15px;
		}
		.txt_info{
		text-align: center;
		    color: green;
		    font-size: 14px;
		    bottom: 0;
		    position: absolute;
		}
	</style>
</head>
<body>
<div id="prod">
	<div class="top_bar">
		<a href="main.php" class="btn_b"></a>
	</div>
	<div class="cont_img">
		<img src="<?php echo $img ?>" />
	</div>
	<div class="result_txt">
		<h2 class="name"><?php echo $nome ?></h2>
		<p class="gray">Parabéns</p>
		<p class="gray">Este aparelho lhe retornará aproximadamente <?php echo number_format($value, 0, ',', '.'); ?> trashy coins</p>
		<div class="coin2"><p><?php echo number_format($value, 0, ',', '.'); ?></p></div>
		<button class="continue" id="continue"></button>
	</div>
</div>
<div id="choose" class="choose none">
	<div class="top_bar">
		<a href="#" id="btn_back" class="btn_b"></a>
	</div>
	<h1 class="txt_c" style="padding: 0 20px">Irei entregar em um ponto de coleta ?</h1>
	<div class="cont_btn" style="padding: 0 20px">
		<button class="y" id="yes"></button>
		<button class="n"></button>
	</div>
	<h2 class="txt_c" style="padding: 0 20px">Ganhe trash Coins extras indo até o ponto de entrega mais <b>PRÓXIMO</b></h2>
</div>

<div id="maps" class="maps none">
	<div class="top_bar">
		<a href="#" id="btn_back2" class="btn_b"></a>
	</div>
	<h2 class="txt_c2">Ponto de coleta mais <b>PRÓXIMO</b></h2>
	<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d7346.623078717787!2d-43.400009800000014!3d-22.975568699999997!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1spt-BR!2sbr!4v1541327679920" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
	<button class="confirm" id="confirm"></button>
</div>

<div id="done" class="done none">
	<div class="top_bar">
		<a href="#" id="btn_back3" class="btn_b"></a>
	</div>
	<h2 class="txt_c3">CONCLUÍDO</h2>
	<div class="coin3"><p><?php echo number_format($value, 0, ',', '.'); ?></p></div>

        <div class="center_element prod_c">
            <div class="produto_content">
                <img style="max-width:100%; border-radius:4px 4px 0 0" src="<?php echo $img ?>" alt="">
                <h3><?php echo $nome ?></h3>
            </div>
        </div>

	<button class="confirm" id="confirm2"></button>
	<p class="txt_info">Após a confirmação seu certificado de Despejo Correto estará salvo em <b>certificados</b>.</p>
</div>

<!-- scripts -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js" type="text/javascript"></script>
<script type="text/javascript">
	$("#continue").click(function () {
		$('#prod').hide().eq($('#choose').fadeIn()); // hide/show a div do slide
	});
	$("#btn_back").click(function () {
		$('#choose').hide().eq($('#prod').fadeIn()); // hide/show a div do slide
	});

	$("#yes").click(function () {
		$('#choose').hide().eq($('#maps').fadeIn()); // hide/show a div do slide
	});

	$("#btn_back2").click(function () {
		$('#maps').hide().eq($('#choose').fadeIn()); // hide/show a div do slide
	});
	$("#confirm").click(function () {
		$('#maps').hide().eq($('#done').fadeIn()); // hide/show a div do slide
	});
	$("#btn_back3").click(function () {
		$('#done').hide().eq($('#maps').fadeIn()); // hide/show a div do slide
	});
	$("#confirm2").click(function () {
		window.location.href = "main.php?id=<?php echo $id ?>&name=<?php echo $nome ?>";
	});

</script>