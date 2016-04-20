<?php
namespace app\components;

use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;

class Fn extends Component {

	public function GetLang ($key = "all") {
		$keys = ['en' => 'English', 'fr' => 'Français'];
	
		if(array_key_exists($key, $keys))
			return $keys[$key];
		elseif($key == 'all')
		return $keys;
		else
			'N/D';
	}
	
	public function GetYesNo ($key = "all") {
		$keys = [0 => 'No', 1 => 'Yes'];
	
		if(array_key_exists($key, $keys))
			return $keys[$key];
		elseif($key == 'all')
		return $keys;
		else
			'N/D';
	}
	
	public function GetAdminStatus ($key = "all") {
		$keys = [
			1 => 'Active',
			10 => 'Pending - E-mail validation',
			19 => 'Pending - Other',
			20 => 'Disabled - No more employee',
			21 => 'Disabled - Fraud',
			29 => 'Disabled - Other'
		];
	
		if(array_key_exists($key, $keys))
			return $keys[$key];
		elseif($key == 'all')
		return $keys;
		else
			'N/D';
	}

	public function GetClienteStatus ($key = "all") {
		$keys = [
			1 => 'Active',
			10 => 'Pending - E-mail validation',
			19 => 'Pending - Other',
			20 => 'Disabled - No more employee',
			21 => 'Disabled - Fraud',
			29 => 'Disabled - Other'
		];
	
		if(array_key_exists($key, $keys))
			return $keys[$key];
		elseif($key == 'all')
		return $keys;
		else
			'N/D';
	}
	public function GetAutoStatus ($key = "all") {
		$keys = [
			1 => 'Buy',
			10 => 'Pending',
			15 => 'Sold',
			20 => 'Disabled',
		];
	
		if(array_key_exists($key, $keys))
			return $keys[$key];
		elseif($key == 'all')
		return $keys;
		else
			'N/D';
	}
	
	function GetUploadedFiles($dirname)
	{
		$files = [];
		if(is_dir($dirname."/.")) {
			$dir = opendir($dirname."/.");
			while($item = readdir($dir)) {
				$file = $dirname."/".$item;
			
				if(is_file($file)) {
					$files[\Yii::$app->homeUrl.$file] = \Yii::$app->homeUrl.$file;
				}
			}
			closedir($dir);
		}
		return($files);
	}
	function DeleteUploadedFiles($filePath)
	{
		$filePath = \Yii::getAlias('@webroot').$filePath;
		//Fn::PrintVar(\Yii::getAlias('@webroot'), '\Yii::app->aliases');
		$errorMsg = '';
		
		if(!file_exists($filePath) ) {
			$errorMsg .= "Error: file not found: $filePath<br/>";
		}
		if(is_file($filePath)) {
			$errorMsg .= "Error: is not a file: $filePath<br/>";
		}
			
		if (@unlink($filePath) ) {
			$errorMsg .= "Error: unable to delete file: $filePath<br/>";
		}
		
		if(!empty($errorMsg)) {
			echo $errorMsg;
			//exit;
			return false;
		}
		else
			return true;
	}
	public function GetUploadedDir ($module = "all") {
		$keys = [
			'autos' 	=> 'files/autos',
			'clientes' 	=> 'files/autos',
		];
	
		if(array_key_exists($module, $keys))
			return $keys[$module];
		elseif($module == 'all')
			return $keys;
		else
			'N/D';
	}

	public function GetLogText ($module = null, $submodule = null, $msgKey = null ) {
		$modules = [
			'login'	=> [
				'pagina' => [
					'errorPwd' 				=> 'Wrong password',
					'errorUsername' 		=> 'Wrong username',
					'exito' 				=> 'Exito',
				],
				'cookie' => [
					'errorKey' 				=> 'Wrong cookie key',
					'success' 				=> 'Exito',
				],
			],
			'autos'	=> [
				'crear' => ['exito' 				=> 'Exito',],
				'actualizar' => [
					'exito' 				=> 'Exito',
				],
				'upload' => [
					'exito' 				=> 'Exito',
				],
				'borrar' => [
					'exito' 				=> 'Exito',
				],
			],
		];
	
		if(is_null($module))
			return $modules;
		elseif (is_null($submodule))
			return $modules[$module];
		elseif (is_null($msgKey))
			return $modules[$module][$submodule];
		else
			return $modules[$module][$submodule][$msgKey];
	}

