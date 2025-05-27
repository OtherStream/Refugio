<?php
require_once __DIR__ . '/DAO/DAOEnAdopcion.php';

$dao = new DAOAnimalAdopcion();
$animales = $dao->obtenerTodos();
?>

<h2>Lista de animales en adopción</h2>
<ul>
<?php foreach ($animales as $a): ?>
    <li>
        <strong><?= $a->nombre ?></strong> - <?= $a->tipo ?> (<?= $a->tamano ?>)
        <br>
        <img src="<?= $a->imagen ?>" width="100">
    </li>
<?php endforeach; ?>
</ul>
