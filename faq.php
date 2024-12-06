<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/about.css">
    <link rel="stylesheet" href="./css/faq.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <title>PageTerner</title>
</head>

<body>

    <div class="container">
        <?php include 'header.php'; ?>

        <div class="about">

            <div class="about-bread">
                <a href="index.php" class="about-bread__link">Home</a>
                <i class="las la-angle-right"></i>
                <a href="faq.php" class="about-bread__link">FAQ's</a>
            </div>

            <div class="about-content">
                <h1 class="about-title">FAQ<Span>'s</Span></h1>
                <p class="about-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. </p>
            </div>
            <div class="faq">
                <div class="faq-item">
                    <div class="faq-item-content">
                        <h2 class="faq-question">What is PageTurner?</h2>
                        <i class="las la-plus"></i>
                    </div>
                    <p class="faq-answer">PageTurner is a website that provides a wide range of books for free. You can read them online or download them to read later.</p>
                </div>

                <div class="faq-item">
                    <div class="faq-item-content">
                        <h2 class="faq-question">How can I read books on PageTurner?</h2>
                        <i class="las la-plus"></i>
                    </div>
                    <p class="faq-answer">You can read books on PageTurner by visiting the Books section and selecting a book to read. You can read the book online or download it to read later.</p>
                </div>

                <div class="faq-item">
                    <div class="faq-item-content">
                        <h2 class="faq-question">Can I download books from PageTurner?</h2>
                        <i class="las la-plus"></i>
                    </div>
                    <p class="faq-answer">Yes, you can download books from PageTurner. Simply visit the Books section, select a book, and click on the download button to download the book.</p>
                </div>

            </div>

        </div>

        <?php include 'footer.php'; ?>
    </div>

    <script>
        document.querySelectorAll('.faq-item').forEach(item => {
            item.addEventListener('click', () => {
                item.classList.toggle('active');
                const icon = item.querySelector('i');
                icon.classList.toggle('la-plus');
                icon.classList.toggle('la-minus');
            });
        });
    </script>

    <script src="./js/app.js"></script>
</body>

</html>