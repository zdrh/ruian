<?php
echo $this->extend('layout/layout');

echo $this->section('content');

?>

<h1>Informace o obcích ve Zlínském kraji</h1>

<p>Stránka, která z <a href="https://cs.wikipedia.org/wiki/Registr_%C3%BAzemn%C3%AD_identifikace,_adres_a_nemovitost%C3%AD">RÚAIN</a> získává informace o Zlínském kraji. Chceš vědět, který nzev ulice je v našem kraji nejčastější? Která obec má nejvíc místních částí? Kolik je v které adresních míst? To vše se dovíž z tohoto webu.


<p>Stránka se vykreslila za {elapsed_time} sekund</p>
<?php

echo $this->endSection();