	// ------------------------------
	// | OUTPUT	: Msg Manipulation  |
	// ------------------------------
	public function ShowMsgError($var)
	{
		echo '<div class="systemmsg"><div class="errormsg">';
	
		if(is_array($var))
		{
			foreach($var as $key => $value)
				echo '<p>'.$value.'</p>';
		}
		else
			echo '<p>'.$value.'</p>';
	
		echo '</div></div>';
	}
	
	public function ShowMsgSuccess($var)
	{
		echo '<div class="systemmsg"><div class="successmsg">';
	
		if(is_array($var))
		{
			foreach($var as $key => $value)
				echo '<p>'.$value.'</p>';
		}
		else
			echo '<p>'.$value.'</p>';
	
		echo '</div></div>';
	}
	
	public function ShowMsgNotice($var)
	{
		echo '<div class="systemmsg"><div class="noticemsg">';
	
		if(is_array($var))
		{
			foreach($var as $key => $value)
				echo '<p>'.$value.'</p>';
		}
		else
			echo '<p>'.$value.'</p>';
	
		echo '</div></div>';
	}
	
	public function ShowMsgNote($var)
	{
		echo '<div class="systemmsg"><div class="notemsg">';
	
		if(is_array($var))
		{
			foreach($var as $key => $value)
				echo '<p>'.$value.'</p>';
		}
		else
			echo '<p>'.$value.'</p>';
	
		echo '</div></div>';
	}
	
	public function ShowJsAlert($var)
	{
		echo '<script type="text/javascript">'.
				'alert( "Avertissement\n\n" ';
	
		if(is_array($var))
		{
			foreach($var as $key => $value)
				echo '+ '.
				'\''.strip_tags($value).'\''. " + \"\\n\"";
		}
		else
			echo '+ '.strip_tags($value);
	
		echo ');'.
				'</script>';
	}

	// ------------------------------
	// | DEBUG	: section/tools		|
	// ------------------------------
	public static function PrintVar($data, $varName = '', $tabContent = '', $isPopup = false)
	{
		$AddTabSpace = '&nbsp; &nbsp; &nbsp; &nbsp;';
		$output = '';

		if ( is_object($data) )
		{
			$className = get_class($data);
			echo "<b><span style='color: blue;'>OBJECT</span> &nbsp;&nbsp;<span style='color: #008800;'>".$varName."</span> &nbsp;&nbsp;<span style='color: #AA0000;'>".$className."</span></b><br>";
			$tabContent .= $AddTabSpace;
	
			if(false) {
				echo $tabContent."<b>METHODS</b> <br />";
				$classMethods = get_class_methods($data);
				foreach ( $classMethods as $method )
				{
					echo$tabContent.$method." <br/>";
				}
				echo '<br/>';
			}
			foreach ( $data as $propertyName => $propertyValue )
			{
				if ( is_array($propertyValue) )
				{
					echo$tabContent.$propertyName." = ";
					Fn::PrintVar($propertyValue,$propertyName, ($tabContent) );
				}
				elseif ( is_object($propertyValue))
				{
					echo$tabContent.$propertyName." = ";
					Fn::PrintVar($propertyValue,$propertyName, ($tabContent));
				}
				else {
					echo$tabContent.$propertyName." = ".$propertyValue." (".gettype($propertyValue).")<br/>";
				}
			}
		}
		elseif ( is_array($data) )
		{
			echo "<b>Array(".count($data).") &nbsp;&nbsp;<span style='color: #008800;'>".$varName."</span></b> <br/>";
			$tabContent .= $AddTabSpace;
	
			foreach ( (array) $data as $key => $value )
			{
				if ( is_array($value) )
				{
					echo$tabContent." <b>Array</b> [".$key."] = ";
					Fn::PrintVar($value,$key, ($tabContent) );
				}
				elseif ( is_object($value))
				{
					echo$tabContent." <b>Array</b> [".$key."] = ";
					Fn::PrintVar($value,$key, ($tabContent));
				}
				else {
					echo$tabContent.$key." = ".$value." (".gettype($value).")<br/>";
				}
			}
		}
		else {
			if($isPopup) {
				$output .= $varName." = ".$tabContent.$data." (".gettype($data).")";
				echo '<script language="javascript"> alert ( "'. str_replace('"', '\"', $output) .'\n" ); </script>';
			}
			else {
				$output .= "<b><span style='color: #008800;'>".$varName."</span></b> = ".$tabContent.$data." (".gettype($data).")<br />";
				echo $output;
			}
		}
			
	}
	
