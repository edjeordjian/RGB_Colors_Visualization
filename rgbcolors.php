<HTML>

<HEAD>  
		<TITLE>  
			RGB Colors Visualization 
			
		</TITLE> 
		
</HEAD>

<BODY>
	
	<p>
	The human eye can percieve about 1 millon colors. However, Hex RGB system used on HTML can show exactly 6^15 = 16777216 different colors. Even if you were a tetrachromat, probably you would not be able to percieve the difference between all of them (because not all of them are variantions of red).
	</p>
	
	<p>
	That's why the result of this script does not show every RGB color, but only near 500000 colors (and also because the browser would hang by just trying to show about 100000 in the actual state of the script). Anyway, optimizing the script would probably not make any appreciable difference in the visualization. 
	</p>
	
	<p> 
	Do not expect a 'rainbow effect' on the visualization: black, grey and white 'variants' are beign shown, and remember that a matrix (2D object) is beign used to show a representative number of the colors available by Hex RGB (which is 3D, because every color is represented through 3 coordinates).
	</p>
	
	<TABLE style="display: inline-block;">
		<?php 
			ini_set('max_execution_time', 1800); /* 30 mins timeout */

			/* Used for correctly formating the RGB code of the color */
			function addZeroes($str){
				$zeroes = "";
				$RGBCodeLen = 6;
				
				for($i = 0; $i < ($RGBCodeLen - strlen($str)); $i++){
					$zeroes = $zeroes . "0";
				}
				
				return $zeroes;
			}
			
			function showColor($colorWid, $colorHei, $colorHexCode, $style, $description){
				echo '<TABLE WIDTH = ' . $colorWid . ' HEIGHT = ' .  $colorHei . 
					 ' BGCOLOR = "' . $colorHexCode . '"' .
					 ' style= "' . $style . '" >'. 
						"<TBODY>" . 
							"<TR>" .
								'<td valign="bottom"> ' .
									'<Font Color = "White" SIZE = "1"> ' .
										$description .
										"</font>" .
								"</td>". 
							"</TR>" .
						"</TBODY>" .
					 "</TABLE>";
			}

			$description = "";
			$lineLen = 16; /* Changing this number might get the visualization worse */
			$colorCount = 16777216; /* Increasing this number would cause colors repetition */
			$colorWid = "50";
			$colorHei = "50";
			$style = "float: left;";

			/* To avoid browser hanging... */
			$print = true;
			$printedcolors = 0;
			$nonPrintedcolors = 0;
			$lineStep = 512; /*"Step" for showing colors. Default: 512*/
			
			for ($i = 0; $i <= $colorCount; $i++) {
				$color = (string)dechex($i);
				/* The following format is mandatory for a correct visualization in HTML */
				$colorHexCode = "#" . addZeroes($color) . $color; 
				$description = $colorHexCode;
				
				if($printedcolors == $lineLen){
					$print = false;
					$printedcolors = 0;
					/*New line...*/
					showColor($colorWid, $colorHei, "#FFFFFF", " float: bottom; ", "");
				}
				
				if($nonPrintedcolors == $lineStep){
					$print = true;
					$nonPrintedcolors = 0;
				}
				
				if ($print) {
					showColor($colorWid, $colorHei, $colorHexCode, $style, $description);
					$printedcolors += 1;
				}
				
				else{
					$nonPrintedcolors += 1;
				}
			}
		?> 

	</TABLE>
	
</BODY>
	
</HTML>
