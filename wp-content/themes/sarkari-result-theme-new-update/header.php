<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"></meta>
<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php endif; ?>
<meta name="description" content="karmodishari job : https://karmodishari.co.in/ provides you all the latest govt/Sarkari Results, Govt Jobs, Admit Cards, in various sectors such as Railway, Bank, CDS, NDA, SSC, Army, Navy, Police, RSMSSB, UPPSC, UPSSSC and more jobalerts only one place."></meta>
<meta name="keywords" content=" Last Date, Admit Cards, Sarkari Result, latest sarkari results, Sarkariresult, Sarkari JOBS, Sarkariresults"></meta>
<meta name="rating" content="general" />
<meta http-equiv="content-language" content="en" />
<meta name="distribution" content="global" />
<meta name="robots" content="index, follow" />
<link href="<?php echo get_stylesheet_uri(); ?>" rel="stylesheet" type="text/css"></link>
</head>
<body>
<div align="center">
<div id="header">
<div id="head-title"><?php bloginfo( 'name' ); ?><br /></div>
<font size="+1" color="#ffffff"><b><?php bloginfo( 'url' ); ?></b></font>
</div>
<div id="menu">
<ul class="menu">
<li><a href="https://karmodishari.co.in" class="parent"><span>Home</span></a></li>
<li><a href="https://karmodishari.co.in/?cat=9" class="parent"><span>Latest Jobs</span></a></li>
<li><a href="https://karmodishari.co.in/?cat=2" class="parent"><span>WB Jobs</span></a></li>
<li><a href="https://karmodishari.co.in/?cat=7" class="parent"><span>Admit Card</span></a></li>
<li><a href="https://karmodishari.co.in/?cat=11" class="parent"><span>Results</span></a></li>
<li><a href="https://karmodishari.co.in/?cat=18" class="parent"><span>Scholarships</span></a></li>
<li><a href="https://karmodishari.co.in/?cat=8" class="parent"><span>Career Guide</span></a></li>
<li><a href="https://karmodishari.co.in/?page_id=217" class="parent"><span>Privacy Policy</span></a></li>
	<li><a href="https://karmodishari.co.in/?page_id=223" class="parent"><span>Disclaimer</span></a></li>

</ul>
<br>
</div>
</div>
<br>
<br>
<div id="marquee1" align="center">
<script src="https://ajax.cloudflare.com/cdn-cgi/scripts/2448a7bd/cloudflare-static/rocket-loader.min.js" data-cf-nonce="f1a80adeaa41ba9339409f79-"></script><marquee behavior="alternate" onmouseover="this.stop();" onmouseout="this.start();">
	<?php $i = 1; 

$custom_query = new WP_Query('cat=9'); // exclude category 9
while($custom_query->have_posts() && $i < 4) : $custom_query->the_post(); ?>
	<a href="<?php the_permalink() ?>" target=_blank><b><font size="3"><?php the_title(); ?></font></b></a> ||
	<?php $i++; endwhile; ?>
<?php wp_reset_postdata(); // reset the query ?>
	</marquee>
	
	
</div><div id="marquee1" align="center">
<script src="https://ajax.cloudflare.com/cdn-cgi/scripts/2448a7bd/cloudflare-static/rocket-loader.min.js" data-cf-nonce="f1a80adeaa41ba9339409f79-"></script><marquee behavior="alternate" onmouseover="this.stop();" onmouseout="this.start();">
	<?php $i = 1; 

$custom_query = new WP_Query('cat=7'); // exclude category 9
while($custom_query->have_posts() && $i < 4) : $custom_query->the_post(); ?>
	
	<a href="<?php the_permalink() ?>" target=_blank><b><font size="3"><?php the_title(); ?></font></b></a> || 
	<?php $i++; endwhile; ?>
<?php wp_reset_postdata(); // reset the query ?>
	</marquee>
</div><div id="marquee1" align="center">
	
<script src="https://ajax.cloudflare.com/cdn-cgi/scripts/2448a7bd/cloudflare-static/rocket-loader.min.js" data-cf-nonce="f1a80adeaa41ba9339409f79-"></script><marquee behavior="alternate" onmouseover="this.stop();" onmouseout="this.start();">
	<?php $i = 1; 

$custom_query = new WP_Query('cat=11'); // exclude category 9
while($custom_query->have_posts() && $i < 4) : $custom_query->the_post(); ?>
	<a href="<?php the_permalink() ?>" target=_blank><b><font size="3"><?php the_title(); ?></font></b></a> ||<?php $i++; endwhile; ?>
<?php wp_reset_postdata(); // reset the query ?> </marquee>
</div></div>
<br>