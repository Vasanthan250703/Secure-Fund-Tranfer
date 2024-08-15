<html>

<head>
    <title> Payment SucessFull</title>
    </title>
</head>

<body>
    <?php

    function encryptOTP($otp, $key)
    {
        $iv = random_bytes(16); // Initialization Vector
        $cipherText = openssl_encrypt($otp, 'aes-256-cbc', $key, 0, $iv);
        return base64_encode($iv . $cipherText);
    }

    function decryptOTP($encryptedOTP, $key)
    {
        $data = base64_decode($encryptedOTP);
        $iv = substr($data, 0, 16);
        $cipherText = substr($data, 16);
        return openssl_decrypt($cipherText, 'aes-256-cbc', $key, 0, $iv);
    }

    $encryptionKey = "YourSecretKey";

    // Retrieve the original OTP from sample.json
    $sam = file_get_contents("sample.json");
    $array = json_decode($sam, true);
    $originalOTP = $array['name'];


    $enteredOTP = $_POST['otp3'];
    // Encrypt the entered OTP for comparison
    $encryptedEnteredOTP = encryptOTP($enteredOTP, $encryptionKey);
    // Decrypt the encrypted entered OTP
    $decryptedEnteredOTP = decryptOTP($encryptedEnteredOTP, $encryptionKey);

    // Verify if the decrypted entered OTP matches the original OTP
    if ($decryptedEnteredOTP == $originalOTP) {
        // Redirect to final.php if OTP matches
        header("Location: final.php");
        // echo "the otp is correct";
        exit;
    } else {
        // Redirect to otpverify1.php if OTP does not match
        // header("Location: otpverify1.php");
        echo '<script>alert("Invalid otp."); window.location.href ="otpverify1.php" </script>';
        //echo "the otp is wrong";
        exit;
    }
    ?>

</body>

</html>