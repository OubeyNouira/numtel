<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style1.css">
    <title>Document</title>
</head>
<body>
    <?php
require 'vendor/autoload.php';
$phoneNumberUtil = \libphonenumber\PhoneNumberUtil::getInstance();
if (isset($_POST['submit']) && $_POST['submit'] === "Submit") {
  $phonenumber = $_POST['test'];
  try {
    $possibleNumber = $phoneNumberUtil->parse($phonenumber);
    if ($phoneNumberUtil->isValidNumber($possibleNumber)) {
      echo "Le numéro est :". "<p>". $phonenumber."</p>"."<br/>";
      $nationalNumber = $phoneNumberUtil->getNationalSignificantNumber($possibleNumber);
      echo "National Significant Number: " ."<p>".$nationalNumber."</p>"."<br/>";
      $phonetype=$phoneNumberUtil->getNumberType($possibleNumber);
      echo "Number Type :"."<p>" ;
      try { 
  switch ($phonetype) {
    case 1:
      echo "Mobile number";
      break;
    case 2:
      echo "Mobile number or Fixed-line number";
      break;
      case 3:
      echo "TOLL_FREE";
      break;
    case 4:
      echo "PREMIUM_RATE";
      break;  
    case 5:
        echo "SHARED_COST";
    case 6:
      echo "VOIP";
      break;  
    case 7:
        echo "PERSONAL_NUMBER";
    case 8:
      echo "PAGER";
      break;  
    case 9:
        echo "UAN";
    case 10:
      echo "VOICEMAIL";
      break;  
    case 11:
        echo "UNKNOWN";
    default:
      echo "Unknown number type";
  } echo"</p>" ;
} catch (Exception $e) {
  echo "Error: " . $e->getMessage();
}
  $countryCode = $phoneNumberUtil->getRegionCodeForNumber($possibleNumber);
 echo "Le numéro est d'origine: <p>" .$countryCode."</p>";
    } else {
      echo "Invalid phone number format.";
    }
  } catch (Exception $e) {
    echo "Error: " . $e->getMessage();
  }
} else {
  echo "Le submit n'a pas été effectué.";
}
?>
</body>
</html>

