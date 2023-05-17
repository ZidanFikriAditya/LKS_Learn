<?php
    if (isset($_POST['submit']))
    {
        $data = $_POST['xml'];
        $simple = simplexml_load_string($data);
        $arr = json_decode( json_encode($simple) , 1);


    }
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .flex{
            display: flex;
            gap: 4rem;
        }

        .result {
            border-radius: 5px;
            padding: 1rem;
            box-shadow: 0px 0px 10px black;
            background-color: rgb(0, 20, 80);
            font-weight: bold;
            color: white;
        }
    </style>
</head>
<body>
<form method="post" action="" class="flex">
    <textarea name="xml" id="xml" cols="30" rows="10"><?= isset($_POST['xml']) ? $_POST['xml'] : '' ?></textarea>

    <div>
        <input type="submit" value="Submit" name="submit">
    </div>

    <div  class="result">
        <pre><?= isset($simple) ? json_encode($arr, JSON_PRETTY_PRINT) : '' ?></pre>
    </div>

</form>
</body>
</html>
