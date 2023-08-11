<!DOCTYPE html>
<html <?php language_attributes(); ?> >

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>"/>
	<?php wp_head(); ?>
</head>


<body <?php body_class(); ?>>


<?php get_template_part( 'layouts/loader' ); ?>


<main class="main-wrapper">

	<?php get_template_part( 'template-parts/navigation-menu' ); ?>

	<?php get_template_part( 'template-parts/breadcrumbs' ); ?>


