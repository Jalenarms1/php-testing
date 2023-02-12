<head>
   <!-- Insert API key from Google Cloud Console into the script tag's scr attribute where it says 'YOUR_API_KEY' -->
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap">
    </script>
    <script type="text/javascript" src="/script.js" defer></script>

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
    <script type="text/javascript" src="/map/script.js" defer></script>
    <link rel="stylesheet" href="/map/styles.css">
    <link rel="stylesheet" href="/styles.css">
    <title>Document</title>
</head>
<body>
    <?php include '../includes/navbar.php'; ?>
        <div class="top">
            <div>
                <h1 class="header">The Daily Grind Coffee House - Specialty Coffee and Tea</h1>
                <h3 class="sub-header">We hope you will come visit us soon!</h3>
            </div>
        
            <div class="info-wrap">
                <p class="address"><b>605 Washington St</b></p>
                <p class="address"><b>Fayette, IA 52142</b></p>
                <p class="phone"><b>888-555-5555</b></p>

            </div>
        </div>
        
        <div id="map" style="height:400px; width:50%;"></div>
    <?php include '../includes/footer.php'; ?>
    
</body>
