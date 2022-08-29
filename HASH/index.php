<?php 

    $aviso = '';
    $hashGer = '';

    $opitions = ['cost' => 12, ];
    
    if(isset($_POST['textoHash'])){
          $texto = $_POST['textoHash'];
        }else{
          $texto = '';
        }
    if(isset($_POST['cript'])){
          $crypt = $_POST['cript'];
        }else{
          $crypt = '';
        }    


        

    $selectCrypto = [
      "" => '',
      "1"  => md5($texto),
      "2" => sha1($texto),
      "3" => password_hash($texto, PASSWORD_DEFAULT),
      "4" => password_hash($texto, PASSWORD_BCRYPT, $opitions)
    ];

    $hash = $selectCrypto[$crypt];

    if(empty($texto)){
      $aviso .= "<h2>-Insira um texto</h2><br>";

    }
    if(empty($crypt)){
      $aviso .= "<h2>-Selecione o tipo de criptografia</h2>";
    }
    if(empty($aviso)){

      if($hash == $selectCrypto[1]){
          $hashGer = $hash; 
                       
      }

      if($hash == $selectCrypto[2]){
          $hashGer = $hash; 
      }

      if($hash == $selectCrypto[3]){
          $hashGer = $hash;
      }

      if($hash == $selectCrypto[4]){
          $hashGer = $hash;
      }
    }


    //VERIFICAR HASH


    $aviso2 = '';

    $opition = ['cost' => 12, ];


    if(isset($_POST['textoVerify'])){
      $textoVerify = $_POST['textoVerify'];
    }else {
      $textoVerify = '';
    }
    if(isset($_POST['hash'])){
      $hashVerify = $_POST['hash'];
    }else  {
      $hashVerify = '';
    }
    if(isset($_POST['cripty'])){
      $crypty = $_POST['cripty'];
    }else {
      $crypty = '';
    }

    $selectCrypto2 = [
      "" => '',
      "1" => md5($textoVerify),
      "2" => sha1($textoVerify),
      "3" => password_hash($textoVerify, PASSWORD_DEFAULT),
      "4" => password_hash($textoVerify, PASSWORD_BCRYPT, $opition)
    ];

    $hash2 = $selectCrypto2[$crypty];

    if(empty($textoVerify)){
      $aviso2 .= "<h2>-Insira um texto</h2><br>";
    }
    if(empty($hashVerify)){
      $aviso2 .= "<h2>-Insira o hash</h2><br>";
    }
    if(empty($crypty)){
      $aviso2 .= "<h2>-Selecione o tipo de criptografia</h2>";
    }
    if(empty($aviso2)){

    
      if($hash2 == $selectCrypto2[1]){
         if($hashVerify == md5($textoVerify)) {
          $aviso2 .= "<h2>HASH VALIDO</h2>";
         }else {
           $aviso2 .= "<h2>HASH INVALIDO</h2>";
         }
      }

      if($hash2 == $selectCrypto2[2]){
        if($hashVerify == sha1($textoVerify)){
          $aviso2 .= "<h2>HASH VALIDO</h2>";
        }else {
          $aviso2 .= "<h2>HAHS INVALIDO</h2>";
        }
      }

      if($hash2 == $selectCrypto2[3]){
        if(password_verify($textoVerify, $hashVerify)){
          $aviso2 .= "<h2>HASH VALIDO</h2>";
        }else {
          $aviso2 .= "<h2>HAHS INVALIDO</h2>";
        }
      }

      if($hash2 == $selectCrypto2[4]){
        if(password_verify($textoVerify, $hashVerify)){
          $aviso2 .= "<h2>HASH VALIDO</h2>";
        }else {
          $aviso2.= "<h2>HAHS INVALIDO</h2>";
        }
      }
    }


?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style.css">

    <title>HASH</title>
  </head>
  <body>

  <br>
  <br>
  <h1>Gere um hash ou verifique um hash</h1>  

  <div class="conter">

    <div class="form">
      <h2>Gerar hash:</h2>
      <form method="POST">
        <input type="text" name="textoHash" placeholder="Insira aqui" value="<?php echo "$texto";?>"><br>
        <select name="cript" >
                    <option value="">Selecione</option>
                    <option value="1">MD5</option>
                    <option value="2">SHA1</option>
                    <option value="3">PHP(DEFAULT)</option>
                    <option value="4">PHP(BCRYPT)</option>
                </select>
                <input type="submit" value="GERAR HASH">
                <textarea name="hashGer"  placeholder="hash gerado"  rows="3"><?php echo $hashGer;?></textarea>
      </form>

      <?php if(!empty($aviso)) {echo $aviso;}?>

    </div>

    <div class="form">
      <h2>Verificar hash:</h2>
      <form method="POST">
        <input type="text" name="textoVerify" placeholder="Insira aqui a chave" value="<?php echo $textoVerify; ?>"><br>
        <textarea rows="3" name="hash" placeholder="Insira aqui o hash que quer verificar"><?php echo $hashVerify; ?></textarea><br>
        <select name="cripty">
                    <option value="">Selecione</option>
                    <option value="1">MD5</option>
                    <option value="2">SHA1</option>
                    <option value="3">PHP(DEFAULT)</option>
                    <option value="4">PHP(BCRYPT)</option>
                </select>
        <input type="submit" value="VERIFICAR HASH">
      </form>

      <?php 
      if(!empty($aviso2)) {
        echo $aviso2;
      }
    
      ?>

    </div>
  </div>

  </body>
</html>