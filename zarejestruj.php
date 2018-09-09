<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Zarejestruj sie</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<?php
 if(isset($_POST['haslo1']) && isset($_POST['haslo2'])){
    if(strlen ($_POST['haslo1']) < 3){
      echo("<div class='alert alert-danger'><strong>Podane hasła jest za krótkie</strong></div>");
    }
    else{
      if($_POST['haslo1'] == $_POST['haslo2']){
        $nazwa_servera = "localhost";
        $nazwa_uzytkownika = "root";
        $haslo_do_bazy_danych = "*****";
        $baza = "uzytkownicy";
        $polaczenie = new mysqli($nazwa_servera, $nazwa_uzytkownika, $haslo_do_bazy_danych,$baza);
        if ($polaczenie->connect_error) {
          die("Nie udalo sie polaczyc: " . $conn->connect_error);
        } 
        $nowy_email = $_POST['email'];
        $nowe_haslo = $_POST['haslo1'];
        $zapytanie = "INSERT into users (email,haslo) values ('$nowy_email','$nowe_haslo');";
        if($polaczenie->query($zapytanie) === TRUE){
          echo("<script>window.location.href = 'zaloguj.php';</script>");
        }
        else{
          $zapytanie_o_duplikat = "select * from users where email='$nowy_email'";
          $duplikat = $polaczenie->query($zapytanie_o_duplikat);
          if($duplikat->num_rows > 0)
          {
            echo("<div class='alert alert-danger'><strong>email juz jest w bazie danych</strong></div>");
            $polaczenie->close();
          }
          else
          {
            echo("<div class='alert alert-danger'><strong>nie udalo sie zarejestrowac</strong></div>");
            $polaczenie->close();
          }
        }
      }
      else{
        echo("<div class='alert alert-danger'><strong>Podane hasła nie są takie same</strong></div>");
      }
    }
    
  }
?>
<body>
<br>
<div class="container">
      <div class="jumbotron text-center">
      <h2>Zarejestruj się</h2><hr>
          <form method="POST">
          <div class="form group">
            <lable>podaj swój email:</label><br>
            <input type="email" name="email" required></input>
          </div>
          <div class="form group">
            <lable>wymyśl hasło:</label><br>
            <input  id="haslo1" type="password" name="haslo1" required></input>
            <p style="padding:0px 0px;font-size:10px;">minimum 3 znaki</p>
          </div>
          <div class="form group">
            <lable>podaj jeszcze raz hasło:</label><br>
            <input id="haslo2" type="password" name="haslo2" required></input>
          </div><br>
          <input type="submit" name="zarejestruj" value="Zarejestruj sie" class="btn btn-primary btn-success">
          </form>
      </div>
</div>
  
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</body>
</html>