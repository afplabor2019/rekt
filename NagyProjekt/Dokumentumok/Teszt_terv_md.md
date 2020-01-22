| Tesztel�si terv |
| --- |
|   |
| Team Finder |
|   |
|   |

| **Dokumentum c�me: (azonos�t�ja)** | Team Finder |
| --- | --- |
| **Min�s�t�s: (�llapot)**_(tervezet, j�v�hagyott, stb.)_ | Fejleszt�s alatt |
| **Verzi�sz�m:** | 1.0 |
| **Projekt n�v:** | Team Finder |
| **K�sz�tette:** | REKT |
| **Utols� ment�s kelte:** | 2019.12.07 |

Tartalomjegyz�k

| 1        Bevezet�s        3 |
| --- |
| 1.1        Tesztel�si terv hat�k�re, c�lja        3 |
| 1.2        Elv�r�sok        3 |
| 2        Sz�ks�ges er�forr�sok        3 |
| 2.1        Feladatk�r�k �s felel�ss�gek (tesztcsapat meghat�roz�sa)        3 |
| 2.2        Tesztk�rnyezet        3 |
| 2.3        Tesztadatok        3 |
| 2.4        Lesz�ll�tand� teszt dokumentumok        3 |
| 2.5        Tesztel�si eszk�z�k        3 |
| 3        Tesztel�si terv        3 |
| 3.1        Fejleszt�i teszt        3 |
| 3.2        Protot�pus (modul) teszt        3 |
| 3.3        Integr�ci�s teszt        3 |
| 3.4        Elfogad�si teszt        3 |
| 3.5        Terhel�ses teszt        3 |
| 3.6        Biztons�gi teszt (audit)        3 |
| 3.7        Go live teszt        3 |
| 3.8        Tesztel�si feladatok, teszt-esetek le�r�sa        3 |
| 3.9        Tesztel�si �temterv, f�gg�s�gek � tesztforgat�k�nyv        3 |
| 4        Tesztel�si jegyz�k�nyv �s tesztel�si jelent�s        3 |
| 4.1        Tesztel�si jegyz�k�nyv        3 |
| 4.2        Tesztel�si jelent�s        3 |
| 4.3        Tesztelt elv�r�sok        3 |
| 4.4        Elfogad�si krit�riumok        3 |
| 4.5        Kock�zat kezel�s        3 |
| 4.6        Hat�sk�r�n k�v�l es� elemek        3 |
| 5        Tesztjegyz�k�nyv minta 1 (Ez a fejezet annyiszor ism�tlend� ah�ny teszt-eset van)        3 |
| 6        Tesztel�si jelent�s minta 1 (Ez a fejezet annyiszor ism�tlend� ah�ny tesztel�si jelent�s van)        3 |
| |

| **V�ltoztat�sok**** jegyz�ke** |
| --- |
| **Verzi�** | **D�tum** | **K�sz�tette** | **Megjegyz�s** |
|   |   |   |   |
|   |   |   |   |
|   |   |   |   |
|   |   |   |   |



| **A dokumentumot megkapj�k** |
| --- |
| **N�v** | **Funkci�** |
|   |   |
|   |   |
|   |   |



1. **1** Bevezet�s

A teszt c�lja a weboldal megfelel� m�k�d�s�nek az ellen�rz�se, hib�inak felt�r�sa.

1.
  1. **1.1** Tesztel�si terv hat�k�re, c�lja

A teszt v�grehajt�s��rt a projekt menedzser - Danisovszky Erik felel, �s a tesztcsapat hajtja v�gre a 2.1. fejezetben meghat�rozott m�don.

1.
  1. **1.2** Elv�r�sok

 Az al�bbi alap elv�r�sok k�pezik ennek a teszttervnek az alapj�t:

- Az olvas� ismeri az alapdokumentumokat, amelyek meghat�rozz�k a rendszert.
- A tesztprogram az ebben a dokumentumban meghat�rozott tesztterv alapj�n fut.

1. **2** Sz�ks�ges er�forr�sok

Szerver a weboldal futtat�s�hoz

1.
  1. **2.1** Feladatk�r�k �s felel�ss�gek (tesztcsapat meghat�roz�sa)

