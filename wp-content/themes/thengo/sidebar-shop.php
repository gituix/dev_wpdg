<?php
/**
 * @package WordPress
 * @subpackage Templuto
 */
?>
<?php global $hook; ?>

<div class="sidebar"><ul>
    <?php
        if(!dynamic_sidebar('sidebar_shop')) {
            $hook->hook('sidebar_shop');
        }
   	?>
</ul></div>
