use MindBazaar;

INSERT INTO UTENTI (username, nome, cognome, data_nascita, password, amministratore) VALUES
('MATT DESTROYER', 'Mattia', 'Ronchi', '2003-11-14', 'ARDUINO', 'Y'), -- Amministratore
('BEG IL SUPREMO', 'Lorenzo', 'Bergami', '2003-08-24', ':D:D:D', 'Y'),
('MEGA FRANCI', 'Francesco', 'Bittasi', '2003-12-05', 'bittone', 'Y'),
('sbaracchino', 'Pietro', 'Sbaraccani', '2003-07-28', 'mypassword789', 'N'),
('monkey03', 'Andrea', 'Monaco', '1993-04-18', 'passMarco2024', 'N'),
('alexBan', 'Alex', 'Guerrini', '1988-01-25', 'elenaPass99', 'N'),
('bigDave', 'Davide', 'Bartoli', '1985-06-30', 'googleSlave', 'N');

INSERT INTO CATEGORIE (nome, immagine) VALUES
('Sogno','sogno.png'),
('Ispirazione','ispirazione.png'),
('Emozione','emozione.png'),
('Nozione','nozione.png');

INSERT INTO PRODOTTI (nome, descrizione, eta_minima, immagine, nome_categoria) VALUES
("Avventura Galattica", "Un sogno epico in cui esplorerai galassie sconosciute e combatterai alieni ostili.", 18, "Avventura_Galattica.png", "Sogno"),
("Viaggio nella Preistoria", "Rivivi la preistoria tra dinosauri, vulcani e paesaggi primordiali.", 18, "Viaggio_Preistoria.png", "Sogno"),
("Caccia al Tesoro", "Un'avventura piratesca alla ricerca di un antico tesoro nascosto.", 18, "Caccia_Tesoro.png", "Sogno"),
("Vita da Rockstar", "Diventa una star della musica e vivi il brivido del palco.", 18, "Vita_Rockstar.png", "Sogno"),
("Esplorazione Subacquea", "Nuota tra le barriere coralline e scopri creature marine incredibili.", 18, "Esplorazione_Subacquea.png", "Sogno"),
("Castello Incantato", "Vivi in un castello pieno di magia, enigmi e creature incantate.", 18, "Castello_Incantato.png", "Sogno"),
("Battaglia Medievale", "Indossa l'armatura e combatti per il tuo regno in un'epica battaglia.", 18, "Battaglia_Medievale.png", "Sogno"),
("Giro del Mondo", "Visita città iconiche e paesaggi incredibili in una notte.", 18, "Giro_Mondo.png", "Sogno"),
("Fuga dal Labirinto", "Trova la via d'uscita da un labirinto mistico pieno di sorprese.", 18, "Fuga_Labirinto.png", "Sogno"),
("Motivazione per Allenarsi", "Trova l'energia per iniziare e mantenere una routine fitness.", 18, "Motivazione_Allenarsi.png", "Ispirazione"),
("Scrivi il Tuo Romanzo", "L'ispirazione perfetta per iniziare o completare un libro.", 18, "Scrivi_Romanzo.png", "Ispirazione"),
("Idee per una Startup", "Scopri nuove idee creative per avviare il tuo business.", 18, "Idee_Startup.png", "Ispirazione"),
("Decluttering Motivazionale", "La spinta giusta per organizzare e semplificare la tua casa.", 18, "Decluttering_Motivazionale.png", "Ispirazione"),
("Componi una Canzone", "Trova l'ispirazione per creare una melodia unica.", 18, "Componi_Canzone.png", "Ispirazione"),
("Progettare un Giardino", "Ispirazione per creare uno spazio verde perfetto.", 18, "Progettare_Giardino.png", "Ispirazione"),
("Allenarsi per una Maratona", "Il focus mentale necessario per prepararti a lungo termine.", 18, "Allenarsi_Maratona.png", "Ispirazione"),
("Lancio di un Progetto", "Trova le idee e l'energia per iniziare un nuovo progetto.", 18, "Lancio_Progetto.png", "Ispirazione"),
("Pittura Astratta", "Visualizza colori e forme che ti porteranno a creare opere d'arte astratte.", 18, "Pittura_Astratta.png", "Ispirazione"),
("Creare una Playlist Perfetta", "Un boost per selezionare i brani più belli per ogni occasione.", 18, "Creare_Playlist.png", "Ispirazione"),
("Felicità", "Un'ondata di gioia e gratitudine che illumina la tua giornata.", 18, "Felicità.png", "Emozione"),
("Serenità", "Un senso profondo di pace e calma interiore.", 18, "Serenità.png", "Emozione"),
("Entusiasmo", "Un'energia contagiosa per affrontare con passione le tue attività.", 18, "Entusiasmo.png", "Emozione"),
("Empatia", "Una connessione profonda e comprensione verso gli altri.", 18, "Empatia.png", "Emozione"),
("Euforia", "Un momento di pura estasi e divertimento.", 18, "Euforia.png", "Emozione"),
("Nostalgia Felice", "Un dolce ricordo che scalda il cuore e ti fa sorridere.", 18, "Nostalgia_Felice.png", "Emozione"),
("Fiducia", "Un'emozione di sicurezza e determinazione verso te stesso e gli altri.", 18, "Fiducia.png", "Emozione"),
("Fondamenti di Astrofisica", "Un corso breve per comprendere le basi dell'universo.", 18, "Fondamenti_Astrofisica.png", "Nozione"),
("Introduzione alla Filosofia", "I pensieri dei più grandi filosofi in una pillola concisa.", 18, "Introduzione_Filosofia.png", "Nozione"),
("Storia dell'Arte", "Una panoramica delle correnti artistiche più importanti.", 18, "Storia_Arte.png", "Nozione"),
("Cucinare come uno Chef", "Tecniche base per migliorare le tue abilità culinarie.", 18, "Cucinare_Chef.png", "Nozione"),
("Fotografia per Principianti", "Impara le basi per scattare foto incredibili.", 18, "Fotografia_Principianti.png", "Nozione"),
("Economia per Tutti", "Le nozioni essenziali per capire come funziona l'economia.", 18, "Economia_Tutti.png", "Nozione"),
("Origine delle Lingue", "Scopri come si sono evolute le lingue del mondo.", 18, "Origine_Lingue.png", "Nozione"),
("Coding in Python", "Un'introduzione semplice alla programmazione con Python.", 18, "Coding_Python.png", "Nozione"),
("Mindfulness e Meditazione", "Una guida pratica per iniziare a meditare.", 18, "Mindfulness_Meditazione.png", "Nozione"),
("Storia dei Videogiochi", "Un viaggio nelle origini e nell'evoluzione del gaming.", 18, "Storia_Videogiochi.png", "Nozione"),
("Introduzione alla Meccanica Quantistica", "Un assaggio di uno degli argomenti più affascinanti della fisica.", 18, "Introduzione_Meccanica_Quantistica.png", "Nozione"),
("Leadership e Comunicazione", "Suggerimenti per migliorare le tue capacità di leadership.", 18, "Leadership_Comunicazione.png", "Nozione"),
("Storia della Moda", "Un viaggio attraverso stili e tendenze nei secoli.", 18, "Storia_Moda.png", "Nozione"),
("Introduzione alla Critica Letteraria", "Scopri come analizzare testi e opere letterarie.", 18, "Critica_Letteraria.png", "Nozione"),
("Storia dei Viaggi nello Spazio", "Dai primi razzi ai viaggi interstellari.", 18, "Viaggi_Spazio.png", "Nozione"),
("Cultura del Tè nel Mondo", "Un'introduzione agli usi e alle tradizioni legati al tè.", 18, "Cultura_Te.png", "Nozione"),
("Segreti del Linguaggio del Corpo", "Capire cosa dicono i gesti delle persone.", 18, "Linguaggio_Corpo.png", "Nozione"),
("Storia della Musica Jazz", "Un viaggio nella musica jazz e nei suoi protagonisti.", 18, "Musica_Jazz.png", "Nozione"),
("Elementi di Filosofia Orientale", "Una breve guida ai pensieri di confucianesimo, taoismo e buddhismo.", 18, "Filosofia_Orientale.png", "Nozione"),
("Tecnologie Web", "Un'introduzione alle basi dello sviluppo web.", 14, "Tecnologie_Web.png", "Nozione");

