<?php
if (empty($args)) {
    return;
}
?>

<div class="card">
    <a href="<?php echo get_permalink($args); ?>" class="card__body">
        <div class="card__image">
            <?php echo getImageThumbnail($args->ID); ?>
        </div>
        <h3 class="card__title">
            <?php echo $args->post_title; ?>
        </h3>
    </a>
</div>