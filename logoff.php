<?php

session_start();
session_destroy();
session_unset();

echo "<script>alert ('Logoff efetuado com sucesso!'); document.location.href='index.html';</script>";

?>