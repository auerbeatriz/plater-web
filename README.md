# Plater

**Autores:** Beatriz Auer Mariano e Mateus Maioli Giacomin </br>
**Contato:** biaauer03@gmail.com, matgiacomin@gmail.com </br>
**Instituição:** Institudo Federal do Espírito Santo, Campus Serra </br>
**Curso:** técnico integrado em informática para internet

Nota: documentação do projeto será inserida em breve nos campos abaixo. Ver arquivos de documentação anexados.

## Introdução
Atualmente, com o surgimento de diversos aplicativos para delivery de alimentos e fast food, o hábito ou hobby de cozinhar se tornou obsoleto, principalemente entre as pessoas mais jovens. E aqueles que por ventura tentem se aventurar na cozinha várias vezes encontram receitas cuja execução não é tão simples quanto parece.

Assim, surgiu a ideia do Plater: um aplicativo e um site amigável, com a proposta de tornar a cozinha um lugar divertido e fácil de lidar. Com ele, as pessoas podem compartilhar suas próprias receitas com outras pessoas, salvar as receitas enviadas por outros usuários e se aventurar em novas gastronomias.

Por limitação de tempo, o escopo do projeto foi reduzido inicialmente em três versões:

| Versão | Funcionalidades |
| ------------ | ------------ |
|1| Login e cadastro de usuários, criação de receitas, salvar receitas, exibição de receitas  |
|2| Criação e gerenciamento de despensa virtual, receitas com uso da despensa  |
|3| Execução de receitas com passo a passo  |

Porém, existem infinitas outras funcionalidades em nossa mente que sonhamos em implementar ainda! Esse projeto está apenas começando, apenas nascendo.

[Clique aqui para ver o arquivo de apresentação do tema.](https://github.com/auerbeatriz/plater/blob/3d0b43e530574d97b7c020e0b8c9a886dfc91432/Arquivos%20de%20documenta%C3%A7%C3%A3o/Defini%C3%A7%C3%A3o%20do%20tema%20-%20Beatriz%20e%20Mateus%20-%20Plater.pdf)

## Project Model Canvas (PMC)
[Você pode conferir o quadro do projeto clicando aqui.](https://github.com/auerbeatriz/plater/blob/55c0a6a83efa6ba57e09ebf635aa5e05642bce75/Arquivos%20de%20documenta%C3%A7%C3%A3o/PMC%20Plater.pdf)

## Descrição do mini-mundo
Plater é um sistema web e um aplicativo móvel que permite aos usuários o compartilhamento de receitas entre si. Ele permite aos usuários fazer login ou cadastro no sistema. O usuário também poderá cadastrar em uma despensa virtual com todos os ingredientes que possuir em casa, podendo alterá-los de acordo com a quantidade disponível. O usuário então terá acesso a todas as receitas do site, que estarão dispostas na página Home. Essas receitas poderão ser filtradas utilizando tags (palavras que identificam as receitas, como "bolo"), pela checkbox disponível na página ou por filtros rápidos. As receitas melhores avaliadas no site devem ganhar destaque na página Home. Quando um usuário selecionar uma receita para ver, uma página com todos os seus dados (título, descrição, criador, média das avaliações dos usuários, tempo de preparo, rendimento e sistema de medidas utilizado, ingredientes e modo de preparo) devem ser exibidos. O usuário deverá ser capaz de alterar o rendimento e o sistema de medidas da receita e isso ter impacto na quantidade de ingredientes. Caso o usuário não tenha algum ingrediente disponível na despensa ou em quantidade insuficiente, o ingrediente deverá ser marcado com uma cor diferente. O usuário poderá fazer a receita com um passo a passo guiado, e ao finalizar a quantidade de ingredientes usados deve ser subtraída do total da despensa. O usuário poderá favoritar receitas de outros usuários e criar as suas próprias receitas, onde poderá também criar um passo a passo guiado. O usuário poderá alterar dados do cadastro em sua página e poderá seguir e visitar a página de outros usuários cadastrados no Plater.

## Descrição dos requisitos
### Requisitos Funcionais
### Requisitos Não Funcionais
## Modelo Conceitual / Classe do projeto
## Projeto do sistema
## Telas do sistema

[Clique aqui para fazer o download da prototipagem do sistema web.](https://github.com/auerbeatriz/plater/blob/55c0a6a83efa6ba57e09ebf635aa5e05642bce75/Prototipagem%20web/Imagens%20-%20wireframes%20web%20Plater.zip)

[Clique aqui para fazer o download da prototipagem do sistema mobile.](https://github.com/auerbeatriz/plater/blob/55c0a6a83efa6ba57e09ebf635aa5e05642bce75/Prototipagem%20m%C3%B3vel/Prototipagem%20m%C3%B3vel%20Plater%20-%20imagens.zip)

## Blocos de código

#### Botões para login com google e facebook
Nota: usar mesmo estilo de #btnCadastrar (incluindo :hover) de **cadastro.html**

`<p> ou </p>
<button class="botoes" id="btnCadGoogle"> Login com o Google </button> </br>
<button class="botoes" id="btnCadFacebook"> Cadastrar com o Facebook </button> </br>
</br>` 

## Referência / consulta de códigos

VALNEY, Mário. **Como colocar o login do Google no meu site?**. Mário Valney, 2015. Disponível em: <[https://mariovalney.com/como-colocar-o-login-do-google-no-meu-site/](http://https://mariovalney.com/como-colocar-o-login-do-google-no-meu-site/ "https://mariovalney.com/como-colocar-o-login-do-google-no-meu-site/")>. Acesso em: 10 julho 2021.
