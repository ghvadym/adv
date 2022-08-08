<?php
get_header();
$id = get_the_ID();
?>

    <section class="section">
        <div class="container">
            <h1 class="title">
                <?php the_title(); ?>
            </h1>
            <div class="thumbnail">
                <?php echo getImageThumbnail($id); ?>
            </div>
            <article class="article">
                <?php the_content(); ?>
            </article>
        </div>
    </section>

<?php
get_footer();