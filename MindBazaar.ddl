-- *********************************************
-- * SQL MySQL generation                      
-- *--------------------------------------------
-- * DB-MAIN version: 11.0.2              
-- * Generator date: Sep 14 2021              
-- * Generation date: Wed Dec 18 17:33:49 2024 
-- * LUN file: C:\Users\Lorenzo\Documents\UNIVERSITA\Tecnologie Web\MindBazaar\MindBazaar\MindBazaar.lun 
-- * Schema: MindBazaar/1-1-1-1 
-- ********************************************* 


-- Database Section
-- ________________ 

create database MindBazaar;
use MindBazaar;


-- Tables Section
-- _____________ 

create table ARTICOLO (
     id int not null,
     formato varchar(20) not null,
     durata varchar(15) not null,
     intensita int not null,
     prezzo decimal(3,2) not null,
     disponibilita int not null,
     constraint ID_ARTICOLO_ID primary key (id, formato, durata, intensita));

create table CATEGORIA (
     ID_CAT int not null auto_increment,
     nome varchar(20) not null,
     immagine varchar(20) not null,
     constraint ID_ID primary key (ID_CAT));

create table in_carrello (
     id int not null,
     formato varchar(20) not null,
     durata varchar(15) not null,
     intensita int not null,
     username varchar(20) not null,
     quantita int not null,
     constraint ID_in_carrello_ID primary key (id, formato, durata, intensita, username));

create table NOTIFICA_ARTICOLO (
     username varchar(20) not null,
     lettoYN char not null,
     data date not null,
     tipologia int not null,
     id int not null,
     formato varchar(20) not null,
     durata varchar(15) not null,
     intensita int not null,
     constraint ID_NOTIFICA_ARTICOLO_ID primary key (username, data));

create table NOTIFICA_ORDINE (
     username varchar(20) not null,
     lettoYN char not null,
     data date not null,
     tipologia int not null,
     tempo_ordinazione date not null,
     constraint ID_NOTIFICA_ORDINE_ID primary key (username, data));

create table ORDINE (
     tempo_ordinazione date not null,
     tempo_spedizione date not null,
     tempo_consegna date not null,
     username varchar(20) not null,
     constraint ID_ORDINE_ID primary key (tempo_ordinazione));

create table PRODOTTO (
     id int not null,
     nome varchar(20) not null,
     descrizione varchar(200) not null,
     eta_minima int not null,
     categoria varchar(20) not null,
     immagine varchar(25) not null,
     ID_CAT int not null,
     constraint ID_PRODOTTO_ID primary key (id));

create table richiesta (
     id int not null,
     formato varchar(20) not null,
     durata varchar(15) not null,
     intensita int not null,
     tempo_ordinazione date not null,
     constraint ID_richiesta_ID primary key (id, formato, durata, intensita, tempo_ordinazione));

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
     foreign key (id)
     references PRODOTTO (id);

alter table in_carrello add constraint FKpossiede_FK
     foreign key (username)
     references UTENTE (username);

alter table in_carrello add constraint FKdesiderato
     foreign key (id, formato, durata, intensita)
     references ARTICOLO (id, formato, durata, intensita);

alter table NOTIFICA_ARTICOLO add constraint FKricevimento_notifica_articolo
     foreign key (username)
     references UTENTE (username);

alter table NOTIFICA_ARTICOLO add constraint FKnotifica_articolo_FK
     foreign key (id, formato, durata, intensita)
     references ARTICOLO (id, formato, durata, intensita);

alter table NOTIFICA_ORDINE add constraint FKricevimento_notifica_ordine
     foreign key (username)
     references UTENTE (username);

alter table NOTIFICA_ORDINE add constraint FKnotifica_ordine_FK
     foreign key (tempo_ordinazione)
     references ORDINE (tempo_ordinazione);

-- Not implemented
-- alter table ORDINE add constraint ID_ORDINE_CHK
--     check(exists(select * from richiesta
--                  where richiesta.tempo_ordinazione = tempo_ordinazione)); 

alter table ORDINE add constraint FKeffettuazione_FK
     foreign key (username)
     references UTENTE (username);

alter table PRODOTTO add constraint FKappartiene_a_FK
     foreign key (ID_CAT)
     references CATEGORIA (ID_CAT);

alter table richiesta add constraint FKric_ORD_FK
     foreign key (tempo_ordinazione)
     references ORDINE (tempo_ordinazione);

alter table richiesta add constraint FKric_ART
     foreign key (id, formato, durata, intensita)
     references ARTICOLO (id, formato, durata, intensita);


-- Index Section
-- _____________ 

create unique index ID_ARTICOLO_IND
     on ARTICOLO (id, formato, durata, intensita);

create unique index ID_IND
     on CATEGORIA (ID_CAT);

create unique index ID_in_carrello_IND
     on in_carrello (id, formato, durata, intensita, username);

create index FKpossiede_IND
     on in_carrello (username);

create unique index ID_NOTIFICA_ARTICOLO_IND
     on NOTIFICA_ARTICOLO (username, data);

create index FKnotifica_articolo_IND
     on NOTIFICA_ARTICOLO (id, formato, durata, intensita);

create unique index ID_NOTIFICA_ORDINE_IND
     on NOTIFICA_ORDINE (username, data);

create index FKnotifica_ordine_IND
     on NOTIFICA_ORDINE (tempo_ordinazione);

create unique index ID_ORDINE_IND
     on ORDINE (tempo_ordinazione);

create index FKeffettuazione_IND
     on ORDINE (username);

create unique index ID_PRODOTTO_IND
     on PRODOTTO (id);

create index FKappartiene_a_IND
     on PRODOTTO (ID_CAT);

create unique index ID_richiesta_IND
     on richiesta (id, formato, durata, intensita, tempo_ordinazione);

create index FKric_ORD_IND
     on richiesta (tempo_ordinazione);

create unique index ID_UTENTE_IND
     on UTENTE (username);

