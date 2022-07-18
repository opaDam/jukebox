<!DOCTYPE html>
<html lang="en">

<head>
    <title>A---Z</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <script src="data.js"></script>
    <script defer src="main.js"></script>
    
</head>

<body id="top">

    <header class="header">
        <div class="nav">
            <!-- <li><a class="a1" href='index.php'>Playlist</a></li> -->
            <audio id="audio" controls src=""></audio>
            <!-- // ! SEARCH FORM ----------------------------------------------------- -->
            <form action='' method='post'>
                <input class='search_form' type='input' name='input' value='' autocomplete='off' placeholder='Search...'>
            </form>
            
            <h3 class="prt_title"></h3>

            <a class="logo" target="_blank" href="https://opa-dam.jouwweb.nl/">OpaD@n</a>
            <a class="swits" href="shuffle.php">Shuffle</a>
            <a class="home" href="index.php">Home</a>

        </div>
    </header>

    <ul id='playlist2'>
    </ul><br>
    <hr><br>
    <ul id='playlist'>

        <?php
        // // ! SCANDISK -----------------------
        $data = "list";
        $songs = [];
        $search = '';
        $search_arr = [];
        if (!isset($fileDir)){$fileDir = "../Muziek/";}
        $files = scandir($fileDir);

        // // ! Make Array $songs ---- READ DIR -----------
       
        //     // global $fileDir, $files, $Songs, $file;

            foreach ($files as $file) {
            if (substr($file, -4) == ".mp3") {
                $file = substr($file, 0, -4);
                array_push($songs, $file);
            }
        }

        // ! Shuffle Array $songs ------------
        function shuffle_array(){
            global $songs;
            shuffle($songs);
        }
        // shuffle_array();

        // ! Print PLaylist ------------------
        function prt_playlist()  {
            global $fileDir, $songs;
            if (isset($songs)) {
                foreach ($songs as $key => $value) {
                    $txt =  explode("-", $value);
                    $txt[0] = strtoupper($txt[0]);
                    $txt[1] = strtoupper($txt[1]);
                    echo "
                    <div class='media' id='B$key'>
                    <div class='div1'>
                    <img class='media-object' data-song='$value' data-key='$key' src='$fileDir$value.jpg'>
                    <div class='div2'></div></div>
                    <div class='media-body'>
                    <h3 class='media-heading'>$txt[0]</h3>
                    <p class='media-heading'>$txt[1]</p>
                    <button class='btn_local_add' onclick='local_add($key);'>Add Song</button>
                    <span class='nummering'>$key</span>
                    </div> </div>";
                }
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
            prt_playlist();
        };
        ?>

    </ul>

    <script>
        let einde;
        // ? JS VARIABELE ----------------------------
        let songs = <?= json_encode($songs); ?>;
        let fileDir = <?= json_encode($fileDir); ?>;
        let files = <?= json_encode($files); ?>;
        let search = <?= json_encode($search); ?>;
        let search_arr = <?= json_encode($search_arr); ?>; 
        

    </script>

    <div class="footer">
        <footer>
            <spam class="copy"> OpaD@m &copy;2022 </spam>
            <button class="btn a a1" onclick="data='list1';print_local();remove_active();document.querySelector('.a1').classList.add('active');window.location.href = '#top';">pl1</button>
            <button class="btn a a2" onclick="data='list2';print_local();remove_active();document.querySelector('.a2').classList.add('active');window.location.href = '#top';">pl2</button>
            <button class="btn a a3" onclick="data='list3';print_local();remove_active();document.querySelector('.a3').classList.add('active');window.location.href = '#top';">pl3</button>
            <button class="btn a a4" onclick="data='list4';print_local();remove_active();document.querySelector('.a4').classList.add('active');window.location.href = '#top';">pl4</button>
            <button class="btn a a5" onclick="data='list5';print_local();remove_active();document.querySelector('.a5').classList.add('active');window.location.href = '#top';">pl5</button>
            <button class="btn a a6" onclick="data='list6';print_local();remove_active();document.querySelector('.a6').classList.add('active');window.location.href = '#top';">pl6</button>
            <button class="btn a a7" onclick="data='list7';print_local();remove_active();document.querySelector('.a7').classList.add('active');window.location.href = '#top';">pl7</button>
            <button class="btn a a8" onclick="data='list8';print_local();remove_active();document.querySelector('.a8').classList.add('active');window.location.href = '#top';">pl8</button>
            <button class="btn a a9" onclick="data='list9';print_local();remove_active();document.querySelector('.a9').classList.add('active');window.location.href = '#top';">pl9</button>
            <button class="btn a a10" onclick="data='list10';print_local();remove_active();document.querySelector('.a10').classList.add('active');window.location.href = '#top';">pl10</button>

            <button type="button" class="btn top_btn" onclick="window.location.href = '#top';">Goto Top</button>
            <button type="button" class="btn song_btn" onclick="key1=key-10;window.location.href =('#B'+key1)">Goto Song</button>
            <!-- <button type="button" class="btn pl_btn" onclick="key3 = key2-10;window.location.href =('#A'+key3)">Goto PL</button> -->


<!-- !----------------------------------------------------------------- -->

<!-- ---------------------------------------------------------------------- -->
        </footer>
    </div>

</body>

</html>