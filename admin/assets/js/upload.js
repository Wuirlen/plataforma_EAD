$(document).ready(function(){
    // File type validation
	$("#arquivo").change(function(){
		const file = $(this)[0].files[0]
		const fileReader = new FileReader()
		fileReader.onloadend = function(){
			$("#imgUp").attr("src",fileReader.result)
		}

		fileReader.readAsDataURL(file)
	})
	
   /* $("#arquivo").change(function(){    	
        var allowedTypes = ['application/pdf', 'application/msword', 'application/vnd.ms-office', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
        var file = this.files[0];
        var fileType = file.type;
        if(!allowedTypes.includes(fileType)){
            alert('Por favor selecione um arquivo (PDF/DOC/DOCX/JPEG/JPG/PNG/GIF).');
            $("#arquivo").val('');
            return false;
        }else{
        	$("#imgUp").attr("src", base_img + data.msg);
        }
    });*/
});
/*
function upload(nome){
	var data = new FormData();
	var arquivos = $('#arquivo')[0].files;
	if(arquivos.length > 0) {
		data.append('arquivo', arquivos[0]);
		data.append('campo', nome);		
		$.ajax({
			type:'POST',
			url:base_url + 'upload/fazer_upload_jquery',
			data:data,
			contentType:false,
			processData:false,
			dataType: "json",
			beforeSend: function(){
				abrirModal("#janela1");
			},
            error:function(){
                $('#uploadStatus').html('<p style="color:#EA4335;">Falha no arquivo, tente novamente.</p>');
            },
			success:function(data){
				$("#imgUp").attr("src", base_img + data.msg);				
			},
			complete: function(data){
				fecharModal();
			}
		});
	}
}
*/
function valida_arquivo (nome){	
	var elemento = $("#"+nome);	;
	var allowedTypes = ['application/pdf', 'application/msword', 'application/vnd.ms-office', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
	var file = elemento[0].files[0];
	var fileType = file.type;
	if(!allowedTypes.includes(fileType)){
	    alert('Por favor selecione um arquivo (PDF/DOC/DOCX/JPEG/JPG/PNG/GIF).');
	    $("#fileInput").val('');
	    return false;
	}else{
		$(".bt_foto").hide();
		$("#bt_" +nome).show();
	}   
}

function upload_geral(nome){	
	var data = new FormData();
	var arquivos = $('#arquivo')[0].files;
	if(arquivos.length > 0) {
		data.append('arquivo', arquivos[0]);
		data.append('id_curso', $("#id_curso").val());
		data.append('id_aula', $("#id_aula").val());
		data.append('titulo', $("#titulo").val());	
		$.ajax({
			type:'POST',
			url:base_url + 'aula/upload',
			data:data,
			contentType:false,
			processData:false,
			dataType: "json",
			beforeSend: function(){
				abrirModal("#janela1");
			},
            error:function(){
                $('#uploadStatus').html('<p style="color:#EA4335;">Falha no arquivo, tente novamente.</p>');
            },
			success:function(data){
				$("#imgUp").attr("src", base_img + data.msg);				
			},
			complete: function(data){
				fecharModal();
			}
		});
	}
}

