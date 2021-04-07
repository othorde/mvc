<?php

/**
 * Standard view template to generate a simple web page, or part of a web page.
 */

declare(strict_types=1);

$header = $header ?? null;
$message = $message ?? null;
?><h1><?= $header ?></h1>

<?php
   unset($_SESSION['playerSum']);
   unset($_SESSION['compSum']);
   unset($_SESSION['returnmess']);
?>
<form action="gamebegin" method="POST">
  <label for="fname">Hur många tärningar vill du kasta?</label><br>
  <input type="number" name="dice1" min = 1 max = 2 value = 1><br>
  <input type="submit" value = "submit" ><br>
</form> 
