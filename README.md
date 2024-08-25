# Webtechnologie Project Herkansing

## Overzicht
Dit project is ontwikkeld om gegevens van een server op te halen, te verwerken, en te presenteren via een webinterface. Het systeem is opgebouwd uit verschillende componenten, waaronder een backend die de gegevens ophaalt en een frontend die deze gegevens dynamisch weergeeft.

## Inhoud
- [Project Beschrijving](#project-beschrijving)
- [Technische Specificaties](#technische-specificaties)
- [Systeemarchitectuur](#systeemarchitectuur)
- [Installatie](#installatie)
- [Gebruik](#gebruik)
- [API Documentatie](#api-documentatie)
- [Technologieën](#technologieën)
- [Bijdragen](#bijdragen)
- [Licentie](#licentie)

## Project Beschrijving
Dit project haalt gegevens op van een server en verwerkt deze gegevens voor presentatie op een webpagina. De server slaat de gegevens op in een database en biedt een API aan waarmee de frontend periodiek de nieuwste gegevens kan ophalen en weergeven in een tabel.

## Technische Specificaties
- **Server**: Verantwoordelijk voor het genereren en opslaan van gegevens.
- **Database**: Opslag van gegevens op de server.
- **Backend**: API voor het ophalen en beheren van gegevens.
- **Frontend**: Webinterface voor het dynamisch weergeven van gegevens.

## Systeemarchitectuur
- **Server**: Zorgt voor de gegevensgeneratie en opslag.
- **Backend**:
  - **API**: Biedt een endpoint aan waarmee gegevens uit de database kunnen worden opgevraagd en toegevoegd.
- **Frontend**:
  - **HTML/CSS**: Structureert en style de webpagina.
  - **JavaScript**: Maakt periodieke API-aanroepen om de gegevens op de webpagina bij te werken.

## Installatie
### Vereisten
- Een server met de juiste configuratie om gegevens te genereren en op te slaan.
- Een database voor het opslaan van gegevens.
- Een webserver met PHP-ondersteuning (bijvoorbeeld Apache).
- Een webbrowser voor toegang tot de webinterface.

### Installatie Stappen
1. **Server Configuratie**:
    - Zorg ervoor dat de server correct is ingesteld om de benodigde gegevens te genereren en op te slaan in de database.

2. **Database Installatie**:
    - Installeer een database zoals PostgreSQL of MySQL.
    - Maak een database en een tabel om de gegevens op te slaan. Bijvoorbeeld:
      ```sql
      CREATE TABLE data_table (
          id SERIAL PRIMARY KEY,
          data_column VARCHAR(255),
          timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
      );
      ```

3. **Webserver Configuratie**:
    - Plaats de `api.php` en de HTML-bestanden in de documentroot van je webserver (bijvoorbeeld `/var/www/html`).
    
4. **PHP Configuratie**:
    - Zorg ervoor dat de PHP-configuratie juist is ingesteld om verbinding te maken met de database. Pas de databaseconfiguratie aan in `api.php`.

5. **Open de Webpagina**:
    - Bezoek `http://server-of-bjarni.pxl.bjth.xyz/` in je webbrowser om de webinterface te bekijken.

## Gebruik
- **Homepagina**: `index.php` biedt toegang tot de verschillende pagina's van het project.
- **Gegevenspagina**: Een HTML-pagina die een dynamische tabel toont met de nieuwste gegevens, welke automatisch wordt bijgewerkt.
  - **Let op**: De tijdstempels van de gegevens zijn afhankelijk van de servertijd, die mogelijk in een andere tijdzone staat.

## API Documentatie
### Endpoints
- **GET /api.php**:
  - Haalt alle gegevens op in JSON-formaat.
  - Optioneel: Voeg een queryparameter `id` toe om gegevens voor een specifieke ID op te halen.

- **POST /api.php**:
  - Voegt een nieuwe gegevensrecord toe aan de database.

- **PUT /api.php?id={id}**:
  - Werkt de gegevens bij voor de opgegeven ID.

- **DELETE /api.php?id={id}**:
  - Verwijdert de gegevens voor de opgegeven ID.

## Technologieën
- **Server**: Verantwoordelijk voor gegevensverwerking en -opslag.
- **Database**: Relationele database voor gegevensopslag (bijvoorbeeld PostgreSQL of MySQL).
- **PHP**: Server-side scripting taal voor de API.
- **HTML/CSS/JavaScript**: Webtechnologieën voor frontend weergave.

## Bijdragen
Bijdragen aan dit project zijn welkom. Maak een pull request of open een issue om wijzigingen voor te stellen.

## Licentie
Dit project is gelicenseerd onder de MIT-licentie.
