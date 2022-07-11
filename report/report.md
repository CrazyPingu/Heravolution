<div style="text-align: center">
    <h1> Elaborato per il corso di basi di dati </h1>
    <h2> A.A 2021/2022 <br> Heravolution </h2>
    <br>
    <h3> Componenti: <br>
        Samuele De Tuglie samuele.detuglie@studio.unibo.it 0000989483 <br>
        Cristina Zoccola cristina.zoccola@studio.unibo.it 0000969874 </h3>
</div>
<div style="page-break-after: always;"></div>

<h1> Indice </h1>

- [Analisi dei requisiti](#analisi-dei-requisiti)
  - [Intervista](#intervista)
  - [Estrazione dei concetti principali](#estrazione-dei-concetti-principali)
- [Progettaziobe concettuale](#progettaziobe-concettuale)
  - [Schema scheletro](#schema-scheletro)
  - [Schema finale](#schema-finale)
- [Progettazione logica](#progettazione-logica)
  - [Stima del volume dei dati](#stima-del-volume-dei-dati)
  - [Descrizione delle operazioni principali e stima delle loro frequenze](#descrizione-delle-operazioni-principali-e-stima-delle-loro-frequenze)
  - [Schemi di navigazione e tabelle degli accessi](#schemi-di-navigazione-e-tabelle-degli-accessi)
  - [Raffinamento dello schema](#raffinamento-dello-schema)
  - [Analisi delle ridondanze](#analisi-delle-ridondanze)
  - [Traduzione di entità e associazioni in relazioni](#traduzione-di-entità-e-associazioni-in-relazioni)
  - [Schema relazione finale](#schema-relazione-finale)
  - [Traduzione delle operazioni in query SQL](#traduzione-delle-operazioni-in-query-sql)
- [Progettazione dell'applicazione](#progettazione-dellapplicazione)
  - [Descrizione dell'architettura dell'applicazione realizzata](#descrizione-dellarchitettura-dellapplicazione-realizzata)

<div style="page-break-after: always;"></div>

# Analisi dei requisiti
## Intervista
Si vuole gestire una compagnia che tratta la vendita e la spedizione di prodotti per la raccolta differenziata e lo smaltimento dei rifiuti. <br>
Comprende tre tipi di utenti: clienti, guidatori e magazzinieri. <br> 
I clienti sono gli utenti base esterni alla compagnia, che usufruiscono dei servizi offerti, quali la vendita e la spedizione di prodotti (sacchetti della spazzatura, contenitori per la raccolta differenziata) e la raccolta dei rifiuti a domicilio. <br>
La raccolta dei rifiuti a domicilio sarà disponibile solo se prima sono stati acquistati i relativi sacchetti della compagnia. <br>
I guidatori si occupano della consegna dei prodotti acquistati e di gestire la raccolta dei rifiuti a domicilio scegliendo anche l'apposita discarica in cui smaltirli, inoltre sono anche considerati dei clienti (quindi possono usufruire dei servizi legati a tale ruolo). <br>
Ogni guidatore deve inserire le patenti che possiede, con la possibilità di aggiornarle in futuro, quindi per effettuare le proprie mansioni potrà scegliere solo tra i veicoli che gli è permesso guidare, stando però attento a cosa deve trasportare siccome ogni mezzo ha una capacità di trasporto massima. <br>
I magazzinieri sono coloro che si occupano di rifornire i diversi magazzini con i prodotti da vendere, durate l'inserimento deve specificare tutte le caratteristiche dei prodotti, proprio come i guidatori anche loro sono considerati dei clienti. <br>
Ogni magazziniere deve scegliere un magazzino in cui rifornire i prodotti, che inoltre può cambiare in qualsiasi momento. <br>
## Estrazione dei concetti principali
| Termine      | Descrizione                                                            | Sinonimi |
|:-------------|:-----------------------------------------------------------------------|:---------|
| Cliente      |utente esterno che interagisce con la compagnia                         |          |
| Guidatore    |utente interno che si occupa delle consegne                             |          |
| Magazziniere |utente interno che si occupa del magazzino                              |          |
| Veicolo      |mezzo per trasportare prodotti e spazzatura                             |          |
| Ordine       |effettuato dai clienti per acquistare prodotti e la raccolta dei rifiuti|          |
| Magazzino    |struttura che contiene i prodotti da vendere/acquistare                 |          |
| Prodotto     |oggetto che può essere venduto/acquistato                               |          |

Ogni **cliente** può effettuare **ordini** di vari **prodotti**, ad ogni **guidatore** è associato un **veicolo** e ad ogni **magazziniere** un **magazzino**. <br>

# Progettaziobe concettuale
## Schema scheletro

## Schema finale

# Progettazione logica

## Stima del volume dei dati

## Descrizione delle operazioni principali e stima delle loro frequenze

## Schemi di navigazione e tabelle degli accessi

## Raffinamento dello schema

## Analisi delle ridondanze

## Traduzione di entità e associazioni in relazioni

## Schema relazione finale

## Traduzione delle operazioni in query SQL

# Progettazione dell'applicazione

## Descrizione dell'architettura dell'applicazione realizzata

