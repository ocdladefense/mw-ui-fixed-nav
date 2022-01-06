<?php

if(!defined("MEDIAWIKI")) die();


$dir = dirname( __FILE__ );

class UIFixedNav {

	const DRAWER_TEMPLATE = "fixed-nav.php";

	public static function SetupUIFixedNav(){
		global $wgHooks, $wgResourceModules, $wgOcdlaShowBooksOnlineDrawer, $wgScriptPath;
		
		
		$wgHooks["BeforePageDisplay"][] = "UIFixedNav::onBeforePageDisplay";
		
		$wgResourceModules["ext.uiFixedNav"] = array(
			"styles" => array(
				"css/fixed-nav.css",
			),
			"position" => "top",
			"remoteBasePath" => "extensions/UIFixedNav",
			"localBasePath" => "extensions/UIFixedNav"
		);
	}
	
	
	public static function onBeforePageDisplay(OutputPage &$out, Skin &$skin ) {

		global $wgOcdlaShowBooksOnlineDrawer, $wgOcdlaShowBooksOnlineNs, $wgScriptPath;
	
		$out->addModules("ext.uiFixedNav");

		$file = __DIR__."/templates/".self::DRAWER_TEMPLATE;

		ob_start();
	
		include $file;
		$template = ob_get_contents(); // get contents of buffer
		ob_end_clean();



		if(is_array($skin->customElements)){
			$skin->customElements = array(
				"fixedNav" => $template
			);
		} else {
			$skin->customElements = array(
				"fixedNav" => $template
			);
		}



		return true;
	}
}