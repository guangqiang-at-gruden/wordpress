<?php
fEnv::registerComponent( 'Heading', 'componentHeading');
class componentHeading extends  componentBasic {
    protected $options = array(


        'modulename' => array(  'id' =>'html_name',
                'description' => 'Heading',
                'type' => 'html_name'),
        
        'title' => array(  'id' => 'title',
                'description' => 'Heading',
                'type' => 'text',
                'default' => 'This is a heading'),
                
            
        'type' => array(  'id' => 'heading_type',
                'description' => 'Heading Type',
                'type' => 'select',
                'value' => 'section-heading',
                'select_values'=> array(
                      array('name'=>'Section Heading', 'value'=>'section-heading'),
                      array('name'=>'H1', 'value'=>'h1'),
                      array('name'=>'H2', 'value'=>'h2'),
                      array('name'=>'H3', 'value'=>'h3'),
                      array('name'=>'H4', 'value'=>'h4')
                ),
        ),
                
       

     );
     
    public function printComponent( $options ) {
        if( !isset( $options['heading_type'] ) )
            $options['heading_type'] = 'section-heading';
	
        $options['text_align'] = 'center';
        $heading_type = $options['heading_type'];
        $heading_text = $options['title'];

        if( 'section-heading' == $options['heading_type'] ){
            echo '<div class="sectionHeader row">';
            echo '<div class="sectionHeadingWrap">';
            echo '<span class="sectionHeading">';
            echo $heading_text;
            echo '</span>';
            echo '</div>';
            echo '</div>';
          }else{
            $style = ' style="text-align:'.$options['text_align'].';" ';
            echo '<div class="tb_module"><' . $heading_type . ' class="tb_heading" '.$style.'>' . $heading_text . '</' . $heading_type . '></div>';
        }
    }
}
?>