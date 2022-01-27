/* Fisico_Plater_BD: */

CREATE TABLE USUARIO (
    username varchar(30) PRIMARY KEY,
    email varchar(255) NOT NULL,
    nome varchar(255),
    senha char(60),
	recovery_code char(4),
    UNIQUE (username, email)
);

CREATE TABLE RECEITA (
    id_receita serial PRIMARY KEY UNIQUE,
    titulo_receita varchar(255) NOT NULL,
    descricao_receita text,
    tempo_preparo int,
    rendimento int,
    multimidia text,
    tipo_multimidia boolean,
    FK_CATEGORIA_id_categoria int NOT NULL,
    FK_TIPO_RENDIMENTO_id_tipo_rendimento int NOT NULL
);

CREATE TABLE PASSO_PREPARO (
    id_passo serial PRIMARY KEY UNIQUE,
    numero_sequencia int NOT NULL,
    instrucao text NOT NULL,
    FK_RECEITA_id_receita int NOT NULL
);

CREATE TABLE INGREDIENTE (
    id_ingrediente serial PRIMARY KEY UNIQUE,
    quantidade float NOT NULL,
    FK_RECEITA_id_receita int NOT NULL,
    FK_INSUMO_id_insumo int NOT NULL,
    FK_UNIDADE_MEDIDA_id_unidade_medida int NOT NULL
);

CREATE TABLE INSUMO (
    id_insumo serial PRIMARY KEY,
    nome_insumo varchar(50) NOT NULL,
    UNIQUE (id_insumo, nome_insumo)
);

CREATE TABLE CATEGORIA (
    id_categoria serial PRIMARY KEY,
    descricao varchar(30) NOT NULL,
    img_categoria text,
    UNIQUE (id_categoria, descricao)
);

CREATE TABLE UNIDADE_MEDIDA (
    id_unidade_medida serial PRIMARY KEY,
    unidade_medida varchar(20) NOT NULL,
    UNIQUE (id_unidade_medida, unidade_medida)
);

CREATE TABLE TIPO_RENDIMENTO (
    id_tipo_rendimento serial PRIMARY KEY,
    tipo_rendimento varchar(10) NOT NULL,
    UNIQUE (id_tipo_rendimento, tipo_rendimento)
);

CREATE TABLE USUARIO_FAVORITA_RECEITA (
    fk_USUARIO_username varchar(30),
    fk_RECEITA_id_receita int
);
 
ALTER TABLE RECEITA ADD CONSTRAINT FK_RECEITA_2
    FOREIGN KEY (FK_CATEGORIA_id_categoria)
    REFERENCES CATEGORIA (id_categoria)
    ON DELETE CASCADE;
 
ALTER TABLE RECEITA ADD CONSTRAINT FK_RECEITA_3
    FOREIGN KEY (FK_TIPO_RENDIMENTO_id_tipo_rendimento)
    REFERENCES TIPO_RENDIMENTO (id_tipo_rendimento)
    ON DELETE CASCADE;
 
ALTER TABLE PASSO_PREPARO ADD CONSTRAINT FK_PASSO_PREPARO_2
    FOREIGN KEY (FK_RECEITA_id_receita)
    REFERENCES RECEITA (id_receita)
    ON DELETE RESTRICT;
 
ALTER TABLE INGREDIENTE ADD CONSTRAINT FK_INGREDIENTE_2
    FOREIGN KEY (FK_RECEITA_id_receita)
    REFERENCES RECEITA (id_receita)
    ON DELETE RESTRICT;
 
ALTER TABLE INGREDIENTE ADD CONSTRAINT FK_INGREDIENTE_3
    FOREIGN KEY (FK_INSUMO_id_insumo)
    REFERENCES INSUMO (id_insumo)
    ON DELETE CASCADE;
 
ALTER TABLE INGREDIENTE ADD CONSTRAINT FK_INGREDIENTE_4
    FOREIGN KEY (FK_UNIDADE_MEDIDA_id_unidade_medida)
    REFERENCES UNIDADE_MEDIDA (id_unidade_medida)
    ON DELETE CASCADE;
 
