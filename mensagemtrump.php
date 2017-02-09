<?php
  
  include 'head.php';
  include 'menu.php';
 $id = $_GET['id'];

 //get mensagem inserida

 $result = mysqli_query($conn,"SELECT mensagem from mensagens WHERE idMensagem='".$id."'");

  $row = mysqli_fetch_assoc($result);

  $mensagem = $row['mensagem'];

  //edição de texto para ficar dentro dos limites.

  $mensagem = preg_replace('#[\r\n]#', ' ', $mensagem);  
  $palavrasMensagem = explode(" ", $mensagem);

  $numPalavrasMensagem = count($palavrasMensagem);

  $limiteCarateresLinha = 20;
  $numCarateresActual = 0;
  $mensagemEditadaEsquerda = "";
  $mensagemEditadaDireita = "";

  $limiteLinhas = 8;
  $numLinhas = 0;

  for($i=0; $i<$numPalavrasMensagem; $i++){
    $numCarateresPalavra = strlen($palavrasMensagem[$i])+1;
    $numCarateresLinha = $numCarateresActual + $numCarateresPalavra;

    if($numLinhas < $limiteLinhas){

      if($numCarateresLinha <= $limiteCarateresLinha){
        $mensagemEditadaEsquerda = $mensagemEditadaEsquerda . $palavrasMensagem[$i] . " ";
        $numCarateresActual = $numCarateresActual + $numCarateresPalavra;
      } else {      
        $mensagemEditadaEsquerda = $mensagemEditadaEsquerda . $palavrasMensagem[$i] . "\n";
        $numCarateresActual = 0;
        $numLinhas++;
      }

    } else {

      if($numLinhas<=10){ //numLinhasTotal
         if($numCarateresLinha <= $limiteCarateresLinha){
          $mensagemEditadaDireita = $mensagemEditadaDireita . $palavrasMensagem[$i] . " ";
          $numCarateresActual = $numCarateresActual + $numCarateresPalavra;
        } else {      
          $mensagemEditadaDireita = $mensagemEditadaDireita . $palavrasMensagem[$i] . "\n";
          $numCarateresActual = 0;
          $numLinhas++;
        }
      } else {
        $mensagemEditadaDireita = $mensagemEditadaDireita;
      }

    }
  }

  //$mensagemEditada = wordwrap($mensagem, 24, "\n");

  //imagem folha lado esquerdo
  $jpg_image = imagecreatefromjpeg('fotos\image.jpg');

  $white = imagecolorallocate($jpg_image, 47, 11, 85);

  $font_path = 'font.TTF';

  imagettftext($jpg_image, 50, -4, 965, 900, $white, $font_path, $mensagemEditadaEsquerda); 
  //imagettftext(resource $image, float $size, float $angle, int $x, int $y, int $color, string $fontfile, string $text)

  imagejpeg($jpg_image, 'fotos\newimage.jpg');

  imagedestroy($jpg_image);

  //imagem folha lado esquerdo
  $jpg_image = imagecreatefromjpeg('fotos\newimage.jpg');

  $white = imagecolorallocate($jpg_image, 47, 11, 85);

  $font_path = 'font.TTF';

  imagettftext($jpg_image, 50, 6, 2050, 950, $white, $font_path, $mensagemEditadaDireita);
  //imagettftext(resource $image, float $size, float $angle, int $x, int $y, int $color, string $fontfile, string $text)

  imagejpeg($jpg_image, 'fotos\newimage2.jpg');

  imagedestroy($jpg_image);



?>


<div id="mensagemTrump">
<img src="fotos\newimage2.jpg">
</div>
