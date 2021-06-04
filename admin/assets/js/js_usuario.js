
function pegaArquivo(files){
	var tipoArquivo = ["image/jpeg","image/png", "image/jpg", "image/gif"];
	var file = files[0];
	console.log(file);
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