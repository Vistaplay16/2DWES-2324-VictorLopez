<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>IPs</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <label for="IPDec">IP en notacion decimal: </label>
        <input type="text" name="IPDec" id="IPDec"><br>
        
        <input type="submit" value="notacion binaria">
        <input type="reset" value="borrar">
    </form>
    <?php 
    if($_SERVER["REQUEST_METHOD"]=="POST"){
    $IPDec=$_POST['IPDec'];
    $bitsDec=explode(".",$IPDec);
    $bitsBin=array();
    for($i=0;$i<count($bitsDec);$i++){
        $bitsBin[$i]=strval(decbin($bitsDec[$i]));
    }
    $IPBin="";
    for($i=0;$i<count($bitsBin);$i++){
        $IPBin.=str_pad($bitsBin[$i],8,"0", STR_PAD_LEFT).".";
    }
    echo "<input type='text' value='$IPBin' size='50'>";
}
    ?>
</body>
</html>