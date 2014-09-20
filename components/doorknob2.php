<?php
	
	// =================================
	// Image #2 of Too Many Door Knobs
	// =================================

	require_once("form_elements.php");
	
	class Doorknob2 extends Forms
	{
		public $radius = 0;
		public $ringGrid = array();
		public $total = 0;

		function __construct($radius=240)
		{
			$this->radius = $radius;
			$this->prepareRings();
		}

		protected function prepareRings()
		{
			$this->total = floor($this->radius/12);
			for ($i=0; $i < $this->total; $i++) { 
				$ring = $this->makeRing($i);
				array_push($this->ringGrid, $ring);
			}
		}

		protected function makeRing($n)
		{
			$ring  = array(); 
			$unit  = 12;
			$r     = 12+(12*$n);
			$rad   = $unit/$r;
			$count = floor(2*pi()/$rad);

			// smoothing leftover space
			$extra = (2*pi()-($count*$rad))/$count;
			$rad   = $rad + $extra;
			$start = mt_rand(0,$count); 

			for ($i=$start; $i < ($count+$start); $i++) 
			{ 
				$x = $r*cos($i*$rad);
				$y = $r*sin($i*$rad);
				array_push($ring, array($x,$y));
			}
			return $ring;
		}

		public function paintRings()
		{
			$ringHtml = "";

			$patterns = array(
				array(1,1,1,1,0),
				array(0,0,1,0,0),
				array(1,0,1,0,0),
				array(1,1,1,0,0),
				array(1,1,1,1,0,0,0,0),
				array(0,0,1),
				array(1,0,1),
				array(1,1),
				array(1,1),
				array(0,0)
			);

			
			// $color = $patterns[0];
			
			foreach ($this->ringGrid as $ring) {

				$color = $patterns[array_rand($patterns)];

				foreach ($ring as $i=>$point) {
					$x = $point[0];
					$y = $point[1];
					$checked = "";
					if($color[$i % count($color)]==1)
					{
						$checked="checked";
					}
					$radio = $this->toggle($checked,"radio");
					$point = '<div class="point" style="top:%dpx;left:%dpx;">%s</div>';
					$ringHtml .= sprintf($point,($y+$this->radius-6),($x+$this->radius-6),$radio);
				}
			}
			
			$container = '<div class="ring_field" style="width:%dpx;height:%dpx;">%s</div>';
			printf($container,($this->radius*2),($this->radius*2),$ringHtml);
		}

		protected function isOutside($x,$y)
		{
			$center = $this->radius;
			$dist = pow(($x-$center),2)+pow(($y-$center),2) - pow($this->radius,2);
			
			if($dist > 0){
				return True;
			}
			else{
				return False;
			}
		}

		public function fillCorners()
		{
			$points = array();
			for($y = 0; $y<($this->radius*2-6); $y=$y+12 )
			{
				for($x = 0; $x<($this->radius*2-6); $x=$x+12 )
				{
					if($this->isOutside(($x+6),($y+6)))
					{
						array_push($points, array($x,$y));

						$checked="";
						$type="checkbox";

						if(($y/12)%2==0)
						{
							$checked="checked";
						}

						$radio = $this->toggle($checked,$type);
						$point = '<div class="point" style="z-index:-1;top:%dpx;left:%dpx;">%s</div>';
						printf($point,($y),($x),$radio);

					}
				}
			}



		}
		
	}


?>