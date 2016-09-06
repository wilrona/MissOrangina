<?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>

<div class="page-header">
    <div class="l-container">
        <h1><?php the_title(); ?></h1>

    </div>
</div>
<div class="l-container l-container-page">
    <?php the_content(); ?>
</div>
    <?php endwhile; ?>
<?php endif; ?>