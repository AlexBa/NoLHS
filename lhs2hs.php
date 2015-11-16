#!/usr/bin/env php
<?php
    /**
     * Print a green success message to the console
     * @var string $message
     **/
     function success($message) 
     {
         echo "\033[0;32m" . $message . "\033[0m" . PHP_EOL;
     }

   /**
    * Print a red error message to the console
    * @var string $message
    **/
    function error($message) 
    {
        echo "\033[0;31m" . $message . "\033[0m" . PHP_EOL;
    }
    
   /**
    * Print a red error message to the console
    * @var string $inputFile
    * @var string $outputFile
    **/
    function convert($inputFile, $outputFile) 
    {
        $input = fopen($inputFile, "r");
        $output = fopen($outputFile, "w");
        
        if ($input && $output) {
            while (($line = fgets($input)) !== false) {
                if (!empty($line) && trim($line) != '') { 
	                if (strpos($line, '>') === 0) {
	                    $line = substr($line, 1);
	                } else if (strpos($line, '--') !== 0) {
	                    $line = '--' . $line;
	                } 
                }
                
                fwrite($output, $line); 
            }

            fclose($input);
            fclose($output);
            success('Succeeded to convert "'.$inputFile.'" to "'.$outputFile.'".');
        } else {
            error('Failed to convert "'.$inputFile.'" to "'.$outputFile.'".');
        }  
    }
    
    $argument1 = $argv[1];
    $argument2 = $argv[2];
    convert($argument1, $argument2);
?>
