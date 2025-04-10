<?php
// Include the Twilio SDK (via Composer)
// require_once 'vendor/autoload.php'; // Make sure Composer autoload is available

use Twilio\Rest\Client;

// Initialize variables
$sid = 'your_account_sid'; // Replace with your Account SID
$token = 'your_auth_token'; // Replace with your Auth Token
$twilio_number = 'whatsapp:+1415XXXXXXX'; // Replace with your Twilio WhatsApp-enabled number

// Initialize message variable
$message = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['message'])) {
    $message = $_POST['message']; // Get the message from the form

    // Create a new Twilio client
    $client = new Client($sid, $token);

    try {
        // Send a WhatsApp message
        $message = $client->messages->create(
            'whatsapp:+91XXXXXXXXXX', // Replace with the recipient's WhatsApp number
            [
                'from' => $twilio_number, // From Twilio WhatsApp number
                'body' => $message // Message content
            ]
        );

        // Success message
        $success = 'Message sent successfully! SID: ' . $message->sid;
    } catch (Exception $e) {
        // Error handling
        $error = 'Error: ' . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send WhatsApp Message via Twilio</title>
    <script src="https://media.twiliocdn.com/sdk/js/video/v2/twilio-video.min.js"></script> <!-- Example CDN for Twilio -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            color: #4CAF50;
        }
        .form-container {
            margin-top: 20px;
        }
        .message-box {
            margin-top: 20px;
            padding: 10px;
            background-color: #f4f4f4;
            border: 1px solid #ccc;
        }
        .message-box.success {
            background-color: #e8f5e9;
            border-color: #81c784;
        }
        .message-box.error {
            background-color: #ffebee;
            border-color: #e57373;
        }
    </style>
</head>
<body>
    <h1>Send WhatsApp Message via Twilio</h1>
    
    <!-- Success/Error Message Display -->
    <?php if (isset($success)): ?>
        <div class="message-box success">
            <?php echo $success; ?>
        </div>
    <?php elseif (isset($error)): ?>
        <div class="message-box error">
            <?php echo $error; ?>
        </div>
    <?php endif; ?>
    
    <!-- Form for sending WhatsApp message -->
    <div class="form-container">
        <form method="POST" action="">
            <label for="message">Message:</label><br>
            <textarea id="message" name="message" rows="4" cols="50" required><?php echo htmlspecialchars($message); ?></textarea><br><br>
            <button type="submit">Send WhatsApp Message</button>
        </form>
    </div>
</body>
</html>
