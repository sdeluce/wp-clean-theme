<?php
    if (! is_active_sidebar('left-area'))
        return;
?>
<aside class="col-md-<?php grid('left'); ?> ">
    <?php if ( is_active_sidebar('left-area') ) : ?>

            <?php dynamic_sidebar('left-area'); ?>

    <?php endif; ?>
</aside>