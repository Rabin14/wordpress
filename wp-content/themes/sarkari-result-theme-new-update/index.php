<?php
get_header(); 
?>
<div align="center">
<div id="facebook">
<a href="https://www.facebook.com/কর্ম-দিশারী-Make-Your-Carrier-413374049459289/" target=_blank><font color="#ffffff">Join us on Facebook</font></a></div>
</div>

<br>

<center><div style="width:75%;"><script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- New ad-1 -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-1203064237638367"
     data-ad-slot="6901239131"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
</div></center>
<br><br>
<table width="75%" align="center">
<tr valign="top">
<td align="left">
<div id="box1" align="left" style="height:770px">
<div id="heading">
<div id="font" align="center">Latest Jobs</div>
<div style="margin-top:700px">
<div id="view" align="center"><a href="https://karmodishari.co.in/?cat=9" target=_blank>View More</a></div>
</div>
</div>
<div id="post">
	

	<?php $i = 1; 

$custom_query = new WP_Query('cat=9'); // exclude category 9
while($custom_query->have_posts() && $i < 11) : $custom_query->the_post(); ?>
	<ul>
<li><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></li>
		</ul>
	<?php $i++; endwhile; ?>
<?php wp_reset_postdata(); // reset the query ?>



</div>
</div>
<br>
<div align="left" id="box2"style="height:320px">
<div id="heading">
<div id="font" align="center">Career Guide</div>
<div style="margin-top:250px">
<div id="view" align="center"><a href="https://karmodishari.co.in/?cat=8" target=_blank>View More</a></div>
</div>
</div>
<div id="post">
<?php $i = 1; 

$custom_query = new WP_Query('cat=8'); // exclude category 9
while($custom_query->have_posts() && $i < 5) : $custom_query->the_post(); ?>
	<ul>
<li><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></li>
		</ul>
	<?php $i++; endwhile; ?>
<?php wp_reset_postdata(); // reset the query ?>

</div>
<br>

</div>
</td>
<td align="center"><div id="box2" align="center" style="height:770px">
<div id="heading">
<div align="center">Admit Card</div>
<div style="margin-top:700px">
<div id="view" align="center"><a href="https://karmodishari.co.in/?cat=7" target=_blank>View More</a></div>
</div>
</div>
<div id="post" align="left">
<?php $i = 1; 

$custom_query = new WP_Query('cat=7'); // exclude category 9
while($custom_query->have_posts() && $i < 11) : $custom_query->the_post(); ?>
	<ul>
<li><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></li>
		</ul>
	<?php $i++; endwhile; ?>
<?php wp_reset_postdata(); // reset the query ?>

</div>
</div>
</div>
<br>
<br>
<div align="center" id="box2" style="margin-top:-20px;height:320px;">
<div id="heading">
<div align="center">Scholarships</div>
<div style="margin-top:250px">
<div id="view" align="center"><a href="https://karmodishari.co.in/?cat=18" target=_blank>View More</a></div>
</div>
</div>
<div id="post" align="left">
<?php $i = 1; 

$custom_query = new WP_Query('cat=18'); // exclude category 9
while($custom_query->have_posts() && $i < 5) : $custom_query->the_post(); ?>
	<ul>
<li><a href='<?php the_permalink() ?>'><?php the_title(); ?></a></li>
		</ul>
	<?php $i++; endwhile; ?>
<?php wp_reset_postdata(); // reset the query ?>

</div>
<br>

</div></td>
<td align="right">
<div id="box1" align="right" style="height:770px">
<div id="heading">
<div id="font" align="center">Results</div>
<div style="margin-top:700px">
<div id="view" align="center"><a href="https://karmodishari.co.in/?cat=11" target=_blank>View More</a></div>
</div>
</div>
<div id="post" align="left">
<?php $i = 1; 

$custom_query = new WP_Query('cat=11'); // exclude category 9
while($custom_query->have_posts() && $i < 11) : $custom_query->the_post(); ?>
	<ul>
<li><a href='<?php the_permalink() ?>'><?php the_title(); ?></a></li>
		</ul>
	<?php $i++; endwhile; ?>
<?php wp_reset_postdata(); // reset the query ?>


</div>
</div>
</div>
<br>
<div align="center" id="box2" style="height:320px; ">
<div id="heading">
<div align="center">GK And Current Affairs</div>
<div style="margin-top:250px">
<div id="view" align="center"><a href="https://karmodishari.co.in/?cat=5" target=_blank>View More</a></div>
</div>
</div>
<div id="post" align="left">
<?php $i = 1; 

$custom_query = new WP_Query('cat=5'); // exclude category 9
while($custom_query->have_posts() && $i < 5) : $custom_query->the_post(); ?>
	<ul>
<li><a href='<?php the_permalink() ?>'><?php the_title(); ?></a></li>
		</ul>
	<?php $i++; endwhile; ?>
<?php wp_reset_postdata(); // reset the query ?>

</div>
</div>
</div>
</div></td>
</tr>
</table>
<center><div style="width:75%;"><script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- New ad-1 -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-1203064237638367"
     data-ad-slot="6901239131"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>

	</div></center>

<br><br>

</html>

<?php get_footer(); ?>
