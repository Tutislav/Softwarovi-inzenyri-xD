CREATE TABLE uzivatel (
    id_uzivatele INT NOT NULL AUTO_INCREMENT,
    jmeno VARCHAR(50) NOT NULL,
    prijmeni VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    heslo VARCHAR(100) NOT NULL,
    role ENUM ('autor', 'recenzent', 'redaktor', 'sefredaktor', 'admin') NOT NULL,
    PRIMARY KEY (id_uzivatele),
    UNIQUE (email)
);

CREATE TABLE prispevek (
    id_prispevku INT NOT NULL AUTO_INCREMENT,
    id_uzivatele INT NOT NULL,
    titulek VARCHAR(255) NOT NULL,
    tematicke_cislo ENUM ('hardware', 'software', 'gaming', 'ai') NOT NULL,
    spoluautori TEXT,
    stav VARCHAR(100) NOT NULL,
    zobrazeny_soubor INT,
    PRIMARY KEY (id_prispevku),
    FOREIGN KEY (id_uzivatele) REFERENCES uzivatel(id_uzivatele),
    FOREIGN KEY (zobrazeny_soubor) REFERENCES soubor(id_souboru)
);

CREATE TABLE soubor (
    id_souboru INT NOT NULL AUTO_INCREMENT,
    id_prispevku INT NOT NULL,
    soubor_cesta VARCHAR(255) NOT NULL,
    datum_nahrani DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id_souboru),
    FOREIGN KEY (id_prispevku) REFERENCES prispevek(id_prispevku)
);

CREATE TABLE ukol (
    id_ukolu INT NOT NULL AUTO_INCREMENT,
    id_uzivatele INT NOT NULL,
    id_zadavatele INT NOT NULL,
    id_prispevku INT,
    datum_zadani DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    termin_splneni DATETIME NOT NULL,
    datum_splneni DATETIME,
    ukol_text TEXT,
    splneno BOOLEAN NOT NULL DEFAULT 0,
    PRIMARY KEY (id_ukolu),
    FOREIGN KEY (id_uzivatele) REFERENCES uzivatel(id_uzivatele),
    FOREIGN KEY (id_zadavatele) REFERENCES uzivatel(id_uzivatele),
    FOREIGN KEY (id_prispevku) REFERENCES prispevek(id_prispevku)
);

CREATE TABLE recenze (
    id_recenze INT NOT NULL AUTO_INCREMENT,
    id_prispevku INT NOT NULL,
    id_recenzenta INT NOT NULL,
    id_ukolu INT NOT NULL,
    h_aktualnost BIT(6) NOT NULL,
    h_originalita BIT(6) NOT NULL,
    h_odborna_uroven BIT(6) NOT NULL,
    h_jazykova_uroven BIT(6) NOT NULL,
    recenze_text TEXT NOT NULL,
    stav VARCHAR(100) NOT NULL,
    zpristupnena BOOLEAN NOT NULL DEFAULT 0,
    PRIMARY KEY (id_recenze),
    FOREIGN KEY (id_prispevku) REFERENCES prispevek(id_prispevku),
    FOREIGN KEY (id_recenzenta) REFERENCES uzivatel(id_uzivatele),
    FOREIGN KEY (id_ukolu) REFERENCES ukol(id_ukolu)
);

CREATE TABLE vzkazy (
    id_vzkazu INT NOT NULL AUTO_INCREMENT,
    id_odesilatele INT NOT NULL,
    id_prijemce INT NOT NULL,
    id_recenze INT,
    datum_odeslani DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    vzkaz_text TEXT NOT NULL,
    precteno BOOLEAN NOT NULL DEFAULT 0,
    PRIMARY KEY (id_vzkazu),
    FOREIGN KEY (id_odesilatele) REFERENCES uzivatel(id_uzivatele),
    FOREIGN KEY (id_prijemce) REFERENCES uzivatel(id_uzivatele),
    FOREIGN KEY (id_recenze) REFERENCES recenze(id_recenze)
);

CREATE TABLE dotaz (
    id_dotazu INT NOT NULL AUTO_INCREMENT,
    datum_odeslani DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    dotaz_titulek VARCHAR(255) NOT NULL,
    dotaz_text TEXT NOT NULL,
    dotaz_odpoved TEXT,
    odpovezeno BOOLEAN NOT NULL DEFAULT 0,
    PRIMARY KEY (id_dotazu)
);

CREATE TABLE archiv (
    id_vydani INT NOT NULL AUTO_INCREMENT,
    datum_vydani DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    tematicke_cislo ENUM ('hardware', 'software', 'gaming', 'ai') NOT NULL,
    soubor_cesta VARCHAR(255) NOT NULL,
    PRIMARY KEY (id_vydani)
);