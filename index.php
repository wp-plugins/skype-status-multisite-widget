<?php
/*
Plugin Name: Skype Status Multisite  Widget
Plugin URI: http://wolftheme.com/
Description: The new Microsoft Live accounts (using "live:", "@hotmail.com" or "@live.com" in the Skype ID) are not supported due to lack of willingness by Microsoft to fix a parse error bug on the Skype online status server.
Version: 1.0.0
Author: WolfTheme
Author URI: http://wolftheme.com/
License: GPLv2 or later
*/
class wt_skype_Widget extends WP_Widget {
	function __construct() {
		parent::__construct(
			'wt_skype_widget', // Base ID
			__('WT Skype', 'wtskype'), // Name
			array( 'description' => __( 'Skype status', 'wtskype' ), ) // Args
		);
	}
	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );
       $skypeuser=$instance['skypeuser'];
       if(!$skypeuser){
            $skypeuser=__("nhatrang-art", 'wtskype');
       }
        if(!$title){
            $title=__("Skype Status", 'wtskype');
        }
        $action = $instance[ 'action' ];
        $style = $instance[ 'style' ];
        $auto = $instance[ 'auto' ];
        
        echo $args['before_widget'];
        echo $args['before_title'].$title.$args['after_title'];
?>
        <div class="wt-skype-widget">
            <style type="text/css">
                .wt-skype-widget tbody {
                    border: none;
                }
            </style>
        
            <?php if($action==""){?>
                <table style="width:auto;border: none;">
                    <tr>
                      <th><img style="vertical-align: middle;"  src="http://mystatus.skype.com/<?php echo $style ?>/<?php echo $skypeuser ?>" /></th>
                      <th style="padding-left: 10px;"><?php echo $auto ?></th>		
                    </tr>
                </table>
           <?php }else{ ?>
                <div class="wt-skype-widget">
                    <a href="Skype:<?php echo $skypeuser ?>?<?php echo $action; ?>"><img style="vertical-align: middle;"  src="http://mystatus.skype.com/<?php echo $style ?>/<?php echo $skypeuser ?>" /></a>
                    <span><a href="Skype:<?php echo $skypeuser ?>?<?php echo $action; ?>"><?php echo $auto ?></a></span>
                </div>

          <?php } ?>
        </div>
