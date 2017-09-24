<?php 
	/**
	 * Класс для измерения времени выполнения скрипта или операций
	 */
	class Timer
	{
	    /**
	     * @var float время начала выполнения скрипта
	     */
	    private static $start = .0;

	    /**
	     * Начало выполнения
	     */
	    static function start()
	    {
	        self::$start = microtime(true);
	    }

	    /**
	     * Разница между текущей меткой времени и меткой self::$start
	     * @return float
	     */
	    static function finish()
	    {
	        return microtime(true) - self::$start;
	    }
	}


	Timer::start(); // время начала работы скрипта
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>Answer</title>
        <style type="text/css">
			body {
				background-image: url("./images/background.jpg");
				font-family: Verdana, Arial, Helvetica, sans-serif; /* Семейство шрифта */
			    color: #336; /* Цвет текста */
			    font-size: 150%;
			}

			p {
				color: #ff0000;
			}
		</style>
		<?php
        	$tmp = str_replace(',','.',$_GET["input_x"]);
        	$x = (int) $tmp;
        	$tmp = str_replace(',','.',$_GET["input_y"]);
        	$y = (float) $tmp;
        	$tmp = str_replace(',','.',$_GET["input_r"]);
        	$r = (float) $tmp;
        	$quarter = 0;
            if (isset($_GET["submit_form"])) {
                $flag;
                if ($x > 0) {
                    if ($y > 0.0) {                             // 1st quarter
                        $quarter = 1;
                        if ($x <= ($r / 2) && $y <= $r) {
                            $flag = true;
                        } else $flag = false;
                    } else if ($y <= $r - $x) {   				// 4th quarter
                        $quarter = 4;
                        $flag = true;
                    } else $flag = false;
                } else if ($y >= 0.0) {   						// 2nd quarter
                		$quarter = 2;                            
                        if ((pow($x, 2) + pow($y, 2)) < pow($r, 2)) {
                            $flag = true;
                        } else $flag = false;
                    } else {									// 3rd quarter
                    	$quarter = 3;
                    	$flag = false;                                                   
            		}
            }

            // extra check when x=0 or y = 0
            if (($x == 0 && $y <= $r) || ($y == 0.0 && $x <= $r)) {
                $flag = true;
            }
        ?>
    </head>

    <body>
    	<center>
	        <h2>Answer:</h2>
            <h3>
            	<?php echo "Point: x=".$x.", y=".$y." with r=".$r." ";?>
      			<p> 
      				<?php if ($flag == true) echo "is"; else echo "is not"; ?>
      			</p>
      			in region
          	</h3>
          	<h5>
          		<?php 
					date_default_timezone_set("Europe/Moscow");
	          		$time = time();
	          		if (date("I") == "0") $time = $time - 1*60*60; // если зимнее, то сделать летнее
	          		
	          		echo (date("l d F Y H:i:s T", $time)); // date and time output
          		?>
          	</h5>
          	<h5>
          		<?php 	
	          		echo "Worked for ".sprintf("%.7f" . " сек.", Timer::finish());
          		?>
          	</h5>
		</center>
    </body>
</html>