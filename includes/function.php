<?php
include('connect.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Delete Function
function deleteRecord($con, $query)
{
    $executeDeleteQuery = mysqli_query($con, $query);
    if ($executeDeleteQuery) {
        echo "<script>alert('Dear Admin, the record has been deleted successfully.')</script>";
    }
}



// * Get the user IP
function get_IP_address()
{
    foreach (array(
        'HTTP_CLIENT_IP',
        'HTTP_X_FORWARDED_FOR',
        'HTTP_X_FORWARDED',
        'HTTP_X_CLUSTER_CLIENT_IP',
        'HTTP_FORWARDED_FOR',
        'HTTP_FORWARDED',
        'REMOTE_ADDR'
    ) as $key) {
        if (array_key_exists($key, $_SERVER) === true) {
            foreach (explode(',', $_SERVER[$key]) as $IPaddress) {
                $IPaddress = trim($IPaddress); // Just to be safe

                if (
                    filter_var(
                        $IPaddress,
                        FILTER_VALIDATE_IP,
                        FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE
                    )
                    !== false
                ) {

                    return $IPaddress;
                }
            }
        }
    }
}


// * Function for find the distance between Pickup Location and Drop Location.
function getDistance($pickupLocation, $dropLocation)
{
    $API_URL = "https://maps.googleapis.com/maps/api/distancematrix/json?departure_time=now"; // * Google Geo Matrix API URL
    $API_KEY = "AIzaSyA4c3zazmSRs__4oKbkBJ9oCNsdUds5CpQ";   // * API Key

    $requestURL = $API_URL . "&destinations=" . urlencode($dropLocation) . "&origins=" . urlencode($pickupLocation) . "&key="
        . $API_KEY;

    $response = file_get_contents($requestURL);    // * Send the request to Google Distance Matrix (Geo Matrix) API

    if ($response === false) {
        echo "<script>alert('Unable to get the data.')</script>";
    } else {
        $distanceObj = json_decode($response);  // * Converting JSON Object into PHP Object.‹

        if ($distanceObj->status == "OK") {
            $tripDistanceInMeter = $distanceObj->rows[0]->elements[0]->distance->value;
            $tripDistanceInKM = $tripDistanceInMeter / 1000;
            return $tripDistanceInKM;
        }
    }
}


// * Function for find Latitude of a Location.
function getLocationLatitude($locationName)
{
    $API_URL = "https://maps.googleapis.com/maps/api/geocode/json?address=";
    $apiKey = "AIzaSyBdH2LC9_imQu7WzWMUJ3I2OpVyg6H1qEE";


    $APIRequest = $API_URL . $locationName . "&key=" . $apiKey;
    $responseOfAPI = file_get_contents($APIRequest);    // * Send the request to Google Geo Code API
    $locationObj = json_decode($responseOfAPI);     // * Converting JSON Object into PHP Object.

    $locationLatitude = $locationObj->results[0]->geometry->location->lat;

    return $locationLatitude;
}




// * Function for find Longitude of a Location
function getLocationLongitude($locationName)
{
    $API_URL = "https://maps.googleapis.com/maps/api/geocode/json?address=";
    $apiKey = "AIzaSyBdH2LC9_imQu7WzWMUJ3I2OpVyg6H1qEE";

    $APIRequest = $API_URL . $locationName . "&key=" . $apiKey;
    $responseOfAPI = file_get_contents($APIRequest);        // * Send the request to Google Geo Code API
    $locationObj = json_decode($responseOfAPI);         // * Converting JSON Object into PHP Object.

    $locationLongitude = $locationObj->results[0]->geometry->location->lng;

    return $locationLongitude;
}


// * Function to Sending Email to Passenger when the reservation confirmed.
function sendReservationConfirmationEmail($passengerEmail, $passengerName, $driverName, $taxiNumber, $driverPhoneNumber) {
    require './PHPMailer/src/Exception.php';
    require './PHPMailer/src/PHPMailer.php';
    require './PHPMailer/src/SMTP.php';

    $mail = new PHPMailer(true);

      $userMail = "aasikmohamed782@gmail.com";           // * Admin mail id
      $passKey = "dulipuxnphdpirkm";


      //$mail->SMTPDebug = 3;                               // * Enable verbose debug output

      $mail->isSMTP();                                      // * Set mailer to use SMTP
      $mail->Host = 'smtp.gmail.com';                       // * Specify main and backup SMTP servers
      $mail->SMTPAuth = true;                               // * Enable SMTP authentication
      $mail->Username = $userMail;                          // * SMTP username
      $mail->Password = $passKey;                           // * SMTP password
      $mail->SMTPSecure = 'ssl';                            // * Enable TLS encryption, `ssl` also accepted
      $mail->Port = 465;                                    // * TCP port to connect to
      $mail->SMTPOptions = array(
        'ssl' => array(
          'verify_peer' => false,
          'verify_peer_name' => false,
          'allow_self_signed' => true
        )
      );

      $mail->setFrom($userMail);
      $mail->addAddress($passengerEmail, $passengerName); // * Add a recipient

      $mail->isHTML(true);                                    // * Set email format to HTML

      $msg = "Dear " . $passengerName . "! Your reservation has been confirmed successfully. The Driver's Name is " . $driverName . ", the taxi number is  " . $taxiNumber . ". You can get connect with driver using " . $driverPhoneNumber . ".";

      $mail->Subject = "{$passengerName}'s Taxi reservation confirmation - City-Taxi";
      $mail->Body    = $msg;
    //   $mail->Body    = "Username: {$passengerUsernameEl} <br> Password: {$passengerPasswordEl}";

      $mail->send();
      echo "<script>alert('Please check your mail...')</script>";
    //   echo "<script>window.open('../passenger-directory/passenger-login.php','_self')</script>";

}

// function sendSMS($phoneNumber, $passengerName, $driverName, $taxiNumber, $driverPhoneNumber)
// {
//     require __DIR__ . "../../vendor/autoload.php";

//     $base_url = "2mr2dp.api.infobip.com";
//     $api_key = "eb6cdab4a475966c201e7d00595ba39a-da048b6e-6c0e-4e3b-9b01-92e110957b61";

//     $msg = "Dear " . $passengerName . "! Your reservation has been confirmed successfully. The Driver's Name is " . $driverName . ", the taxi number is  " . $taxiNumber . ". You can get connect with driver using " . $driverPhoneNumber . ".";
//     // $msg = "Dear {$passengerName}! Your reservation has been confirmed successfully. The Driver's Name is {$driverName}, the taxi number is {$taxiNumber}. You can get connect with driver using {$driverPhoneNumber}.";

//     $configuration = new Configuration(host: $base_url, apiKey: $api_key);

//     $api = new SmsApi(config: $configuration);

//     $destination = new SmsDestination(to: $phoneNumber);

//     $message = new SmsTextualMessage(
//         destinations: [$destination],
//         text: $msg
//     );

//     $request = new SmsAdvancedTextualRequest(messages: [$message]);

//     $response = $api->sendSmsMessage($request);

//     echo var_dump($response);
// }


// * Function to Sending SMS to Driver when Payment process completed.
// function sendSMSForPaymentSuccess($phoneNumber, $driverName, $reservationId)
// {
//     require __DIR__ . "../../vendor/autoload.php";

//     $base_url = "2mr2dp.api.infobip.com";
//     $api_key = "eb6cdab4a475966c201e7d00595ba39a-da048b6e-6c0e-4e3b-9b01-92e110957b61";

//     $msg = "Dear " . $driverName . "! The payment received for the Reservation ID: " . $reservationId . " successfully!";

//     $configuration = new Configuration(host: $base_url, apiKey: $api_key);

//     $api = new SmsApi(config: $configuration);

//     $destination = new SmsDestination(to: $phoneNumber);

//     $message = new SmsTextualMessage(
//         destinations: [$destination],
//         text: $msg
//     );

//     $request = new SmsAdvancedTextualRequest(messages: [$message]);

//     $response = $api->sendSmsMessage($request);

//     echo var_dump($response);
// }

// * Function for convert String value into Integer
function convertStringIntoInt($stringValue)
{
    $intValue = intval($stringValue);
    $readableValue = "";

    if ($intValue <= 9) {
        $readableValue = "0" . $intValue;
    } else {
        $readableValue = $intValue;
    }

    return $readableValue;
}
