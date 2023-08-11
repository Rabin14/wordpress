<?php
get_header(); 
?>
<center>
<style>
table a{
  color:blue;
  font-weight:700;

}
table h1{
  color:#222222;


}
table h2{
  color:;


}
table h3{
  color:green;


}
table h4{
  color:#ff00ff;


}
table b{
  color:red;
  font-weight:800;

}

</style>
<div style="width:75%;height:auto;margin-top:0px;">
<table style="width:100%;height:auto;">
<tr>
<td style="width:55%;"><h1><?php echo get_the_title( $post_id ); ?></h1><hr>

	<?php if ( have_posts() ) : ?>
	<?php while ( have_posts() ) : the_post(); ?>
	<div <?php post_class(); ?>>
		<?php the_content(); ?>
		<?php edit_post_link(); ?>
		<?php wp_link_pages(); ?> 
	</div>
<?php endwhile; /* rewind or continue if all posts have been fetched */ ?>
<?php else : ?>
<?php endif; ?>
	
	
<td style="width:20%;"><script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
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
</td>
</tr>
</table>
	</br>


</center>
<?php get_footer(); ?>
