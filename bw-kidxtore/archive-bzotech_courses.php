<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package BzoTech-Framework
 */
get_header();
?>
<?php do_action('bzotech_before_main_content')?>

<div id="main-content" class="main-page-default">

    <div class="bzotech-container">
        
        <div class="bzotech-row">
            <?php bzotech_output_sidebar('left')?>
            <div class="<?php echo esc_attr(bzotech_get_main_class()); ?>">
               
                <div class="elbzotech-courses-wrap">
                    <?php if(have_posts()):
                        $dem=1;
                        ?>
                        <div class="js-content-main list-post-wrap bzotech-row">
                        
                            <?php while (have_posts()) :the_post();?>

                                <?php
                                $attr['dem'] =$dem;
                                echo '<div class="list-col-item list-3-item list-2-item-tablet list-2-item-mobile ">';
                                bzotech_get_template('course/item-course','',array('size' => '' ),true);
                                echo '</div>';
                                $dem = $dem+1;
                                ?>

                            <?php endwhile;?>

                        </div>
                        
                        <?php 
                        bzotech_paging_nav(); 
                        ?>

                    <?php else : ?>

                        <?php echo bzotech_get_template_post( 'content' , 'none' ); ?>

                    <?php endif;?>

                </div>
            </div>
        <?php bzotech_output_sidebar('right')?>
        </div>
    </div>
</div>
<?php do_action('bzotech_after_main_content')?>
<?php get_footer(); ?>
