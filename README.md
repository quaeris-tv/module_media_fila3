# Module Media
Modulo dedicato alla gestione dei media (immagini, video)

## Aggiungere Modulo nella base del progetto
Dentro la cartella laravel/Modules

```bash
git submodule add https://github.com/laraxot/module_media_fila3.git Media
```

## Verificare che il modulo sia attivo
```bash
php artisan module:list
```
in caso abilitarlo
```bash
php artisan module:enable Media
```

## Eseguire le migrazioni
```bash
php artisan module:migrate Media
```