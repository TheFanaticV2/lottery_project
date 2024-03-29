<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Télécharger un fichier CSV</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="bg-dark">

<div class="container mt-5 ">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          Télécharger un fichier CSV
        </div>
        <div class="card-body">
          <h6 class="text-danger">Attention ! ! ! , seulement les 5 premières grilles de chaque personne sont prises en compte.</h6>
          <form action="Controllers/LotteryController.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label for="csvFile">Sélectionner votre fichier CSV de joueurs :</label>
              <input type="file" class="form-control-file" id="csvFile" name="csvFile">
            </div>
            <button type="submit" class="btn btn-primary">Télécharger le CSV des gagnants</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
