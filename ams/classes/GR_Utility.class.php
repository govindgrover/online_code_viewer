<?php
/**
 * Website:	http://www.grcoders.com/
			http://www.gopalgrover.com/
 * Contributions by	:
 *		Gopal Grover	(Developer)
 *
 * @author Gopal Grover (GR) <gg_gg05@hotmail.com>
 *							 <info@grcoders.com>
 */

namespace GRSOFTWARES\MODULE\GR_UTILITY;

class GR_Utility
{
	private $zlibEnabled;
	private $buffer;
	private $minPHPVersion;
	/**
	  * @author GR Software
	  * @function compress
	  *
	  */
	public function __consruct()
	{
		if (!$this->versionCheck())
			die("PHP Error. PHP Version reqiured: " . $this->getPHPVersionRequired());

		$this->setVaribles();
		$this->setErrorLogging();
		$this->setFunctions();

		$zlibVal = ini_get("zlib.output_compression");
		$zlibComLevel = ini_get("zlib.output_compression_level");

		if ($zlibVal == "On" && $zlibComLevel == "9")
		{
			$this->zlibEnabled = true;
			$this->buffer = "";
		}
		else
		{
			$this->zlibEnabled = false;
			$this->buffer = "";
		}
		
		$this->minPHPVersion = "7.3.1";
	}

	private function initBuffer($buff)
	{
		$this->buffer = $buff;
	}

	/**
	  * @author GR Software
	  * @function compress
	  *
	  */
	public function grCompress($buff)
	{
		$this->initBuffer($buff);

		if ($this->zlibEnabled)
			return $this->grUserCompress();
		else
		{
			if (function_exists("ob_gzhandler"))
				return $this->grUseLibrary() ?: $this->grUserCompress();
			else
				return $this->grUserCompress();
		}
	} // grCompress
	
	/**
	  * @author GR Software
	  * @function grUseLibrary
	  *
	  */
	private function grUseLibrary()
	{
		return ob_gzhandler($this->buffer, 6);
	} // grUseLibrary

	/**
	  * @author GR Software
	  * @function grUserCompress
	  *
	  */
	private function grUserCompress()
	{
		return $this->minify_html($this->buffer);
	} // grUserCompress

	private function getSystemPHPVersion()
	{
		return PHP_VERSION;
	}

	private function getPHPVersionRequired()
	{
		return $this->minPHPVersion;
	}

	private function versionCheck()
	{
		if (!function_exists("version_compare"))
			return false;

		if (version_compare($this->getSystemPHPVersion(), $this->getPHPVersionRequired()) < 0)
			return false;
		else
			return true;
	}

	private function setErrorLogging($val = false)
	{
		if (!defined(DEBUG))
			define("DEBUG", $val);

		if (DEBUG)
		{
			error_reporting(E_ALL);
			display_errors(true);
			log_errors(false);
		}
		else
		{
			error_reporting(E_ERROR | E_PARSE);
			display_errors(false);
			log_errors(true);
		}
	}

	private function setVaribles()
	{
		/**
		 * Setting PHP variable
		 */
		ini_set("zlib.output_compression", "On");
		ini_set("zlib.output_compression_level", "9");
		ini_set("max_execution_time", "90");
		ini_set("default_charset", "utf-8");
		ini_set("display_errors", "On");
		ini_set("max_input_time", "60");
		ini_set("max_input_vars", "1000");
		ini_set("memory_limit", "128M");
		ini_set("post_max_size", "8M");
		ini_set("session.gc_maxlifetime", "600");
		ini_set("upload_max_filesize", "2M");
		ini_set("log_errors", "1");
		ini_set("error_log", dirname(__DIR__) . "/logs/php-error.log");
	}

	private function setFunctions()
	{
		setlocale(LC_MONETARY, 'en_IN');
		date_default_timezone_set('Asia/Kolkata');
		mb_internal_encoding('UTF-8');
		mb_http_output('UTF-8');
		mb_http_input('UTF-8');
		mb_language('uni');
		mb_regex_encoding('UTF-8');
	}


