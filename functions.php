<?php
date_default_timezone_set('America/Sao_Paulo');

$host = "localhost";
$user = "root";
$pass = "";
$bd = "montarsite";


    if (isset($_POST["acao"])){
       if ($_POST['acao']=="inserir"){
          validacaoString();
          registrar();
       }
      if ($_POST["acao"]=="alterar"){
             atualizar();
      } 
      if ($_POST["acao"]=="excluir"){
             excluir();
      }
}
       function connect(){
              $host = "localhost";
              $user = "root";
              $pass = "";
              $bd = "montarsite";
              $conexao = $con = mysqli_connect($host, $user, $pass, $bd) or die("Erro na abertura do banco de dados". mysqli_error($con));
              return $conexao;
       }
       
       function validacaoString()
       {      $nome = $_POST['nome'];
              if (strlen($nome) < 15){
              echo'<script>alert ("DIGITE SEU NOME COMPLETO"); location.href="index.php"</script>';
               die("Erro");
       }
}
      
       function registrar(){
              $con = connect();
              $nome = $_POST['nome'];
              $nascimento = $_POST['nascimento'];
              $email = $_POST['email'];
              $rg = $_POST['rg'];
              $sql = "INSERT INTO  usuario (nm_usuario, dt_usuario, mail_usuario, rg_usuario) VALUES ('$nome','$nascimento','$email','$rg')";
              mysqli_query($con, $sql) or die ("Erro na inserçao de registro".mysqli_error ($con));
              validacaoString();
              echo'<script>alert ("REGISTRO REALIZADO"); location.href="index.php"</script>';
              
       }

       function listar(){
              $con = connect();
              $sql = "SELECT * FROM usuario";
              $res = mysqli_query($con, $sql) or die ("Erro na lista de registro".mysqli_error ($con));
              while ($row = mysqli_fetch_array($res)){
                     $listar [] = $row;
              }
              return $listar;
              
       }
       function selectUsuario($id_usuario){
              $con = connect();
              $sql = "SELECT * FROM usuario WHERE id_usuario =".$id_usuario;
              $res = mysqli_query($con, $sql) or die ("Erro na lista de registro".mysqli_error ($con));
              $usuario = mysqli_fetch_assoc($res);
              return $usuario;

       }
       function atualizar(){


              $con = connect();
              $id_usuario = $_POST['id_usuario'];
              $nome = $_POST['nome'];
              $nascimento = $_POST['nascimento'];
              $email = $_POST['email'];
              $rg = $_POST['rg'];

 	$sql = "UPDATE usuario SET nm_usuario = '$nome', mail_usuario = '$email', dt_usuario = '$nascimento', rg_usuario = '$rg' WHERE id_usuario = '$id_usuario'";
       $res = mysqli_query ($con, $sql) or die ("Erro na inserçao de registro".mysqli_error ($con));

       validacaoString();
       if(mysqli_affected_rows($con)){
              header("Location: listagem.php");
       } else{
              echo "<p style ='color:red;'> Usuario não editado!";
       }
        

       }

       
       function excluir(){
              $con = connect();
              $id_usuario = filter_input(INPUT_POST, 'id_usuario', FILTER_SANITIZE_NUMBER_INT);
              $sql = "DELETE FROM usuario WHERE id_usuario = $id_usuario";
              mysqli_query($con, $sql) or die ("Erro na exclusão de registro".mysqli_error ($con));

              if(mysqli_affected_rows($con)){
                     header("Location: listagem.php");
              } else{
                     echo "<p style ='color:red;'> Usuario nao apagado!";
              }

       }

  


       




?>