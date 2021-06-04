function pegaArquivo(files){
	let valor = $("#arquivo").val();

	$("#arquivo").attr(valor, url_img);
	alert(	$("#arquivo").attr(valor, url_img));
	fileReader.readAsDataURL(file);

/*	if(!tipoArquivo.includes(tipo)){
		alert("tipo de Arquivo inválido");
		$("#arquivo").val("");
		$("#imgUp").attr("src",url_img + "img-usuario.png" );
		return false;
	}else{
		
	}*/
}

function upload(){
	var data = new FormData();
	var arquivos = $("#arquivo")[0].files;
	if(arquivos.length > 0){
		data.append("arquivo", arquivos[0]);
		data.append("id_aula", $("#id_aula").val());
		data.append("id_curso", $("#id_curso").val());	
		data.append("titulo_download", $("#titulo_download").val());
	
		$.ajax({
			type: "POST",
			url: base_url + "aula/fazer_upload_jquery",
			data: data,
			contentType: false,
			processData: false,
			dataType: "json",
			success: function (data){
				if(data.erro<=0){
					lista_itens(data.lista);
				}else{
					alert(data.msg);
				}
			},
			error: function (){
				
			}
		});
	}
}
	 
	 function lista_itens(data){   
	   html = "<tr>";
	   for(var i in data){ 
		   html +=  '<td align="center">' + data[i].id_download     +  '</td>' + 	
			   		'<td align="center">' + data[i].titulo_download +  '</td>' + 
					'<td align="center">' + data[i].path_download   +  '</td>' +
					'<td width="10%" align="center"><a id="btn" onclick=alert_validacao('+ data[i].id_download +')  class="btn btn-vermelho d-inline-bock">Excluir</a></td></tr>';

		}
		$("#lista_down").html(html);
}


function alert_validacao(id_download){
	confirme = confirm('Deseja Realmente excluir?');
	if(confirme == true){
		$("#btn").append("class='btn btn-vermelho d-inline-bock'");
		window.location.href = 'http://localhost/projetos-tutiplast/mvc/admin/download/excluir/'+ id_download;
	}else{
		window.location.href = 'http://localhost/projetos-tutiplast/mvc/admin/aula/create';
	}
}

