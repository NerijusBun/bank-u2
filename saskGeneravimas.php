<?php

// Banko sąskaitos numeriai Lietuvoje sudaromi iš 20 simbolių:
// raidinis šalies kodas	LT
// 2 kontroliniai skaitmenys (automatiškai priskiria bankas)	XX
// 5 skaitmenų banko kodas	XXXXX 
// 11 skaitmenų senasis sąskaitos numeris	XXXXXXXXXXX ----- 0000000xxxx

$accountNo = 'LT' . rand(10,99) . '70770' . rand(10000000000, 99999999999);

// echo $accountNo;

// ASMENS KODO TAISYKLES:
// Asmens kodas susideda iš 11 skaitmenų, pvz.: 33309240064:
// pirmasis rodo gimimo šimtmetį ir asmens lytį (1 – XIX a. gimęs vyras, 2 – XIX a. gimusi moteris, 3 – XX a. gimęs vyras, 4 – XX a. gimusi moteris, 5 – XXI a. gimęs vyras, 6 – XXI a. gimusi moteris);
// tolesni šeši – asmens gimimo metų du paskutiniai skaitmenys, mėnuo (du skaitmenys), diena (du skaitmenys);
// dar tolesni trys skaitmenys – tą dieną gimusių asmenų eilės numeris;
// paskutinis – iš kitų skaitmenų išvedamas kontrolinis skaičius.
// Jei asmens kodas užrašomas ABCDEFGHIJK, tai:
// S = A*1 + B*2 + C*3 + D*4 + E*5 + F*6 + G*7 + H*8 + I*9 + J*1
// Suma S dalinama iš 11, ir jei liekana nelygi 10, ji yra asmens kodo kontrolinis skaičius K. Jei liekana lygi 10, tuomet skaičiuojama nauja suma su tokiais svertiniais koeficientais:
// S = A*3 + B*4 + C*5 + D*6 + E*7 + F*8 + G*9 + H*1 + I*2 + J*3
// Ši suma S vėl dalinama iš 11, ir jei liekana nelygi 10, ji yra asmens kodo kontrolinis skaičius K. Jei vėl liekana yra 10, kontrolinis skaičius K yra 0.
