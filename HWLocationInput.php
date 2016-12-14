<?php

use HWLI\HookRegistry;

/**
 * @see https://github.com/Hitchwiki/HWLocationInput-extension
 *
 * @defgroup HWLocationInput Hitchwiki Location Input
 * @codeCoverageIgnore
 */
class HWLocationInput {

  /**
   * @since 1.0
   */
  public static function initExtension() {

    define( 'HWLI_VERSION', '1.0.0' );

    $GLOBALS['wgHWLICount'] = 0;
    $GLOBALS['wgHWLocationInput_debug'] = 1; // Debug on/off

    // Register resource files
    $GLOBALS['wgResourceModules']['ext.HWLocationInput.leaflet'] = array(
      'localBasePath' => __DIR__ ,
      'remoteExtPath' => 'HWLocationInput',
      'scripts' => array(
        'modules/vendor/leaflet/dist/leaflet.js',
      ),
      'styles' => array(
        'modules/vendor/leaflet/dist/leaflet.css',
      )
    );
    $GLOBALS['wgResourceModules']['ext.HWLocationInput'] = array(
      'localBasePath' => __DIR__ ,
      'remoteExtPath' => 'HWLocationInput',
      'position' => 'bottom',
      'scripts' => array(
        'modules/js/ext.HWLocationInput.js'
      ),
      'dependencies' => array(
        'ext.pageforms.main',
        'ext.HWLocationInput.leaflet'
      )
    );

  }

  /**
   * @since 1.0
   */
  public static function onExtensionFunction() {

    if ( !defined( 'PF_VERSION' ) ) {
      die( '<b>Error:</b><a href="https://github.com/SemanticMediaWiki/HWLocationInput/">Hitchwiki Location Input</a> requires the <a href="https://www.mediawiki.org/wiki/Extension:PageForms">Page Forms</a> extension. Please install and activate this extension first.' );
    }

    if ( isset( $GLOBALS['wgPageFormsFormPrinter'] )) {
      $GLOBALS['wgPageFormsFormPrinter']->setInputTypeHook( 'HW_Location', '\HWLI\HWLocationInput::init', array() );
    }
  }

  /**
   * @since 1.0
   *
   * @param string $dependency
   *
   * @return string|null
   */
  public static function getVersion( $dependency = null ) {

    if ( $dependency === null && defined( 'HWLI_VERSION' ) ) {
      return HWLI_VERSION;
    }

    if ( $dependency === 'PageForms' && defined( 'PF_VERSION' ) ) {
      return PF_VERSION;
    }

    return null;
  }

  /**
   * @since 1.0
   *
   * @return boolean
   */
  public static function onResourceLoaderGetConfigVars( array &$vars ) {
    global $hwConfig;

    $varNames = array( // explicit list to avoid private tokens ending up in JS vars
      'mapbox_username',
      'mapbox_access_token',
      'mapbox_mapkey_streets',
      'mapbox_mapkey_satellite'
    );

    foreach ($varNames as $varName) {
      if (!isset($hwConfig['vendor'][$varName])) {
        // doesn't look like there's a better way to handle this case
        throw new Exception('vendor.' . $hwConfig['vendor'][$varName] . ' config option missing');
      }
      $vars[$varName] = $hwConfig['vendor'][$varName];
    }

    $vars['hwConfig'] = array(
      'vendor' => $vars
    );

    return true;
  }

}
