<?php
/**
 * Content Wrappers
 */

if (is_product()) return;
?>
<!-- PAGE META -->
<div id="page-meta" class="group">

    <h1 class="page-title"><?php woocommerce_page_title(); ?></h1>

    <?php

    do_action('yith_before_shop_page_meta');

    do_action('shop-page-meta');

    ?>
</div>
<!-- END PAGE META -->