	public static function PrintVarFile($data, $tabCar = '')
	{
		if ( is_array($data) )
		{
			echo "$tabCar Array \n";
			$tabCar .= "   ";

			reset($data);
			foreach ( (array) $data as $key => $value )
			{
				if ( is_array($value) )
				{
					echo $tabCar." Array [".$key."] \n";
					Fn::PrintVar($value, ($tabCar.$tabCar) );
				}
				elseif ( is_object($value) )
				echo $tabCar." Object (".$key.") \n";
				else
					echo $tabCar."[".$key."] => ".$value." \n";
			}
		}
		else
			echo "$tabCar ".ucfirst(gettype($data))." => $data \n";
	}

	public static function GeneratePwd($str)
	{
		$str .= date("his");
		return $str;
	}
	
	//	|	DEBUG SETTINGS
	public static function RunDebug()
	{
		ini_set('error_reporting', E_ALL);
		ini_set('display_errors', 1);
	}
	
	// SORT ARRAY ASSOC
	public static function CreateFnSortBy($field)
	{
		$code = "return strnatcmp(\$a['".$field."'], \$b['".$field."']);";
		return create_function('$a,$b', $code);

		// This function call is like that
		// $myFnSortBy = CreateFnSortBy('my_column_name');
		// usort($arr_assoc, $myFnSortBy);
	}

	// Remove leading/ending white space from USER HTML FORM
	public static function TrimData($data)
	{
		if ( is_array($data) )
		{
			reset($data);
			foreach ( (array) $data as $key => $value )
			{
				$data[$key] = Fn::TrimData( $value );
			}
		}
		else
			$data = trim( $data );

		return $data;
	}

	// PREPARE DB for PHP
	public static function AddSlashesData($data, $isTrimable)
	{
		if ( is_array($data) )
		{
			reset($data);
			foreach ( (array) $data as $key => $value )
			{
				$data[$key] = AddSlashesData( $value, $isTrimable );
			}
		}
		elseif ( !is_numeric($data) && !is_null($data) && !is_object($data))
		{
			if($isTrimable)
				$data = trim($data);
			$data = addslashes( $data );
		}
		return $data;
	}

	// PREPARE PHP for DB
	public static function StripSlashesData($data, $isTrimable)
	{
		if ( is_array($data) )
		{
			reset($data);
			foreach ( (array) $data as $key => $value )
			{
				$data[$key] = Fn::StripSlashesData( $value, $isTrimable );
			}
		}
		elseif ( !is_numeric($data) && !is_null($data) && !is_object($data))
		{
			if($isTrimable)
				$data = trim($data);
			$data = stripslashes( $data );
		}
		return $data;
	}

	// PREPARE PHP for DB
	public static function UTF8EncodeData($data, $isTrimable, $slashesAction = 'none|add|strip')
	{
		if ( is_array($data) )
		{
			reset($data);
			foreach ( (array) $data as $key => $value )
			{
				$data[$key] = Fn::UTF8EncodeData( $value, $isTrimable, $slashesAction );
			}
		}
		elseif ( is_string($data) )
		{
			if($isTrimable)
				$data = trim( $data );
			if($slashesAction == 'add')
				$data = addslashes( $data );
			elseif($slashesAction == 'strip')
			$data = stripslashes( $data );
			$data = utf8_encode($data);
		}

		return $data;
	}

