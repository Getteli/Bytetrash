<?php
	// charset
	header('Content-Type: text/html; charset=utf-8');

	// var
	$HOST = 'beautymei-bd.cw1tkvnvvbo0.sa-east-1.rds.amazonaws.com';
	$USERNAME = 'masterUsername';
	$PASSWORD = 'Beautymei1,';
	$DATABASE = 'bytetrash_db';
	$PORT = '3306'; // port do mysql
	define('HOST', 'beautymei-bd.cw1tkvnvvbo0.sa-east-1.rds.amazonaws.com');
	define('USERNAME', 'masterUsername');
	define('PASSWORD', 'Beautymei1,');
	define('DATABASE', 'bytetrash_db');
	define('PORT', '3306');

	// CONEXAO MYSQLI
	$conn = new mysqli($HOST, $USERNAME, $PASSWORD, $DATABASE);

	// Caso algo tenha dado errado, exibe uma mensagem de erro
	if (mysqli_connect_errno()){
		// pega o perro
		$get_erro = mysqli_connect_error();
		// informe o erro em nosso email
		send_email($get_erro, 'MYSQLI');
		// mostra o erro
		echo $get_erro;
	}else{
		// charset utf8
		mysqli_set_charset($conn,"utf8");
		ini_set('default_charset', 'UTF-8');

		// echo "tudo show (y' - MYSQLI";
	}

	// echo "<br/>";

	// CONEXAO PDO
	class Conexao {
		public static $instance;  
		private function __construct() {
			//
		}
		public static function getInstance() {
			try{
				// verifica se ja nao ha outra conexao pdo
				if (!isset(self::$instance)) {
					self::$instance = new PDO('mysql:host='.HOST.';port='.PORT.';dbname='.DATABASE.'', USERNAME, PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
					self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					self::$instance->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING);

					echo "tudo show (y' - PDO";
				}
				// charset utf8
				ini_set('default_charset', 'UTF-8');
				return self::$instance;
			} catch(PDOException $e) {
				// pega o perro
				$get_erro_pdo = $e->getMessage();
				// informe o erro em nosso email
				send_email($get_erro_pdo, 'PDO');
				// mostra o erro
				echo $get_erro_pdo;
			}
		}
	}
	// test conexao pdo
	// conexao::getInstance();

	/*
	Outros tipos de erro para o pdo:
	PDO::ERRMODE_SILENT
	PDO::ERRMODE_WARNING
	PDO::ERRMODE_EXCEPTION
	*/

	// function para enviar email info erro
	function send_email($error, $type){
		date_default_timezone_set("Brazil/East"); // default time zone
		$to = "NOSSO_EMAIL";
		// verifica versao do php para o charset
		if (PHP_VERSION_ID < 50600) {
			iconv_set_encoding('input_encoding', 'UTF-8');
			iconv_set_encoding('output_encoding', 'UTF-8');
			iconv_set_encoding('internal_encoding', 'UTF-8');
		}else{
			ini_set('default_charset', 'UTF-8');
		}
		// cabecalho
		$headers = "MIME-Version: 1.1\r\n";
		$headers .= "From: NAME_PROJETO@scripts_interno\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
		$headers  .= "Content-type: text/html; charset=iso-8859-1 \r\n";
		('Content-type: text/html; charset=iso-8859-1 \r\n');
		// assunto
		$subject = "[NAME_PROJETO] CONEXAO";
		// mensagem
		$mensagem  = "Mensagem enviado pelo site do(a) NAME_PROJETO em : SCRIPT DE CONEXAO com BANCO DE DADOS.<br/>
		CONEXAO: {$type} <br/>
		ERRO: {$error}";
		// encapsulando uft8
		$subject = utf8_decode($subject);
		$mensagem = utf8_decode($mensagem);
		// enviando msg
		$send_contact = mail($to, $subject, $mensagem, $headers);  
		// redireciona para a pagina de erro, front para o usuario
		if ( $send_contact ) {
			header('location:error.php');
		}
	}