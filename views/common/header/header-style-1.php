<?php 
use ChengChivas\Frontend\LandingMenuWalker;
$classes = 'is-transparent-header';
?>
<div id="cheng-header" class="header-sticky">
    <div id="header" class="header <?php echo esc_attr($classes) ?>">
        <div class="header-main no-center menu-left">
            <div class="navbar navbar-expand-lg  header-content container">
                <div class="row flex-menu d-flex align-items-center">
                    <div class="col-12 col-md-4">
                        <div class="d-flex align-items-center">
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu_main" aria-controls="menu_main" aria-expanded="false" aria-label="Toggle navigation">
                                <i class="fa fa-bars" aria-hidden="true"></i>
                            </button>
                        </div>
                        <div class="brand__logo d-flex">
                            <?php
                            $custom_logo_id = get_theme_mod('custom_logo');
                            $logo = wp_get_attachment_image_src($custom_logo_id, 'full');

                            if (has_custom_logo()) : ?>
                                <a href="<?php echo esc_url(home_url('/')); ?>">
                                    <img src="<?php echo esc_url($logo[0]); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>">
                                </a>
                            <?php else : ?>
                                <a href="<?php echo esc_url(home_url('/')); ?>">
                                    <h1 class="text-logo"><?php echo esc_html(get_bloginfo('name')); ?></h1>
                                </a>
                            <?php endif; ?>
                            <span class="brand__text">
                                <span class="brand__name">
                                    <?php echo esc_html(get_bloginfo('name')); ?>
                                </span>
                                <span class="brand__tag">
                                    <?php echo esc_html(get_bloginfo('description')); ?>
                                </span>
                            </span>
                        </div>
                    </div>
                    <div class="header__center d-flex align-items-center col-12 col-md-8">
                        <div class="navbar-collapse collapse" id="menu_main">
                            <?php
                            if (has_nav_menu('primary')) {
                                wp_nav_menu([
                                    'theme_location' => 'primary',
                                    "container" => "",
                                    "container_class" => "header__primary_menu",
                                    'items_wrap' => '<ul id="primary-menu" class="%2$s navbar-nav mr-auto header-item list-unstyled main-menu" data-depth="main-menu">%3$s</ul>',
                                    'walker' => new LandingMenuWalker(),
                                ]);
                            }
                            ?>
                        </div>
                        <?php
                        if ( function_exists('pll_the_languages') ) {
                            $languages = pll_the_languages([
                                'raw' => 1
                            ]);
                            echo '<div class="language-switcher">';
                            foreach ($languages as $lang) {
                                if ($lang['current_lang']) {
                                    echo '<button class="language-current" type="button">';
                                    echo '<img src="'.esc_url($lang['flag']).'" alt="'.esc_attr($lang['name']).'">';
                                    echo '<span>'.strtoupper($lang['slug']).'</span>';
                                    echo '<i class="arrow"></i>';
                                    echo '</button>';
                                }
                            }
                            echo '<ul class="language-dropdown">';
                            foreach ($languages as $lang) {
                                if($lang['current_lang']) continue;

                                echo '<li>';
                                echo '<a href="'.esc_url($lang['url']).'">';
                                echo '<img src="'.esc_url($lang['flag']).'" alt="'.esc_attr($lang['name']).'">';
                                echo '<span>'.strtoupper($lang['slug']).'</span>';
                                echo '</a>';
                                echo '</li>';
                            }
                            echo '</ul>';
                            echo '</div>';
                        }
                        ?>                    
                    </div>
                </div> 
            </div> 
        </div>
    </div>
</div>
