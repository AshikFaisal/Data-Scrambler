<?php
    include_once "functions.php";
    $mode = 'encode';
    if(isset($_GET['mode']) && $_GET['mode'] != '') {
        $mode = $_GET['mode'];
    }

    $originalKey = 'abcdefghijklmnopqrstuvwxyz1234567890';
    $key = 'abcdefghijklmnopqrstuvwxyz1234567890';

    if('key' == $mode) {
        $key_original = str_split($key);
        shuffle($key_original);
        $key = join('',$key_original);
    }elseif (isset($_REQUEST['key']) && $_REQUEST['key'] != '') {
        $key = $_REQUEST['key'];
    }else {
        $key = '';
    }

    $scrambledData = '';
    if( 'encode' == $mode ) {
        $data = $_REQUEST['data'] ?? '';
        if( $data != '' ) {
            $scrambledData = scrambleData( $data, $key );
        }
    }

    if( 'decode' == $mode ) {
        $data = $_REQUEST['data'] ?? '';
        if( $data != '' ) {
            $scrambledData = decodeData( $data, $key );
        }
    }

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Scrambler</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.4.1/milligram.css">
    <style>
        body {
            margin-top: 30px;
        }
        #data {
            width: 100%;
            height: 160px;
        }
        #result {
            width: 100%;
            height: 160px;
        }
        .hidden {
            display: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="column column-60 column-offset-20">
                <h2>Data Scrambler</h2>
                <p>Use this application to scramble your data</p>
                <p>
                    <a href="/index.php?mode=encode">Encode</a> |
                    <a href="/index.php?mode=decode">Decode</a> |
                    <a href="/index.php?mode=key">Generate Key</a>
                </p>
            </div>
        </div>
        <div class="row">
            <div class="column column-60 column-offset-20">
                <form method="POST" action="index.php<?php if('decode' == $mode){echo "?mode=decode";} ?>">
                    <label for="key">Key</label>
                    <input type="text" name="key" id="key" <?php displayKey($key); ?> disabled>
                    <label for="data">Data</label>
                    <textarea name="data" id="data"><?php if(isset($_REQUEST['data'])) {echo $_REQUEST['data'];} ?></textarea>
                    <label for="data">Result</label>
                    <textarea name="result" id="result"><?php echo $scrambledData; ?></textarea>
                    <button type="submit">Do It For Me</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
