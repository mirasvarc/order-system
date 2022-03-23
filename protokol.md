## Scénář

Vytvoření objednávkového systému pro společnost zabývající se zemědělstvím. Systém bude sloužit obchodníků pro vytváření objednávek, které jim zadají klienti. Zároveň bude udržovat i databázi klientů. Objednávka se po vytvoření odešle na centrálu, kde si ji přeberou další zaměstnanci. U objednávky je možné měnit její stav. Po vyřízení objednávky se vygeneruje faktura a odešle email s informacemi.


## Požadavky

1) Správa klientů
2) Vytváření objednávek pro jednotlivé klienty
3) Správa objednávky (změna stavu, možnost upravit)
4) Vygenerování faktury a odeslání emailu
5) Přehled objednávek a klientů

## Použité technologie

Pro vytvoření systému bude využit jazyk PHP, konkrétně framework Laravel. Pro ukládání dat databáze MySQL.

## Otázky

1) Co vše je potřeba evidovat u klienta?
2) Jakým způsobem má být zadáváno zboží do objednávky?
3) Jak má vypadat vygenerovaná faktura?
4) Co vše má obsahovat posílaný email?

## Časový plán

1) Návrh databáze - 2 hod.
2) Návrh architektury systému - 3 hod.
3) Grafický návrh - 3 hod.
4) Vytvoření migrací databáze podle návrhu - 2 hod.
5) Vytvoření nového Laravel projektu a základní nastavení - 3 hod.
6) Implementace systému klientů - 4 hod.
7) Implementace systému objednávek - 4 hod.
8) Implementace uživatelských oprávnění - 2 hod.
9) Implementace generování faktury - 5 hod.
10) Implementace generování a zasílání emailů - 4 hod.
11) Kódování designu dle návrhu - 5 hod.
12) Testování - 4 hod.


