<?php
    if (! is_active_sidebar('footer-area'))
        return;
?>
<aside class="row">
    <?php if ( is_active_sidebar('footer-area') ) : ?>

            <?php dynamic_sidebar('footer-area'); ?>

    <?php endif; ?>
</aside>