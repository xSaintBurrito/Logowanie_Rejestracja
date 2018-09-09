<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Zaloguj sie</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
<?php
if(isset($_POST['zaloguj'])){
$nazwa_servera = "localhost";
$nazwa_uzytkownika = "root";
$haslo_do_bazy_danych = "*****";
$baza = "uzytkownicy";
$polaczenie = new mysqli($nazwa_servera, $nazwa_uzytkownika, $haslo_do_bazy_danych,$baza);
$haslo = $_POST['password'];
$email = $_POST['email'];

if ($polaczenie->connect_error) {
  die("Nie udalo sie polaczyc: " . $polaczenie->connect_error);
} 

$zapytanie = "SELECT haslo from users where email = '$email'";
$wynik = $polaczenie->query($zapytanie);

if ($wynik->num_rows > 0) {
  while($row = $wynik->fetch_assoc()) {
      if($row["haslo"] == $haslo){
        echo"<script>window.location.href = 'strona.php?dostep=dostep';</script>";
      }
      else{
        echo("<div class='alert alert-danger' role='alert'>Złe hasło</div>");
      }
  }
  } 
  else {
    echo("<div class='alert alert-danger' role='alert'>Tego emaila nie ma w bazie danych</div>");
  }

}
?>
  <div class="container">
  <br>
    <div class="jumbotron text-center">
    <h2>Zaloguj sie</h2><hr>
      <form class="form-horizontal" method="post" enctype="multipart/form-data">
        <div class="form-group">
        <label>email:</label>
        <input type="email" class="form-controll" name="email" required></input>
        </div>
        <div class="form-group">
        <label>hasło:</label>
        <input type="password" class="form-controll" name="password" required></input>
        </div>
        <input type="submit" name="zaloguj" value="Zaloguj sie" class="btn btn-primary btn-success"><br>
        <a href="zarejestruj.php">jesli nie masz konta zarejestruj się</a>
      </from>
    </div>
  </div>
  
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</body>
</html>