ALTER TABLE USUARIO_FAVORITA_RECEITA ADD CONSTRAINT FK_USUARIO_FAVORITA_RECEITA_1
    FOREIGN KEY (fk_USUARIO_username)
    REFERENCES USUARIO (username)
    ON DELETE SET NULL;
 
ALTER TABLE USUARIO_FAVORITA_RECEITA ADD CONSTRAINT FK_USUARIO_FAVORITA_RECEITA_2
    FOREIGN KEY (fk_RECEITA_id_receita)
    REFERENCES RECEITA (id_receita)
    ON DELETE SET NULL;

/* INSERINDO DADOS */

    /* usuario */

    INSERT INTO usuario VALUES
    ('plater_chef', 'plater@plater.com', 'Plater', '36d49c9b8283b3590023391f3801a1ab');

    /* insumo */

    INSERT INTO insumo (nome_insumo)
    VALUES ('açúcar'),
            ('manteiga'),
            ('raspas de limão'),
            ('gemas de ovos'),
            ('farinha de trigo');

    /* unidade_medida */

    INSERT INTO unidade_medida (unidade_medida)
    VALUES ('xícara de chá de'),
            ('xícaras de chá de'),
            ('a gosto'),
            ('unidade de'),
            ('unidades de');

    /* categoria */

    INSERT INTO categoria (descricao) VALUES ('Biscoitos'), ('Doces');

    /* tipo_rendimento */

    INSERT INTO tipo_rendimento (tipo_rendimento) VALUES ('porções'), ('porção'), ('unidades'), ('unidade'), ('pessoas'), ('pessoa');

    /* receita */

    INSERT INTO receita (titulo_receita, descricao_receita, tempo_preparo, rendimento, multimidia, tipo_multimidia, FK_CATEGORIA_id_categoria, FK_TIPO_RENDIMENTO_id_tipo_rendimento)
    VALUES ('Biscoito Amanteigado', 'Minha receita pessoal e favorita. É um prazer adicioná-la nessa plataforma. Você também pode usar margarina no lugar de manteiga.', 65, 200, 'https://res.cloudinary.com/plater/image/upload/v1638446839/biscoitos_amanteigados_mi2rt7.jpg', true, 1, 3);
    /* ingrediente */

    INSERT INTO ingrediente (quantidade, FK_RECEITA_id_receita, FK_INSUMO_id_insumo, FK_UNIDADE_MEDIDA_id_unidade_medida)
    VALUES (0.5, 1, 1, 1),
            (0.5, 1, 2, 1),
            (1, 1, 3, 3),
            (2, 1, 4, 5),
            (2, 1, 5, 2);

    /* passo_preparo */

    INSERT INTO passo_preparo (numero_sequencia, instrucao, fk_RECEITA_id_receita)
    VALUES (1, 'Em uma vasilha ou na batedeira misture o açúcar, a manteiga, as raspas de limão e bata até obter um creme bem claro.', 1),
            (2, 'Acrescente as gemas, uma por vez, e misture bem até o creme voltar a ficar claro.', 1),
            (3, 'Junte a farinha de trigo e misture com a mão. Não trabalhe demais a massa. Ela deverá ficar uniforme e completamente misturada, sendo capaz de formar uma bola.', 1),
            (4, 'Abra a massa em uma superfície plana com ajuda de um rolo e farinha de trigo, tendo cuidado para não deixar a massa muito grossa ou fina. Modele os biscoitos da forma que preferir.', 1),
            (5, 'Leve os biscoitos para descansar na parte menos refrigerada da geladeira por cerca de 20 minutos.', 1),
            (6, 'Leve os biscoitos para assar em forno pré-aquecido em 200° por 15 minutos, ou até dourarem.', 1);
    
