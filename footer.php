    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-3">
                    <div class="footer-item footer-item-1">
                        <?php dynamic_sidebar('footer-1-sidebar'); ?>
                    </div>
                </div>
                <div class="col-12 col-md-9">
                    <?php
                        $name_company=eld_get_setting('name_company', '');
                        $link_facebook=eld_get_setting('link_facebook', '');
                        $link_twitter=eld_get_setting('link_twitter', '');
                        $link_instagram=eld_get_setting('link_instagram', '');
                        $number_tel=eld_get_setting('number_tel', '');
                        $number_hotline=eld_get_setting('number_hotline', '');
                        $gmail_contact=eld_get_setting('gmail_contact', '');
                    ?>
                     <div class="company-name">
                        <h3 class="name">
                            <?php echo esc_html($name_company);?>
                        </h3>
                        <div class="row">
                            <div class="col-12 col-sm-8">
                                <div class="footer-item footer-item-2">
                                    <?php dynamic_sidebar('footer-2-sidebar'); ?>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="infor-contact">
                                    <h3>
                                        <?php echo esc_html('Tel: ','elanding'); echo '<span>'.esc_html($number_tel).'</span>';?> 
                                    </h3>
                                    <h3>
                                        <?php echo esc_html('Hotline: ','elanding'); echo '<span>'.esc_html($number_hotline).'</span>';?> 
                                    </h3>
                                    <h3>
                                        <?php echo esc_html('Email: ','elanding'); echo '<span>'.esc_html($gmail_contact).'</span>';?> 
                                    </h3>
                                </div>

                                <h3 class="connect-social">
                                    Kết nối với vannien
                                </h3>
                                <ul class="list-unstyled list-inline ccv-social">
                                    <li class="list-inline-item">
                                        <a href="<?php echo esc_url($link_facebook);?>">
                                            <i class="fa fa-facebook"></i>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="<?php echo esc_url($link_instagram);?>">
                                        <i class="fa fa-instagram"></i>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="<?php echo esc_url($link_twitter);?>">
                                        <i class="fa fa-twitter"></i>
                                        </a>
                                    </li>
                                </ul>
                                
                            </div>
                        </div>
 
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a href="#top" class="back_to_top"><img src="<?php echo get_template_directory_uri();?>/assets/images/back_to_top.png" alt="back to top"></a>

    <?php wp_footer();?>
</body>

</html>
