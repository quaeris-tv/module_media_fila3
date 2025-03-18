# Correzioni PHPStan Livello 10 - Modulo Media

Questo documento traccia gli errori PHPStan di livello 10 identificati nel modulo Media e le relative soluzioni implementate.

## Principio Fondamentale: Evitare `mixed` a tutti i costi

Il tipo `mixed` dovrebbe essere considerato **SOLO come ultima spiaggia** quando non è possibile determinare tipi più specifici. In tutti gli altri casi, dobbiamo sostituirlo con tipi più precisi per:

- Migliorare l'analisi statica del codice
- Ridurre gli errori a runtime
- Aumentare la leggibilità e la manutenibilità
- Facilitare l'autocompletamento negli IDE
- Garantire che i contratti di tipo siano rispettati

### Alternative raccomandate a `mixed`:

1. **Tipi unione**: `string|int|null`
2. **Tipi generici**: `array<string, int>`
3. **Interfacce**: `MediaInterface` invece di oggetti generici
4. **Value objects e DTO**: Utilizzare classi specifiche per i dati (Spatie Data)
5. **Type narrowing**: Controllare i tipi con `is_*` e gestire ogni caso separatamente

## Errori Identificati

### 1. Uso del tipo mixed per risorsa di file in VideoStream.php

```php
private mixed $stream; // File stream resource
```

**Problema**: Utilizzo del tipo `mixed` per la proprietà `$stream` che rappresenta una risorsa di file. In PHP, le risorse hanno un tipo specifico che non può essere correttamente rappresentato come scalare o oggetto.

**Soluzione**:
1. Utilizzato un'annotazione PHPDoc per specificare il tipo `resource|null` e inizializzato la proprietà a `null`:
   ```php
   /** @var resource|null */
   private $stream = null; // File stream resource
   ```

   Questo approccio è necessario perché PHP non supporta direttamente il tipo `resource` come tipo di dichiarazione, ma PHPStan può comprenderlo attraverso l'annotazione PHPDoc.

### 2. Altri problemi di tipo in SubtitleService.php

Il file `SubtitleService.php` contiene un'annotazione PHPDoc con tipi complessi che potrebbero generare errori a livello 10:

```php
* @return (float|int|mixed|string)[][]
* @psalm-return list{0?: array{sentence_i: int<0, max>, item_i: int<0, max>, start: float|int, end: float|int, time: string, text: mixed},...}
```

**Problema**: L'uso di `mixed` e tipizzazioni complesse può rendere difficile per PHPStan analizzare correttamente il codice.

**Soluzione da implementare**:
1. Rivedere e semplificare le tipizzazioni quando possibile
2. Sostituire i tipi `mixed` con tipi più specifici in base al contesto
3. Valutare la creazione di Value Objects o Data Transfer Objects per rappresentare la struttura in modo tipizzato

### 3. Proprietà con tipo mixed in Media.php

Il modello `Media.php` contiene diverse proprietà documentate con tipo `mixed`:

```php
* @property mixed $extension
* @property mixed $human_readable_size
* @property mixed $original_url
* @property mixed $preview_url
```

**Soluzione da implementare**:
1. Specificare tipi più precisi per queste proprietà in base ai valori effettivi che possono assumere:
   ```php
   * @property string $extension Estensione del file
   * @property string $human_readable_size Dimensione leggibile del file (es. "2.5 MB")
   * @property string $original_url URL originale del media
   * @property string|null $preview_url URL dell'anteprima, se disponibile
   ```

### 4. Rimozione della proprietà $navigationIcon ridefinita nelle risorse Filament

**Problema**: Le classi che estendono `XotBaseResource` non devono ridefinire la proprietà `protected static ?string $navigationIcon` poiché questa è già gestita dalla classe base.

**Soluzione**:
1. Applicato il principio di ereditarietà corretto: le proprietà di configurazione di navigazione devono essere gestite centralmente nella classe base e non ridefinite nelle classi figlie.
2. Mantenere la responsabilità di definire le icone di navigazione nella classe base permette una gestione coerente e un punto unico di configurazione per l'interfaccia utente.

**Benefici**:
- Riduzione della duplicazione del codice
- Semplificazione della manutenzione (modifiche all'UI in un unico punto)
- Coerenza visiva attraverso l'intera applicazione
- Separazione delle responsabilità: la classe base gestisce l'aspetto, le classi figlie la logica specifica

**Pattern applicato**: _Principle of Least Knowledge_ - Le classi figlie non dovrebbero preoccuparsi di dettagli di implementazione dell'interfaccia utente che possono essere gestiti dalla classe base.

## Principi Applicati

1. **Uso appropriato di PHPDoc per tipi speciali**: Quando PHP non supporta nativamente un tipo (come `resource`), utilizzare annotazioni PHPDoc per fornire informazioni di tipo a PHPStan.
2. **Inizializzazione appropriata**: Inizializzare le proprietà con valori appropriati per il loro tipo.
3. **Documentazione chiara**: Fornire commenti esplicativi che indicano lo scopo e il tipo atteso delle proprietà.
4. **Evitare ridefinizioni inutili**: Non ridefinire proprietà o metodi già gestiti dalla classe base, a meno che non sia necessario.
5. **Evitare l'uso di mixed**: Utilizzare tipi specifici il più possibile e considerare `mixed` solo come ultima spiaggia.

## Prossimi Passi

1. Completare la revisione di `SubtitleService.php` per risolvere i problemi di tipo complessi.
2. Aggiornare il modello `Media.php` per specificare tipi più precisi per le proprietà attualmente documentate come `mixed`.
3. Eseguire l'analisi PHPStan a livello 10 per verificare che le correzioni risolvano effettivamente gli errori.
4. Documentare pattern e soluzioni standard per gestire risorse di file e altri tipi speciali nel progetto. 