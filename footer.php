</div> <!-- Close container from header -->

<!-- AI Chatbot Button -->
<div class="ai-chat-button" id="chatButton">
    <i class="fas fa-robot"></i>
</div>

<!-- AI Chatbot Modal -->
<div class="ai-chat-modal" id="chatModal">
    <div class="ai-chat-header">
        <h5>Medical Assistant</h5>
        <button class="close-chat">&times;</button>
    </div>
    <div class="ai-chat-body" id="chatMessages">
        <div class="ai-message">Hello! I'm your medical assistant. How can I help you today?</div>
    </div>
    <div class="ai-chat-footer">
        <input type="text" id="userMessage" placeholder="Type your message...">
        <button id="sendMessage"><i class="fas fa-paper-plane"></i></button>
    </div>
</div>

<footer class="bg-dark text-white mt-5 py-4">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h5>About MediEmergency</h5>
                <p>Connecting patients with emergency medical services quickly and efficiently.</p>
            </div>
            <div class="col-md-4">
                <h5>Quick Links</h5>
                <ul class="list-unstyled">
                    <li><a href="<?php echo BASE_URL; ?>/patient/hospitals.php" class="text-white">Find Hospitals</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/patient/services.php" class="text-white">Services</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/emergency-call.php" class="text-white">Emergency Call</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h5>Contact</h5>
                <p><i class="fas fa-phone"></i> Emergency: 911</p>
                <p><i class="fas fa-envelope"></i> info@mediemergency.com</p>
            </div>
        </div>
        <hr>
        <div class="text-center">
            <p>&copy; <?php echo date('Y'); ?> MediEmergency. All rights reserved.</p>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_GOOGLE_MAPS_API_KEY&libraries=places"></script>
<script src="<?php echo BASE_URL; ?>/assets/js/script.js"></script>
<script src="<?php echo BASE_URL; ?>/assets/js/map.js"></script>
<script src="<?php echo BASE_URL; ?>/assets/js/ai-chat.js"></script>
</body>
</html>