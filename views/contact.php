<?php
$popupMessage = '';
if (isset($_GET['success']) && $_GET['success'] == 1) {
    $popupMessage = "Message sent successfully!";
} elseif (isset($_GET['success']) && $_GET['success'] == 0) {
    $popupMessage = "Failed to send message. Please try again.";
}
?>

<!-- Contact Form -->
<div class="contact-form">
  <h2><i class="fas fa-paper-plane"></i> Contact Me</h2>
  <form method="POST" action="message.php">
    <input type="text" name="name" placeholder="Your Name" required />
    <input type="email" name="email" placeholder="Your Email" required />
    <textarea name="message" rows="5" placeholder="Your Message" required></textarea>
    <button type="submit">Send</button>
  </form>
</div>

<!-- ✅ JavaScript popup alert -->
<?php if (!empty($popupMessage)): ?>
<script>
  alert("<?= $popupMessage ?>");
</script>
<?php endif; ?>
