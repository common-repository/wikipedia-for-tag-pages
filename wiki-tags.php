<?php
/*
Plugin Name: Wikipedia for tag pages
Plugin URI: http://voxpublica.no
Description: Widget that displays articles from Wikipedia relevant to the tag on tag pages
Author: H&aring;var Skaugen
Version: 1.4
Author URI: http://havar.skaugen.name
*/
include 'functions.php';
 
class tagWiki extends WP_Widget
{

	function tagWiki()
	{
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'tagWiki', 'description' => 'Show relevant excerpts of wikipedia articles on tag pages' );

		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'tag-wiki' );

		/* Create the widget. */
		$this->WP_Widget( 'tag-wiki', 'Wikipedia for tag pages', $widget_ops, $control_ops );

	}
  
  	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags (if needed) and update the widget settings. */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['languages'] = strip_tags( $new_instance['languages'] );
		$instance['limit'] = strip_tags( $new_instance['limit'] );

		return $instance;
	}
 
	function form($instance)
	{
	/* Set up some default widget settings. */
	$defaults = array('languages' => 'no,nn,en', );
	$instance = wp_parse_args( (array) $instance, $defaults ); ?>

	<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
	</p>

	<p>
			<label for="<?php echo $this->get_field_id( 'languages' ); ?>">Prioritized comma seperated list of languages to query (example: no,nn,en):</label>
			<input id="<?php echo $this->get_field_id( 'languages' ); ?>" name="<?php echo $this->get_field_name( 'languages' ); ?>" value="<?php echo $instance['languages']; ?>" style="width:100%;" />
	</p>

	<p>
			<label for="<?php echo $this->get_field_id( 'limit' ); ?>">Number of results to show:</label>
			<input id="<?php echo $this->get_field_id( 'limit' ); ?>" name="<?php echo $this->get_field_name( 'limit' ); ?>" value="<?php echo $instance['limit']; ?>" style="width:100%;" />
	</p>
	<?php
	}
	


  function widget($args, $instance)
  {
	if(is_tag()) {
		$title = apply_filters('widget_title', $instance['title'] );
		$languages = array_reverse(explode(',', $instance['languages']));
		$limit = $instance['limit'];
		$count = 0;
		$xmls = array();
		foreach ($languages as $lang) {
			$temp = get_wiki($lang,$limit);
			if ($temp->Section->Item) {
				$xmls[$count] = $temp;
				$count++;
			}
		}
		$xml = lev_sort(strtolower(single_tag_title("", false)), $xmls);
		$counter =0;
		if($xml->Section->Item){
			echo $args['before_widget'];
			echo "<ul>";
			echo $args['before_title'] . $title . $args['after_title'];
				foreach($xml->Section->Item as $data => $value){
					echo "<li style=\"margin-top: 5px;\">";
					if(isset($value->Image[0]['source'])){
						echo "<div class=\"wikiimg\" style=\"float: left; margin-right: 5px;\"><a href='" . $value->Url . "'><img src='" . $value->Image[0]['source'] . "' /></a></div>";
					}
					echo "<a href='" . $value->Url . "'>" . $value->Text . "</a>";
					echo "<p><span id='wikipedia_widget_" . $counter++ . "'>" . $value->Description . "</span></p></li>";
				}
			echo "</ul>";
			echo $args['args_widget'];
		}
	}	
  } 
}
function init_widget(){
	register_widget('tagWiki');
}
add_action( 'widgets_init', 'init_widget', 100);
add_action( 'wp_enqueue_scripts', 'safely_add_stylesheet' );
    function safely_add_stylesheet() {
        wp_enqueue_style( 'prefix-style', plugins_url('/wikipedia-for-tag-pages/css/style.css', __FILE__) );
    }
?>