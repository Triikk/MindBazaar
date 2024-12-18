-- *********************************************
-- * SQL MySQL generation                      
-- *--------------------------------------------
-- * DB-MAIN version: 11.0.2              
-- * Generator date: Sep 14 2021              
-- * Generation date: Wed Dec 18 18:27:12 2024 
-- * LUN file: C:\Users\Lorenzo\Documents\UNIVERSITA\Tecnologie Web\MindBazaar\MindBazaar\MindBazaar.lun 
-- * Schema: MindBazaar 
-- ********************************************* 


-- Database Section
-- ________________ 

create database MindBazaar;
use MindBazaar;


-- Tables Section
-- _____________ 

create table ARTICOLO (
     id_prodotto int not null,
     formato varchar(20) not null,
     durata varchar(15) not null,
     intensita int not null,
     prezzo decimal(3,2) not null,
     disponibilita int not null,
     versione int not null,
     constraint ID_ARTICOLO_ID primary key (id_prodotto, versione));

create table ARTICOLO_IN_CARRELLO (
     id_prodotto int not null,
     versione_articolo int not null,
     username varchar(20) not null,
     quantita int not null,
     constraint ID_ARTICOLO_IN_CARRELLO_ID primary key (id_prodotto, versione_articolo, username));

create table CATEGORIA (
     nome varchar(20) not null,
     id int not null auto_increment,
     immagine varchar(20) not null,
     constraint ID_CATEGORIA_ID primary key (id));

create table NOTIFICA_ARTICOLO (
     username varchar(20) not null,
     lettoYN char not null,
     data date not null,
     tipologia int not null,
     id_prodotto int not null,
     versione_articolo int not null,
     constraint ID_NOTIFICA_ARTICOLO_ID primary key (username, data));

create table NOTIFICA_ORDINE (
     username varchar(20) not null,
     lettoYN char not null,
     data date not null,
     tipologia int not null,
     id_ordine int not null,
     constraint ID_NOTIFICA_ORDINE_ID primary key (username, data));

create table ORDINE (
     tempo_ordinazione date not null,
     tempo_spedizione date not null,
     tempo_consegna date not null,
     id int not null auto_increment,
     username varchar(20) not null,
     constraint ID_ORDINE_ID primary key (id));

create table PRODOTTO (
     id int not null auto_increment,
     nome varchar(20) not null,
     descrizione varchar(200) not null,
     eta_minima int not null,
     categoria varchar(20) not null,
     immagine varchar(25) not null,
     id_categoria int not null,
     constraint ID_PRODOTTO_ID primary key (id));

create table RICHIESTA (
     id_ordine int not null,
     id_prodotto int not null,
     versione_articolo int not null,
     quantita int not null,
     constraint ID_RICHIESTA_ID primary key (id_ordine, id_prodotto, versione_articolo));

create table UTENTE (
     username varchar(20) not null,
     nome varchar(20) not null,
     cognome varchar(20) not null,
     data_nascita date not null,
     password varchar(255) not null,
     amministratore char not null,
     constraint ID_UTENTE_ID primary key (username));


-- Constraints Section
-- ___________________ 

alter table ARTICOLO add constraint FKscaffale
     foreign key (id_prodotto)
     references PRODOTTO (id);

alter table ARTICOLO_IN_CARRELLO add constraint FKpossiede_FK
     foreign key (username)
     references UTENTE (username);

alter table ARTICOLO_IN_CARRELLO add constraint FKdesiderato
     foreign key (id_prodotto, versione_articolo)
     references ARTICOLO (id_prodotto, versione);

alter table NOTIFICA_ARTICOLO add constraint FKricevimento_notifica_articolo
     foreign key (username)
     references UTENTE (username);

alter table NOTIFICA_ARTICOLO add constraint FKnotifica_articolo_FK
     foreign key (id_prodotto, versione_articolo)
     references ARTICOLO (id_prodotto, versione);

alter table NOTIFICA_ORDINE add constraint FKricevimento_notifica_ordine
     foreign key (username)
     references UTENTE (username);

alter table NOTIFICA_ORDINE add constraint FKnotifica_ordine_FK
     foreign key (id_ordine)
     references ORDINE (id);

-- Not implemented
-- alter table ORDINE add constraint ID_ORDINE_CHK
--     check(exists(select * from RICHIESTA
--                  where RICHIESTA.id_ordine = id)); 

alter table ORDINE add constraint FKeffettuazione_FK
     foreign key (username)
     references UTENTE (username);

alter table PRODOTTO add constraint FKappartiene_a_FK
     foreign key (id_categoria)
     references CATEGORIA (id);

alter table RICHIESTA add constraint FKriferimento_FK
     foreign key (id_prodotto, versione_articolo)
     references ARTICOLO (id_prodotto, versione);

alter table RICHIESTA add constraint FKcontenimento
     foreign key (id_ordine)
     references ORDINE (id);


-- Index Section
-- _____________ 

create unique index ID_ARTICOLO_IND
     on ARTICOLO (id_prodotto, versione);

create unique index ID_ARTICOLO_IN_CARRELLO_IND
     on ARTICOLO_IN_CARRELLO (id_prodotto, versione_articolo, username);

create index FKpossiede_IND
     on ARTICOLO_IN_CARRELLO (username);

create unique index ID_CATEGORIA_IND
     on CATEGORIA (id);

create unique index ID_NOTIFICA_ARTICOLO_IND
     on NOTIFICA_ARTICOLO (username, data);

create index FKnotifica_articolo_IND
     on NOTIFICA_ARTICOLO (id_prodotto, versione_articolo);

create unique index ID_NOTIFICA_ORDINE_IND
     on NOTIFICA_ORDINE (username, data);

create index FKnotifica_ordine_IND
     on NOTIFICA_ORDINE (id_ordine);

create unique index ID_ORDINE_IND
     on ORDINE (id);

create index FKeffettuazione_IND
     on ORDINE (username);

create unique index ID_PRODOTTO_IND
     on PRODOTTO (id);

create index FKappartiene_a_IND
     on PRODOTTO (id_categoria);

create unique index ID_RICHIESTA_IND
     on RICHIESTA (id_ordine, id_prodotto, versione_articolo);

create index FKriferimento_IND
     on RICHIESTA (id_prodotto, versione_articolo);

create unique index ID_UTENTE_IND
     on UTENTE (username);

