<?php
// preloader trigger
$preloader_trigger = aragon_get_option('opt_preloader_trigger');
// Type of preloader (ball, line or misc)
$preloader_type = empty(!aragon_get_option('opt_preloader_type')) ? aragon_get_option('opt_preloader_type') : 'ball';
// Ball type
$ball_type = empty(!aragon_get_option('opt_balls_loaders')) ? aragon_get_option('opt_balls_loaders') : 'ball-grid-pulse';
// Line type
$line_type = empty(!aragon_get_option('opt_lines_loaders')) ? aragon_get_option('opt_lines_loaders') : 'line-scale';
// Misc type
$misc_type = empty(!aragon_get_option('opt_misc_loaders')) ? aragon_get_option('opt_misc_loaders') : 'square-spin';
?>

<?php if ($preloader_trigger): ?>
    <div class="loader">
        <?php if ($preloader_type === 'ball'): ?>

            <?php if ($ball_type === 'ball-grid-pulse'): ?>

                <div class="loader-inner ball-grid-pulse">
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                </div>

            <?php endif; ?>

            <?php if ($ball_type === 'ball-clip-rotate'): ?>

                <div class="loader-inner ball-clip-rotate">
                    <div></div>
                </div>

            <?php endif; ?>

            <?php if ($ball_type === 'ball-pulse-rise'): ?>

                <div class="loader-inner ball-pulse-rise">
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                </div>

            <?php endif; ?>

            <?php if ($ball_type === 'ball-rotate'): ?>

                <div class="loader-inner ball-rotate">
                    <div></div>
                </div>

            <?php endif; ?>

            <?php if ($ball_type === 'ball-scale'): ?>

                <div class="loader-inner ball-scale">
                    <div></div>
                </div>

            <?php endif; ?>

            <?php if ($ball_type === 'ball-scale-multiple'): ?>

                <div class="loader-inner ball-scale-multiple">
                    <div></div>
                    <div></div>
                    <div></div>
                </div>

            <?php endif; ?>

            <?php if ($ball_type === 'ball-beat'): ?>

                <div class="loader-inner ball-beat">
                    <div></div>
                    <div></div>
                    <div></div>
                </div>

            <?php endif; ?>

            <?php if ($ball_type === 'ball-scale-ripple'): ?>

                <div class="loader-inner ball-scale-ripple">
                    <div></div>
                </div>

            <?php endif; ?>

            <?php if ($ball_type === 'ball-spin-fade-loader'): ?>

                <div class="loader-inner ball-spin-fade-loader">
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                </div>

            <?php endif; ?>

            <?php if ($ball_type === 'ball-grid-beat'): ?>

                <div class="loader-inner ball-grid-beat">
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                </div>

            <?php endif; ?>

            <?php if ($ball_type === 'ball-scale-random'): ?>

                <div class="loader-inner ball-scale-random">
                    <div></div>
                    <div></div>
                    <div></div>
                </div>

            <?php endif; ?>

        <?php endif; ?>

        <?php if ($preloader_type === 'line'): ?>

            <?php if ($line_type === 'line-scale'): ?>

                <div class="loader-inner line-scale">
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                </div>

            <?php endif; ?>

            <?php if ($line_type === 'line-scale-party'): ?>

                <div class="loader-inner line-scale-party">
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                </div>

            <?php endif; ?>

            <?php if ($line_type === 'line-scale-pulse-out'): ?>

                <div class="loader-inner line-scale-pulse-out">
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                </div>

            <?php endif; ?>

            <?php if ($line_type === 'line-scale-pulse-out-rapid'): ?>

                <div class="loader-inner line-scale-pulse-out-rapid">
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                </div>

            <?php endif; ?>

            <?php if ($line_type === 'line-spin-fade-loader'): ?>

                <div class="loader-inner line-spin-fade-loader">
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                </div>

            <?php endif; ?>

        <?php endif; ?>

        <?php if ($preloader_type === 'misc'): ?>

            <?php if ($misc_type === 'square-spin'): ?>

                <div class="loader-inner square-spin">
                    <div></div>
                </div>

            <?php endif; ?>

            <?php if ($misc_type === 'pacman'): ?>

                <div class="loader-inner pacman">
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                </div>

            <?php endif; ?>

        <?php endif; ?>

    </div>
<?php endif; ?>