| **Feladatk�r�k �s felel�ss�gek** |
| --- |
| **Feladatk�r** | **Felel�ss�g/tev�kenys�g** |
| **Tesztel�:** |
- A teszt v�grehajt�sa
- �szrev�telek dokument�l�sa
- Teszt dokument�ci� archiv�l�sa
 |
| **Szak�rt�:** | A szak�rt� az �szrev�telek elemzi �s megold�st javasol. |
| **Teszt**** - ****koordin�tor:** |
- Teszt terv k�sz�t�se
- A tesztterv j�v�hagyat�sa a projektmenedzserrel
- Teszt forgat�k�nyvek l�trehoz�sa
- Helyes �s id�beni hibakezel�s
- Sz�ks�g eset�n probl�m�k eszkal�l�sa a projekt menedzsernek
- V�gs� riport k�sz�t�se
- Teszt dokumentum archiv�l�sa
- Az �szrev�telek st�tusz�nak k�vet�se, ill. dokument�l�sa
 |
| **Projektvezet�:** |
- Teszt terv j�v�hagy�sa
- Teszt forgat�k�nyv (testscript)
 |

1.
  1. **2.2** Tesztadatok

A teszt v�grehajt�s�hoz sz�ks�ges rekordok (tesztadatok) sz�ma: 1

Teszt rekord dokumentumok:

- User\_Table\_Test\_data.sql

A tesztadatoknak az al�bbi k�vetelm�nyeknek kell megfelelni�k:

- Az alapadatok �rt�kk�szlete az �les rendszerrel megegyez� kell, hogy legyen.



1.
  1. **2.3** Fejleszt�i teszt

A fejleszt�i tesztel�s c�lja a rendszer alapvet� funkci�inak ellen�rz�se, a hibakezel�s �s az alapvet� funkci�k m�k�d�s�nek vizsg�lata. M�dszere: Static testing

1.
  1. **2.4** Protot�pus (modul) teszt

A protot�pustesztel�s (vagy m�sik nev�n modultesztel�s) c�lja a rendszer m�r m�k�d� moduljainak �n�ll� tesztel�se, a modulon bel�li hib�k azonos�t�s�nak �s kik�sz�b�l�s�nek �rdek�ben.

1.
  1. **2.5** Integr�ci�s teszt

Az integr�ci�s teszt c�lja a rendszer m�s rendszerekhez t�rt�n� illeszt�s�nek vizsg�lata, a t�bb rendszereken kereszt�l �t�vel� funkci�k tesztel�s�nek �rdek�ben. Az adatmigr�ci�s tesztel�s az integr�ci�s tesztel�shez tartozik, ennek l�nyege, hogy a bevezetend� rendszerbe �tt�ltik azokat az adatokat, amelyekkel a rendszer dolgozni fog �s letesztelik a bet�lt�tt adatok, illetve az adatokat kezel� funkci�k helyess�g�t. M�dszere: Black box testing

1.
  1. **2.6** Elfogad�si teszt

Az elfogad�si teszt c�lja a rendszer teljes funkcionalit�s�nak vizsg�lata a felhaszn�l�k szemsz�g�b�l.

1.
  1. **2.7** Terhel�ses teszt

A terhel�ses teszt c�lja a tervezett kapacit�sok, valamint a rendelkez�sre �ll� n�veked�si potenci�l meghat�roz�sa. M�dszere: Stress testing

1.
  1. **2.8** Biztons�gi teszt

Adatb�zis v�delm�nek tesztel�se.



1. **3** Tesztel�si jegyz�k�nyv �s tesztel�si jelent�s
  1. **3.1** Tesztelt elv�r�sok

| **#** | **Le�r�s** |
| --- | --- |
| **1.** | Regisztr�ci�/Bejelentkez�s m�k�d�se |
| **2.** | Sz�r�s pontoss�ga |
| **3.** | Hirdet�s felad�sa |
| **4.** | Hirdet�kkel val� kapcsolatfelv�tel |
| **5.** | Oldal �tl�that�s�ga |
| **6.** | Oldal�klhat�s�ga ldal haszn�lhat�s�ga |



1.
  1. **3.2** Elfogad�si krit�riumok

A teszt sikeress�g�nek krit�riumai:

- A tesztelt elv�r�sok teljes�l�se.
- A projekt menedzser j�v�hagy�sa.