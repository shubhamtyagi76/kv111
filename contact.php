<?php
// Contact Form Handler for Vyomexa.ai
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Handle preflight requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Check if request is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

// Get POST data
$input = json_decode(file_get_contents('php://input'), true);

// If JSON decode fails, try form data
if (!$input) {
    $input = $_POST;
}

// Validate required fields
$required_fields = ['name', 'email', 'message'];
foreach ($required_fields as $field) {
    if (empty($input[$field])) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => "Field '$field' is required"]);
        exit;
    }
}

// Sanitize input
$name = filter_var($input['name'], FILTER_SANITIZE_STRING);
$email = filter_var($input['email'], FILTER_SANITIZE_EMAIL);
$message = filter_var($input['message'], FILTER_SANITIZE_STRING);

// Validate email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Invalid email address']);
    exit;
}

// Email configuration
$to = 'vyomexa.ai@gmail.com'; // Replace with your email
$subject = 'New Contact Form Submission - Vyomexa.ai™';
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= "From: noreply@" . $_SERVER['HTTP_HOST'] . "\r\n";
$headers .= "Reply-To: " . $email . "\r\n";

// Email body with beautiful HTML template
$email_body = "
<!DOCTYPE html>
<html>
<head>
    <meta charset='UTF-8'>
    <title>New Contact Form Submission</title>
    <style>
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            line-height: 1.6; 
            color: #333; 
            margin: 0; 
            padding: 0; 
            background-color: #f4f4f4; 
        }
        .container { 
            max-width: 600px; 
            margin: 20px auto; 
            background: white; 
            border-radius: 10px; 
            overflow: hidden; 
            box-shadow: 0 0 20px rgba(0,0,0,0.1); 
        }
        .header { 
            background: linear-gradient(135deg, #0db2e9, #b2fefa); 
            color: white; 
            padding: 30px; 
            text-align: center; 
        }
        .header h1 { 
            margin: 0; 
            font-size: 24px; 
        }
        .content { 
            padding: 30px; 
        }
        .field { 
            margin-bottom: 20px; 
            padding: 15px; 
            background: #f8f9fa; 
            border-radius: 8px; 
            border-left: 4px solid #0db2e9; 
        }
        .label { 
            font-weight: bold; 
            color: #0db2e9; 
            margin-bottom: 5px; 
            display: block; 
        }
        .value { 
            color: #333; 
            word-wrap: break-word; 
        }
        .footer { 
            background: #f8f9fa; 
            padding: 20px; 
            text-align: center; 
            color: #666; 
            font-size: 14px; 
        }
        .logo { 
            font-size: 20px; 
            font-weight: bold; 
            color: #0db2e9; 
        }
    </style>
</head>
<body>
    <div class='container'>
        <div class='header'>
            <div class='logo'>🤖 Vyomexa.ai™</div>
            <h1>New Contact Form Submission</h1>
            <p>Someone has reached out through your website</p>
        </div>
        
        <div class='content'>
            <div class='field'>
                <span class='label'>Name:</span>
                <div class='value'>" . htmlspecialchars($name) . "</div>
            </div>
            
            <div class='field'>
                <span class='label'>Email:</span>
                <div class='value'>" . htmlspecialchars($email) . "</div>
            </div>
            
            <div class='field'>
                <span class='label'>Message:</span>
                <div class='value'>" . nl2br(htmlspecialchars($message)) . "</div>
            </div>
            
            <div class='field'>
                <span class='label'>Submitted:</span>
                <div class='value'>" . date('F j, Y \a\t g:i A') . "</div>
            </div>
            
            <div class='field'>
                <span class='label'>IP Address:</span>
                <div class='value'>" . $_SERVER['REMOTE_ADDR'] . "</div>
            </div>
        </div>
        
        <div class='footer'>
            <p><strong>Vyomexa.ai™</strong> - AI Business Automation Platform</p>
            <p>This email was automatically generated from your website contact form.</p>
        </div>
    </div>
</body>
</html>
";

// Send email
$mail_sent = mail($to, $subject, $email_body, $headers);

if ($mail_sent) {
    // Log the submission (optional)
    $log_entry = date('Y-m-d H:i:s') . " - Contact: $name ($email) - " . substr($message, 0, 50) . "...\n";
    @file_put_contents('logs/contact.log', $log_entry, FILE_APPEND | LOCK_EX);
    
    echo json_encode([
        'success' => true, 
        'message' => 'Thank you for your message! We\'ll get back to you within 24 hours.'
    ]);
} else {
    http_response_code(500);
    echo json_encode([
        'success' => false, 
        'message' => 'Sorry, there was an error sending your message. Please try again or contact us directly.'
    ]);
}
?>