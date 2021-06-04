
function pegaArquivo(files){
	var tipoArquivo = ["application/vnd.openxmlformats-officedocument.spreadsheetml.sheet","application/vnd.ms-excel"];
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
			$("#imgUp").attr("src","https://static.wixstatic.com/media/321e0b_5689d04981b54079bb78989a31d9141a~mv2.png/v1/fill/w_292,h_158,al_c,q_85,usm_0.66_1.00_0.01/excel%20logo.webp");
		}
		fileReader.readAsDataURL(file);
	}
}
