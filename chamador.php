<?php

  $de = rawurlencode("Nilson Caetano Grande");
  $assunto=rawurlencode("Teste de envio de e-mail");
  $corpo = rawurlencode("estou testando o envio desse email");
  $para = rawurlencode("carlos@vidrolar.com");
  
  $endereco = "http://intranet.vidrolar.com/emailgenerico.php?from=$de&subject=$assunto&body=$corpo&to=$para";
  
  echo $endereco;
  
  $envio = file_get_contents($endereco);

  //echo "<br>conteudo: ".$envio;
?>