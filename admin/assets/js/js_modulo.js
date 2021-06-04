function upload(){
	var data = new FormData();
	var arquivos = $("#arquivo")[0].files;
	if(arquivos.length > 0){
		data.append("arquivo", arquivos[0]);
		data.append("id_modulo", $("#id_modulo").val());
		data.append("id_curso", $("#id_curso").val());	
		data.append("titulo_aula", $("#titulo_aula").val());
		data.append("embed_youtube", $("#embed_youtube").val());
		data.append("duracao_aula", $("#QuantidadeHoras").val());
		$.ajax({
			type: "POST",
			url:  base_url + "modulo/fazer_upload_jquery",
			data: data,
			contentType: false,
			processData: false,
			dataType: "json",
			success: function (data){
				if(data.erro<=0){
					lista_itens(data.lista);
					$("#titulo_aula").val("");
					$("#embed_youtube").val("");
					$("#QuantidadeHoras").val("");
					$("#arquivo").val("");
				}else{
					alert(data.msg);
				}
			},
			error: function (){
				
			}
		});
	  }else{
		data.append("id_modulo", $("#id_modulo").val());
		data.append("id_curso", $("#id_curso").val());	
		data.append("titulo_aula", $("#titulo_aula").val());
		data.append("embed_youtube", $("#embed_youtube").val());
		data.append("duracao_aula", $("#QuantidadeHoras").val());
		
		$.ajax({
			type: "POST",
			url: base_url + "modulo/fazer_upload_jquery",
			data: data,
			contentType: false,
			processData: false,
			dataType: "json",
			success: function (data){
				console.log(data);
				if(data.erro<=0){
					lista_itens(data.lista);
					$("#titulo_aula").val("");
					$("#embed_youtube").val("");
					$("#QuantidadeHoras").val("");
					
				}else{
					alert(data.msg);
				}
			},
			error: function (){
				
			}
		});
	  }
}
function upload_avaliacao(){
	var data = new FormData();
	    data.append("id_modulo", $("#id_modulo").val());
		data.append("titulo_pergunta", $("#titulo_pergunta").val());
		data.append("questao_a", $("#questao_a").val());	
		data.append("questao_b", $("#questao_b").val());
		data.append("questao_c", $("#questao_c").val());
		data.append("questao_d", $("#questao_d").val());
		data.append("resposta", $("#resposta").val());
		$.ajax({
			type: "POST",
			url:  base_url + "modulo/fazer_upload_avaliacao_jquery",
			data: data,
			contentType: false,
			processData: false,
			dataType: "json",
			success: function (data){
				if(data.erro<=0){
					lista_itens_avaliacao(data.lista);
					$("#titulo_pergunta").val("");
					$("#questao_a").val("");
					$("#questao_b").val("");
					$("#questao_c").val("");
					$("#questao_d").val("");
					$("#resposta").val("");
				}else{
					alert(data.msg);
				}
			},
			error: function (){
				
			}
		});
	  
}

	 function lista_itens(data){   
	   html = "<tr>";
	   for(var i in data){ 
		   html += 	
			   		'<td align="center">' + data[i].titulo_aula +  '</td>' + 
					'<td align="center"><a id="btn" onclick=alert_validacao_edit('+ data[i].id_aula +')  class="btn editar d-inline-bock">Editar</a></td>' +
					'<td width="10%" align="center"><a id="btn-2" onclick=alert_validacao('+ data[i].id_aula +')  class="btn btn-vermelho d-inline-bock">Excluir</a></td></tr>';

		}
		$("#lista_down").html(html);
    }
	function lista_itens_avaliacao(data){   
		html = "<tr>";
		for(var i in data){ 
			html += 	
						'<td align="center">' + data[i].titulo_pergunta +  '</td>' + 
					 '<td align="center"><a id="btn3" onclick=alert_validacao_edit_avaliacao('+ data[i].id_avaliacao +')  class="btn editar d-inline-bock">Editar</a></td>' +
					 '<td width="10%" align="center"><a id="btn-4" onclick=alert_validacao_avaliacao('+ data[i].id_avaliacao +')  class="btn btn-vermelho d-inline-bock">Excluir</a></td></tr>';
 
		 }
		 $("#lista_avaliacao").html(html);
	 }
function alert_validacao(id_aula){
	confirme = confirm('Deseja Realmente excluir?');
	if(confirme == true){
		$("#btn-2").append("class='btn btn-vermelho d-inline-bock'");
		window.location.href = 'http://localhost/projetos-tutiplast/mvc/admin/aula/excluir/'+ id_aula;
	}else{
		window.location.href = 'http://localhost/projetos-tutiplast/mvc/admin/modulo/create';
	}
}
function alert_validacao_avaliacao(id_avaliacao){
	confirme = confirm('Deseja Realmente excluir?');
	if(confirme == true){
		$("#btn-4").append("class='btn btn-vermelho d-inline-bock'");
		window.location.href = 'http://localhost/projetos-tutiplast/mvc/admin/avaliacao/excluir/'+ id_avaliacao;
	}else{
		window.location.href = 'http://localhost/projetos-tutiplast/mvc/admin/modulo/create';
	}
}
function alert_validacao_edit_avaliacao(id_avaliacao){
	$("#btn-3").append("class='btn editar d-inline-bock'");
	window.location.href = 'http://localhost/projetos-tutiplast/mvc/admin/avaliacao/edit/'+ id_avaliacao;
}
function alert_validacao_edit(id_aula){
		$("#btn").append("class='btn editar d-inline-bock'");
		window.location.href = 'http://localhost/projetos-tutiplast/mvc/admin/aula/edit/'+ id_aula;
}


