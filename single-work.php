<?php
/*
 * Template Name: Flex Portfolio Work
 * Template Post Type: post, work
 */

get_header();
?>

<?php if (!post_password_required()): ?>
    <!-- Full-width Hero Section -->
    <div class="hero full-width">
        <div class="title-wrapper">
            <p class="title"><?php the_field('title'); ?></p>
            <h2><?php the_field('subtitle'); ?></h2>
        </div>
        <div class="top-image" style="background:<?php the_field('bg_color'); ?>">
            <img class="lazy" src="<?php echo THEMEROOT; ?>/img/blank-slate.png" data-src="<?php the_field('top_image'); ?>" alt="<?php the_field('alt'); ?>">
        </div>
    </div>
<?php endif; ?>

<div class="container">
    <?php if (post_password_required()): ?>
        <div class="password-protected-content">
            <?php echo get_the_password_form(); ?>
        </div>
    <?php else: ?>
        <div class="content">
            <div class="description">
                <div class="about">
                    <h3><?php the_field('title'); ?></h3>
                    <p><?php the_field('description_big'); ?></p>
                </div>

                <dl class="sidebar">
                    <dd>Client</dd><dt><?php the_field('client'); ?></dt>
                    <dd>Role</dd><dt><?php the_field('role'); ?></dt>
                    <dd>Year</dd><dt><?php the_field('year'); ?></dt>
                    <dd>Included</dd><dt><?php the_field('included'); ?></dt>
                </dl>
            </div>

            <?php if( have_rows('image_details') ) : while ( have_rows('image_details') ) : the_row(); ?>
                <div class="image">
                    <a class="screenshot" href="<?php the_sub_field('image'); ?>">
                        <img class="lazy" src="<?php echo THEMEROOT; ?>/img/blank-slate.png" data-src="<?php the_sub_field('image'); ?>" alt="<?php the_sub_field('alt'); ?>">
                    </a>
                    <div class="text-description">
                        <h4><?php the_sub_field('title'); ?></h4>
                        <p><?php the_sub_field('image_description'); ?></p>
                    </div>
                </div>
            <?php endwhile; endif; ?>
        </div>
    <?php endif; ?>

    <!-- Navigation Links -->
    <div class="navigation-links">
        <?php
        $args = array(
            'post_type'      => 'work',
            'orderby'        => 'menu_order', // Follow custom post order
            'order'          => 'ASC',
            'posts_per_page' => -1
        );

        $works = new WP_Query($args);
        $work_ids = array();

        if ($works->have_posts()) {
            while ($works->have_posts()) {
                $works->the_post();
                $work_ids[] = get_the_ID();
            }
            wp_reset_postdata();
        }

        $current_id = get_the_ID();
        $current_index = array_search($current_id, $work_ids);
        $prev_id = $current_index > 0 ? $work_ids[$current_index - 1] : null;
        $next_id = $current_index < count($work_ids) - 1 ? $work_ids[$current_index + 1] : null;
        ?>

        <div class="nav-wrapper">
            <?php if ($prev_id): ?>
                <a href="<?php echo get_permalink($prev_id); ?>" class="nav-link prev-link">
                    &larr; <?php echo esc_html(str_replace('Protected: ', '', get_the_title($prev_id))); ?>
                </a>
            <?php endif; ?>

            <?php if ($next_id): ?>
                <a href="<?php echo get_permalink($next_id); ?>" class="nav-link next-link">
                    <?php echo esc_html(str_replace('Protected: ', '', get_the_title($next_id))); ?> &rarr;
                </a>
            <?php endif; ?>
        </div>
    </div>

    <?php if (!post_password_required()): ?>
        <div class="related">
            <h3>More Projects</h3>
            <?php
            $posttags = wp_get_post_tags($post->ID);
            if (!empty($posttags)) {
                $first_tag = $posttags[0]->term_id;
                $args = array(
                    'posts_per_page' => 3,
                    'tag__in' => array($first_tag),
                    'post__not_in' => array($post->ID),
                    'post_type' => 'work'
                );

                $related_posts = new WP_Query($args);

                if ($related_posts->have_posts()) :
                    echo '<ul class="related-items">';
                    while ($related_posts->have_posts()) : $related_posts->the_post(); ?>
                        <a href="<?php the_permalink(); ?>">
                            <li>
                                <div class="img-wrapper">
                                    <?php the_post_thumbnail('medium'); ?>
                                </div>
                                <div class="thumb-details">
                                    <h4><?php echo esc_html(str_replace('Protected: ', '', get_the_title())); ?></h4>
                                    <span>
                                        <?php $post_tags = get_the_tags();
                                        if ($post_tags) {
                                            foreach ($post_tags as $tag) {
                                                echo '<p class="left">' . $tag->name . '</p>';
                                            }
                                        } ?>
                                    </span>
                                </div>
                            </li>
                        </a>
                    <?php endwhile;
                    echo '</ul>';
                endif;

                wp_reset_postdata();
            }
            ?>
        </div><!-- end of related -->
    <?php endif; ?>
</div><!-- end of container -->

<?php get_footer(); ?>