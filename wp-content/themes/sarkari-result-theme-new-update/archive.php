<?php
get_header(); 
?>
<center>

<div style="width:75%;height:auto;margin-top:0px;">
<table style="width:100%;height:auto;">
<tr>
<td style="width:55%;"><div id="box1" align="left" style="height:auto;width:100%;margin-top:0;">
<div id="heading">
<div id="font" align="center">-------------</div>

</div>
<div id="post">
	<?php if ( have_posts() ) : ?>
	<?php while ( have_posts() ) : the_post(); ?>
<ul>
<li><a href="" target=_blank><a href="<?php the_permalink(); ?>" target=_blank><?php echo get_the_title( $post_id ); ?></a> </a></li>
</ul>
	<?php endwhile; /* rewind or continue if all posts have been fetched */ ?>
			
<?php else : ?>
<?php endif; ?>

</div>
</div></td>
<td style="width:20%;padding:10px;"><img src="https://tpc.googlesyndication.com/simgad/8237519466514634616?sqp=4sqPyQQ7QjkqNxABHQAAtEIgASgBMAk4A0DwkwlYAWBfcAKAAQGIAQGdAQAAgD-oAQGwAYCt4gS4AV_FAS2ynT4&rs=AOga4ql9Z2x88f8JLNMje-lKKAdtScQZNw"style="width:100%;"></td>
</tr>
</table>
</br>


</center>
<?php get_footer(); ?>
