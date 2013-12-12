<?php

class FooterWiseguysMenu extends Walker_Nav_Menu {
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		if( $depth > 0 ) return;
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul>\n";
	}
	
	/**
	 * @see Walker::end_lvl()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int $depth Depth of page. Used for padding.
	 */
	public function end_lvl( &$output, $depth = 0, $args = array() ) {
		if( $depth > 0 ) return;
		$indent = str_repeat("\t", $depth);
		$output .= "$indent</ul>\n";
	}
	
	public function start_el( &$output, $item, $depth, $args){

    if( 0 != $depth ) return;
    
		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
		$class_names = ' class="' . esc_attr( $class_names ) . '"';

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= "\n\n" . '<li' . $id . $value . $class_names .' >';

		$attributes = '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';

		$item_output .= $args->link_before . strtoupper( apply_filters( 'the_title', $item->title, $item->ID ) ) . $args->link_after;

		$item_output .= '</a>';

		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, 0, $args )."\n";

  }

  public function end_el( &$output, $item, $depth ){
    if( 0 != $depth ) return;
    $output .= '</li>'."\n\n";
  }
}
