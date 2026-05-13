<?php
$rra = 'Gostay@2026';

$senhacripto = password_hash($rra, PASSWORD_ARGON2ID);
echo($senhacripto);


?>