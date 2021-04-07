<?php

/**
 * Standard view template to generate a simple web page, or part of a web page.
 */

declare(strict_types=1);

$header = $header ?? null;
$message = $message ?? null;
$_SESSION["diceHandRoll"] = $_SESSION["diceHandRoll"] ?? null;
$_SESSION["playerSum"] = $_SESSION["playerSum"] ?? null;
$_SESSION["playerSafe"] = $_SESSION["playerSafe"] ?? null;
$_SESSION["playerSafeComp"] = $_SESSION["playerSafeComp"] ?? null;
$_SESSION["comSays"] = $_SESSION["comSays"] ?? null;
$_SESSION["compPoints"] = $_SESSION["compPoints"] ?? null;
$_SESSION["playerPoints"] = $_SESSION["playerPoints"] ?? null;

?><h1><?= $header ?></h1>

<br>



<p><?php $_SESSION["diceHandRoll"] ?></p>

<p></p>
<p class = "dice-utf8">

    <?php if (isset($diceHandRollGraph)) {
        foreach ($diceHandRollGraph as $value) : ?>
            <i class="<?= $value ?>"></i>
        <?php endforeach;
    }
    ?>
    
</p>
<hr>

<p>SUMMA: <?= $_SESSION["playerSum"]?></p>


<p><?= $_SESSION["playerSafe"]?></p>
<br><br><br>

<p>Datorn fick:</p>

<p><?= $_SESSION["playerSafeComp"]?></p>
<p><?= $_SESSION["comSays"]?></p>




<hr>

<p>Vinster (computer)</p>
<p><?= $_SESSION["compPoints"]?></p>
<hr>

<p>Vinster (player)</p>
<p><?= $_SESSION["playerPoints"]?></p>
<hr>

<form action="gamebegin" method="POST">
<input type="submit" name="stop" value = "STOP"> |
<input type="submit" name="kasta" value = "KASTA" > |
<input type="submit" name="reset" value = "RESET" >
