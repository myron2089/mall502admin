<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File; 
use Illuminate\Support\Facades\Cache; 

class LocalizationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        
        if ( request()->is( 'en', 'en/*' ) ) {
            Cache::pull( 'translations' );
            App::setLocale( 'en' );
            $this->langPath = resource_path( 'lang/en' );
         } elseif ( request()->is( 'es', 'es/*' ) ) {
            Cache::pull( 'translations' );
            App::setLocale( 'es' );
            $this->langPath = resource_path( 'lang/es' );
         }

         /*
         *
         *  Actualizar cuando se arregle lo de los lenguajes
         * 
         */
         App::setLocale( 'es' );
         $this->langPath = resource_path( 'lang/es' );
         //dd($this->langPath);
        
        Cache::rememberForever( 'translations', function () {
        return collect( File::allFiles( $this->langPath ) )->flatMap( function ( $file ) {
            return [
                $translation = $file->getBasename( '.php' ) => trans( $translation ),
            ];
        } )->toJson();
        } );
    }
}
