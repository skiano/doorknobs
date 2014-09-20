<?php 
	
	// =================================
	// Basic Set of Form-making tools
	// =================================	

	class Forms
	{
		function __construct()
		{
			# code...
		}

		protected function toggle($state="",$type="checkbox")
		{
			if($state != ""){
				$state = "checked='checked'";
			}
			return "<input type='".$type."' ".$state." />";
		}

		protected function textArea($w,$h)
		{
			$patterns = array(
				"&#215; &#248; ",
				"&#175; _ - &ndash; &mdash; ",
				"&#183; &#184; &#180; ",
				"&#164; @ ",
				"/ O \\ ",
				"/ ^ \\ _ ",
				"; ( : ) ",
				" \\| # /|",
				"&#165; &#191; ",
				"&copy; &reg; "
			);

			$string="";
			$add = $patterns[array_rand($patterns)];

			for ($i=0; $i < 2000; $i++) { 

				if(mt_rand(0,60)==0)
				{
					// $string .= "too many door knobs! ";
					$string .= $patterns[array_rand($patterns)];
				}

				$string .= $add;
			}

			$text = '<textarea style="width:%dpx;height:%dpx;">%s</textarea>';
			return sprintf($text,$w,$h,$string);
		}

		protected function button()
		{
			$patterns = array(
				array("***","radio"),
				array("^^^^","checkbox"),
				array("&#186;&#186;&#186;","")
			);


			$string = $patterns[array_rand($patterns)];

			$button = '<button type="button" class="%s">%s</button>';
			return sprintf($button,$string[1],$string[0]);
		}

		protected function select($units)
		{
			$patterns = array(
				array("\\","/"),
				array(">","<"),
				array("$","%"),
				array(")","("),
				array("[","}","{","]")
			);
			
			$options = "";
			$txt = $patterns[array_rand($patterns)];

			for ($i=0; $i < mt_rand(5,180); $i++) {
				$char = $txt[$i % count($txt)]; 
				
				$option_html = "<option>%'".$char.$units."s</option>";
				$options .= sprintf($option_html,"");
			}

			$select = '<select>%s</select>';
			return sprintf($select,$options);
		}

		public function test(){
			for ($i=0; $i < 1000 ; $i++) {

				if ($i % 2 == 0){
					$type = "radio";
				}

				if ($i % 10 == 0){
					echo '<button type="button">!!!</button>';
				}


				else{
					$type = "checkbox";
				}

				if (mt_rand(0,1)==0) {
					echo $this->toggle("",$type);
				}
				else{
					echo $this->toggle("checked",$type);
				}
			}
		}

	}

?>