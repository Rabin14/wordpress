<?php
if (aragon_is_blog()):
    $id = get_option('page_for_posts');
endif;
$footer_type = aragon_get_field('footer_type', $id);
?>
</main>

<?php if ($footer_type): ?>
    <div class="footer-spacing">
    </div>
<?php endif; ?>

<footer class="<?php echo esc_attr($footer_type); ?>">
    <?php get_template_part('layouts/footer-content'); ?>
</footer>
<?php wp_footer(); ?>
</body>
</html>
