<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Contact Us</title>
</head>
<body>



<div class="contact-messages">
    <!-- Messages will be displayed here -->
</div>


<script>
    function submitForm() {
        // Clear previous messages
        document.querySelector('.contact-messages').innerHTML = '';

        // You can add client-side validation here if needed

        // Submit the form
        return true;
    }
</script>

    <div class="contact-container">
        <div class="contact-form">


        <?php
            if (isset($_GET['message']) && $_GET['message'] === 'success') {
                echo '<div class="alert alert-success">Message sent successfully!</div>';
            } elseif (isset($_GET['message']) && $_GET['message'] === 'error') {
                echo '<div class="alert alert-danger">Message could not be sent. Please try again later.</div>';
            }
            ?>
            <h2>Contact Us</h2>
            <form action="send-email.php"   method="POST" onsubmit="return submitForm();">
                <div class="mb-5">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-5">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-5">
                    <label for="subject" class="form-label">Subject</label>
                    <input type="text" class="form-control" id="subject" name="subject" required>
                </div>
                <div class="mb-5">
                    <label for="message" class="form-label">Message</label>
                    <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</body>
</html>