	// PREPARE PHP for DB
	public static function UTF8DecodeData($data, $isTrimable, $slashesAction = 'none|add|strip')
	{
		if ( is_array($data) )
		{
			reset($data);
			foreach ( (array) $data as $key => $value )
			{
				$data[$key] = Fn::UTF8DecodeData( $value, $isTrimable, $slashesAction );
			}
		}
		elseif ( is_string($data) )
		{
			if($isTrimable)
				$data = trim( $data );
			if($slashesAction == 'add')
				$data = addslashes( $data );
			elseif($slashesAction == 'strip')
			$data = stripslashes( $data );
			$data = utf8_decode($data);
		}

		return $data;
	}

	// Check USER input data length for DB insertion
	public static function ValidInputLength($str, $length, $lengthType = 'min | is | max')
	{
		if($lengthType == 'min' && strlen($str) >= $length)
			return true;
		elseif($lengthType == 'is' && strlen($str) == $length)
		return true;
		elseif($lengthType == 'max' && strlen($str) <= $length)
		return true;
		else
			return false;
	}

	// Check if USER submit any data
	public static function ValidUserInput($str, $minLength = null, $maxLength = null)
	{
		if(strlen($str) >= $minLength && strlen($str) <= $maxLength)
			return true;
		else
			return false;
	}

	// Check if USER submit a requested number
	public static function ValidUserInputNumber($n, $min, $max)
	{
		$n = intval($n);
		if(is_numeric($n) && $n >= $min && $n <= $max)
			return true;
		else
			return false;
	}

	// Check if USER submit a requested number
	public static function ValidCurrencyFormat($amount)
	{
		if( preg_match("/^[+-]?[0-9]*\.?[0-9]+$/", $amount ) )
			return true;
		else
			return false;
	}

	// Check if USER submit a requested number
	public static function FormatCurrency($amount, $currencyCode = 'can')
	{
		$thousandSep = " ";
		if( $countryCode == 'usd')
			$thousandSep = ",";

		if( empty($amount) || is_null($amount))
			return "0.00";
		else
			return number_format($amount, 2, '.', $thousandSep);
	}

	// Check if USER submit a valid E-mail
	public static function ValidEmail($email)
	{
		if( !preg_match('/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i', $email ) )
			return false;
		else
			return true;
	}

	// Check if USER submit a valid phone number
	public static function ValidPhone($phone)
	{
		// (xxx)xxx-xxxx = preg_match('/\(?\d{3}\)?[-\s.]?\d{3}[-\s.]\d{4}/x', $phone)
		// xxx-xxx-xxxx = preg_match('/\d{3}[-]\d{3}[-]\d{4}/x', $phone)
		//if ( preg_match('/\d{3}[-]\d{3}[-]\d{4}\b', $phone) )'\(?[0-9]{3}\)?[-. ]?[0-9]{3}[-. ]?[0-9]{4}'
		if ( preg_match('/\d{3}[-]\d{3}[-]\d{4}$/', $phone) )
			return true;
		else
			return false;
	}

	// Check if IP Address is an IPv4
	public static function ValideIP($ip)
	{
		$ip = "198.168.1.78";
		if (preg_match('/^(([1-9]?[0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5]).){3}([1-9]?[0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])$/',$ip))
			return true;
		else
			return false;
	}

	// ------------------------------
	//	|	DATE Manipulation		|
	// ------------------------------
	// Check if datetime is comatible to MySQL
	public static function ValidDateTime($dateTime)
	{
		if ( preg_match('/\d{4}[-]\d{2}[-]\d{2}[ ]\d{2}[:]\d{2}/x', $dateTime))
			return true;
		else
			return false;
	}

	public static function ValidDateBasic($date)
	{
		if ( preg_match('/\d{4}[-]\d{2}[-]\d{2}$/', $date))
			return true;
		else
			return false;
	}

	public static function ValidTime($time, $isFormat24h = true)
	{
		if($isFormat24h)
			$exp = '/^(0[0-9]|1[0-2]|2[0-3]):([0-5][0-9])$/';
		else
			$exp = '/^(0[1-9]|1[0-2]):([0-5][0-9])([AaPp][Mm])$/';

		if (preg_match($exp, $time))
			return true;
		else
			return false;
	}

