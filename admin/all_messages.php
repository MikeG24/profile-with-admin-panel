<?php
// Connect to the database
$conn = new mysqli("localhost", "root", "", "portfoliodb");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Filter messages by sender if provided
$filterSender = isset($_GET['sender']) ? $_GET['sender'] : null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>All Messages</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">

<div class="container mt-5">
  <a href="javascript:history.back()" class="btn btn-outline-light mb-3">← Back</a>

  <h2 class="mb-4">
    All Messages
    <?php if ($filterSender): ?>
      from <span class="text-info"><?= htmlspecialchars($filterSender) ?></span>
    <?php endif; ?>
  </h2>
  

  <?php
  if ($filterSender) {
      $stmt = $conn->prepare("SELECT * FROM messages WHERE name = ? ORDER BY created_at DESC");
      $stmt->bind_param("s", $filterSender);
      $stmt->execute();
      $result = $stmt->get_result();
  } else {
      $result = $conn->query("SELECT * FROM messages ORDER BY created_at DESC");
  }

  if ($result->num_rows > 0): ?>
    <div class="table-responsive">
      <table class="table table-bordered table-dark align-middle text-white">
        <thead>
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Message</th>
            <th>Date</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        <?php $i = 1; while ($row = $result->fetch_assoc()):
          $modalId = "viewModal" . $row['id'];
        ?>
          <tr id="row-<?= $row['id'] ?>">
            <td><?= $i++ ?></td>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td><?= htmlspecialchars($row['email']) ?></td>
            <td><?= substr(htmlspecialchars($row['message']), 0, 30) ?>...</td>
            <td><?= date('M d, Y H:i', strtotime($row['created_at'])) ?></td>
            <td class="status" id="status-<?= $row['id'] ?>"><?= $row['status'] ?></td>
            <td>
              <button class="btn btn-primary btn-sm view-btn" data-id="<?= $row['id'] ?>" data-bs-toggle="modal" data-bs-target="#<?= $modalId ?>">View</button>
            </td>
          </tr>

          <!-- Modal -->
          <div class="modal fade text-dark" id="<?= $modalId ?>" tabindex="-1" aria-labelledby="<?= $modalId ?>Label" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="<?= $modalId ?>Label">Message from <?= htmlspecialchars($row['name']) ?></h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <p><strong>Date:</strong> <?= date('M d, Y H:i', strtotime($row['created_at'])) ?></p>
                  <p><strong>Message:</strong><br><?= nl2br(htmlspecialchars($row['message'])) ?></p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>
        <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  <?php else: ?>
    <p>No messages found<?= $filterSender ? " from " . htmlspecialchars($filterSender) : "" ?>.</p>
  <?php endif; ?>
</div>

<!-- JS Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.querySelectorAll('.view-btn').forEach(btn => {
  btn.addEventListener('click', function() {
    const messageId = this.getAttribute('data-id');
    fetch('mark_read.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: 'id=' + messageId
    })
    .then(response => response.text())
    .then(data => {
      if (data === 'success') {
        document.getElementById('status-' + messageId).textContent = 'Read';
      }
    });
  });
});
</script>

</body>
</html>
