# Plater

**Autores:** Beatriz Auer Mariano e Mateus Maioli Giacomin </br>
**Contato:** biaauer03@gmail.com, matgiacomin@gmail.com </br>
**Instituição:** Institudo Federal do Espírito Santo, Campus Serra </br>
**Curso:** técnico integrado em informática para internet

## Introdução
Atualmente, com o surgimento de diversos aplicativos para delivery de alimentos e fast food, o hábito ou hobby de cozinhar se tornou obsoleto, principalemente entre as pessoas mais jovens. E aqueles que por ventura tentem se aventurar na cozinha várias vezes encontram receitas cuja execução não é tão simples quanto parece.

Assim, surgiu a ideia do Plater: um aplicativo amigável com a proposta de tornar a cozinha um lugar divertido e fácil de lidar. Com ele, as pessoas podem acessar receitas e se aventurar em novas gastronomias.

Por limitação de tempo, o escopo do projeto foi reduzido para a produção de um módulo, segmentado em duas versões:

| Versão | Funcionalidades |
| ------------ | ------------ |
|1| Login e cadastro de usuários; controle de informações de conta; visualização, favoritagem, segmentação em categorias e alteração de rendimento de receitas. |
|2| Criação e avaliação de receitas; interações entre os usuários (seguir, por exemplo)  |

Existem ainda infinitas outras funcionalidades em nossa mente que sonhamos em implementar! Esse projeto está apenas começando, apenas nascendo.

[Clique aqui para ver o arquivo de apresentação do tema.](https://github.com/auerbeatriz/plater-web/blob/761f14a4abced02bab9ba4e162661bf168d248aa/doc/definicaotema.pdf)

*Durante todo o percurso até aqui, várias funcionalidades tiveram que ter a sua implementação paralisada, por isso há mais funcionalidades previstas na apresentação do projeto, que é o que o **Plater** é de fato, do que o que será implementado como projeto integrador.*

## Project Model Canvas (PMC)
[Você pode conferir o quadro do projeto clicando aqui.](https://github.com/auerbeatriz/plater-web/blob/275060c76a3767e43d5ad9466ee396289990ea5e/doc/pmc.pdf)

## Descrição do mini-mundo
Plater é um aplicativo móvel que permite aos usuários, por meio de cadastro e login, criar uma conta e acessar as receitas no sistema. Primeiramente, o usuário poderá acessar, filtrar por categorias e favoritar as receitas. Em uma segunda versão, o usuário também poderá criar receitas e seguir outros usuários, para ter acesso às receitas deles. O usuário também será capaz de alterar o rendimento da receita, e os ingredientes serão redimensionados proporcionalmente. Na segunda versão, ainda, o usuário poderá avaliar uma receita com uma nota de 1 a 5, que será usada para calcular a média de avaliações dq receita e classificá-la como prioridade de exibição em filtragens (destaque, mais bem avaliadas, etc) ou não.

## Descrição dos requisitos
[Clique aqui para visualizar o backlog de requisitos do sistema](https://github.com/auerbeatriz/plater-web/blob/56859521e45377d247dafc5df731bd5a2d81f6d4/doc/Backlog%20de%20Requisitos%20Plater%20-%20M%C3%B3dulo%201.pdf)

## Modelo de Classe do projeto
[Clique aqui para visualizar o modelo de classes do projeto](https://github.com/auerbeatriz/plater-web/blob/83015619118087d7877eab2715db5fd754d6b13a/doc/Diagrama%20de%20Classe%20Plater.png)

## Modelos do banco de dados

**Modelo Conceitual:**
[Clique aqui para visualizar o modelo conceitual do banco de dados](https://github.com/auerbeatriz/plater-web/raw/83015619118087d7877eab2715db5fd754d6b13a/doc/Diagrama%20de%20Classe%20Plater.png)

**Modelo Lógico:**
[Clique aqui para visualizar o modelo lógico do banco de dados](https://github.com/auerbeatriz/plater-web/raw/main/doc/Modelo_Logico.png)

**Modelo físico:**
[Clique aqui para visualizar o modelo físico do banco de dados (script/backup)](https://github.com/auerbeatriz/plater-web/blob/c1677fa4d379e0f8bfb2b78814d12ad01daec2b0/doc/script_plater_bd.sql.pdf)

## Projeto do sistema
#### Do lado cliente web
    Não haverá sistema web

#### Do lado cliente mobile
     Java

#### Do lado servidor:
     Linguagem php
     Postgres como banco de dados 
     Heroku + Twilio Sendgrid (envio de e-mail) + Cloudinary (armazenamento de imagens)
     Serviço de DNS (cloudflare via get.tech)
     
     A aplicação web pode ser acessada em: [http://plater.tech/](http://plater.tech/)

## Telas do sistema

[Clique aqui para fazer o download da prototipagem do sistema móvel.](https://github.com/auerbeatriz/plater-web/raw/main/doc/Prototipagem%20m%C3%B3vel%20Plater%20-%20imagens.zip)

[Clique aqui para fazer o download das telas desenvolvidas do sistema (app real) até 13/12/21.](https://github.com/auerbeatriz/plater-web/raw/main/doc/telas_plater.zip)

## Lições aprendidas

10/06 (grupo): [Acesse o documento](https://github.com/auerbeatriz/plater-web/blob/29ce577d0fcc3a17d0984efd559fd4d8199f4519/doc/Canvas%20de%20Li%C3%A7%C3%B5es%20Aprendidas%20-%20Plater.pdf)

23/11 (beatriz): [Acesso do documento](https://github.com/auerbeatriz/plater-web/blob/29ce577d0fcc3a17d0984efd559fd4d8199f4519/doc/Li%C3%A7%C3%B5es%20aprendidas%20-%20Beatriz.pdf)

## Roadmap

[Clique aqui para visualizar o roadmap do projeto](https://github.com/auerbeatriz/plater-web/blob/29ce577d0fcc3a17d0984efd559fd4d8199f4519/doc/Roadmap-v2%20Plater.pdf)

## Plano de testes

[Clique aqui para visualizar o plano de testes do projeto](https://docs.google.com/spreadsheets/d/1zku7M4rGdRLX32uIreZFBYQzo-tcYPgKLh6cyLSQETw/edit?usp=sharing)

## Apresentação final

[Clique aqui para visualizar o arquivo de apresentação final do projeto](https://docs.google.com/presentation/d/1E2y09DQG028qIUpwRhuNc2xime8c_vuQOhY95nE0JNE/edit?usp=sharing)

## Referência / consulta de códigos

VALNEY, Mário. **Como colocar o login do Google no meu site?**. Mário Valney, 2015. Disponível em: <[https://mariovalney.com/como-colocar-o-login-do-google-no-meu-site/](http://https://mariovalney.com/como-colocar-o-login-do-google-no-meu-site/ "https://mariovalney.com/como-colocar-o-login-do-google-no-meu-site/")>. Acesso em: 10 julho 2021.