insert into categoria (descricao, img_categoria) 
values ('Pães','https://res.cloudinary.com/plater/image/upload/v1643237913/categories/different-types-of-bread-made-from-wheat-flour_jbq559.jpg'),
('Macarrão','https://res.cloudinary.com/plater/image/upload/v1643139092/categories/categories_jonathan-borba-UgaFu56WPmA-unsplash_u3oete-c_mfit_h_300_qhl4py.jpg');

insert into unidade_medida (unidade_medida)
values ('caixa de '), ('caixas de '), ('lata de '), ('latas de '), ('gramas de '), ('ml de '), ('litros de '), ('litro de '), ('kg de '), ('talo de '), ('talos de');

insert into insumo(nome_insumo)
values ('cacau em pó'), ('água morna'), ('azeite de oliva'), ('mel'), ('fermento biológico seco'), ('açúcar mascavo'), ('canela'), ('macarrão'), ('creme de leite'), ('atum defumado'), ('cebola'), ('alho'), ('azeitona'), ('ricota'), ('queijo mussarela ralado'), ('cebolinha verde');

insert into receita (titulo_receita, descricao_receita, tempo_preparo, rendimento, multimidia, tipo_multimidia, fk_categoria_id_categoria, fk_tipo_rendimento_id_tipo_rendimento)
values ('Bolo de chocolate amanteigado', 'Sempre use cacau em pó e manteiga ao invés dos seus "substitutos". Peinere a farinha de trigo antes de incorporar à massa. Rende 8 pedações de aproximadamente 150g. Separe os ingredientes antes de iniciar a receita. Apesar de feinho na foto, é maravilhoso', 60, 8, 'https://res.cloudinary.com/plater/image/upload/v1643237580/recipes/bolo_chocolate_amanteigado_1_x08m4y.png', true, 2, 1),
('Pão com cobertura de mel', 'A receita do pão é super versátil e pode ser usado tanto para receitas doces quanto para receitas salgadas.', 90, 8,'https://res.cloudinary.com/plater/image/upload/v1643237523/recipes/pao_mel_1_tn4a2l.png',true,4,1),
('Macarrão com patê de atum defumado', 'Se desejar, adicione manjericão fresco ao patê de atum, ou outro acompanhamento. Recomendo usar macarrão penne ou fusili.', 25, 4, 'https://res.cloudinary.com/plater/image/upload/v1643138684/recipes/macarrao_com_atum_mqz1v4.jpg', true, 5, 5),
('Esfirras abertas com recheio de queijo', 'Fique à vontade para adicionar o recheio que quiser. Rende 8 esfirras gigantes. Pique os talos da cebolinha.', 130, 8, 'https://res.cloudinary.com/plater/image/upload/v1643237261/recipes/esfirras_abertas_hdo9tn.png', true, 3, 1);


alter table ingrediente alter column quantidade type varchar(100);

insert into ingrediente(fk_receita_id_receita, quantidade, fk_unidade_medida_id_unidade_medida, fk_insumo_id_insumo)
values (4, '6', 5, 8), (4, '200', 14, 2), (4, '250', 14, 1), (4, '1/2', 1, 16), (4, '1', 1, 5), (4, '1', 8, 7);

insert into ingrediente(fk_receita_id_receita, quantidade, fk_unidade_medida_id_unidade_medida, fk_insumo_id_insumo)
values (5, '1', 1, 17), (5, '2', 9, 18), (5, '2', 9, 19), (5, '2', 7, 6), (5, '3 1/3', 2, 5), (5, '1 1/2', 8, 20), (5, '3', 9, 19), (5, '', 3, 6);

insert into ingrediente(fk_receita_id_receita, quantidade, fk_unidade_medida_id_unidade_medida, fk_insumo_id_insumo)
values (6, '500', 14, 23), (6, '1', 10, 24), (6, '1', 12, 25), (6, '', 3, 26), (6, '', 3, 27), (6, '', 3, 28), (6, '', 3, 18);

