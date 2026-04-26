<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= $pageTitle ?? 'JB Barbershop' ?></title>
    <!-- Favicon -->
    <link rel="icon" href="/assets/images/icon_logo.png" type="image/png">
    <!-- Link to font awsome for fonts and icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;700&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">



    <!-- Global Styles -->
    <link rel="stylesheet" href="/assets/css/styles.css?ver=<?= time(); ?>">
    <link rel="stylesheet" href="/assets/css/header.css?ver=<?= time(); ?>">
    <link rel="stylesheet" href="/assets/css/book.css?ver=<?= time(); ?>">
    <link rel="stylesheet" href="/assets/css/auth.css?ver=<?= time(); ?>">
    <link rel="stylesheet" href="/assets/css/footer-contact.css?ver=<?= time(); ?>">
    
    <!-- Extra layout-specific styles -->
    <?= $extraCss ?? '' ?>
</head>
<body class="admin-page">


    <?php include __DIR__ . '/../partials/header.php'; ?> <!-- Header Section -->

    <main>
        <?php 
            require_once __DIR__ . '/../../helpers/flash_helper.php'; 
            flash('success');
            flash('error');
            flash('info');
            flash('warning');
        ?>
        <?= $content ?? '' ?>
    </main>

    <?php include __DIR__ . '/../partials/footer.php'; ?> <!-- Footer Section -->

    <!-- Global JS -->
    <script src="/assets/js/autoRedirect.js" defer></script>
    <script src="/assets/js/script.js" defer></script>
    <script src="/assets/js/booking.js" defer></script>
    
    <!-- Extra layout-specific scripts -->
    <?= $extraJs ?? '' ?>
</body>

</html>
