
function pegaArquivo(files){
	var  tipoArquivo = ["image/jpeg","image/png", "image/jpg", "imag/gif"];
	var file = files[0];
	var tipo = file.type;
	if(!tipoArquivo.includes(tipo)){
		alert("tipo de Arquivo inválido");
		$("#arquivo").val("");
		$("#imgUp").attr("src",url_img + "img-usuario.png" );
		return false;
	}else{
		const fileReader = new FileReader();
		fileReader.onloadend = function(){
			$("#imgUp").attr("src", fileReader.result);
		}
		fileReader.readAsDataURL(file);
	}
}




function pegaAssinatura(files){
	var tipoArquivo = ["image/jpeg","image/png", "image/jpg", "imag/gif"];
	var file = files[0];
	var tipo = file.type;
	if(!tipoArquivo.includes(tipo)){
		alert("tipo de Arquivo inválido");
		$("#assinatura").val("");
		$("#imgUpAssinatura").attr("src",url_img + "img-usuario.png" );
		return false;
	}else{
		const fileReader = new FileReader();
		fileReader.onloadend = function(){
			$("#imgUpAssinatura").attr("src", fileReader.result);
		}
		fileReader.readAsDataURL(file);
	}
}

$(function () {
	/*** modal **/
	$("a[rel=modal]").click( function(ev){
        ev.preventDefault();
 
        var id = $(this).attr("href");                 
         tela(id);	
		
    });
 
    $("#mascara").click( function(){
        $(this).hide();
        $(".window").hide();
    });
 
    $('.fechar').click(function(ev){
        ev.preventDefault();
        $("#mascara").hide();
        $(".window").hide();
    });
	
	/*** fim modal 	**/ 

});	

function abrirModal(id){
    var alturaTela = $(document).height();
    var larguraTela = $(window).width();

    //colocando o fundo preto
    $('#mascara').css({'width':larguraTela,'height':alturaTela});
    $('#mascara').fadeIn(1000);	
    $('#mascara').fadeTo("slow",0.8);

    var left = ($(window).width() /2) - ( $(id).width() / 2 );
    var top = ($(window).height() / 2) - ( $(id).height() / 2 );

    $(id).css({'top':top,'left':left});
    $(id).show();
	$(window).scrollTop(0) ;
}

function fecharModal(){
	//inicio();	
	$("#mascara").hide();
    $(".window").hide();
}

function upload(){
	var data = new FormData();
	var arquivos = $("#arquivo")[0].files;
	if(arquivos.length > 0){
		data.append("arquivo", arquivos[0]);
		data.append("id_curso", $("#id_curso").val());	
		data.append("titulo_modulo", $("#titulo_modulo").val());
	
		$.ajax({
			type: "POST",
			url: base_url + "curso/fazer_upload_jquery",
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
		   html +=  '<td align="center">' + data[i].id_curso     +  '</td>' + 	
			   		'<td align="center">' + data[i].titulo_modulo +  '</td>' + 
					'<td align="center">' + data[i].id_modulo   +  '</td>' +
					'<td width="10%" align="center"><a id="btn" onclick=alert_validacao('+ data[i].id_modulo +')  class="btn btn-vermelho d-inline-bock">Excluir</a></td></tr>';

		}
		$("#lista_modulo").html(html);
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


