<?php

declare(strict_types=1);

$header = $header ?? null;
$message = $message ?? null;
?><h1><?= $header ?></h1>
<p> <?= $message ?> </p>
<?php


?>
<?php

if (empty($_POST)) {
    $NrOfDicesToThrowNextRound = 5;
} else {
    $NrOfDicesToThrowNextRound = 6 - count($_POST); // 6 = 5 tärningar i arrayn plus "KASTA" därav 6
}

$game = $_SESSION["yatzygame"]; //hämtar obj
$roll = $game->roll(); // roll
$game->setNrOfDice($NrOfDicesToThrowNextRound);
$whatRound = $game->whatRound();
$whatThrow = $game->whatThrow();
$newRoundOrNot = $game->newRoundOrNot();
$graphDice = $game->getGraphicalDices(); // hämtar värden skriver ut
$getLastRoll = $game->getLastRollWithoutSum();
$savedDicesGraphical = $game->savedDices();
$returnMess = $game->returnMess();
$getnrDice = $game->getNrOfDice();
$checkScore = $game->checkScore();
$checkSum = $game->getSum();

?>
<br>
<p> Poäng denna runda: <?= $checkScore ?> </p>
<p> Summa: <?= $checkSum ?> </p>

<p> Du har kastat  <?= $whatThrow ?> kast denna runda. </p>
<p> Du är på omgång nummer <?= $whatRound ?>. </p>
<p><?= $returnMess ?> </p>
<p class = "mark-newround"> <?= $newRoundOrNot ?> </p>


<!-- Grafisk visning av tärningarna -->
<p class = "dice-utf8">
    <?php if (isset($graphDice)) {
        foreach ($graphDice as $value) : ?>
            <i class="<?= $value ?>"></i>
        <?php endforeach;
    }
    ?>
</p>
<hr>

<p>Välj nedan vilka tärningar du vill spara </p>
<!-- checkboxes för tärningar -->
<hr>
 <form action=yatzy method="POST">
    <?php if (isset($getLastRoll)) {
        $nameOfValue = 0;
        foreach ($getLastRoll as $value) :
            $nameOfValue = $nameOfValue + 1?> <!-- för att byta namn på värdet -->
            <input type="checkbox" name= <?= $nameOfValue ?> value = <?= $value ?>></i>
        <?php endforeach;
    }
    ?>
<!-- Grafisk visning av sparade tärningarna -->
<p>Sparade tärningar </p>
<p class = "dice-utf8"> 
    <?php foreach ($savedDicesGraphical as $value) : ?>
            <i class="<?= $value ?>"></i>
            <?php
            $nameOfValue = $nameOfValue + 1 ?><!-- för att byta namn på värdet , kan ej ha samma namn -->
    <?php endforeach;
        $savedDicesGraphical ?>
</p>

<!-- Checkboxes sparade tärningarna -->
<?php
    $nameOfValue = 0;
    $counter = 0;
foreach ($_SESSION["savedDices"] as $value) :
    $nameOfValue = $nameOfValue - 1?> <!-- för att byta namn på värdet, kan ej ha samma namn -->
    <input type="checkbox" name= <?= $nameOfValue ?> value = <?= $value ?>></i>
<?php endforeach; ?>
<input type="submit" name="kasta" value = "KASTA">

</form>

