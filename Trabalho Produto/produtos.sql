-- Active: 1695837195664@@localhost@3306@produtos
/* Tabela de Produto */
CREATE TABLE produtos (
	id INTEGER NOT NULL AUTO_INCREMENT,
	descricao VARCHAR(50) NOT NULL,
	un_medida VARCHAR(50) NOT NULL,
	CONSTRAINT pk_produtos PRIMARY KEY (id)
);
