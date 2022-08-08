<?php
wp_footer();
?>

</main>

<footer class="footer">
    <div class="container">
        <div class="footer__nav">
            <div class="row">
                <div class="footer-column col">
                    <a class="footer__logo" href="<?php echo home_url(); ?>">

                    </a>
                    <div class="footer__nav">
                        <?php wp_nav_menu(['theme_location' => 'main_footer',]) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

</body>
</html>