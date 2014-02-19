<?php
    if (! is_active_sidebar('right-area'))
        return;
?>
<aside class="col-md-<?php grid('right'); ?> ">
    <?php if ( is_active_sidebar('right-area') ) : ?>

            <?php dynamic_sidebar('right-area'); ?>

    <?php endif; ?>
</aside>