INSERT INTO ARTICOLI (id_prodotto, formato, durata, intensita, prezzo, disponibilita, versione) VALUES
(1,"marmellata","5 ore",2,89.99,247,1),
(1,"olio essenziale","1 ora",3,79.99,173,2),
(1,"marmellata","1 ora",3,89.99,98,3),
(2,"incenso","1 ora",2,63.99,223,1),
(2,"incenso","1 ora",2,53.99,223,2),
(2,"caramella","5 ore",2,102.99,148,3),
(2,"caramella","1 ora",1,45.99,204,4),
(3,"incenso","1 ora",3,86.99,30,1),
(3,"miele","1 ora",3,85.99,131,2),
(3,"incenso","15 ore",3,122.99,230,3),
(4,"lattina","15 ore",1,117.99,202,1),
(4,"miele","5 ore",1,83.99,99,2),
(5,"incenso","5 ore",2,91.99,143,1),
(5,"miele","5 ore",2,93.99,226,2),
(6,"miele","1 ora",2,56.99,90,1),
(6,"incenso","15 ore",3,128.99,53,2),
(6,"caramella","15 ore",3,118.99,13,3),
(7,"incenso","1 ora",2,58.99,239,1),
(8,"miele","15 ore",1,126.99,168,1),
(9,"marmellata","15 ore",3,133.99,166,1),
(9,"miele","5 ore",1,84.99,5,2),
(9,"miele","5 ore",2,90.99,99,3),
(10,"miele","1 ora",1,59.99,150,1),
(10,"incenso","15 ore",1,128.99,209,2),
(11,"lattina","10 ore",3,97.99,146,1),
(11,"miele","3 ore",3,80.99,19,2),
(11,"incenso","30 minuti",2,51.99,188,3),
(12,"miele","30 minuti",1,22.99,85,1),
(12,"incenso","3 ore",3,50.99,233,2),
(12,"miele","30 minuti",3,45.99,168,3),
(13,"lattina","10 ore",2,61.99,236,1),
(13,"lattina","3 ore",2,47.99,102,2),
(13,"incenso","10 ore",2,78.99,20,3),
(14,"marmellata","3 ore",3,78.99,221,1),
(14,"olio essenziale","10 ore",3,102.99,57,2),
(14,"lattina","30 minuti",1,31.99,227,3),
(14,"miele","3 ore",3,76.99,175,4),
(15,"miele","10 ore",3,97.99,114,1),
(15,"olio essenziale","3 ore",2,64.99,145,2),
(15,"incenso","30 minuti",1,38.99,154,3),
(16,"caramella","30 minuti",1,30.99,168,1),
(17,"caramella","3 ore",3,70.99,66,1),
(18,"olio essenziale","3 ore",2,51.99,107,1),
(19,"lattina","30 minuti",3,50.99,145,1),
(19,"lattina","30 minuti",2,39.99,167,2),
(19,"marmellata","30 minuti",3,47.99,242,3),
(19,"lattina","10 ore",1,54.99,39,4),
(20,"olio essenziale","30 minuti",2,38.99,224,1),
(21,"marmellata","6 ore",1,106.99,119,1),
(21,"caramella","30 minuti",1,56.99,0,2),
(21,"miele","6 ore",2,127.99,179,3),
(22,"marmellata","30 minuti",2,81.99,118,1),
(22,"lattina","2 ore",1,84.99,228,2),
(22,"miele","6 ore",2,116.99,189,3),
(22,"miele","30 minuti",1,62.99,150,4),
(23,"olio essenziale","2 ore",1,96.99,6,1),
(24,"lattina","2 ore",1,95.99,96,1),
(24,"marmellata","2 ore",1,92.99,213,2),
(24,"caramella","2 ore",3,142.99,95,3),
(24,"olio essenziale","2 ore",3,122.99,248,4),
(25,"olio essenziale","2 ore",1,95.99,164,1),
(25,"lattina","30 minuti",1,68.99,79,2),
(25,"miele","2 ore",1,87.99,125,3),
(26,"caramella","2 ore",3,126.99,190,1),
(26,"incenso","2 ore",1,83.99,243,2),
(26,"caramella","30 minuti",2,75.99,193,3),
(26,"olio essenziale","2 ore",3,129.99,172,4),
(27,"lattina","2 ore",1,95.99,130,1),
(27,"lattina","2 ore",2,112.99,240,2),
(27,"caramella","2 ore",3,126.99,168,3),
(28,"incenso","6 ore",3,142.99,98,1),
(28,"marmellata","30 minuti",1,63.99,80,2),
(28,"miele","6 ore",1,116.99,33,3),
(29,"incenso","2 ore",3,129.99,209,1),
(29,"marmellata","2 ore",3,121.99,21,2),
(29,"marmellata","30 minuti",3,105.99,51,3),
(30,"miele","2 ore",1,89.99,21,1),
(30,"miele","6 ore",2,139.99,59,2),
(31,"lattina","1 settimana",3,177.99,8,1),
(31,"miele","1 giorno",1,85.99,38,2),
(31,"miele","5 ore",2,70.99,4,3),
(31,"olio essenziale","1 settimana",1,123.99,51,4),
(32,"miele","1 giorno",2,112.99,48,1),
(32,"marmellata","5 ore",3,102.99,163,2),
(32,"marmellata","5 ore",2,77.99,205,3),
(32,"miele","1 settimana",3,192.99,179,4),
(33,"olio essenziale","1 settimana",2,154.99,28,1),
(34,"caramella","5 ore",3,104.99,131,1),
(35,"lattina","1 giorno",2,114.99,195,1),
(35,"caramella","5 ore",1,44.99,0,2),
(35,"lattina","1 settimana",1,126.99,79,3),
(36,"marmellata","1 giorno",1,88.99,55,1),
(36,"incenso","1 settimana",3,205.99,80,2),
(37,"caramella","5 ore",1,52.99,181,1),
(38,"lattina","1 giorno",2,106.99,29,1),
(38,"lattina","5 ore",2,77.99,90,2),
(38,"marmellata","5 ore",1,51.99,166,3),
(39,"olio essenziale","5 ore",1,41.99,226,1),
(39,"marmellata","5 ore",3,105.99,24,2),
(40,"lattina","1 settimana",1,130.99,36,1),
(40,"lattina","5 ore",3,94.99,192,2),
(41,"marmellata","1 settimana",2,147.99,227,1),
(41,"miele","5 ore",2,73.99,215,2),
(42,"lattina","5 ore",3,96.99,97,1),
(43,"lattina","5 ore",3,95.99,128,1),
(43,"marmellata","5 ore",1,44.99,232,2),
(43,"olio essenziale","5 ore",2,80.99,222,3);
-- (44,"olio essenziale","1 settimana",3,177.99,90,1),
-- (44,"caramella","1 giorno",3,147.99,124,2),
-- (44,"marmellata","5 ore",3,97.99,137,3),
-- (45,"marmellata","5 ore",3,110.99,22,1),
-- (46,"marmellata","5 ore",3,103.99,112,1),
-- (46,"marmellata","1 giorno",1,85.99,18,2),
-- (46,"lattina","1 giorno",3,146.99,65,3),
-- (47,"incenso","1 settimana",3,184.99,205,1),
-- (47,"marmellata","1 giorno",1,90.99,58,2),
-- (47,"caramella","1 giorno",1,88.99,81,3),
-- (47,"lattina","1 giorno",1,96.99,151,4),
-- (48,"lattina","1 settimana",2,163.99,91,1),
-- (48,"caramella","1 settimana",1,127.99,35,2),
-- (49,"incenso","1 settimana",1,122.99,202,1),
-- (50,"olio essenziale","1 giorno",2,107.99,227,1),
-- (50,"incenso","1 settimana",2,165.99,153,2),
-- (51,"marmellata", "1 giorno", 2, 199.99, 0, 1),
-- (51,"marmellata", "1 settimana", 3, 399.99, 0, 2),
-- (51,"caramella", "1 giorno", 1, 119.99, 0, 3),
-- (51,"incenso", "5 ore", 2, 89.99, 0, 4);

