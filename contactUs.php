
<?php include 'header.php';?> 
<?php include 'nav.php';?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleHome.css"> 

    <title>Contact Us</title>
</head>
<body>
    <?php
  
    $name = $email = $message = '';
    $nameErr = $emailErr = $messageErr = '';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
        if (empty($_POST["name"])) {
            $nameErr = "Name is required";
        } else {
            $name = test_input($_POST["name"]);
        }

        if (empty($_POST["email"])) {
            $emailErr = "Email is required";
        } else {
            $email = test_input($_POST["email"]);
      
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format";
            }
        }

        if (empty($_POST["message"])) {
            $messageErr = "Message is required";
        } else {
            $message = test_input($_POST["message"]);
        }

     
        if ($name && $email && $message) {
            $to = "noorakraa8@gmail.com"; 
            $subject = "New Inquiry from Contact Form";
            $body = "Name: $name\nEmail: $email\n\n$message";

            // Send email
            if (mail($to, $subject, $body)) {
                echo "<p>Your message has been sent successfully. We will get back to you soon!</p>";
            } else {
                echo "<p>Sorry, there was an error sending your message. Please try again later.</p>";
            }
        }
    }

    // Function to sanitize form data
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
      
        return $data;
    }

    
    ?>
  <div class='main_page'>
    <h2>Contact Us</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name">
        <span class="error"><?php echo $nameErr; ?></span><br><br>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email">
        <span class="error"><?php echo $emailErr; ?></span><br><br>

        <label for="message">Message:</label>
        <textarea id="message" name="message" rows="4"></textarea>
        <span class="error"><?php echo $messageErr; ?></span><br><br>

        <input type="submit" name="submit" value="Submit">
    </form>
</body>
</html>
<?php include 'footer.php';?>