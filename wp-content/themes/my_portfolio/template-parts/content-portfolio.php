<div class="work_list">
    <div class="work_headline">
        <h2><?php the_title(); ?></h2>
        <span class="work_link"><?php the_content(); ?></span>
    </div>
    <?php if (get_field('image_for_project')): ?>
        <img src="<?php the_field('image_for_project'); ?>"/>
    <?php endif; ?>
</div>