insert into ingrediente(fk_receita_id_receita, quantidade, fk_unidade_medida_id_unidade_medida, fk_insumo_id_insumo)
values (7, '12', 14, 20), (7, '3', 7, 1), (7, '200', 15, 17), (7, '50', 15, 18), (7, '400', 14, 5), (7, '', 3, 6), (7, '200', 14, 29), (7, '150', 14, 30), (7,'2', 20, 31);

insert into passo_preparo (numero_sequencia, instrucao, fk_receita_id_receita)
values (1, 'Preaqueça o forno em 180º.', 4),
(2, 'Unte uma forma média, do formato de sua preferência, com margarina ou manteiga e farinha de trigo.', 4),
(3, 'Separe as gemas das claras dos ovos. Reserve as claras.', 4),
(4, 'Bata as gemas e o açúcar em velocidade alta (recomendo usar batedeira) até formarem um creme bem claro.', 4),
(5, 'Acrescente a manteiga e o cacau em pó e continue batendo por mais 5 minutos em velocidade máxima.', 4),
(6, 'Adicione a farinha de trigo à massa. Use um fuê, se tiver, em movimentos leves de baixo para cima. Mexa apenas o suficiente para a farinha de trigo incorporar na massa.', 4),
(7, 'Bata as claras até formarem uma espuma (claras em neve) e a incorpore à massa.', 4),
(8, 'Adicione o fermento à massa.', 4),
(9, 'Coloque a massa na forma untada e leve ao forno por aproximadamente 25 a 35 minutos. Experimente inserir um palito de dentes; se sair limpo, o bolo está pronto.', 4),
(10, 'Desenforme e sirva frio. A massa é excelente para rechear e usar a cobertura de sua preferência.', 4);

insert into passo_preparo (numero_sequencia, instrucao, fk_receita_id_receita)
values (1, 'Pré-aqueça o forno a 190º.', 5),
(2, 'Coloque a água, o azeite, o mel, as colheres de sopa de sal, a farinha de trigo e o fermento em uma vasilha grande e misture.', 5),
(3, 'Quando a massa começar a dar liga, sove-a até deixar de grudas nas mãos.', 5),
(4, 'Deixe a massa descansar por aproximadamente 30 minutos, até duplicar de tamanho.', 5),
(5, 'Corte a massa em 8 pedaços e faça bolinhas. É possível cortar em mais pedaços, depende do tamanho da massa e do peso de cada pedaço.', 5),
(6, 'Deixe descansar por mais 10 a 15 minutos.', 5),
(7, 'Em uma outra vasilha, misture a manteiga, o açúcar mascavo, a canela, o mel e uma quantidade a gosto de sal até formar uma pasta.', 5),
(8, 'Unte a assadeira que usará para assar os pães com a pasta formada.', 5),
(9, 'Coloque os pães na assadeira, sobre a pasta, e deixe assar a 190º por aproximadamente 30 minutos, ou até os pões dourarem.', 5);

insert into passo_preparo (numero_sequencia, instrucao, fk_receita_id_receita)
values (1, 'Em uma panela, refogue a cebola no azeite até dourar.', 6),
(2, 'Adicione o alho à cebola e espere dourar levemente.', 6),
(3, 'Acrescente o atum à panela e misture-o com o alho e a cebola.', 6),
(4, 'Adicione o creme de leite na panela e misture.', 6),
(5, 'Após misturar bem o creme de leite e o atum, acrescente as azeitonas.', 6),
(6, 'Espere o creme de leite reduzir um pouco (o patê engrossar), e desligue a panela. Tampe para que não esfrie.', 6),
(7, 'Cozinhe o macarrão seguindo as instruções da embalagem do mesmo.', 6),
(8, 'Escorra o macarrão e transfira-o para um refratário.', 6),
(9, 'Sirva o macarrão e o patê ainda quentes. Fica a sua escolha misturá-los antes de servir ou deixar a encargo de cada pessoa escolher suas porções.', 6);

