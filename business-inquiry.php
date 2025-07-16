<?php
// Business Inquiry Handler for Vyomexa.ai
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
$required_fields = ['businessName', 'businessIdea', 'industry', 'budget', 'email'];
foreach ($required_fields as $field) {
    if (empty($input[$field])) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => "Field '$field' is required"]);
        exit;
    }
}

// Sanitize input
$businessName = filter_var($input['businessName'], FILTER_SANITIZE_STRING);
$businessIdea = filter_var($input['businessIdea'], FILTER_SANITIZE_STRING);
$industry = filter_var($input['industry'], FILTER_SANITIZE_STRING);
$budget = filter_var($input['budget'], FILTER_SANITIZE_STRING);
$email = filter_var($input['email'], FILTER_SANITIZE_EMAIL);
$phone = isset($input['phone']) ? filter_var($input['phone'], FILTER_SANITIZE_STRING) : '';

// Validate email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Invalid email address']);
    exit;
}

// Email configuration
$to = 'vyomexa.ai@gmail.com'; // Replace with your email
$subject = '🚀 New Business Inquiry: ' . $businessName . ' - ' . $industry;
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
    <title>New Business Inquiry - Vyomexa.ai™</title>
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
            max-width: 700px; 
            margin: 20px auto; 
            background: white; 
            border-radius: 15px; 
            overflow: hidden; 
            box-shadow: 0 0 30px rgba(0,0,0,0.1); 
        }
        .header { 
            background: linear-gradient(135deg, #0db2e9, #b2fefa); 
            color: white; 
            padding: 40px 30px; 
            text-align: center; 
        }
        .header h1 { 
            margin: 0 0 10px 0; 
            font-size: 28px; 
        }
        .header p { 
            margin: 0; 
            opacity: 0.9; 
        }
        .content { 
            padding: 30px; 
        }
        .section { 
            margin-bottom: 30px; 
            padding: 20px; 
            background: #f8f9fa; 
            border-radius: 10px; 
            border-left: 5px solid #0db2e9; 
        }
        .section h3 { 
            color: #0db2e9; 
            margin-top: 0; 
            margin-bottom: 15px; 
            font-size: 18px; 
        }
        .field { 
            margin-bottom: 15px; 
        }
        .label { 
            font-weight: bold; 
            color: #555; 
            display: inline-block; 
            min-width: 100px; 
        }
        .value { 
            color: #333; 
            word-wrap: break-word; 
        }
        .highlight { 
            background: #e3f2fd; 
            padding: 15px; 
            border-radius: 8px; 
            border-left: 4px solid #0db2e9; 
            margin: 15px 0; 
        }
        .contact-info { 
            background: #f1f8e9; 
            padding: 15px; 
            border-radius: 8px; 
            border-left: 4px solid #4caf50; 
        }
        .next-steps { 
            background: #fff3e0; 
            padding: 20px; 
            border-radius: 8px; 
            border-left: 4px solid #ff9800; 
        }
        .next-steps ul { 
            margin: 10px 0; 
            padding-left: 20px; 
        }
        .next-steps li { 
            margin-bottom: 8px; 
        }
        .footer { 
            background: #f8f9fa; 
            padding: 25px; 
            text-align: center; 
            color: #666; 
            font-size: 14px; 
        }
        .logo { 
            font-size: 24px; 
            font-weight: bold; 
            color: #0db2e9; 
            margin-bottom: 10px; 
        }
        .priority { 
            background: #ffebee; 
            color: #c62828; 
            padding: 10px 15px; 
            border-radius: 5px; 
            font-weight: bold; 
            text-align: center; 
            margin-bottom: 20px; 
        }
    </style>
</head>
<body>
    <div class='container'>
        <div class='header'>
            <div class='logo'>🤖 Vyomexa.ai™</div>
            <h1>🚀 New Business Inquiry</h1>
            <p>A potential client wants to build their digital empire with AI</p>
        </div>
        
        <div class='content'>
            <div class='priority'>
                ⚡ HIGH PRIORITY LEAD - Respond within 24 hours
            </div>
            
            <div class='section'>
                <h3>📋 Business Overview</h3>
                <div class='field'>
                    <span class='label'>Business Name:</span>
                    <span class='value'>" . htmlspecialchars($businessName) . "</span>
                </div>
                <div class='field'>
                    <span class='label'>Industry:</span>
                    <span class='value'>" . htmlspecialchars($industry) . "</span>
                </div>
                <div class='field'>
                    <span class='label'>Budget Range:</span>
                    <span class='value'>" . htmlspecialchars($budget) . "</span>
                </div>
            </div>

            <div class='section'>
                <h3>💡 Business Idea</h3>
                <div class='highlight'>
                    " . nl2br(htmlspecialchars($businessIdea)) . "
                </div>
            </div>

            <div class='section'>
                <h3>📞 Contact Information</h3>
                <div class='contact-info'>
                    <div class='field'>
                        <span class='label'>Email:</span>
                        <span class='value'><a href='mailto:" . htmlspecialchars($email) . "'>" . htmlspecialchars($email) . "</a></span>
                    </div>";
                    
if (!empty($phone)) {
    $email_body .= "
                    <div class='field'>
                        <span class='label'>Phone:</span>
                        <span class='value'><a href='tel:" . htmlspecialchars($phone) . "'>" . htmlspecialchars($phone) . "</a></span>
                    </div>";
}

$email_body .= "
                </div>
            </div>

            <div class='section'>
                <h3>⚡ Next Steps</h3>
                <div class='next-steps'>
                    <ul>
                        <li><strong>Contact the client within 24 hours</strong></li>
                        <li>Schedule a discovery call to discuss requirements</li>
                        <li>Prepare a customized AI solution proposal</li>
                        <li>Begin website and marketing strategy development</li>
                        <li>Set up project timeline and milestones</li>
                    </ul>
                </div>
            </div>

            <div class='section'>
                <h3>📊 Lead Details</h3>
                <div class='field'>
                    <span class='label'>Submitted:</span>
                    <span class='value'>" . date('F j, Y \a\t g:i A') . "</span>
                </div>
                <div class='field'>
                    <span class='label'>IP Address:</span>
                    <span class='value'>" . $_SERVER['REMOTE_ADDR'] . "</span>
                </div>
                <div class='field'>
                    <span class='label'>User Agent:</span>
                    <span class='value'>" . htmlspecialchars($_SERVER['HTTP_USER_AGENT']) . "</span>
                </div>
            </div>
        </div>

        <div class='footer'>
            <div class='logo'>Vyomexa.ai™</div>
            <p><strong>AI Business Automation Platform</strong></p>
            <p>This inquiry was automatically generated from your website.</p>
            <p>Respond quickly to convert this lead into a client!</p>
        </div>
    </div>
</body>
</html>
";

// Send email
$mail_sent = mail($to, $subject, $email_body, $headers);

if ($mail_sent) {
    // Save inquiry to database/file (optional)
    $inquiry_data = [
        'timestamp' => date('Y-m-d H:i:s'),
        'businessName' => $businessName,
        'businessIdea' => $businessIdea,
        'industry' => $industry,
        'budget' => $budget,
        'email' => $email,
        'phone' => $phone,
        'ip' => $_SERVER['REMOTE_ADDR'],
        'userAgent' => $_SERVER['HTTP_USER_AGENT']
    ];
    
    // Create logs directory if it doesn't exist
    if (!file_exists('logs')) {
        mkdir('logs', 0755, true);
    }
    
    // Save to JSON file
    $inquiries_file = 'logs/business_inquiries.json';
    $inquiries = [];
    
    if (file_exists($inquiries_file)) {
        $inquiries = json_decode(file_get_contents($inquiries_file), true) ?: [];
    }
    
    $inquiries[] = $inquiry_data;
    file_put_contents($inquiries_file, json_encode($inquiries, JSON_PRETTY_PRINT));
    
    // Also log to text file
    $log_entry = date('Y-m-d H:i:s') . " - Business Inquiry: $businessName ($email) - $industry - $budget\n";
    @file_put_contents('logs/business_inquiries.log', $log_entry, FILE_APPEND | LOCK_EX);
    
    echo json_encode([
        'success' => true, 
        'message' => 'Your business inquiry has been submitted successfully! Our AI team will analyze your requirements and contact you within 24 hours.',
        'data' => [
            'inquiryId' => 'VYX-' . date('Ymd') . '-' . substr(md5($email . time()), 0, 6),
            'businessName' => $businessName,
            'estimatedResponse' => '24 hours',
            'nextSteps' => [
                'AI analysis of your business requirements',
                'Custom strategy development',
                'Initial consultation call',
                'Project proposal and timeline'
            ]
        ]
    ]);
} else {
    http_response_code(500);
    echo json_encode([
        'success' => false, 
        'message' => 'Sorry, there was an error processing your inquiry. Please try again or contact us directly at vyomexa.ai@gmail.com'
    ]);
}
?>