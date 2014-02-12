<div id="content">
    <?php if (have_posts()) : while (have_posts()) : the_post();?>
    <div class="post">
        <h2><?php the_title();?></h2>
        <div class="entrytext">
            <?php the_content('<p class="serif">Read the rest of this page È</p>'); ?>
        </div>
    </div>
    <?php endwhile; endif; ?>
</div>