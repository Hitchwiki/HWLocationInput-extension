<?php

use HWLI\HookRegistry;

/**
 * @see https://github.com/SemanticMediaWiki/HWLocationInput/
 *
 * @defgroup HWLocationInput Semantic Forms Select
 * @codeCoverageIgnore
 */
class HWLocationInput {

	/**
	 * @since 1.0
	 */
	public static function initExtension() {

		define( 'HWLI_VERSION', '1.0.0' );

		// Api modules
		$GLOBALS['wgAPIModules']['sformsselect'] = 'HWLI\ApiHWLocationInput';

		$GLOBALS['wgScriptSelectCount'] = 0;
		$GLOBALS['wgHWLocationInput_debug'] = 0; // Debug on/off

		// Register resource files
		$GLOBALS['wgResourceModules']['ext.HWLocationInput'] = array(
			'localBasePath' => __DIR__ ,
			'remoteExtPath' => 'HWLocationInput',
			'position' => 'bottom',
			'scripts' => array(
				'modules/js/ext.HWLocationInput.js'
			),
			'dependencies' => array(
				'ext.pageforms.main'
			)
		);
	}

	/**
	 * @since 1.0
	 */
	public static function onExtensionFunction() {

		if ( !defined( 'PF_VERSION' ) ) {
			die( '<b>Error:</b><a href="https://github.com/SemanticMediaWiki/HWLocationInput/">Semantic Forms Select</a> requires the <a href="https://www.mediawiki.org/wiki/Extension:PageForms">Page Forms</a> extension. Please install and activate this extension first.' );
		}

		if ( isset( $GLOBALS['wgPageFormsFormPrinter'] )) {
			$GLOBALS['wgPageFormsFormPrinter']->setInputTypeHook( 'SF_Select', '\HWLI\HWLocationInput::init', array() );
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

}
