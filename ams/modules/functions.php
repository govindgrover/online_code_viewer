<?php
/**
  * Website:	http://www.grsoftware.in/
  * Contributions by	:
  *		Gopal Grover	(Developer)
  *		Govind Grover	()
  *
  * @author GR Software <developer@grsoftware.in>
  */

	require_once(__DIR__ . "/modules.php");	

    function getPhpScript($page = null, $ext = ".php") : string
    {
		return (
			(!is_null($page))
				? basename($page, $ext)
				: basename($_SERVER['PHP_SELF'], '.php')
		);
    }

    function getPageTitle($echo = false)
	{
		$title = "";
		
		switch(getPhpScript())
		{
			case 'index':
				$title = "Home | ";
				break;
			case "py":
				$title = "Python Codes | ";
				break;
			default:
				$title = "";
				break;
		}

		if ($echo)
			echo $title . SITE_NAME;
		else
			return $title . SITE_NAME;
	}

	function fetchFileContent($fileName, $whatFolder) : void {
		$code_folder = "_my_codes";
		$dir = dirname(dirname(__DIR__));

		switch($whatFolder) {
			case "py33":
				readfile($dir . "/" . $code_folder . "/python_3_3/" . $fileName);
				return;
			default:
				return;
		}
	}

	function putSpaceAfterCapitalAlphabet(string $string = null) : string {
		$capitalAlphabets = array(
			"A", "B", "C", "D"
			, "E", "F", "G", "H"
			, "I", "J", "K", "L"
			, "M", "N", "O", "P"
			, "Q", "R", "S", "T"
			, "U", "V", "W", "X"
			, "Y", "Z"
		);

		$formatted = null;

		for($f = 0; $f < strlen($string); $f++) {
			if(in_array($string[$f], $capitalAlphabets)) {
				$formatted .= " " . $string[$f];
			} else {
				$formatted .= $string[$f];
			}
		}

		return $formatted;
	}
