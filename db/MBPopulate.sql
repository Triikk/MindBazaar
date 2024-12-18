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
('', '', '', '', ''),