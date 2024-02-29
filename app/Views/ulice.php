<?php
echo $this->extend('layout/layout');

echo $this->section('content');

?>
<h1>Nejčastější názvy ulic</h1>
<?php
$table = new \CodeIgniter\View\Table();

$table->setHeading('Pořadí', 'Název ulice', 'Počet výskytů', 'Seznam obcí s ulicí');

foreach ($ulice as $key => $row) {
    $seznamObci = $ulice2[$row->nazev];
    $vysledek = "";
    foreach ($seznamObci as $obec) {
        $vysledek .= $obec . ", ";
    }
    $vysledek = substr($vysledek, 0, -2);
    $table->addRow($key + $firstRecord, $row->nazev, $row->pocet, $vysledek);
}

$template = array(
    'table_open' => '<table class="table table-bordered">',
    'thead_open' => '<thead>',
    'thead_close' => '</thead>',
    'heading_row_start' => '<tr>',
    'heading_row_end' => ' </tr>',
    'heading_cell_start' => '<th>',
    'heading_cell_end' => '</th>',
    'tbody_open' => '<tbody>',
    'tbody_close' => '</tbody>',
    'row_start' => '<tr>',
    'row_end'  => '</tr>',
    'cell_start' => '<td>',
    'cell_end' => '</td>',
    'row_alt_start' => '<tr>',
    'row_alt_end' => '</tr>',
    'cell_alt_start' => '<td>',
    'cell_alt_end' => '</td>',
    'table_close' => '</table>'
);

$table->setTemplate($template);


echo $table->generate();
echo $pager->links();

?>
    <p>Stránka se vykreslila za {elapsed_time} sekund</p>
<?= $this->endSection();?>