	private function minify_html($input) {
		if(trim($input) === "") return $input;
		// Remove extra white-space(s) between HTML attribute(s)
		$input = preg_replace_callback('#<([^\/\s<>!]+)(?:\s+([^<>]*?)\s*|\s*)(\/?)>#s', function($matches) {
			return '<' . $matches[1] . preg_replace('#([^\s=]+)(\=([\'"]?)(.*?)\3)?(\s+|$)#s', ' $1$2', $matches[2]) . $matches[3] . '>';
		}, str_replace("\r", "", $input));
		// Minify inline CSS declaration(s)
		if(strpos($input, ' style=') !== false) {
			$input = preg_replace_callback('#<([^<]+?)\s+style=([\'"])(.*?)\2(?=[\/\s>])#s', function($matches) {
				return '<' . $matches[1] . ' style=' . $matches[2] . $this->minify_css($matches[3]) . $matches[2];
			}, $input);
		}
		if(strpos($input, '</style>') !== false) {
		  $input = preg_replace_callback('#<style(.*?)>(.*?)</style>#is', function($matches) {
			return '<style' . $matches[1] .'>'. $this->minify_css($matches[2]) . '</style>';
		  }, $input);
		}
		if(strpos($input, '</script>') !== false) {
		  $input = preg_replace_callback('#<script(.*?)>(.*?)</script>#is', function($matches) {
			return '<script' . $matches[1] .'>'. $this->minify_js($matches[2]) . '</script>';
		  }, $input);
		}

		return preg_replace(
			array(
				// t = text
				// o = tag open
				// c = tag close
				// Keep important white-space(s) after self-closing HTML tag(s)
				/* '#<(img|input)(>| .*?>)#s', */
				// Remove a line break and two or more white-space(s) between tag(s)
				'#(<!--.*?-->)|(>)(?:\n*|\s{2,})(<)|^\s*|\s*$#s',
				'#(<!--.*?-->)|(?<!\>)\s+(<\/.*?>)|(<[^\/]*?>)\s+(?!\<)#s', // t+c || o+t
				'#(<!--.*?-->)|(<[^\/]*?>)\s+(<[^\/]*?>)|(<\/.*?>)\s+(<\/.*?>)#s', // o+o || c+c
				'#(<!--.*?-->)|(<\/.*?>)\s+(\s)(?!\<)|(?<!\>)\s+(\s)(<[^\/]*?\/?>)|(<[^\/]*?\/?>)\s+(\s)(?!\<)#s', // c+t || t+o || o+t -- separated by long white-space(s)
				'#(<!--.*?-->)|(<[^\/]*?>)\s+(<\/.*?>)#s', // empty tag
				'#<(img|input)(>| .*?>)<\/\1>#s', // reset previous fix
				'#(&nbsp;)&nbsp;(?![<\s])#', // clean up ...
				'#(?<=\>)(&nbsp;)(?=\<)#', // --ibid
				// Remove HTML comment(s) except IE comment(s)
				'#\s*<!--(?!\[if\s).*?-->\s*|(?<!\>)\n+(?=\<[^!])#s'
			),
			array(
				// '<$1$2<$1>',
				'$1$2$3',
				'$1$2$3',
				'$1$2$3$4$5',
				'$1$2$3$4$5$6$7',
				'$1$2$3',
				'<$1$2',
				'$1 ',
				'$1',
				""
			),
		$input);
	}

	// CSS Minifier => http://ideone.com/Q5USEF + improvement(s)
	private function minify_css($input) {
		if(trim($input) === "") return $input;
		return preg_replace(
			array(
				// Remove comment(s)
				'#("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\')|\/\*(?!\!)(?>.*?\*\/)|^\s*|\s*$#s',
				// Remove unused white-space(s)
				'#("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\'|\/\*(?>.*?\*\/))|\s*+;\s*+(})\s*+|\s*+([*$~^|]?+=|[{};,>~+]|\s*+-(?![0-9\.])|!important\b)\s*+|([[(:])\s++|\s++([])])|\s++(:)\s*+(?!(?>[^{}"\']++|"(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\')*+{)|^\s++|\s++\z|(\s)\s+#si',
				// Replace `0(cm|em|ex|in|mm|pc|pt|px|vh|vw|%)` with `0`
				'#(?<=[\s:])(0)(cm|em|ex|in|mm|pc|pt|px|vh|vw|%)#si',
				// Replace `:0 0 0 0` with `:0`
				'#:(0\s+0|0\s+0\s+0\s+0)(?=[;\}]|\!important)#i',
				// Replace `background-position:0` with `background-position:0 0`
				'#(background-position):0(?=[;\}])#si',
				// Replace `0.6` with `.6`, but only when preceded by `:`, `,`, `-` or a white-space
				'#(?<=[\s:,\-])0+\.(\d+)#s',
				// Minify string value
				'#(\/\*(?>.*?\*\/))|(?<!content\:)([\'"])([a-z_][a-z0-9\-_]*?)\2(?=[\s\{\}\];,])#si',
				'#(\/\*(?>.*?\*\/))|(\burl\()([\'"])([^\s]+?)\3(\))#si',
				// Minify HEX color code
				'#(?<=[\s:,\-]\#)([a-f0-6]+)\1([a-f0-6]+)\2([a-f0-6]+)\3#i',
				// Replace `(border|outline):none` with `(border|outline):0`
				'#(?<=[\{;])(border|outline):none(?=[;\}\!])#',
				// Remove empty selector(s)
				'#(\/\*(?>.*?\*\/))|(^|[\{\}])(?:[^\s\{\}]+)\{\}#s'
			),
			array(
				'$1',
				'$1$2$3$4$5$6$7',
				'$1',
				':0',
				'$1:0 0',
				'.$1',
				'$1$3',
				'$1$2$4$5',
				'$1$2$3',
				'$1:0',
				'$1$2'
			),
		$input);
	}

	// JavaScript Minifier
	private function minify_js($input) {
		if(trim($input) === "") return $input;
		return preg_replace(
			array(
				// Remove comment(s)
				'#\s*("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\')\s*|\s*\/\*(?!\!|@cc_on)(?>[\s\S]*?\*\/)\s*|\s*(?<![\:\=])\/\/.*(?=[\n\r]|$)|^\s*|\s*$#',
				// Remove white-space(s) outside the string and regex
				'#("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\'|\/\*(?>.*?\*\/)|\/(?!\/)[^\n\r]*?\/(?=[\s.,;]|[gimuy]|$))|\s*([!%&*\(\)\-=+\[\]\{\}|;:,.<>?\/])\s*#s',
				// Remove the last semicolon
				'#;+\}#',
				// Minify object attribute(s) except JSON attribute(s). From `{'foo':'bar'}` to `{foo:'bar'}`
				'#([\{,])([\'])(\d+|[a-z_][a-z0-9_]*)\2(?=\:)#i',
				// --ibid. From `foo['bar']` to `foo.bar`
				'#([a-z0-9_\)\]])\[([\'"])([a-z_][a-z0-9_]*)\2\]#i'
			),
			array(
				'$1',
				'$1$2',
				'}',
				'$1$3',
				'$1.$3'
			),
		$input);
	}
}