<?php
		echo $args['after_widget'];
	}

	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __("Skype Status", 'wtskype');
		}
        if ( isset( $instance[ 'skypeuser' ] ) ) {
			$skypeuser = $instance[ 'skypeuser' ];
		}
		else {
			$skypeuser=__("nhatrang-art", 'wtskype');
		}
        $action = $instance[ 'action' ];
        $style = $instance[ 'style' ];
        $auto = $instance[ 'auto' ];

		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php echo __( 'Title',"wtskype" ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
        <p>
		<label style="font-weight: bold;"><?php echo __( 'Update Your Skype Setting',"wtskype" ); ?></label><br /> 
        <span style="font-weight: bold; font-style: italic; opacity: 0.7"> <?php __("Tools -&gt; Options -&gt; Privacy Settings","wtskype") ?></span>
		  <img src="<?php echo plugins_url() ?>/wt-skype-status-widget/skype.jpg" />
		</p>
        <div class="wt_skype_container">
            <p>
    		<label for="<?php echo $this->get_field_id( 'skypeuser' ); ?>"><?php echo __( 'Enter Your Skype Name',"wtskype" ); ?></label> 
    		<input class="widefat skype-user" id="<?php echo $this->get_field_id( 'skypeuser' ); ?>" name="<?php echo $this->get_field_name( 'skypeuser' ); ?>" type="text" value="<?php echo esc_attr( $skypeuser ); ?>">
    		</p>
            <p>
    		<label for="<?php echo $this->get_field_id( 'auto' ); ?>"><?php echo __( 'Add Custom Text',"wtskype" ); ?></label> 
    		<input class="widefat" id="<?php echo $this->get_field_id( 'auto' ); ?>" name="<?php echo $this->get_field_name( 'auto' ); ?>" type="text" value="<?php echo esc_attr( $auto ); ?>">
    		</p>
        </div>
        <input class="wt_count_skype" value="1" name="wt_count_skype" type="hidden" />
        <!--<p><a class="wt_skype_add" href="#">Add</a> | <a class="wt_skype_del" href="#">Delete</a></p>-->
        <p>
		<label for="<?php echo $this->get_field_id( 'action' ); ?>"><?php echo __( 'Action',"wtskype" ); ?></label>
        <select name="<?php echo $this->get_field_name( 'action' ); ?>" class="action" style="width: 100%;">
            <option value=""><?php echo __("Empty, No action","wtskype") ?></option>
            <option <?php if(esc_attr( $action )=="call"){echo 'selected="selected"';} ?> value="call"><?php echo __("Call to user","wtskype") ?></option>
            <option <?php if(esc_attr( $action )=="chat"){echo 'selected="selected"';} ?> value="chat"><?php echo __("Open chat window","wtskype") ?></option>
            <option <?php if(esc_attr( $action )=="add"){echo 'selected="selected"';} ?> value="add"><?php echo __("Add to skype","wtskype") ?></option>
            <option <?php if(esc_attr( $action )=="userinfo"){echo 'selected="selected"';} ?> value="userinfo"><?php echo __("Open user profile","wtskype") ?> </option>
            <option <?php if(esc_attr( $action )=="voicemail"){echo 'selected="selected"';} ?> value="voicemail"><?php echo __("Leave voicemail","wtskype") ?></option>
            <option <?php if(esc_attr( $action )=="sendfile"){echo 'selected="selected"';} ?> value="sendfile"><?php echo __("Send file to user","wtskype") ?></option>
        </select> 
		</p>
        <p>
		<label for="<?php echo $this->get_field_id( 'style' ); ?>"><?php echo __( 'Style skype',"wtskype" ); ?></label>
        <select name="<?php echo $this->get_field_name( 'style' ); ?>" class="skype_style" style="width: 100%;" >
            <option <?php if($style=="balloon"){echo 'selected="selected"';} ?> value="balloon"><?php echo __("Balloon style","wtskype") ?> </option>
            <option <?php if($style=="bigclassic"){echo 'selected="selected"';} ?> value="bigclassic"><?php echo __("Big Classic Style","wtskype") ?> </option>
            <option <?php if($style=="smallclassic"){echo 'selected="selected"';} ?> value="smallclassic"><?php echo __("Small Classic Style","wtskype") ?> </option>
            <option <?php if($style=="smallicon"){echo 'selected="selected"';} ?> value="smallicon"><?php echo __("Small Icon","wtskype") ?> </option>
            <option <?php if($style=="mediumicon"){echo 'selected="selected"';} ?> value="mediumicon"><?php echo __("Medium Icon","wtskype") ?> </option>
            <option <?php if($style=="dropdown-white"){echo 'selected="selected"';} ?> value="dropdown-white"><?php echo __("Dropdown White Background","wtskype") ?> </option>
            <option <?php if($style=="dropdown-trans"){echo 'selected="selected"';} ?> value="dropdown-trans"><?php echo __("Dropdown Transparent Background","wtskype") ?></option>
        </select> 
		</p>
        
        <p class="skype-review" style="text-align: center;">
    		<label><?php echo __( 'Preview',"wtskype" ); ?></label><br /> 
    		<img class="skype-review-img" src="http://mystatus.skype.com/<?php echo $style ?>/<?php echo $skypeuser;?>" />
		</p>
        
		<?php 
	}
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['skypeuser'] = ( ! empty( $new_instance['skypeuser'] ) ) ? strip_tags( $new_instance['skypeuser'] ) : '';
        $instance['action'] = ( ! empty( $new_instance['action'] ) ) ? strip_tags( $new_instance['action'] ) : '';
        $instance['style'] = ( ! empty( $new_instance['style'] ) ) ? strip_tags( $new_instance['style'] ) : '';
        $instance['auto'] = ( ! empty( $new_instance['auto'] ) ) ? strip_tags( $new_instance['auto'] ) : '';
		return $instance;
	}

} // class wt_skype_Widget
add_action( 'widgets_init', function(){
     register_widget( 'wt_skype_Widget' );

});

function wt_script_skype(){ ?>
    <script type="text/javascript">
        jQuery(document).ready(function($) {  
            $(".skype_style").change(function(){
                var vl = $(this).val();
                var name =$(this).parent().parent().find(".skype-user").attr("value");
                $(".skype-review-img").attr("src","http://mystatus.skype.com/"+vl+"/"+name);
            });
            $(".wt_skype_add").click(function(){
                var count = $(".wt_count_skype").attr("value");
                count =parseInt(count)+1;
                $(".wt_count_skype").attr("value",count);
                
                return false;
            })
        });

    </script>
<?php }
add_action("admin_footer","wt_script_skype");