-- *********************************************
-- * SQL MySQL generation                      
-- *--------------------------------------------
-- * DB-MAIN version: 11.0.2              
-- * Generator date: Sep 14 2021              
-- * Generation date: Wed Dec 18 21:08:33 2024 
-- * LUN file: C:\Users\Lorenzo\Documents\UNIVERSITA\Tecnologie Web\MindBazaar\MindBazaar\MindBazaar.lun 
-- * Schema: MindBazaar 
-- ********************************************* 


-- Database Section
-- ________________ 

create database MindBazaar;
use MindBazaar;


-- Tables Section
-- _____________ 

create table ARTICOLI (
     id_prodotto int not null,
     formato varchar(20) not null,
     durata varchar(15) not null,
     intensita int not null,
     prezzo decimal(3,2) not null,
     disponibilita int not null,
     versione int not null,
     constraint ID_ARTICOLO_ID primary key (id_prodotto, versione));

create table ARTICOLI_IN_CARRELLO (
     id_prodotto int not null,
     versione_articolo int not null,
     username varchar(20) not null,
     quantita int not null,
     constraint ID_ARTICOLO_IN_CARRELLO_ID primary key (id_prodotto, versione_articolo, username));

create table CATEGORIE (
     nome varchar(20) not null,
     immagine varchar(20) not null,
     constraint ID_CATEGORIA_ID primary key (nome));

create table NOTIFICHE_ARTICOLI (
     username varchar(20) not null,
     lettoYN char not null,
     data date not null,
     tipologia int not null,
     id_prodotto int not null,
     versione_articolo int not null,
     constraint ID_NOTIFICA_ARTICOLO_ID primary key (username, data));

create table NOTIFICHE_ORDINI (
     username varchar(20) not null,
     lettoYN char not null,
     data date not null,
     tipologia int not null,
     id int not null,
     constraint ID_NOTIFICA_ORDINE_ID primary key (username, data));

create table ORDINI (
     tempo_ordinazione date not null,
     tempo_spedizione date not null,
     tempo_consegna date not null,
     id int not null auto_increment,
     username varchar(20) not null,
     constraint ID_ORDINE_ID primary key (id));

create table PRODOTTI (
     id int not null auto_increment,
     nome varchar(50) not null,
     descrizione varchar(200) not null,
     eta_minima int not null,
     immagine varchar(50) not null,
     nome_categoria varchar(20) not null,
     constraint ID_PRODOTTO_ID primary key (id));

create table RICHIESTE (
     id_ordine int not null,
     id_prodotto int not null,
     versione_articolo int not null,
     quantita int not null,
     constraint ID_RICHIESTA_ID primary key (id_ordine, id_prodotto, versione_articolo));

create table UTENTI (
     username varchar(20) not null,
     nome varchar(20) not null,
     cognome varchar(20) not null,
     data_nascita date not null,
     password varchar(255) not null,
     amministratore char not null,
     constraint ID_UTENTE_ID primary key (username));


-- Constraints Section
-- ___________________ 

alter table ARTICOLI add constraint FKscaffale
     foreign key (id_prodotto)
     references PRODOTTI (id);

alter table ARTICOLI_IN_CARRELLO add constraint FKpossiede_FK
     foreign key (username)
     references UTENTI (username);

alter table ARTICOLI_IN_CARRELLO add constraint FKdesiderato
     foreign key (id_prodotto, versione_articolo)
     references ARTICOLI (id_prodotto, versione);

alter table NOTIFICHE_ARTICOLI add constraint FKricevimento_notifica_articolo
     foreign key (username)
     references UTENTI (username);

alter table NOTIFICHE_ARTICOLI add constraint FKnotifica_articolo_FK
     foreign key (id_prodotto, versione_articolo)
     references ARTICOLI (id_prodotto, versione);

alter table NOTIFICHE_ORDINI add constraint FKricevimento_notifica_ordine
     foreign key (username)
     references UTENTI (username);

alter table NOTIFICHE_ORDINI add constraint FKnotifica_ordine_FK
     foreign key (id)
     references ORDINI (id);

-- Not implemented
-- alter table ORDINI add constraint ID_ORDINE_CHK
--     check(exists(select * from RICHIESTE
--                  where RICHIESTE.id_ordine = id)); 

alter table ORDINI add constraint FKeffettuazione_FK
     foreign key (username)
     references UTENTI (username);

alter table PRODOTTI add constraint FKappartiene_a_FK
     foreign key (nome_categoria)
     references CATEGORIE (nome);

alter table RICHIESTE add constraint FKriferimento_FK
     foreign key (id_prodotto, versione_articolo)
     references ARTICOLI (id_prodotto, versione);

alter table RICHIESTE add constraint FKcontenimento
     foreign key (id_ordine)
     references ORDINI (id);


-- Index Section
-- _____________ 

create unique index ID_ARTICOLO_IND
     on ARTICOLI (id_prodotto, versione);

create unique index ID_ARTICOLO_IN_CARRELLO_IND
     on ARTICOLI_IN_CARRELLO (id_prodotto, versione_articolo, username);

create index FKpossiede_IND
     on ARTICOLI_IN_CARRELLO (username);

create unique index ID_CATEGORIA_IND
     on CATEGORIE (nome);

create unique index ID_NOTIFICA_ARTICOLO_IND
     on NOTIFICHE_ARTICOLI (username, data);

create index FKnotifica_articolo_IND
     on NOTIFICHE_ARTICOLI (id_prodotto, versione_articolo);

create unique index ID_NOTIFICA_ORDINE_IND
     on NOTIFICHE_ORDINI (username, data);

create index FKnotifica_ordine_IND
     on NOTIFICHE_ORDINI (id);

create unique index ID_ORDINE_IND
     on ORDINI (id);

create index FKeffettuazione_IND
     on ORDINI (username);

create unique index ID_PRODOTTO_IND
     on PRODOTTI (id);

create index FKappartiene_a_IND
     on PRODOTTI (nome_categoria);

create unique index ID_RICHIESTA_IND
     on RICHIESTE (id_ordine, id_prodotto, versione_articolo);

create index FKriferimento_IND
     on RICHIESTE (id_prodotto, versione_articolo);

create unique index ID_UTENTE_IND
     on UTENTI (username);

