
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>cdplayer 1.9 Home</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="index.css?123">
</head>

<body class="bg-dark">
  <nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand">Player 1.8</a>
      <!-- <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" /> 
         <button class="btn btn-outline-warning" type="submit">Search</button>
      </form> --> 
      <form action='' method='post'>
                <input class='search_form form-control me-2' type='input' name='input' value='' autocomplete='off' placeholder='Search...'>
            </form>
    </div>
  </nav>
  <br>
  <!-- <button type="button" class="btn btn-primary w-25 m-lg-5"> <a href="#">Home</a></button> -->
  <button type="button" class="btn btn1 btn-warning w-25 m-lg-5"> <a class="btn1" href="a---z.php">Play List A---Z</a></button>
  <button type="button" class="btn btn1 btn-warning w-25 m-lg-5"><a class="btn1" href="shuffle.php">Play List Shuffle</a></button>
  <hr>
  
  <?php
  // ! SCANDISK -----------------------
  $data = 'list';
  $songs = [];
  $search = '';
  $search_arr = [];
  $fileDir = "../Muziek1/";
  $files = scandir($fileDir);

  // ! Make Array $songs ---- READ DIR -----------

  // global $fileDir, $files, $Songs, $file;

  foreach ($files as $file) {
    if (substr($file, -4) == ".mp3") {
      $file = substr($file, 0, -4);
      array_push($songs, $file);
    }
  }

  // ! GET input -----------------------------------------------------------
  if (isset($_POST['input']));
  $search = filter_input(INPUT_POST, 'input', FILTER_SANITIZE_SPECIAL_CHARS);

  if (empty($search)) $search = '';
  $search = strtolower($search);

  foreach ($songs as $file) {
      $file = strtolower($file);
      if (str_contains($file, $search)) {
          array_push($search_arr, $file);
      };
  };
  if (!empty($search_arr)) {
      $songs = $search_arr;
  };
  ?>

  <ul id="playlist">

    <script>
      // let data = <?= json_encode($data); ?>; 
      const playlist = document.querySelector('#playlist');
      let songs = [];
      songs = <?php echo json_encode($songs) ?>;

      songs.forEach((element, index) => {
        playlist.innerHTML += `<li id='${index}'> ${element} </li>`;
      });
    </script>

  </ul>
</body>

</html>
