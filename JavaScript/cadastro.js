/*Essa função irá validar os dados inseridos no formulário.
    - Se já existe um usuário com o mesmo nome_usuario |
    - Se o e-mail já está cadastrado                   | !!!! Necessário consulta ao banco de dados -> atualizar posteriormente !!!!
    (ok) Se as senhas inseridas conferem
    (ok) Se a senha tem pelo menos 6 caracteres
*/
function validar() {
	if (infoCadastro.senha.value != infoCadastro.confSenha.value) { 
		infoCadastro.senha.style.borderColor = 'red';
		infoCadastro.confSenha.style.borderColor = 'red';
		document.getElementById("divInformeErros").innerHTML += "<p>As senhas informadas devem ser iguais.</p>";
	}
	if (infoCadastro.senha.value.length < 6) {
		infoCadastro.senha.style.borderColor = 'red';
		document.getElementById("divInformeErros").innerHTML += "<p>A senha deve possuir ao menos 6 caracteres.</p>";
	}
	if (infoCadastro.nomeCompleto.value == '' || infoCadastro.nomeUsuario.value == '' || infoCadastro.email.value == '' || infoCadastro.senha.value == '' || infoCadastro.confSenha.value == '') {
		document.getElementById("divInformeErros").innerHTML += "<p>Todos os campos devem ser preenchidos.</p>"
	}
}