	public static function GetDate($precisionCode = 'all')
	{
		if($precisionCode == 'all')
			return date("Y-m-d");
		elseif($precisionCode == 'y')
			return date("Y");
		elseif($precisionCode == 'm')
			return date("m");
		elseif($precisionCode == 'd')
			return date("d");
		elseif($precisionCode == '1970-01-01')
			return "N/D";
		elseif($precisionCode == 'none')
			return "1970-01-01";
		else
			return $precisionCode;
	}
	
	public static function GetDateTime($precisionCode = 'ms')
	{
		if($precisionCode == 'min')
			return date("Y-m-d H:i");
		else
			return date("Y-m-d H:i:s");
	}

	public static function GetDateFromDateTime( $dbDateTime )
	{
		$dateFull 	= explode(" ", $dbDateTime);

		if(count($dateFull) )
			return $dateFull[0];
		else
			return "0000-00-00";
	}

	public static function GetTimeFromDateTime( $dbDateTime )
	{
		$dateFull 	= explode(" ", $dbDateTime);
		$dateH 		= explode(":", $dateFull[1]);

		if(count($dateH) )
			return $dateH[0].':'.$dateH[1];
		else
			return "00:00";
	}

	public static function DateCompare($dateStart, $dateEnd)
	{
		$dateStart = strtotime($dateStart);
		$dateEnd = strtotime($dateEnd);

		if ($dateStart < $dateEnd)
			return -1;
		elseif ($dateStart == $dateEnd)
		return 0;
		else
			return 1;
	}

	public static function MakeDateTimeFromDB( $dbDate )
	{
		$dateFull 	= explode(" ", $dbDate);
		$dateD 		= explode("-", $dateFull[0]);
		$dateH 		= explode(":", $dateFull[1]);

		$makeTime	= $dateD[0].'-'.$dateD[1].'-'.$dateD[2].' à  '.$dateH[0].':'.$dateH[1];

		return $makeTime;
	}

	public static function MakeDateFromDB( $dbDate )
	{
		$dateFull 	= explode(" ", $dbDate);
		$dateD 		= explode("-", $dateFull[0]);

		// Check if TIME is present inside the date string
		if(count($dateFull) == 2)
			$dateH 		= explode(":", $dateFull[1]);
		else
			$dateH 		= array(0,0,0);

		$dateD[0] = intval($dateD[0]);
		$dateD[1] = intval($dateD[1]);
		$dateD[2] = intval($dateD[2]);

		$dateH[0] = intval($dateH[0]);
		$dateH[1] = intval($dateH[1]);
		$dateH[2] = intval($dateH[2]);

		$makeTime	= mktime($dateH[0], $dateH[1], $dateH[2], $dateD[1], $dateD[2], $dateD[0]);

		return $makeTime;
	}

	public static function GetDateFullReadable ($dbDate, $addHour = false)
	{
		$configFn = Array();
		$configFn['days'] = array('Dimanche','Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi');
		$configFn['months'] = array(1 => 'Janvier',2 => 'Février', 3 => 'MArs', 4 => 'Avril', 5 => 'Mai', 6 => 'Juin', 7 => 'Juillet', 8 => 'Août',9  => 'Septembre', 10 => 'Octobre', 11 => 'Novembre', 12 => 'Décembre');

		if($dbDate == '0000-00-00 00:00:00')
			return 'N/D';

		$makeTime = Fn::MakeDateFromDB( $dbDate );

		if( $addHour )
		{
			$dateTmp = date("w j n Y H i", $makeTime);
			$dateArr = explode(" ", $dateTmp);
			$dateStr = $configFn['days'][$dateArr[0]] . ', ' . $dateArr[1] . ' ' . $configFn['months'][$dateArr[2]] . ' ' . $dateArr[3] . ' Ã  ' . $dateArr[4] . ':' . $dateArr[5];
		}
		else
		{
			$dateTmp = date("w j n Y", $makeTime);
			$dateArr = explode(" ", $dateTmp);
			$dateStr = $configFn['days'][$dateArr[0]] . ', ' . $dateArr[1] . ' ' . $configFn['months'][$dateArr[2]] . ' ' . $dateArr[3];
		}
		return $dateStr;
	}

