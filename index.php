<?php
   require_once ('classes/EncryptStr.php');
   
   $publicKey = '-----BEGIN PUBLIC KEY-----
MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAty1TevLdqcOs0T75rD6t
hTTOxkUcCa7n8loepxTVq6qCEx3oilowZW6M6+TTfjHF05U1WJ7Bwd2OVo6YN04C
Egj2ktFN0SfZZWTy0jTiYLOjy/EbkXJ6msgSLwAOUznVQU5oyCHew5sJO5t5Ktb2
XOI4pXy4Fax6+PPNkrA5qv5F+NU42mA4bqG7CrI4gc3dxtRMhAdYrPladYSmMNlo
ey4yLNul34MzznMJIBeYYmHtwQIg60M2lkkhg0MOp7BSzY4V/eEft11qTosomOxz
4brF5qEiJg9grT8hAcKEnUsHxpGXGZm2QU8OqQe8Q1A/dVG+cT1Ss6R9Vky2rF6n
rwIDAQAB
-----END PUBLIC KEY-----';

$publicKeyJS = preg_replace('/\s+/', ' ', trim($publicKey));
$encryptedData = null;
$jsonData = null;

if(!empty($_POST['json-data']) && isset($_POST['process-php']) ){

    $jsonData = trim($_POST['json-data']);
    $encryptedData = EncryptStr::encrypt($jsonData, $publicKey);
}
?>
<!DOCTYPE html>
<html>

<head>
<meta http-equiv="cache-control" content="max-age=0" />
<meta http-equiv="cache-control" content="no-cache" />
<meta http-equiv="expires" content="0" />
<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
<meta http-equiv="pragma" content="no-cache" />

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>Cifrado mensajes JSON</title>

    <script type="application/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script type="application/javascript" src="js/jquery.cryptopost.js"></script>
        <script type="application/javascript" src="js/jsencrypt.js"></script>
        <script>
            var public_key = '<?php echo ($publicKeyJS);?>';
            
        </script>
</head>

<body>
    <div class="container" id="form-encrypt">
        <h2>Cifrado mensajes JSON</h2>
        <form method = "POST" action="" >
            <div class="form-group">
                <label for="first-name">JSON Data</label>
                <textarea class="form-control" rows="5" id="json-data" name ="json-data" placeholder="JSON Data"><?php if(isset($jsonData)) echo($jsonData);?></textarea>
            </div>
            <div class="form-group">
                <label for="last-name">Encrypted data</label>
                <textarea class="form-control" rows="5" id="encrypted-data" placeholder="Encrypted data"><?php if(isset($encryptedData)) echo($encryptedData);?></textarea>
            </div>
            <div class="clearfix"></div>
            <button type="submit" class="btn btn-info btn-lg btn-responsive btn-process" id="process-php" name="process-php" value="process-php"> <span class="glyphicon glyphicon-cog"></span> Cifrar con PHP</button>
            <button type="button" class="btn btn-info btn-lg btn-responsive btn-process" id="process-javascript">
                <span class="glyphicon glyphicon-cog"></span> Cifrar con JavaScript</button>
        </form>
    </div>
</body>

</html>