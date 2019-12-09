$(document).ready(function () {
		// var
		btn = document.getElementById('btn');
		// btn_pic = document.getElementById('btn_pic');
		local = document.getElementById('local');
		cont = document.getElementById('result');
		var new_img64;
		var scrollingElement = (document.cont || cont);
		api_key = 'AIzaSyCT1zOtXlYbnE93Skv8C4VQsYGryE6g-Qk';
		api_key2 = 'AIzaSyC-OKSpUvAAfVMdeJ-bDTzWKvF1C3aHg3I';

		// // tira a foto do obj
		// function take_pic(input) {

		//     if (input.files && input.files[0]) {
		//         var reader = new FileReader();
		//         reader.onload = function (e) {
		//             $('#local').attr('src', e.target.result);
		//           	// alert('foto: ' + e.target.result);
		// 	        reader.readAsDataURL(input.files[0]);

		// 			// var url = 'https://vision.googleapis.com/v1/images:annotate?alt=json&key='+api_key; // url para a api
		// 			// // obj
		// 			// var requests = {
		// 			// 	image : { content : e.target.result },
		// 			// 	features : { type : "LABEL_DETECTION", maxResults : 3 }
		// 			// };
		// 			// var payload = { requests };
		// 			// // inicia a chamada para a api, enviando os parametros
		// 			// send_vision(url, payload);
		// 			// // appendobj( cont, 'cliquei p tirar foto' );
		// 		}
		// 	}
		// }

		// funcao precisa ser async, para fazer a requisicao
		async function send_vision(url, payload, image64) {
			// appendobj( cont, 'vai enviar' );
			myHeaders = new Headers({
				"Content-Type": "application/json"
			});
			// faz a requisicao com a api, via ajax
			$.ajax({
				type: "POST",
				beforeSend: function(request) {
					request.setRequestHeader("Content-Type", "application/json");
					// appendobj( cont, 'add header' );
				},
				url: url,
				dataType: 'json',
				data: JSON.stringify(payload),
				processData: false,
				success: function(result) {
					// appendobj( cont, 'chegou' );
					num = result.responses[0].labelAnnotations;
					for (var i = 0; i < num.length; i++) {
						nameobj = num[i].description;
						// rola a div para o final
						// scroll_btm(cont);
						// traduz
						// appendobj( cont, nameobj );
						translate(nameobj, image64);
					}
				}
			});
		}

		// busca a traducao
		function translate(nameobj, image64) {
			var url = 'https://translation.googleapis.com/language/translate/v2?key='+api_key2; // url para a api
			// obj
			var payload = {
				q :  nameobj,
				source :  'en' ,
				target :  'pt' ,
				format :  'text' 
			};

			// inicia a chamada para a api, enviando os parametros
			call_trans(url, payload, image64);
			// appendobj( cont, 'cliquei p tirar foto' );
		}

		// funcao precisa ser async, para fazer a requisicao ao translate
		async function call_trans(url, payload, image64) {
			// appendobj( cont, 'vai enviar' );
			myHeaders = new Headers({
				"Content-Type": "application/json"
			});
			// faz a requisicao com a api, via ajax
			$.ajax({
				type: "POST",
				beforeSend: function(request) {
					request.setRequestHeader("Content-Type", "application/json");
					// appendobj( cont, 'add header' );
				},
				url: url,
				dataType: 'json',
				data: JSON.stringify(payload),
				processData: false,
				success: function(result) {
					// appendobj( cont, 'chegou' );
					num = result.data.translations;
					for (var i = 0; i < num.length; i++) {
						nameobj = num[i].translatedText;
						// rola a div para o final
						// scroll_btm(cont);
						// traduz
						// appendobj( cont, nameobj );
						switch (nameobj) {
							case 'netbook':
							case 'computador portátil':
								up_img('3', image64, 'note');
							break;
							case 'gadget':
							case 'celular':
								up_img('1', image64, 'cel');
							break;
							case 'tecnologia':
							case 'placa-mãe':
								up_img('2', image64, 'placa');
							break;
						}
					}
				},
				complete: function() {
					// $('#load').hide();
				}
			});
		}

		function up_img(id, img, name) {
			$.ajax({
				url: '_assets/_php/up_img.php',
				// Aqui você deve preencher o tipo de dados que será lido,
				type:'POST',
				data: ({
					img: img,
					id: id
				}),
				// SUCESS é referente a função que será executada caso
				// ele consiga ler a fonte de dados com sucesso.
				// O parâmetro dentro da função se refere ao nome da variável
				// que você vai dar para ler esse objeto.
				success: function(resposta){
					// Confere se houve erro e o imprime
					if(resposta == "ERRO"){
						alert('imagem nao aceita, tente novamente');
					}else{
						window.location.href = "produto.php?name="+name+"&id="+id;
						// alert(resposta)
					}
				}
			});
		}

		// add o objeto ao txt
		function appendobj(cont, obj) {
			var element = document.createElement('p');
			element.setAttribute('id', 'bs64');
			element.innerHTML = obj;
			cont.appendChild(element);
		}

		function scroll_btm(cont) {
			$(scrollingElement).animate({
				scrollTop: cont.scrollHeight
			}, 500);
		}

		function readURL(input) {
		    if (input.files && input.files[0]) {
		        var reader = new FileReader();
		        reader.onload = function (e) {
					new_img64 = e.target.result;
					// preview
		            // $('#your_img_id').attr('src', new_img64);
		          	// alert('foto: ' + e.target.result);
		          	$('#load').show();
					go_api(new_img64);
		        }
		        reader.readAsDataURL(input.files[0]);

		    }
		}

		function go_api(image64) {
			var image64 = image64.replace('data:image/png;base64,', ''); // retira o base64
			var image64 = image64.replace('data:image/jpeg;base64,', ''); // retira o base64
			var image64 = image64.replace('data:image/jpg;base64,', ''); // retira o base64
			var url = 'https://vision.googleapis.com/v1/images:annotate?alt=json&key='+api_key; // url para a api
			// obj
			var requests = {
				image : { content : image64 },
				features : { type : "LABEL_DETECTION", maxResults : 3 }
			};
			var payload = { requests };
			// inicia a chamada para a api, enviando os parametros
			send_vision(url, payload, image64);
			// appendobj( cont, 'cliquei p tirar foto' );
		}


		$(".cameraInput").change(function(){
		    readURL(this);
		});

});