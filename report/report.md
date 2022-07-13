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
- [Progettazione concettuale](#progettazione-concettuale)
  - [Schema scheletro](#schema-scheletro)
  - [Schema finale](#schema-finale)
- [Progettazione logica](#progettazione-logica)
  - [Stima del volume dei dati](#stima-del-volume-dei-dati)
  - [Descrizione delle operazioni principali e stima delle loro frequenze](#descrizione-delle-operazioni-principali-e-stima-delle-loro-frequenze)
  - [Schemi di navigazione e tabelle degli accessi](#schemi-di-navigazione-e-tabelle-degli-accessi)
  - [Operazioni di controllo](#operazioni-di-controllo)
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
| Termine      | Descrizione                                                            | Sinonimi         |
|:-------------|:-----------------------------------------------------------------------|:-----------------|
| Cliente      |utente esterno che interagisce con la compagnia                         | client           |
| Guidatore    |utente interno che si occupa delle consegne                             | driver           |
| Magazziniere |utente interno che si occupa del magazzino                              | warehouse worker |
| Veicolo      |mezzo per trasportare prodotti e spazzatura                             | vehicle          |
| Patente      |licenza per la guida                                                    | driver license   |
| Ordine       |effettuato dai clienti per acquistare prodotti e la raccolta dei rifiuti| order            |
| Magazzino    |struttura che contiene i prodotti da vendere/acquistare                 | warehouse        |
| Prodotto     |oggetto che può essere venduto/acquistato                               | product          |
| Contenitore  |oggetto che contiene i sacchetti della spazzatura da ritirare           | container        |
| Sacchetto    |oggetto che contiene la spazzatura da ritirare                          | trashbag         |


Ogni **cliente** può effettuare **ordini** di vari **prodotti**, ad ogni **guidatore** è associato un **veicolo** e ad ogni **magazziniere** un **magazzino**. <br>

Lista delle principali operazioni effettuate:
- aggiungere un nuovo utente (cliente, guidatore o magazziniere)
- effettuare l'accesso degli utenti con i relativi permessi
- effettuare un nuovo ordine di prodotti
- richiedere la raccolta della spazzatura a domicilio
- mostrare la cronologia degli ordini effettuati
- assegnare un veicolo ad un guidatore
- inserire le patenti di un guidatore
- mostrare la cronologia dei veicoli assegnati ad un guidatore
- consegnare gli ordini effettuati
- raccogliere la spazzatura a domicilio e rilasciarla in una discarica specifica
- associare un magazzino ad un magazziniere
- aggiungere un nuovo prodotto al magazzino
- visualizzare l'inventario di tutti i magazzini

<div style="page-break-after: always;"></div>

# Progettazione concettuale
## Schema scheletro
![User ER](./res/user.png) <br>
L'entità _driver_ e l'entità _warehouse worker_ sono la generalizzazione dell'entita _client_. <br>
Sono identificati per _fiscal code_ e vengono utilizzati l'_username_ e la _password_ per accedere all'applicazione. <br>
Ogni _driver_ possiede una o più _driver license_. <br>
Ogni _vehicle_ è identificato dalla _license plate_ e può essere guidato da un solo _driver_ alla volta che deve possedere la _driver license_ richiesta, inoltre ad ogni veicolo è associato un _brand_; tramite il campo _date_ nell'associazione _drives_ ci è possibile tenere traccia dei veicoli guidati da ogni guidatore durante quella giornata. <br>

![Order ER](./res/order.png) <br>
L'entità _order_ ha associato il _client_ che l'ha effettuato e il _driver_ che lo ha consegnato. <br>
Esistono due tipi di ordini: _pick up garbage_ e _order of product_ che sono la generalizzazione dell'entita _order_. <br>
Ogni _pick up garbage_ è poi rilasciato in una _waste disposal_. <br>
Ad ogni _order of product_ sono associati i prodotti acquistati, mentre ad un _pick up garbage_ sono associati i _trashbag_ da ritirare. <br>
Ad ogni _product_ quando viene acquistato viene associato l'_order of product_ e/o il _pick up garbage_ corrispondente. <br>

## Schema finale
![Conceptual ER](./res/conceptual.png) <br>

# Progettazione logica
## Stima del volume dei dati

| Concetto         | Costrutto | Volume    |
|:-----------------|:---------:|:----------|
| client           | E         | 2.004.000 |
| driver           | E         | 2.000     |
| warehouse worker | E         | 2.000     |
| warehouse        | E         | 40        |
| driver license   | E         | 5         |
| vehicle          | E         | 1200      |
| brand            | E         | 20        |
| drives           | R         | 500.000   |
| order            | E         | 2.000.000 |
| pick up garbage  | E         | 1.100.000 |
| order of product | E         | 1.200.000 |
| product          | E         | 5.000.000 |
| trashbag         | E         | 3.700.000 |
| container        | E         | 1.300.000 |
| waste disposal   | E         | 20        |

Ci aspettiamo di avere un numero elevato e sempre in aumento di _order_ (_pick up garbage_, _order of product_), _product_ (_trashbag_, _container_) e _drives_ , rispettivamente perchè gli _order_ e i _drives_ servono per gli storici, mentre i _product_ una volta essere stati venduti non vengono eliminati dal database per poter risalire a quali prodotti sono stati acquistati nei singoli ordini ed inoltre per poter scegliere quali _trashbag_ possono essere ritirate. <br>

<div style="page-break-after: always;"></div>

## Descrizione delle operazioni principali e stima delle loro frequenze

| Codice | Operazione                                   | Frequenza         |
|:------:|:---------------------------------------------|:------------------|
| 1      |aggiungere un nuovo cliente                   | 80 al giorno      |
| 2      |aggiungere un nuovo magazziniere              | 30 all'anno       |
| 3      |aggiungere un nuovo guidatore                 | 30 all'anno       |
| 4      |effettuare l'accesso degli utenti             | 150.000 al giorno |
| 5      |effettuare un nuovo ordine di prodotti        | 10.000 al giorno  |
| 6      |richiedere la raccolta della spazzatura       | 5.000 al giorno   |
| 7      |mostrare la cronologia degli ordini effettuati| 3.000 al giorno   |
| 8      |assegnare un veicolo ad un guidatore          | 8.000 al giorno   |
| 9      |inserire le patenti di un guidatore           | 70 all'anno       |
| 10     |mostrare la cronologia dei veicoli assegnati  | 100 all'anno      |
| 11     |consegnare gli ordini effettuati              | 5.500 al giorno   |
| 12     |raccogliere la spazzatura e rilasciarla       | 2.500 al giorno   |
| 13     |associare un magazzino ad un magazziniere     | 45 all'anno       |
| 14     |aggiungere un nuovo prodotto al magazzino     | 25.000 al giorno  |
| 15     |visualizzare l'inventario di tutti i magazzini| 2 alla settimana  |

## Schemi di navigazione e tabelle degli accessi
Di seguito sono riportate le tabelle degli accessi per ogni operazione sopra riportata: <br>

<h3> Operazione 1: aggiungere un nuovo cliente </h3>

| Concetto | Costrutto | Accessi | Tipo |
|:---------|:---------:|:-------:|:----:|
| client   | E         | 2       | L    |
| client   | E         | 1       | S    |

totale: 2L + 1S → 80 al giorno

<h3> Operazione 2: aggiungere un nuovo magazziniere </h3>

| Concetto         | Costrutto | Accessi | Tipo |
|:-----------------|:---------:|:-------:|:----:|
| client           | E         | 2       | L    |
| client           | E         | 1       | S    |
| warehouse worker | E         | 1       | S    |

totale: 2L + 2S → 30 all'anno

<h3> Operazione 3: aggiungere un nuovo guidatore </h3>

| Concetto | Costrutto | Accessi | Tipo |
|:---------|:---------:|:-------:|:----:|
| client   | E         | 2       | L    |
| client   | E         | 1       | S    |
| driver   | E         | 1       | S    |

totale: 2L + 2S → 30 all'anno

<h3> Operazione 4: effettuare l'accesso degli utenti </h3>

| Concetto | Costrutto | Accessi | Tipo |
|:---------|:---------:|:-------:|:----:|
| client   | E         | 1       | L    |

totale: 1L → 150.000 al giorno

<h3> Operazione 5: effettuare un nuovo ordine di prodotti </h3>

| Concetto         | Costrutto | Accessi | Tipo |
|:-----------------|:---------:|:-------:|:----:|
| product          | E         | 3       | L    |
| order of product | E         | 1       | L    |
| order of product | E         | 1       | S    |
| product          | E         | 1       | S    |

totale: 4L + 2S → 10.000 al giorno

<h3> Operazione 6: richiedere la raccolta della spazzatura </h3>

| Concetto         | Costrutto | Accessi | Tipo |
|:-----------------|:---------:|:-------:|:----:|
| product          | E         | 2       | L    |
| trashbag         | E         | 1       | L    |
| order of product | E         | 1       | L    |
| pick up garbage  | E         | 1       | S    |
| trashbag         | E         | 1       | S    |

totale: 4L + 2S → 5.000 al giorno

<h3> Operazione 7: mostrare la cronologia degli ordini effettuati </h3>

| Concetto         | Costrutto | Accessi | Tipo |
|:-----------------|:---------:|:-------:|:----:|
| order of product | E         | 1       | L    |
| pick up garbage  | E         | 1       | L    |
| waste disposal   | E         | 1       | L    |

totale: 3L → 3.000 al giorno

<h3> Operazione 8: assegnare un veicolo ad un guidatore </h3>

| Concetto         | Costrutto | Accessi | Tipo |
|:-----------------|:---------:|:-------:|:----:|
| driver           | E         | 3       | L    |
| vehicle          | E         | 1       | L    |
| owns             | R         | 1       | L    |
| driver           | E         | 1       | S    |
| drives           | R         | 1       | S    |

totale: 5L + 2S → 8.000 al giorno

<h3> Operazione 9: inserire le patenti di un guidatore </h3>

| Concetto         | Costrutto | Accessi | Tipo |
|:-----------------|:---------:|:-------:|:----:|
| owns             | R         | 2       | L    |
| driver license   | E         | 1       | L    |
| owns             | R         | 1       | S    |

totale: 3L + 1S → 70 all'anno

<h3> Operazione 10: mostrare la cronologia dei veicoli assegnati </h3>

| Concetto         | Costrutto | Accessi | Tipo |
|:-----------------|:---------:|:-------:|:----:|
| drives           | R         | 1       | L    |
| vehicle          | E         | 1       | L    |

totale: 2L → 100 all'anno

<h3> Operazione 11: consegnare gli ordini effettuati </h3>

| Concetto         | Costrutto | Accessi | Tipo |
|:-----------------|:---------:|:-------:|:----:|
| driver           | E         | 1       | L    |
| vehicle          | E         | 1       | L    |
| order of product | E         | 2       | L    |
| order of product | E         | 1       | S    |
| driver           | E         | 1       | S    |

totale: 4L + 2S → 5.500 al giorno

<h3> Operazione 12: raccogliere la spazzatura e rilasciarla </h3>

| Concetto         | Costrutto | Accessi | Tipo |
|:-----------------|:---------:|:-------:|:----:|
| driver           | E         | 1       | L    |
| vehicle          | E         | 1       | L    |
| pick up garbage  | E         | 2       | L    |
| waste disposal   | E         | 1       | L    |
| pick up garbage  | E         | 1       | S    |
| driver           | E         | 1       | S    |

totale: 5L + 2S → 2.500 al giorno

<h3> Operazione 13: associare un magazzino ad un magazziniere </h3>

| Concetto         | Costrutto | Accessi | Tipo |
|:-----------------|:---------:|:-------:|:----:|
| warehouse worker | E         | 2       | L    |
| warehouse        | E         | 1       | L    |
| warehouse worker | E         | 1       | S    |

totale: 3L + 1S → 45 all'anno

<h3> Operazione 14: aggiungere un nuovo prodotto al magazzino</h3>

| Concetto           | Costrutto | Accessi | Tipo |
|:-------------------|:---------:|:-------:|:----:|
| warehouse worker   | E         | 1       | L    |
| garbage            | E         | 1       | L    |
| product            | E         | 1       | S    |
| trashbag/container | E         | 1       | S    |  

L'ultima operazione cambia in base a che tipo di prodotto si sta aggiungendo

totale: 2L + 2S → 25.000 al giorno

<h3> Operazione 15: visualizzare l'inventario di tutti i magazzini </h3>

| Concetto         | Costrutto | Accessi | Tipo |
|:-----------------|:---------:|:-------:|:----:|
| warehouse        | E         | 1       | L    |
| product          | E         | 1       | L    |

totale: 2L → 2 alla settimana

## Operazioni di controllo
Le sequenti operazioni vengono eseguite ogni volta che un guidatore vuole rispondere ad un ordine.

<h3>  Controllo se c'è una patente associata al guidatore </h3> 

| Concetto         | Costrutto | Accessi | Tipo |
|:-----------------|:---------:|:-------:|:----:|
| owns             | R         | 1       | L    |

totale: 1L

<h3> Controllo se il veicolo è assegnato al guidatore </h3> 

| Concetto         | Costrutto | Accessi | Tipo |
|:-----------------|:---------:|:-------:|:----:|
| driver           | E         | 1       | L    |

totale: 1L

## Raffinamento dello schema

## Analisi delle ridondanze

## Traduzione di entità e associazioni in relazioni

## Schema relazione finale

## Traduzione delle operazioni in query SQL

# Progettazione dell'applicazione

## Descrizione dell'architettura dell'applicazione realizzata

