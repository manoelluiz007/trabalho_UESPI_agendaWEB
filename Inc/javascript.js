	/* Terceira Avaliacao da Disciplina Programacao 3 WEB
	 * Desenvolvido por
	 *		Manoel Luiz de Carvalho Melo
	 */
	 
function mascara(o,f){
	v_obj=o
	v_fun=f
	setTimeout("execmascara()",1)
}
function execmascara(){
	v_obj.value=v_fun(v_obj.value)
}
/////////////////////////////////////////////////////////////////////////////////////////
function mdata(v){
	v=v.replace(/\D/g,"")                    //Remove tudo o que não é dígito
    v=v.replace(/(\d{2})(\d)/,"$1/$2")       //Coloca um / entre o segundo e o terceiro dígitos
    v=v.replace(/(\d{2})(\d)/,"$1/$2")       //Coloca um / entre o quarto e o quito dígitos
    return v
}
function mnum(v){
    v=v.replace(/\D/g,"")                   //Remove tudo o que não é dígito
    return v
}
////////////////////////////////////////////////////////////////////////////////////////
function id( el ){
	return document.getElementById( el );
}
window.onload = function(){
//	id('telefone').onkeyup = function(){
//		mascara( this, mtel );
//	}
//	id('cpf').onkeyup = function(){
//		mascara( this, mcpf );
//	}
}