INSERT INTO ORDINI (tempo_ordinazione, tempo_spedizione, tempo_consegna, username) VALUES
('2024-11-1 9:27:37', '2024-11-1 12:27:37', '2024-11-4 16:47:43', "alexBan"),
('2024-12-15 3:10:34', '2024-12-15 6:10:34', '2024-12-20 15:37:41', "alexBan"),
('2024-8-4 12:43:21', '2024-8-4 16:43:21', '2024-8-9 17:36:33', "alexBan"),
('2024-11-13 0:45:36', '2024-11-13 2:45:36', '2024-11-18 14:45:47', "alexBan"),
('2024-7-23 12:56:26', '2024-7-23 15:56:26', '2024-7-29 13:23:29', "BEG IL SUPREMO"),
('2024-10-21 13:24:6', '2024-10-21 17:24:6', '2024-10-26 13:21:37', "BEG IL SUPREMO"),
('2024-8-9 3:0:31', '2024-8-9 6:0:31', '2024-8-16 15:6:39', "BEG IL SUPREMO"),
('2024-7-27 6:16:51', '2024-7-27 10:16:51', '2024-7-30 11:48:57', "BEG IL SUPREMO"),
('2024-9-11 23:45:32', '2024-9-12 8:45:32', '2024-9-15 13:30:3', "bigDave"),
('2024-12-24 20:50:15', '2024-12-25 10:50:15', '2024-12-28 12:40:35', "bigDave"),
('2024-12-2 16:26:38', '2024-12-3 12:26:38', '2024-12-7 17:9:24', "bigDave"),
('2024-8-2 15:9:33', '2024-8-3 12:9:33', '2024-8-9 16:20:51', "bigDave"),
('2024-12-30 23:57:11', '2025-1-1 9:57:11', '2025-1-5 11:1:46', "MATT DESTROYER"),
('2024-12-23 10:27:36', '2024-12-23 14:27:36', '2024-12-30 12:18:40', "MATT DESTROYER");

