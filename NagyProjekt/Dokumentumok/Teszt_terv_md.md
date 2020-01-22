| Tesztelési terv |
| --- |
|   |
| Team Finder |
|   |
|   |

| **Dokumentum címe: (azonosítója)** | Team Finder |
| --- | --- |
| **Minõsítés: (állapot)**_(tervezet, jóváhagyott, stb.)_ | Fejlesztés alatt |
| **Verziószám:** | 1.0 |
| **Projekt név:** | Team Finder |
| **Készítette:** | REKT |
| **Utolsó mentés kelte:** | 2019.12.07 |

Tartalomjegyzék

| 1        Bevezetés        3 |
| --- |
| 1.1        Tesztelési terv hatóköre, célja        3 |
| 1.2        Elvárások        3 |
| 2        Szükséges erõforrások        3 |
| 2.1        Feladatkörök és felelõsségek (tesztcsapat meghatározása)        3 |
| 2.2        Tesztkörnyezet        3 |
| 2.3        Tesztadatok        3 |
| 2.4        Leszállítandó teszt dokumentumok        3 |
| 2.5        Tesztelési eszközök        3 |
| 3        Tesztelési terv        3 |
| 3.1        Fejlesztõi teszt        3 |
| 3.2        Prototípus (modul) teszt        3 |
| 3.3        Integrációs teszt        3 |
| 3.4        Elfogadási teszt        3 |
| 3.5        Terheléses teszt        3 |
| 3.6        Biztonsági teszt (audit)        3 |
| 3.7        Go live teszt        3 |
| 3.8        Tesztelési feladatok, teszt-esetek leírása        3 |
| 3.9        Tesztelési ütemterv, függõségek – tesztforgatókönyv        3 |
| 4        Tesztelési jegyzõkönyv és tesztelési jelentés        3 |
| 4.1        Tesztelési jegyzõkönyv        3 |
| 4.2        Tesztelési jelentés        3 |
| 4.3        Tesztelt elvárások        3 |
| 4.4        Elfogadási kritériumok        3 |
| 4.5        Kockázat kezelés        3 |
| 4.6        Hatáskörön kívül esõ elemek        3 |
| 5        Tesztjegyzõkönyv minta 1 (Ez a fejezet annyiszor ismétlendõ ahány teszt-eset van)        3 |
| 6        Tesztelési jelentés minta 1 (Ez a fejezet annyiszor ismétlendõ ahány tesztelési jelentés van)        3 |
| |

| **Változtatások**** jegyzéke** |
| --- |
| **Verzió** | **Dátum** | **Készítette** | **Megjegyzés** |
|   |   |   |   |
|   |   |   |   |
|   |   |   |   |
|   |   |   |   |



| **A dokumentumot megkapják** |
| --- |
| **Név** | **Funkció** |
|   |   |
|   |   |
|   |   |



1. **1** Bevezetés

A teszt célja a weboldal megfelelõ mûködésének az ellenõrzése, hibáinak feltárása.

1.
  1. **1.1** Tesztelési terv hatóköre, célja

A teszt végrehajtásáért a projekt menedzser - Danisovszky Erik felel, és a tesztcsapat hajtja végre a 2.1. fejezetben meghatározott módon.

1.
  1. **1.2** Elvárások

 Az alábbi alap elvárások képezik ennek a teszttervnek az alapját:

- Az olvasó ismeri az alapdokumentumokat, amelyek meghatározzák a rendszert.
- A tesztprogram az ebben a dokumentumban meghatározott tesztterv alapján fut.

1. **2** Szükséges erõforrások

Szerver a weboldal futtatásához

1.
  1. **2.1** Feladatkörök és felelõsségek (tesztcsapat meghatározása)

| **Feladatkörök és felelõsségek** |
| --- |
| **Feladatkör** | **Felelõsség/tevékenység** |
| **Tesztelõ:** |
- A teszt végrehajtása
- Észrevételek dokumentálása
- Teszt dokumentáció archiválása
 |
| **Szakértõ:** | A szakértõ az észrevételek elemzi és megoldást javasol. |
| **Teszt**** - ****koordinátor:** |
- Teszt terv készítése
- A tesztterv jóváhagyatása a projektmenedzserrel
- Teszt forgatókönyvek létrehozása
- Helyes és idõbeni hibakezelés
- Szükség esetén problémák eszkalálása a projekt menedzsernek
- Végsõ riport készítése
- Teszt dokumentum archiválása
- Az észrevételek státuszának követése, ill. dokumentálása
 |
| **Projektvezetõ:** |
- Teszt terv jóváhagyása
- Teszt forgatókönyv (testscript)
 |

1.
  1. **2.2** Tesztadatok

A teszt végrehajtásához szükséges rekordok (tesztadatok) száma: 1

Teszt rekord dokumentumok:

- User\_Table\_Test\_data.sql

A tesztadatoknak az alábbi követelményeknek kell megfelelniük:

- Az alapadatok értékkészlete az éles rendszerrel megegyezõ kell, hogy legyen.



1.
  1. **2.3** Fejlesztõi teszt

A fejlesztõi tesztelés célja a rendszer alapvetõ funkcióinak ellenõrzése, a hibakezelés és az alapvetõ funkciók mûködésének vizsgálata. Módszere: Static testing

1.
  1. **2.4** Prototípus (modul) teszt

A prototípustesztelés (vagy másik nevén modultesztelés) célja a rendszer már mûködõ moduljainak önálló tesztelése, a modulon belüli hibák azonosításának és kiküszöbölésének érdekében.

1.
  1. **2.5** Integrációs teszt

Az integrációs teszt célja a rendszer más rendszerekhez történõ illesztésének vizsgálata, a több rendszereken keresztül átívelõ funkciók tesztelésének érdekében. Az adatmigrációs tesztelés az integrációs teszteléshez tartozik, ennek lényege, hogy a bevezetendõ rendszerbe áttöltik azokat az adatokat, amelyekkel a rendszer dolgozni fog és letesztelik a betöltött adatok, illetve az adatokat kezelõ funkciók helyességét. Módszere: Black box testing

1.
  1. **2.6** Elfogadási teszt

Az elfogadási teszt célja a rendszer teljes funkcionalitásának vizsgálata a felhasználók szemszögébõl.

1.
  1. **2.7** Terheléses teszt

A terheléses teszt célja a tervezett kapacitások, valamint a rendelkezésre álló növekedési potenciál meghatározása. Módszere: Stress testing

1.
  1. **2.8** Biztonsági teszt

Adatbázis védelmének tesztelése.



1. **3** Tesztelési jegyzõkönyv és tesztelési jelentés
  1. **3.1** Tesztelt elvárások

| **#** | **Leírás** |
| --- | --- |
| **1.** | Regisztráció/Bejelentkezés mûködése |
| **2.** | Szûrés pontossága |
| **3.** | Hirdetés feladása |
| **4.** | Hirdetõkkel való kapcsolatfelvétel |
| **5.** | Oldal átláthatósága |
| **6.** | Oldaláklhatósága ldal használhatósága |



1.
  1. **3.2** Elfogadási kritériumok

A teszt sikerességének kritériumai:

- A tesztelt elvárások teljesülése.
- A projekt menedzser jóváhagyása.