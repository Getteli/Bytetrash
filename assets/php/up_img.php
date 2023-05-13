<?php
	// charset
	header('Content-Type: text/html; charset=utf-8');
	// conexao com o bd
	include_once('conection.php');
	// impede erros de NOTICE a aparecer na page, pois caso as variaveis estejam vazias dera erro(notice)
	error_reporting(0);
	// inicia a sessao para pegar o id do usuario
	session_start();

	// var
	$foto  = $_POST['img'];
	$id_trash  = $_POST['id'];

	// verificar a conexao, se tudo estiver certo, vai executar a linha, se nao vai informar qual o erro
	try{
		if ($conn) {
			// arquivo ja modificado
			$profile = base64_jpg( $foto );
			if ($profile == false) {
				throw new Exception('Erro na tentativa de subir imagem.');
			}
			// antes de subir uma nova imagem, excluir antiga imagem
			// $query_before = mysqli_query($conn, " SELECT foto_usu FROM usuario WHERE id_usu = $id_usu ");
			// $linha_before = mysqli_fetch_assoc($query_before);
			// $profile_before = $linha_before['foto_usu'];
			// // excluir imagem
			// delete_image( $profile_before );
			// query a ser exec
			$query = mysqli_query($conn, " UPDATE prod_trash SET img_trash = '$profile' WHERE id_trash = $id_trash ");
			if ( $query ) {
				// feito com exito!
				// echo $del;
				echo "Imagem alterada com sucesso!";
			}else{
				throw new Exception('Erro na tentativa de salvar imagem.');
			}
		}else{
			throw new Exception('Erro na tentativa de se conectar com o banco de dados.');
		}
	}catch(Exception $Error0) {
		// pega o erro
		$erro0 = $Error0->getMessage();
		// dar echo e retorna pelo ajax
		echo $erro0;
	}

	// transformar imagem base64 em um arquivo jpg e enviar para pasta
	function base64_jpg( $image ) {
		$type = "png";
		// remove jpg, png, jpeg
		$image = str_replace('data:image/png;base64,', '', $image);
		$image = str_replace('data:image/jpg;base64,', '', $image);
		$image = str_replace('data:image/jpeg;base64,', '', $image);
		$image = str_replace('', '+', $image);
		// $data = base64_decode($image1);
		$data = base64_decode($image);
		$f = finfo_open();
		$mime_type = finfo_buffer($f, $data, FILEINFO_MIME_TYPE);
		// se for png, muda a ext no nome e faz a alteracao necessaria
		if ($mime_type == "image/png") {
			list($type, $image) = explode(';', $image);
			list($type, $image) = explode(',', $image);
			$newName = uniqid ( time () ) . '.' . 'png';
		}else{
			$newName = uniqid ( time () ) . '.' . 'jpg';
		}
		// path para subir ao servidor
		$path = '../img/trash/' . $newName;
		// envia ao servidor
		file_put_contents($path , $data);
		// executa a funcao de redimensionar a imagem, enviando o caminho da imagem original ja enviada ao servidor, novo tamanho e o novo nome
		$resize_img = resizeImg($path, 430, 630, $newName);
		// name a ser enviado ao banco
		$new_pic = str_replace('../img/trash/', '', $path); // retira
		$new_pic = 'assets/img/trash/' . $new_pic; // add
		if ($resize_img == true) {
		return $new_pic; // retorna o caminho para enviar ao banco, a imagem é alterada pela funcao resizeImg, mas o caminho/nome permanece o mesmo
		}else{
			return false;
		}
	}

	// redimensionar image
	function resizeImg($imagem, $largura, $altura, $nome){
		// Verifica extensão do arquivo
		$extensao = strrchr($imagem, '.');
		switch($extensao) {
			case '.png':
				$funcao_cria_imagem = 'imagecreatefrompng';
				$funcao_salva_imagem = 'imagepng';
				break;
			case '.jpg':
			case '.jpeg':
				$funcao_cria_imagem = 'imagecreatefromjpeg';
				$funcao_salva_imagem = 'imagejpeg';
				break;
			default:
				return 'Erro. Tipo de arquivo não aceito';
				exit;
				break;
		}
		// Cria um identificador para nova imagem
		$imagem_original = $funcao_cria_imagem($imagem);
		// Salva o tamanho antigo da imagem
		list($largura_antiga, $altura_antiga) = getimagesize($imagem);
		// Cria uma nova imagem com o tamanho indicado
		// Esta imagem servirá de base para a imagem a ser reduzida
		$imagem_tmp = imagecreatetruecolor($largura, $altura);
		// manter transparencia se for png
		imagealphablending( $imagem_tmp, false );
		imagesavealpha( $imagem_tmp, true );
		// Faz a interpolação da imagem base com a imagem original
		imagecopyresampled($imagem_tmp, $imagem_original, 0, 0, 0, 0, $largura, $altura, $largura_antiga, $altura_antiga);
		// Salva a nova imagem. Ao efetuar, pelo fato de terem o mesmo nome, e excluido a imagem original
		$resultado = $funcao_salva_imagem($imagem_tmp, "../img/trash/$nome");
		// Libera memoria
		imagedestroy($imagem_original);
		imagedestroy($imagem_tmp);
		if($resultado){
			// feito com exito!
			return true;
		}else{
			// erro
			return false;
		}
	}

	// excluir imagem
	function delete_image($pic_before){
		// altera o caminho pois do banco e diferente daqui para a imagem
		$pic_before = str_replace('assets/img/trash/', '', $pic_before); // retira
		$pic_before = '../img/trash/' . $pic_before; // add
		// se nao estiver vazio, se o arquivo existir, exclua a foto anterior
		if ( !empty( $pic_before ) && file_exists( $pic_before ) ) {
			// exclui
			unlink( $pic_before );	
		}
	}

	// desencriptar
	function Desencriptar($en_var, $iv_len = 16){
		$en_var = base64_decode($en_var);
		$n = strlen($en_var);
		$i = $iv_len;
		$var = '';
		$iv = substr(substr($en_var, 0, $iv_len), 0, 512);
		while ($i < $n) {
			$Bloco = substr($en_var, $i, 16);
			$var .= $Bloco ^ pack('H*', md5($iv));
			$iv = substr($Bloco . $iv, 0, 512);
			$i += 16;
		}
		return preg_replace('/\x13\x00*$/', '', $var);
	}
