# Plater

**Autores:** Beatriz Auer Mariano e Mateus Maioli Giacomin </br>
**Contato:** biaauer03@gmail.com, matgiacomin@gmail.com </br>
**Instituição:** Institudo Federal do Espírito Santo, Campus Serra </br>
**Curso:** técnico integrado em informática para internet

Nota: documentação do projeto será inserida em breve nos campos abaixo. Ver arquivos de documentação anexados.

## Introdução
Atualmente, com o surgimento de diversos aplicativos para delivery de alimentos e fast food, o hábito ou hobby de cozinhar se tornou obsoleto, principalemente entre as pessoas mais jovens. E aqueles que por ventura tentem se aventurar na cozinha várias vezes encontram receitas cuja execução não é tão simples quanto parece.

Assim, surgiu a ideia do Plater: um aplicativo e um site amigável, com a proposta de tornar a cozinha um lugar divertido e fácil de lidar. Com ele, as pessoas podem compartilhar suas próprias receitas com outras pessoas, salvar as receitas enviadas por outros usuários e se aventurar em novas gastronomias.

Por limitação de tempo, o escopo do projeto foi reduzido inicialmente em dois módulos:

| Versão | Funcionalidades |
| ------------ | ------------ |
|1| Login e cadastro de usuários; seguir usuários; exibição, criação, favoritagem, filtragem, avaliação e alteração de rendimento de receitas  |
|2| Criação e gerenciamento de despensa virtual, receitas com uso da despensa  |

Porém, existem infinitas outras funcionalidades em nossa mente que sonhamos em implementar ainda! Esse projeto está apenas começando, apenas nascendo.

[Clique aqui para ver o arquivo de apresentação do tema.](https://github.com/auerbeatriz/plater-web/blob/761f14a4abced02bab9ba4e162661bf168d248aa/doc/definicaotema.pdf)

## Project Model Canvas (PMC)
[Você pode conferir o quadro do projeto clicando aqui.](https://github.com/auerbeatriz/plater-web/blob/dea4d084fb6a8cca18ce5e4d0eb6edc1dd212926/doc/pmc.pdf)

## Descrição do mini-mundo
Plater é uma plataforma web e aplicativo móvel que permite aos usuários, por meio de login ou cadastro, acessar receitas compartilhadas pelos usuários no sistema. O usuário poderá criar, acessar, filtrar, favoritar e avaliar receitas, seguir outros usuários e cadastrar uma despensa virtual com os ingredientes que possui em casa. A despensa poderá ser alterada a qualquer momento pelo usuário, assim como as receitas que criou. As receitas serão exibidas marcando os ingredientes de acordo com a disponibilidade na despensa do usuário. O usuário também será capaz de alterar o rendimento da receita, e os ingredientes serão redimensionados proporcionalmente. Ao marcar que fez uma receita, o usuário terá direito a avaliá-la com uma nota de 1 a 5, que será usada para calcular a média de avaliações de receita e classificá-la como prioridade de exibição em filtragens ou não. Além disso, os ingredientes da receita poderão ser descontados da despensa do usuário, se assim desejar.

## Descrição dos requisitos
### Requisitos Funcionais
### Requisitos Não Funcionais
## Modelo Conceitual / Classe do projeto
## Projeto do sistema
## Telas do sistema

[Clique aqui para fazer o download da prototipagem do sistema web.](https://github.com/auerbeatriz/plater-web/raw/main/doc/prototipagem_web/Imagens%20-%20wireframes%20web%20Plater.zip)

## Blocos de código

#### Botões para login com google e facebook
Nota: usar mesmo estilo de #btnCadastrar (incluindo :hover) de **cadastro.html**

`<p> ou </p>
<button class="botoes" id="btnCadGoogle"> Login com o Google </button> </br>
<button class="botoes" id="btnCadFacebook"> Cadastrar com o Facebook </button> </br>
</br>` 

## Referência / consulta de códigos

VALNEY, Mário. **Como colocar o login do Google no meu site?**. Mário Valney, 2015. Disponível em: <[https://mariovalney.com/como-colocar-o-login-do-google-no-meu-site/](http://https://mariovalney.com/como-colocar-o-login-do-google-no-meu-site/ "https://mariovalney.com/como-colocar-o-login-do-google-no-meu-site/")>. Acesso em: 10 julho 2021.