INSERT INTO RICHIESTE (id_ordine, id_prodotto, versione_articolo, quantita) VALUES
(1, 18, 1, 1),
(2, 14, 2, 7),
(2, 27, 1, 2),
(2, 43, 2, 1),
(3, 27, 3, 7),
(3, 41, 2, 4),
(4, 4, 1, 2),
(5, 39, 2, 4),
(5, 8, 1, 10),
(5, 31, 2, 2),
(6, 15, 1, 8),
(6, 42, 1, 4),
(7, 30, 1, 6),
(7, 26, 1, 8),
(8, 4, 2, 9),
(8, 39, 2, 3),
(8, 31, 3, 7),
(8, 41, 2, 5),
(9, 7, 1, 10),
(10, 24, 1, 7),
(11, 2, 3, 3),
(12, 40, 1, 8),
(12, 37, 1, 9),
(12, 41, 2, 2),
(13, 3, 2, 7),
(13, 3, 1, 2),
(14, 9, 1, 5),
(14, 35, 3, 9),
(14, 32, 4, 9),
(14, 18, 1, 12);

INSERT INTO ARTICOLI_IN_CARRELLO (id_prodotto, versione_articolo, username, quantita) VALUES
(1, 1,  'MATT DESTROYER', 5),
(4, 1,  'MATT DESTROYER', 5),
(16, 1,  'MATT DESTROYER', 5),
(43, 1,  'MATT DESTROYER', 5);

INSERT INTO NOTIFICHE_ORDINI (username, lettoYN, data, tipologia, id_ordine) VALUES
('BEG IL SUPREMO', 'N', '2024-12-23 10:27:36', 0, 5),
('BEG IL SUPREMO', 'N', '2024-12-23 10:27:37', 1, 6);

INSERT INTO NOTIFICHE_ARTICOLI (username, lettoYN, data, tipologia, id_prodotto, versione_articolo) VALUES
('BEG IL SUPREMO', 'N', '2024-12-23 10:27:36', 0, 5, 1),
('BEG IL SUPREMO', 'N', '2024-12-23 10:27:37', 1, 5, 2);