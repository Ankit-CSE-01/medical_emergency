<?php
require_once 'includes/header.php';
require_once 'includes/db.php';

// Simple AI response logic (in a real app, you'd integrate with an AI API)
function getAIResponse($message) {
    $message = strtolower(trim($message));
    
    // Common medical questions and responses
    $responses = [
        'hello' => 'Hello! I\'m your medical assistant. How can I help you today?',
        'hi' => 'Hi there! How can I assist you with your medical concerns?',
        'emergency' => 'If this is a medical emergency, please call emergency services immediately or use our emergency call feature.',
        'pain' => 'Pain can have many causes. Can you describe your symptoms in more detail? Is the pain severe?',
        'fever' => 'Fever is often a sign of infection. If your temperature is above 103°F (39.4°C) or lasts more than 3 days, please see a doctor.',
        'headache' => 'Headaches can be caused by many factors. Stay hydrated and rest. If the pain is severe or persistent, consult a doctor.',
        'appointment' => 'You can book an appointment using our online system. Would you like me to direct you to the appointment page?',
        'hospital' => 'You can find nearby hospitals using our hospital locator. Would you like me to show you how?',
        'thank' => 'You\'re welcome! Is there anything else I can help you with?',
        'bye' => 'Goodbye! Take care and don\'t hesitate to reach out if you have more questions.'
    ];
    
    // Check for specific keywords
    foreach ($responses as $keyword => $response) {
        if (strpos($message, $keyword) !== false) {
            return $response;
        }
    }
    
    // Default responses
    $defaultResponses = [
        "I'm not sure I understand. Could you provide more details about your medical concern?",
        "That's an important question. For accurate medical advice, I recommend consulting with a healthcare professional.",
        "I can provide general information, but for specific medical advice, please consult a doctor.",
        "Your health is important. If you're experiencing serious symptoms, please seek medical attention."
    ];
    
    return $defaultResponses[array_rand($defaultResponses)];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sessionId = $_POST['session_id'];
    $userMessage = $_POST['user_message'];
    
    // Get AI response
    $aiResponse = getAIResponse($userMessage);
    
    // Log the conversation to database
    $stmt = $pdo->prepare("INSERT INTO ai_chat_logs (session_id, user_message, ai_response) VALUES (?, ?, ?)");
    $stmt->execute([$sessionId, $userMessage, $aiResponse]);
    
    // Return JSON response
    header('Content-Type: application/json');
    echo json_encode(['response' => $aiResponse]);
    exit();
}

// If not a POST request, redirect to home
header('Location: index.php');
exit();
?>