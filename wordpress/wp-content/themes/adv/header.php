<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title><?php the_title() ?></title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="header">
    <div class="container">
        <div class="header__row">
            <div class="header__logo">
                <a href="<?php echo home_url(); ?>">
                    <?php echo get_bloginfo('title') ?: __('ADV', 'adv'); ?>
                </a>
            </div>
            <div id="burger" class="nav__burger">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div id="menu" class="nav__menu">
                <?php wp_nav_menu(['theme_location' => 'main_header']) ?>
            </div>
        </div>
    </div>
</header>
<main class="main">