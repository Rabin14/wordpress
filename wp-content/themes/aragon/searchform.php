<form class="search-form" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <div class="search-input-wrapper d-flex align-items-center">
        <input type="text" class="searchinput" value="<?php echo get_search_query(); ?>" name="s"
               placeholder="<?php esc_attr_e( 'Enter keyword', 'aragon' ); ?>" required="">
        <div class="form-close search-toggle d-flex justify-content-center align-items-center">
            <i class="fa fa-times"></i>
        </div>
        <button type="submit" class="navbar-hidden-btn">
            <i class="fa fa-search" aria-hidden="true"></i>
        </button>
    </div>
</form>
