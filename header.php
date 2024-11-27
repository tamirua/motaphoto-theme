<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header class="navbar">
    <div class="container">
        <!-- Logo -->
        <div class="logo">
            <a href="<?php echo home_url(); ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png" alt="<?php bloginfo('name'); ?>">
            </a>
        </div>

        <!-- Navigation Menu -->
        <nav class="main-menu">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'main-menu',
                'container' => false,
                'menu_class' => 'nav-links',
            ));
            ?>
        </nav>
    </div>
    
</header>

<!-- Contact Link (will trigger modal) -->
<!--<a href="#" class="contact-nav-link">Contact</a>-->
<!--<a href="javascript:void(0);" onclick="openModal()">Contact</a>-->



<main> <!-- Main content starts here -->
