/*
 * MadBoxr *
 *
 * DESCRIPTION: Allows lightbox (slimbox) effect in the images in your webpage, eventually using Flickr off-site images
 *
 * HISTORY:
 * version 0.5 (2007-09-09): by Daniele "MadMage" Calisi
 * version 0.6 (2008-01-06): by Daniele "MadMage" Calisi, added support for Flickr off-site images
 * version 0.7 (2008-01-13): by Daniele "MadMage" Calisi, added Slimbox Ex, that allows iframe content
 * 
 * NOTES: this plugin uses:
 * - slimbox, a lightbox clone that works with mootools,
 * - slimbox_ex, a slimbox clone that allows for iframe content, not only images
 * slimbox and slimbox_ex are under the MIT license (http://www.opensource.org/licenses/mit-license.php)
 *
 * INSTRUCTIONS:
 * see the plugin instruction on the resource page on the MODx site
 * or go to http://www.mindreamz.net/?q=51 for a detailed description and examples 
 */

switch ($modx->Event->name) {
	case "OnLoadWebDocument":
		$modx->regClientStartupScript('manager/media/script/mootools/mootools.js');
		if ($scriptToUse=="slimbox") {
			$modx->regClientCSS('assets/plugins/madboxr/slimbox/css/slimbox.css');
			$modx->regClientStartupScript('assets/plugins/madboxr/slimbox/js/slimbox.js');
		}
		else if ($scriptToUse=="slimbox_ex") {
			$modx->regClientCSS('assets/plugins/madboxr/slimbox_ex/styles/slimbox_ex.css');
			$modx->regClientStartupScript('assets/plugins/madboxr/slimbox_ex/scripts/slimbox_ex.js');
		}
		break;
		
	case "OnWebPagePrerender":
		$pattern = '~<a([^>]*)\shref="#madboxr([^"]*)"([^>]*)>'.
			'((?:[^<]|<(?!/?a[^>]*>)|(?R))+)'.
			'</a>~i';
		
		function replaceCallback($matches)
		{
			$a1 = $matches[1];
			if ($matches[2] != '') $matches[2] = substr($matches[2], 1);	// strips '?'
			$optslines = explode("&", html_entity_decode($matches[2]));
			$opts = array();
			foreach ($optslines as $optline) {
				$p = explode("=", $optline);
				$opts[$p[0]] = (isset($p[1]) ? $p[1] : "");
			}
			$a2 = $matches[3];
			$content = $matches[4];
			$rev = '';
			if (isset($opts['w'])) $rev .= 'width='.$opts['w'];
			if (isset($opts['h'])) $rev .= ($rev != '' ? ',' : '') . 'height='.$opts['h'];
			$mt = array();
			if (isset($opts['flickr'])) {
				$href = 'NO-IMAGE-FOUND-INSIDE-MADBOXR-FLICKR-LINK';
				if (preg_match('~<img[^>]*\ssrc="([^"]*)(_t|_o|_b|_m|_s).jpg"[^>]*>~i', $content, $mt)) {
					$href = $mt[1];
				}
				if ($opts['flickr'] != '') $href .= '_'.$opts['flickr'];
				$href .= '.jpg';
				$title = '';
				if (preg_match('~<img[^>]*\stitle="([^"]*)"[^>]*>~i', $content, $mt)) {
					$title = $mt[1];
				}
				return '<a'.$a1.' rel="lightbox" href="'.$href.'" title="'.$title.'" rev="'.$rev.'"'.$a2.'>'.$content.'</a>';
			}
			else {
				$title = '';
				if (preg_match('~<img[^>]*\stitle="([^"]*)"[^>]*>~i', $content, $mt)) {
					$title = $mt[1];
				}
				return '<a'.$a1.' rel="lightbox" href="'.$opts['url'].'" title="'.$title.'" rev="'.$rev.'"'.$a2.'>'.$content.'</a>';
			}
		}
		$modx->documentOutput = preg_replace_callback($pattern, 'replaceCallback', $modx->documentOutput);
		break;
			    
	default:	// stop here
		return; 
		break;	
}
