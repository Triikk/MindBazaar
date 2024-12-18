INSERT INTO UTENTE (username, nome, cognome, data_nascita, password, amministratore) VALUES
('MATT DESTROYER', 'Mattia', 'Ronchi', '2003-11-14', 'ARDUINO', 'Y'), -- Amministratore
('BEG IL SUPREMO', 'Lorenzo', 'Bergami', '2003-08-24', ':D:D:D', 'Y'),
('MEGA FRANCI', 'Francesco', 'Bittasi', '2003-12-05', 'bittone', 'Y'),
('sbaracchino', 'Pietro', 'Sbaraccani', '2003-07-28', 'mypassword789', 'N'),
('monkey03', 'Andrea', 'Monaco', '1993-04-18', 'passMarco2024', 'N'),
('alexBan', 'Alex', 'Guerrini', '1988-01-25', 'elenaPass99', 'N'),
('bigDave', 'Davide', 'Bartoli', '1985-06-30', 'googleSlave', 'N');

INSERT INTO CATEGORIA (nome, immagine) VALUES
('Sogno','sogno.png'),
('Ispirazione','ispirazione.png'),
('Emozione','emozione.png'),
('Nozione','nozione.png');

INSERT INTO PRODOTTO (nome, descrizione, eta_minima, immagine, id_categoria) VALUES
("Avventura Galattica", "Un sogno epico in cui esplorerai galassie sconosciute e combatterai alieni ostili.", 18, ".png", "Sogno")
("Viaggio nella Preistoria", "Rivivi la preistoria tra dinosauri, vulcani e paesaggi primordiali.", 18, ".png", "Sogno")
("Caccia al Tesoro", "Un'avventura piratesca alla ricerca di un antico tesoro nascosto.", 18, ".png", "Sogno")
("Vita da Rockstar", "Diventa una star della musica e vivi il brivido del palco.", 18, ".png", "Sogno")
("Esplorazione Subacquea", "Nuota tra le barriere coralline e scopri creature marine incredibili.", 18, ".png", "Sogno")
("Castello Incantato", "Vivi in un castello pieno di magia, enigmi e creature incantate.", 18, ".png", "Sogno")
("Battaglia Medievale", "Indossa l'armatura e combatti per il tuo regno in un'epica battaglia.", 18, ".png", "Sogno")
("Giro del Mondo", "Visita città iconiche e paesaggi incredibili in una notte.", 18, ".png", "Sogno")
("Fuga dal Labirinto", "Trova la via d'uscita da un labirinto mistico pieno di sorprese.", 18, ".png", "Sogno")
("Incontro con Supereroi", "Collabora con i tuoi eroi preferiti per salvare il mondo.", 18, ".png", "Sogno")
("Motivazione per Allenarsi", "Trova l'energia per iniziare e mantenere una routine fitness.", 18, ".png", "Ispirazione")
("Scrivi il Tuo Romanzo", "L'ispirazione perfetta per iniziare o completare un libro.", 18, ".png", "Ispirazione")
("Idee per una Startup", "Scopri nuove idee creative per avviare il tuo business.", 18, ".png", "Ispirazione")
("Decluttering Motivazionale", "La spinta giusta per organizzare e semplificare la tua casa.", 18, ".png", "Ispirazione")
("Componi una Canzone", "Trova l'ispirazione per creare una melodia unica.", 18, ".png", "Ispirazione")
("Progettare un Giardino", "Ispirazione per creare uno spazio verde perfetto.", 18, ".png", "Ispirazione")
("Allenarsi per una Maratona", "Il focus mentale necessario per prepararti a lungo termine.", 18, ".png", "Ispirazione")
("Lancio di un Progetto", "Trova le idee e l'energia per iniziare un nuovo progetto.", 18, ".png", "Ispirazione")
("Pittura Astratta", "Visualizza colori e forme che ti porteranno a creare opere d'arte astratte.", 18, ".png", "Ispirazione")
("Creare una Playlist Perfetta", "Un boost per selezionare i brani più belli per ogni occasione.", 18, ".png", "Ispirazione")
("Felicità", "Un'ondata di gioia e gratitudine che illumina la tua giornata.", 18, ".png", "Emozione")
("Serenità", "Un senso profondo di pace e calma interiore.", 18, ".png", "Emozione")
("Entusiasmo", "Un'energia contagiosa per affrontare con passione le tue attività.", 18, ".png", "Emozione")
("Empatia", "Una connessione profonda e comprensione verso gli altri.", 18, ".png", "Emozione")
("Euforia", "Un momento di pura estasi e divertimento.", 18, ".png", "Emozione")
("Accondiscendenza", "Un senso di soddisfazione e approvazione verso ciò che ti circonda.", 18, ".png", "Emozione")
("Nostalgia Felice", "Un dolce ricordo che scalda il cuore e ti fa sorridere.", 18, ".png", "Emozione")
("Gratitudine", "Un'emozione calda che ti fa apprezzare le piccole cose.", 18, ".png", "Emozione")
("Amore Universale", "Un sentimento di amore e connessione con il mondo intero.", 18, ".png", "Emozione")
("Fiducia", "Un'emozione di sicurezza e determinazione verso te stesso e gli altri.", 18, ".png", "Emozione")
("Fondamenti di Astrofisica", "Un corso breve per comprendere le basi dell'universo.", 18, ".png", "Nozione")
("Introduzione alla Filosofia", "I pensieri dei più grandi filosofi in una pillola concisa.", 18, ".png", "Nozione")
("Storia dell'Arte", "Una panoramica delle correnti artistiche più importanti.", 18, ".png", "Nozione")
("Cucinare come uno Chef", "Tecniche base per migliorare le tue abilità culinarie.", 18, ".png", "Nozione")
("Fotografia per Principianti", "Impara le basi per scattare foto incredibili.", 18, ".png", "Nozione")
("Economia per Tutti", "Le nozioni essenziali per capire come funziona l'economia.", 18, ".png", "Nozione")
("Origine delle Lingue", "Scopri come si sono evolute le lingue del mondo.", 18, ".png", "Nozione")
("Coding in Python", "Un'introduzione semplice alla programmazione con Python.", 18, ".png", "Nozione")
("Mindfulness e Meditazione", "Una guida pratica per iniziare a meditare.", 18, ".png", "Nozione")
("Storia dei Videogiochi", "Un viaggio nelle origini e nell'evoluzione del gaming.", 18, ".png", "Nozione")
("Introduzione alla Meccanica Quantistica", "Un assaggio di uno degli argomenti più affascinanti della fisica.", 18, ".png", "Nozione")
("Le Basi del Giardinaggio", "Un corso pratico per prenderti cura delle tue piante.", 18, ".png", "Nozione")
("Leadership e Comunicazione", "Suggerimenti per migliorare le tue capacità di leadership.", 18, ".png", "Nozione")
("Storia della Moda", "Un viaggio attraverso stili e tendenze nei secoli.", 18, ".png", "Nozione")
("Introduzione alla Critica Letteraria", "Scopri come analizzare testi e opere letterarie.", 18, ".png", "Nozione")
("Storia dei Viaggi nello Spazio", "Dai primi razzi ai viaggi interstellari.", 18, ".png", "Nozione")
("Cultura del Tè nel Mondo", "Un'introduzione agli usi e alle tradizioni legati al tè.", 18, ".png", "Nozione")
("Segreti del Linguaggio del Corpo", "Capire cosa dicono i gesti delle persone.", 18, ".png", "Nozione")
("Storia della Musica Jazz", "Un viaggio nella musica jazz e nei suoi protagonisti.", 18, ".png", "Nozione")
("Elementi di Filosofia Orientale", "Una breve guida ai pensieri di confucianesimo, taoismo e buddhismo.", 18, ".png", "Nozione")