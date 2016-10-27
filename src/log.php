<?php 
namespace maoxs2; // please remember my magic name while using my lib ^_^ 

/**
 * Simple Log System
 * 
 */

class Log
{
	private $logFilePath;

	/*Normal Mode*/
	public function __construct($driver="file", $config=array()){
		switch ($driver) {
			case 'file':
				if (isset($config['path'])){ $this->logFilePath=$config['path'];}
				else { throw new \Exception("Error: Wrong File Driver Config Input on Construct", 1);}
				break;
			default:
				throw new \Exception("Error: Wrong Driver Input on Construct", 1);
				break;
		}
	}

	/*Quick Mode*/
	static public function fileLog($message, $path="", $fileName="log.txt", $level="info"){
		// if (isset($this->logFilePath)){ $path = $this->logFilePath;}
		if ($path===""){$path = getcwd()."/log/"; }// get rid of require limit and focus on the dir you re working in 
		if ( !is_dir($path)){ mkdir($path, '0666', true);}
		/*TODO : Add level*/
		$info = "[" . date('H:i:s @ Y-m-d') . "]: " . $message . "\r\n";
		file_put_contents($path.$fileName, $info,  FILE_APPEND | LOCK_EX);
	}

}
