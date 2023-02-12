<?php
    
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="/contact/script.js" defer></script>
    <script type="text/javascript" src="/script.js" defer></script>

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/contact/styles.css">
    <link rel="stylesheet" href="/styles.css">

    <title>Document</title>
</head>
<body>
    <?php include '../includes/navbar.php'; ?>
    <div class="contact-wrap">

        <h1 class="page-title">Contact The Daily Grind</h1>
        <form action="submit.php" method="POST" class="contact-form">
            <div class="form-group">
                <label for="salutation">Salutation:</label>
                <select id="salutation" name="salutation" class="form-control-salutation">
                <option value="Mr.">Mr.</option>
                <option value="Ms.">Ms.</option>
                <option value="Mrs.">Mrs.</option>
                <option value="Dr.">Dr.</option>
                </select>
            </div>
            <div class="form-group">
                <label for="first-name">First Name:</label>
                <input type="text" id="first-name" name="first-name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="last-name">Last Name:</label>
                <input type="text" id="last-name" name="last-name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="tel" id="phone" name="phone" class="form-control">
            </div>
            <div class="form-group">
                <label for="subject">Subject:</label>
                <input type="text" id="subject" name="subject" class="form-control">
            </div>
            <div class="form-group">
                <label for="comments">Comments:</label>
                <textarea id="comments" name="comments" class="form-control"></textarea>
            </div>
            <div class="form-group-consent">
                <div>
                    <input type="checkbox" id="consent" name="replyConsent" class="form-checkbox">
                    <label for="consent">I consent to a reply</label>
                </div>
                <div class="reset-wrap">
                    <button class="reset" id="reset-form">Reset</button>
                </div>
            </div>
            <button type="submit" class="btn btn-submit" id="submit-btn">Submit</button>
        </form>
    </div>


    <?php include '../includes/footer.php'; ?>
</body>



