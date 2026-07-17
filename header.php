<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <!-- SEO -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <!-- Favicons -->
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri();?>/assets/images/favicon.ico">
    <?php wp_head();?>
</head>

<body <?php body_class(); ?> data-spy="scroll" data-target="#navbar" data-offset="100">
    <?php echo apply_filters('eld_header_template', elanding_load_template('common/header/header-style-1')); ?>
