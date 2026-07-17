<?php
namespace ChengChivas;
class ElandingInit
{
    public static function get_services() 
    {
        return [
            Admin\LController::class,
            Admin\LCustomize::class,
            Elementor\ELElementor::class,
            Frontend\LandingMenuWalker::class,
            Frontend\PostType::class,
        ];
    }
    public static function st_services() 
    {
        foreach ( self::get_services() as $class ) {
        	if(class_exists($class)) {
		        $service = self::instant( $class );
		        if ( method_exists( $service, 'admin_controller_init' ) ) {
			        $service->admin_controller_init();
		        }
                if ( method_exists( $service, 'admin_customizer_init' ) ) {
			        $service->admin_customizer_init();
		        }
	        }
        }
    }
    private static function instant( $class )
    {
        $service = new $class();
        return $service;
    }
}