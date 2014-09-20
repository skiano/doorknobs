<?php
	
	// =================================
	// Image #1 of Too Many Door Knobs
	// =================================

	require_once("form_elements.php");
	
	class Doorknob extends Forms
	{
		public $boxes  = array();
		public $grid   = array();
		public $width  = 0;
		public $height = 0;

		function __construct($w="100",$h="100")
		{
			$this->width = $w;
			$this->height = $h;
			$this->pepareGrid();
			$this->pepareBoxes(400);
		}

		private function pepareGrid()
		{
			for($y=0;$y<$this->height;$y++)
			{
				for($x=0;$x<$this->width;$x++)
				{
					$this->grid["x".$x."y".$y] = array($x,$y);
				}
			}
		}

		private function pepareBoxes($max=5)
		{
			$go = True;
			while($go){
				$go = $this->drawSquare($max);
			}
		}

		private function isUsed($key)
		{
			if(array_key_exists($key,$this->grid)){
				return False;
			}
			else{
				return True;
			}
		}

		private function getShell($start, $size)
		{	
			$shell = array();
			$current = array();

			// get y line of the shell

			$x = $start[0] + $size;

			for ($i=0; $i < $size; $i++) 
			{ 
				$search = "x".$x."y".($start[1]+$i);

				if($this->isUsed($search)){
					return False;
				}
				else
				{
					array_push($shell,$search);
				}
			}

			// get X line of shell 
			// it is one longer to account 
			// for corner

			$y = $start[1] + $size;
			
			for ($i=0; $i <= $size; $i++) 
			{ 
				$search = "x".($start[0]+$i)."y".$y;
				
				if($this->isUsed($search))
				{
					return False;
				}
				else
				{
					array_push($shell,$search);
				}
			}

			$current = $this->grid[$shell[count($shell)-1]];
			
			foreach ($shell as $key) 
			{
				unset($this->grid[$key]);
			}

			return $current;
		}

		private function drawSquare($max = 24)
		{	
			if(count($this->grid)==0){
				return False;
			}

			$key = array_rand($this->grid);
			$pos = $this->grid[$key];
			$end_pos = $pos;
			
			unset($this->grid[$key]);

			$l = 1;

			while($l)
			{
				if($l >= $max)
				{
					$l = False;
				}

				$shell = $this->getShell($pos, $l);

				if($shell !== FALSE)
				{	
					$end_pos = $shell;
					$l ++;
				}
				else{
					$l = False;
				}

			}

			$box = array("start"=>$pos,"end"=>$end_pos);
			array_push($this->boxes,$box);

			return True;
		}

		public function testBoxes($scale = 10)
		{
			echo "<div class='test_grid' ";
				echo "style='";
				echo "width:".($this->width*$scale)."px;height:".($this->height*$scale)."px;' >";


			foreach ($this->boxes as $i=>$box) {
				$size = ($box["end"][1] - $box['start'][1] + 1) * $scale;
				$x = $box['start'][0] * $scale;
				$y = $box['start'][1] * $scale;

				echo "<div class='test_box' ";
				echo "style='top:".$y."px;left:".$x."px;";
				echo "width:".$size."px;height:".$size."px;";
				echo "'>".($size/$scale)."</div>";
			}

			echo "</div>";
		}

		public function paintGrid($scale = 12)
		{
			$box_html = "";

			foreach ($this->boxes as $i=>$box)
			{
				$units = $box["end"][1] - $box['start'][1] + 1;
				$size  = $units * $scale;
				$area  = $size * $size;
				$x     = $box['start'][0] * $scale;
				$y     = $box['start'][1] * $scale;

				if($units <= 9 && $units >= 4 && mt_rand(0,6)==0)
				{
					$content = $this->fillSelect($units);
				}
				else if($i%8==0 && $size > 70)
				{
					$content = $this->textArea($size,$size);
				}
				else if($i%5==0 && $size > 60)
				{
					$content = $this->fillButtons($units);
				}
				else if($units % 2 == 0)
				{
					// even
					if(mt_rand(0,2) == 0){
						$content = $this->toggleHorizontalStripes($units,"radio");
					}
					else{
						$content = $this->toggleVerticalStripes($units,"radio");
					}
				}
				else{
					// odd
					if(mt_rand(0,9) == 0){
						$content = $this->toggleVerticalStripes($units,"checkbox");
					}
					else{
						$content = $this->toggleHorizontalStripes($units,"checkbox");
					}
				}

				$grid_unit = '<div class="grid_unit" style="top:%dpx;left:%dpx;width:%dpx;height:%dpx;">%s</div>';
				$box_html .= sprintf($grid_unit,$y,$x,$size,$size,$content);
			}

			$w = $this->width * $scale;
			$h = $this->height * $scale;
			$container = '<div class="frame" style="width:%dpx;height:%dpx;">%s</div>';
			printf($container,$w,$h,$box_html);
		}

		protected function fillToggle($units,$type="checkbox")
		{
			$html = "";

			for ($i=0; $i<($units*$units); $i++) 
			{ 
				$html .= $this->toggle("",$type);
			}

			return($html);
		}

		protected function toggleHorizontalStripes($units,$type="checkbox")
		{
			$html = "";
			$state = "";

			for ($i=0; $i<($units*$units); $i++) 
			{ 
				if($i%$units==0)
				{
					$state = ($state == "" ? "checked" : ""); 
				}
				$html .= $this->toggle($state,$type);
			}

			return($html);
		}

		protected function toggleVerticalStripes($units,$type="checkbox")
		{
			$html = "";

			for ($i=0; $i<($units*$units); $i++) 
			{ 
				$state = "";
				if($i%2==0)
				{
					$state = "checked"; 
				}
				$html .= $this->toggle($state,$type);
			}

			return($html);
		}

		protected function fillButtons($units)
		{
			$extras = $units % 3;
			$button_count = floor($units/3);


			$html = "";

			for ($y=0; $y < $units; $y++) {
				$line = array();

				for ($x=0; $x < $button_count; $x++) 
				{
					array_push($line, $this->button());
				}
				for ($i=0; $i < $extras; $i++) 
				{ 
					array_push($line, $this->toggle("","radio"));
				}
				shuffle($line);
				$html .= implode("",$line);
			}


			return $html;
		}

		protected function fillSelect($units)
		{
			$button_count = $units * ($units - 2);
			$html_arr = array($this->select($units));
			$type = "radio";
			if(mt_rand(0,3)==0){
				$type = "checkbox";
			}

			for ($i=0; $i < $units - 2 ; $i++) 
			{ 
				$line = array();

				for ($x=0; $x < $units ; $x++) 
				{ 
					if($x%2==0)
					{
						array_push($line, $this->toggle("",$type));
					}
					else{
						array_push($line, $this->toggle("checked",$type));
					}
				}

				array_push($html_arr, implode("", $line) );
			}

			shuffle($html_arr);

			return implode("", $html_arr);
		}
	}


?>