insert into passo_preparo (numero_sequencia, instrucao, fk_receita_id_receita)
values (1, 'Em uma vasilha, adicione o fermento, a água, o açúcar. Mexa até o açúcar dissolver e deixe descansar por 15 minutos', 7),
(2, 'Depois, adicione o azeite e, aos poucos, a farinha de trigo. Quando a massa começar a ficar pesada, deixe a colher de lado e comece a misturar e sovar a massa com as mãos, até desgrudar.', 7),
(3, 'Deixe a massa descansar e crescer por 45 minutos.', 7),
(4, 'Em uma vasilha à parte, misture a ricota, o queijo e a cebolinha. Reserve.', 7),
(5, 'Separa a massa na quantidade de porções desejadas. Abra cada um dela com a mão ou com auxílio de um rolo de massas, com o cuidado de não deixar a espessura nem muito fina e nem muito grossa.', 7),
(6, 'Dobre as estremidades da massa para dentro, de modo a formar uma borda.', 7),
(7, 'Recheie com a mistura feita anteriormente.', 7),
(8, 'Leve para assar em forno pré-aquecido a 200ºC por 30 minutos, ou até a massa dourar.', 7);

insert into unidade_medida (unidade_medida) values ('colher de chá'),
	('colheres de chá'), ('colher de sopa'), ('colheres de sopa');


insert into categoria(descricao, img_categoria) values ('Lanches', 'https://res.cloudinary.com/plater/image/upload/v1642786344/categories/lanches_rnoy05.jpg');


insert into receita (titulo_receita, 
		descricao_receita, 
		tempo_preparo, 
		rendimento, 
		multimidia, 
		tipo_multimidia, 
		fk_categoria_id_categoria, 
		fk_tipo_rendimento_id_tipo_rendimento)
values ('Waffle Americano',
		'Receita obtida do canal de youtube "Cozinha Legal". Instagram do criador: @cozinhalegalblog. Todos os direitos do uso de imagem e do material foram concedidos pelo criador. Dica para a receita: sempre use manteiga, evite margarina ou óleo.',
		25,
		6,
		'https://www.youtube.com/watch?v=G3ww7VI5964&ab_channel=CozinhaLegal',
		false,
		3,
		1);

insert into insumo (nome_insumo)
values ('sal'),
		('fermento químico em pó'),
		('ovos'),
		('ovo'),
		('leite'),
		('leite morno'),
		('leite quente'),
		('manteiga derretida'),
		('extrato de baunilha'),
		('favo de baunilha');


insert into ingrediente (quantidade,
			fk_receita_id_receita,
			fk_insumo_id_insumo,
			fk_unidade_medida_id_unidade_medida)
values (2, 2, 5, 2),
	(1, 2, 6, 6),
	(4, 2, 7, 7),
	(2, 2, 1, 9),
	(2, 2, 8, 5),
	(1.5, 2, 11, 2),
	(1.3, 2, 13, 2),
	(1, 2, 15, 6);


insert into passo_preparo (numero_sequencia, instrucao, fk_receita_id_receita)
values (1, 'Em uma tigela grande, misture a farinha, o sal, o fermento e o açúcar. Reserve.', 2),
	(2, 'Pré-aqueça a máquina de waffle até a temperatura desejada (eu deixo no máximo).', 2),
	(3, 'Em uma tigela separada, bata os ovos. Acrescente o leite, a manteiga e a baunilha. Despeje a mistura de leite na mistura de farinha. Bata com um fouet até misturar.', 2),
	(4, 'Coloque a massa na máquina de waffle pré-aquecida. Cozinhe os waffles até dourarem e ficarem crocantes. Sirva imediatamente.', 2);

update receita set multimidia='https://res.cloudinary.com/plater/image/upload/v1643248921/recipes/IMG_20190717_170519408_HDR_1_l85j4k.png' where id_receita =5;
update receita set multimidia='https://res.cloudinary.com/plater/image/upload/v1643248917/recipes/IMG_20200611_200050872_1_hhzkol.png' where id_receita =7;
