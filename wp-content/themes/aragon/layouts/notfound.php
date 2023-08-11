<?php if ( is_search() ): ?>
    <section class="section not-found">
        <div class="container not-found-container">
            <div class="not-found-alert">
                <h2 class="title display-4">
                    <?php esc_html_e( 'Not found',
                        'aragon' ); ?><span class="highlight"><?php esc_html_e( '.',
                            'aragon' ); ?></span>
                </h2>
                <p class="subtitle"><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.',
                        'aragon' ); ?></p>
                <div class="buttons-wrapper d-flex">
                    <a href="<?php echo esc_url( get_home_url() ); ?>" class="btn-gradient-type-1"><i class="fa fa-home"></i><?php echo
                        esc_html__( 'Back to homepage', 'aragon' ); ?></a>
                </div>
            </div>
        </div>
    </section>
<?php else: ?>
    <section class="section not-found">
        <div class="container">
            <h4><?php esc_html_e( 'No results were found for the requested page.', 'aragon' ); ?></h4>
        </div>
    </section>
<?php endif; ?>