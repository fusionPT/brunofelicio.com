<?php
/*
 * Template Name: Flex Portfolio Work
 * Template Post Type: post, work
 */

get_header();
?>

<?php if (!post_password_required()): ?>
    <!-- Full-width Hero Section -->
    <div class="hero">

        <div class="title-wrapper">
            <p class="title"><?php the_field('title'); ?></p>
            <h1><?php the_field('subtitle'); ?></h1>
        </div>

        <div class="top-image" style="background:<?php the_field('bg_color'); ?>">
            <img class="lazy" src="<?php echo THEMEROOT; ?>/img/blank-slate.png" data-src="<?php the_field('top_image'); ?>" alt="<?php the_field('alt'); ?>">
        </div>
    </div>
<?php endif; ?>

<div class="container">
    <?php if (post_password_required()): ?>
        <div class="password-protected-content">
            <h1><?php the_title(); ?></h1>
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

            <?php if (have_rows('flex_details')) : while (have_rows('flex_details')) : the_row(); ?>
                <?php if (get_row_layout() == 'flex_image') : ?>
                    <div class="image-flex">
                        <a class="screenshot" href="<?php the_sub_field('image_url'); ?>">
                            <img class="lazy" src="<?php echo THEMEROOT; ?>/img/blank-slate.png" data-src="<?php the_sub_field('image_url'); ?>" alt="<?php the_sub_field('alt'); ?>">
                        </a>
                        <span class="caption"><?php the_sub_field('caption'); ?></span>
                    </div>
                <?php elseif (get_row_layout() == 'flex_text') : ?>
                    <div class="text-block">
                        <h3><?php the_sub_field('text_block_title'); ?></h3>
                        <p><?php the_sub_field('text_block_description'); ?></p>
                    </div>
                <?php elseif (get_row_layout() == 'flex_video') : ?>
                    <div class="text-block">
                        <h3><?php the_sub_field('video_block_title'); ?></h3>
                        <div class="video-container">
                            <iframe src="<?php the_sub_field('video_block'); ?>" frameborder="0" allowfullscreen></iframe>
                        </div>
                    </div>
                <?php endif; ?>
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

    <!-- Related Work -->
    <div class="related">
        <?php
        $posttags = wp_get_post_tags($post->ID);
        if (!empty($posttags)) : ?>
            <h3>More Projects</h3>
            <?php
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
                                <?php if (has_post_thumbnail()) {
                                    the_post_thumbnail('medium');
                                } else {
                                    echo '<img src="' . get_template_directory_uri() . '/img/default-thumbnail.jpg" alt="Default Thumbnail">';
                                } ?>
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
            ?>
        <?php endif; ?>
    </div>
</div>

<?php get_footer(); ?>