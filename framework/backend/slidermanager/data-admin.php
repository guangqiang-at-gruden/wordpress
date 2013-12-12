<?php
class fSliderManagerSliderBasicObject {
	protected $sliderDataObject = null;
	protected $customOptions = null;
	public $transitions = null;
	
	public function __construct( $sliderDataObject = null ) {
		$this->customOptions = new fThemeOptionsStore();
		$this->addBasicSliderOptions();
		if ( $sliderDataObject != null )
			$this->setSliderDataObject( $sliderDataObject );
	}
	
	private function addBasicSliderOptions() {
		$slider_types = array( array('name' => 'Accordeon', 'value'=> 'Accordeon'),array('name'=>'Fly', 'value'=>'Fly'), array('name'=>'3d', 'value'=>'3D'),  array('name'=>'Cubes', 'value'=>'Cubes'), array('name'=>'Tabbed', 'value'=>'Tabbed'),array('name'=>'Logo Slider', 'value'=>'Logo'));
		$opt = $this->customOptions;
		$opt->startNamespace('slider_options', 'slider_options', 'Slider Options');
			$opt->startOption('Slider Type', '');
				$opt->addParameterNL('select', 'slider_type', 'fSliderManagerSliderAccordeon', ' Slider Type', $slider_types);
			$opt->startOption('Slider Options', '');
				$opt->addParameterNL('text', 'slider-width', '960', ' Slider Width in pixels'); $opt->addParameterNL('text', 'slider-height', '400', ' Slider Height in pixels');
				$opt->addParameter('check', 'slider-autoslide-enable', 1, ' enable Auto-Sliding with delay of ');
				$opt->addParameterNL('text', 'slider-autoslide-interval', '5000', ' milliseconds between each slide ');/// $opt->addParameterNL('text', 'slider-height', '400', ' Slider Height in pixels');
	
	}
	
	
	protected function addTransition( $name, $value ) {
		$this->transitions[ $name ] = $value;
	}
	
	public function setSliderDataObject( $name ) {	
		$sdm = new fSliderManagerDataManager();
		$data_object = $sdm->getSlider( $name );
		
		if( $data_object == null ) return false;
		
		$this->sliderDataObject = $data_object;
		
		
	}
	public function getOptions() { return $this->customOptions; }
	
	public function addSlide( fSliderManagerSlide $slide_to_add ) {
		$this->sliderDataObject->addSlide( $slide_to_add );
	}
	
	public function getSlides() {
		return $this->sliderDataObject->slides;
	}
	
	public function getSliderDataObject() {
		return $this->sliderDataObject;
	}
}

class fSLiderManagerSliderAccordeonObject extends  fSliderManagerSliderBasicObject {
	public function __construct(){
		parent::__construct();
		$this->addCustomSliderOptions();
	}
	private function addCustomSliderOptions() {
		$opt = $this->customOptions;
		$this->customOptions = $opt;
	}
}

class fSLiderManagerSliderLogoObject extends  fSliderManagerSliderBasicObject {
	public function __construct(){
		parent::__construct();
		$this->addCustomSliderOptions();
	}
	private function addCustomSliderOptions() {
		$opt = $this->customOptions;
		$opt->addParameterNL('text', 'slider_logo_elements_count', '5', ' the number of Logos displayed at once  ');/// $opt->addParameterNL('text', 'slider-height', '400', ' Slider Height in pixels');
		$opt->addParameterNL('text', 'slider_logo_elements_spacing', '50', ' the space between Logos in pixels ');
		$this->customOptions = $opt;
	}
}

class fSliderManagerSliderCubesObject extends fSliderManagerSliderBasicObject {
	public function __construct() {
		parent::__construct();
		$this->addCustomSliderOptions();
		
		
	}
	private function addCustomSliderOptions() {
		$opt = $this->customOptions;
		$opt->addParameterNL('text', 'slider_cubes_x_count', '6', ' the Number of Cubes horizontally ');
		
		$opt->addParameterNL('text', 'slider_cubes_y_count', '3', ' the Number of Cubes vertically ');
		$opt->addParameterNL('check', 'slider_show_arrows_outside', 1, ' move Slider Arrows outside of the Slider? ');
		$opt->addParameterNL('check', 'slider_show_grid', 0, ' Grid Effect ');
		$this->customOptions = $opt;
		
		$this->addTransition( 'Random Disapper', 'random');
		//$this->addTransition( 'Implode', 'implode');
		$this->addTransition( 'Run Away Right', 'runaway_right');
		$this->addTransition( 'Run Away Left', 'runaway_left');
		$this->addTransition( 'Fly Right Top', 'fly_right_top');
		$this->addTransition( 'Fly Left Bottom', 'fly_left_bottom');
		$this->addTransition( 'Fall Down', 'fall_down');
		$this->addTransition( 'Sin Wave', 'sin_wave');
		$this->addTransition( 'Disappear', 'disappear');
		$this->addTransition( 'Column Fall', 'column_fall');
		
		
	}
}

class fSliderManagerSliderFlyObject extends  fSliderManagerSliderBasicObject {
	public function __construct(){
		parent::__construct();
		$this->addCustomSliderOptions();
	}
	private function addCustomSliderOptions() {
		$opt = $this->customOptions;
		
		
		$this->customOptions = $opt;
		
		
		
		$this->addTransition( 'Fly Top', 'fly_top');
		$this->addTransition( 'Fly Right', 'fly_right');		
		$this->addTransition( 'Fly Bottom', 'fly_bottom');
		$this->addTransition( 'Fly Left', 'fly_left');
				
		$this->addTransition( 'Fly Top Left', 'fly_top fly_left');
		$this->addTransition( 'Fly Top Right', 'fly_top fly_right');
		$this->addTransition( 'Fly Bottom Right', 'fly_bottom fly_right');			
		$this->addTransition( 'Fly Bottom Left', 'fly_bottom fly_left');

		$this->addTransition( 'Static', 'none');			
	}
}

class fSLiderManagerSliderTabbedObject extends  fSliderManagerSliderBasicObject {
	public function __construct(){
		parent::__construct();
		$this->addCustomSliderOptions();
	}
	private function addCustomSliderOptions() {
		$opt = $this->customOptions;
		
		$this->customOptions = $opt;
	}
}

class fSLiderManagerSlider3DObject extends  fSliderManagerSliderBasicObject {
	public function __construct(){
		parent::__construct();
		$this->addCustomSliderOptions();
	}
	private function addCustomSliderOptions() {
		$opt = $this->customOptions;
		$opt->addParameterNL('check', 'slider-3d-shadow', 0, ' show shadow under each slide. Please note, that you have to add at least 6 slides to properly run this slider.');/// $opt->addParameterNL('text', 'slider-height', '400', ' Slider Height in pixels');
		$this->customOptions = $opt;
	}
}
?>