	public static function GetTimeDiff ( $secStart, $secEnd = false)
	{
		if ($secEnd == false) 						// set default time to now
			$secEnd = time();

		$diff = $secEnd - $secStart;
		$timeDiff = array();

		$timeDiff['d'] = floor ( $diff / 86400 ); 	// (60s * 60m * 24h = 86400s = 1 day)
		$diff = $diff - ($timeDiff['d'] * 86400); 	// subtract the days from remaining time

		$timeDiff['h'] = floor ( $diff / 3600 ); 	// calculate the hours
		$diff = $diff - ($timeDiff['h'] * 3600); 	// subtract the hours from remaining time

		$timeDiff['m'] = floor ( $diff / 60 ); 		// calculate the minutes
		$diff = $diff - ($timeDiff['m'] * 60); 		// subtract the mins from remaining time

		$timeDiff['s'] = $diff; 					// what's left is the seconds from remaining time;

		return $timeDiff;
	}

	public static function Getmicrotime()
	{
		list($usec, $sec) = explode(" ",microtime());
		return ((float)$usec + (float)$sec);
	}

	public static function RedirectURL($url)
	{
		header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date dans le passÃ©
		header("Pragma: no-cache"); // HTTP/1.1
		header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
		header('Location: '.$url);
		exit;
	}

	public static function GetStringPreview($str, $strMaxLength)
	{
		if(strlen($str) > $strMaxLength)
			$str = substr($str, 0, ($strMaxLength - 3)).'...';

		return $str;
	}

	public static function GetSearchResultNav($urlQueryString, $numResult, $numResultLimit, $startIndex, $navTitle = null)
	{
		$txt = array();
		if(is_null($navTitle))
			$navTitle = $txt['lblResults'];

		$str ='<p>';
		//$urlQueryString = urlencode($urlQueryString);

		// SET current page
		if($startIndex < $numResultLimit)
			$currentPage = 1;
		else
		{
			$currentPage = intval(($startIndex + 1) / $numResultLimit);

			if(($startIndex + 1) % $numResultLimit > 0)
				$currentPage++;
		}

		// SET number of page
		if($numResult <= $numResultLimit)
			$numPage = 1;
		else
		{
			$numPage = intval($numResult / $numResultLimit);

			if($numResult % $numResultLimit > 0)
				$numPage++;
		}

		// SET result Range
		$str .= $navTitle.': <b>'.($startIndex + 1).' '.$txt['lblTo'].' '.($startIndex + $numResultLimit).'</b> &nbsp; ';

		// SET/UNSET previous page link
		if($currentPage == 1)
			$str .= $txt['lblPage'].' ';
		else
			$str .= '<a href="'.$urlQueryString.'&startIndex='.($startIndex - $numResultLimit).'" class="search_nav_prev">< '.$txt['lblPrevious'].'</a> ';

		// SET page ID Link
		for($i = 1; $i <= $numPage; $i++)
		{
			if($i == $currentPage)
				$str .= '<a href="#" class="search_nav_page_sel">'.$i.'</a>';
			else
				$str .= '<a href="'.$urlQueryString.'&startIndex='.(($i - 1) * $numResultLimit).'" class="search_nav_pages">'.$i.'</a> ';
		}

		// SET/UNSET next page link
		if($currentPage < $numPage)
			$str .= '<a href="'.$urlQueryString.'&startIndex='.($startIndex + $numResultLimit).'" class="search_nav_next">'.$txt['lblNext'].' ></a>';

		$str .= '</p>';
		return $str;
	}

	public static function GetSearchStartIndex($numResult, $numResultLimit, $startIndex)
	{
		if($startIndex >= $numResult)
		{
			$startIndex = $startIndex - $numResultLimit;
		}

		return $startIndex;
	}
}
?>