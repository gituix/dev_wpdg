<?php
/**
 * @package WordPress
 * @subpackage Templuto
 */
?>
<?php global $hook; ?>

<div class="sidebar"><ul>
    <?php
        if(!dynamic_sidebar('sidebar_right')) {
            $hook->hook('sidebar_right');
        }
   	?>
</ul></div>
