<?php
/**
* Plugin Name: SMS Ten Sending
* Plugin URI: https://abacies.com
* Description: Plugin for sending ten SMS
* Version: 1.05
* Author: Abacies
* Author URI: https://abacies.com
**/
define( 'SMS_TEN',     plugin_dir_url( __FILE__ )  );
define( 'SMS_TEN_PATH',    plugin_dir_path( __FILE__ ) );
require_once(ABSPATH.'/wp-content/plugins/wpcharitable-textmessage/twilio-php-main/src/Twilio/autoload.php');
use Twilio\Rest\Client;

add_action('wp_enqueue_scripts', 'scripts_for_sms_ten_js');
function scripts_for_sms_ten_js() {
	wp_enqueue_script('sms_tenjs', SMS_TEN.'assets/js/bootstrap.js', array('jquery'), '1.1.0', true );
	wp_enqueue_script('smssend_tenjs', SMS_TEN.'assets/js/sms-ten-sending.js', array('jquery'), '1.2.0', true );
}

add_action('wp_enqueue_scripts', 'scripts_for_sms_ten_css');
add_action('admin_enqueue_scripts', 'scripts_for_sms_ten_css');
function scripts_for_sms_ten_css() {
	wp_enqueue_style('sms_tencss', SMS_TEN.'assets/css/bootstrap.css');
	wp_enqueue_style('smssending_ten_css', SMS_TEN.'assets/css/sms-ten-sending.css');
}

/*
*
*Button Click message sent
*/
function sms_sent_btn_function() {
	$previous_url = wp_get_referer();
    $html .= $previous_url;
    if (($previous_url && isset($_GET['message_content'])) || (isset($_GET['message_content']))) {
        $string_to_find  = 'page';
        $position = strpos($previous_url, $string_to_find);
        if ($position !== false) {
            $updated_url = substr($previous_url, -1, $position + strlen($string_to_find));
        } else {
            $updated_url = $previous_url;
        }
        $html .= '<a href="' . $updated_url . '"><button class="back-page" style="padding-bottom:10px;"> Back 	</button></a>';
    }
    $current_url = get_permalink();
   
    echo    "<div class='cronjob-message-sent-ten'> 
                <a href='$current_url?message_content=message1' style='text-decoration: none;' ><button class='sms-message-one btn btn-sm text-sm' style='margin-right: 1rem; margin-bottom:1rem;'>Send Message 1</button></a>
                <a href='$current_url?message_content=message2' style='text-decoration: none;' ><button class='sms-message-two btn btn-sm text-sm' style='margin-right: 1rem; margin-bottom:1rem;'>Send Message 2</button></a>
                <a href='$current_url?message_content=message3' style='text-decoration: none;' ><button class='sms-message-three btn btn-sm text-sm' style='margin-right: 1rem; margin-bottom:1rem;'>Send Message 3</button></a>
                <a href='$current_url?message_content=message4' style='text-decoration: none;' ><button class='sms-message-four btn btn-sm text-sm' style='margin-right: 1rem; margin-bottom:1rem;'>Send Message 4</button></a>
                <a href='$current_url?message_content=message5' style='text-decoration: none;' ><button class='sms-message-five btn btn-sm text-sm' style='margin-right: 1rem; margin-bottom:1rem;'>Send Message 5</button></a>
                <a href='$current_url?message_content=message6' style='text-decoration: none;' ><button class='sms-message-six btn btn-sm text-sm' style='margin-right: 1rem; margin-bottom:1rem;'>Send Message 6</button></a>
                <a href='$current_url?message_content=message7' style='text-decoration: none;' ><button class='sms-message-seven btn btn-sm text-sm' style='margin-right: 1rem; margin-bottom:1rem;'>Send Message 7</button></a>
                <a href='$current_url?message_content=message8' style='text-decoration: none;' ><button class='sms-message-eight btn btn-sm text-sm' style='margin-right: 1rem; margin-bottom:1rem;'>Send Message 8</button></a>
                <a href='$current_url?message_content=message9' style='text-decoration: none;' ><button class='sms-message-nine btn btn-sm text-sm' style='margin-right: 1rem; margin-bottom:1rem;'>Send Message 9</button></a>
                <a href='$current_url?message_content=message10' style='text-decoration: none;' ><button class='sms-message-ten btn btn-sm text-sm' style='margin-right: 1rem; margin-bottom:1rem;'>Send Message 10</button></a>
            </div>
            <div class='loader d-none' id ='phone-sent'>
                <div class='d-flex justify-content-center' >
                    <div class='spinner-border' role='status'>
                    <span class='sr-only'>Loading...</span>
                    </div>
                </div>
            </div>";
    
}

/*
*listing Student Entries form list
*
*/
add_shortcode('sms_ten_send', 'sms_ten_send_function');
function sms_ten_send_function(){
    $get_list =get_campaign_start_date();
    $field_id_settings = get_option('field_id_settings');
    $formID = $field_id_settings['std_formID'];
    $message1ID = $field_id_settings['ten_message1'];
    $message2ID = $field_id_settings['ten_message2'];
    $message3ID = $field_id_settings['ten_message3'];
    $message4ID = $field_id_settings['ten_message4'];
    $message5ID = $field_id_settings['ten_message5'];
    $message6ID = $field_id_settings['ten_message6'];
    $message7ID = $field_id_settings['ten_message7'];
    $message8ID = $field_id_settings['ten_message8'];
    $message9ID = $field_id_settings['ten_message9'];
    $message10ID = $field_id_settings['ten_message10'];
    foreach ($get_list as $value) {
        if($value->form_id = $formID){

            if($value->id == $message1ID ) {
                $message1 = $value->meta_value;
            }
            if($value->id == $message2ID ) {
                $message2 = $value->meta_value;
            }
            if($value->id == $message3ID ) {
                $message3 = $value->meta_value;
            }
            if($value->id == $message4ID ) {
                $message4 = $value->meta_value;
            }
            if($value->id == $message5ID ) {
                $message5 = $value->meta_value;
            }
            if($value->id == $message6ID ) {
                $message6 = $value->meta_value;
            }
            if($value->id == $message7ID ) {
                $message7 = $value->meta_value;
            }
            if($value->id == $message8ID ) {
                $message8 = $value->meta_value;
            }
            if($value->id == $message9ID ) {
                $message9 = $value->meta_value;
            }
            if($value->id == $message10ID ) {
                $message10 = $value->meta_value;
            }
        }
    }
    
    
    $html = "";
    $headings = [];
    $user_id = get_current_user_id();
    if($user_id){
        $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
        if(!current_user_can('administrator')){
            $cmp_ary = array (
                'post_type' => 'campaign',
                'posts_per_page' => 25,
                'paged' => $paged,
                'author' => $user_id,
                'post_status' =>'publish',
                'order'=> 'DESC');
                $campaign_ary = get_posts($cmp_ary);
        }else {
            $cmp_ary = array (
                'post_type' => 'campaign',
                'posts_per_page' => 25,
                'paged' => $paged,
                'post_status' =>'publish',
                'order'=> 'DESC');
                $campaign_ary = get_posts($cmp_ary);
        }
    }
    
    if (!isset($_GET['message_content'])){

        $html .= sms_sent_btn_function();
        $html .= "<table class='table' id='form_results10'>
        <thead>
        <tr>
            <th scope='col'>#</th>
            
            <th scope='col' style='width: 15%;'>Campaign Title</th>
            <th scope='col' style='width: 15%;'>Campaign Creator</th>
            <th scope='col' style='width: 15%;'>Phone Number</th>
            <th scope='col' style='width: 10%;'>Create Date</th>
            <th scope='col'>Message</th>
            <th scope='col'>Subject</th>
        </tr>
        </thead>
        <tbody>";
        $i = 0;
        foreach($campaign_ary as $querys){
           
            $camp_user = [];
            $author_id = $querys->post_author;
            $author_obj = get_user_by('id', $author_id);
            $author_phone_number = $author_obj->phone_number;  
            if($author_phone_number){
                array_push($camp_user, $querys);
            }

            foreach($camp_user as $query){
                $i++;
                $postID = $query->ID;
                $Camp_title = get_the_title($query->ID);
                $selected = false;
                
                $createDate = new DateTime($query->post_date);
                $campaign_date = $createDate->format('Y-m-d');
                
               
                $author_name = $author_obj->display_name;
                if(!$author_name){
                    $author_name = $author_obj->user_nicename;
                }
               
                $html .="<tr>
                            <td scope='row'>".$i."</td>
                            <td>".$Camp_title."</td>
                            <td>".$author_name."</td>
                            <td>".$author_phone_number."</td>
                            <td>".$campaign_date."</td>
                            <td>
                            
                                <select class='form-select' name='message_$postID' id='message_$postID'  aria-label='Default select example'>
                                    
                                        <option value='$message1' data-msg='message1'>$message1</option>
                                        <option value='$message2' data-msg='message2'>$message2</option>
                                        <option value='$message3' data-msg='message3'>$message3</option>
                                        <option value='$message4' data-msg='message4'>$message4</option>
                                        <option value='$message5' data-msg='message5'>$message5</option>
                                        <option value='$message6' data-msg='message6'>$message6</option>
                                        <option value='$message7' data-msg='message7'>$message7</option>
                                        <option value='$message8' data-msg='message8'>$message8</option>
                                        <option value='$message9' data-msg='message9'>$message9</option>
                                        <option value='$message10' data-msg='message10'>$message10</option>
                                    </select>
                            </td>";
                $current_url = get_permalink();
                $html .="<td>
                            <button type='button' class='send_cronjob_ten_msg' data-pagurl='$current_url' data-postID='$postID'  data-campTitle='$Camp_title' data-phone='$author_phone_number' class='btn btn-primary'>Send</button> </a> 
                        </td>
                        </tr>";   
                    
            }
        }
        
    
    $html .= "</tbody>
        </table>";
        // Pagination
        $total_posts = count($campaign_ary);
            $html .= '<div class="pagination">';
            $html .= paginate_links(array(
                'base'    => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
                'format'  => '?paged=%#%',
                'current' => max(1, get_query_var('paged')),
                'total'   =>  $total_posts -1
            ));
            $html .=  '</div>';

            wp_reset_postdata();
    } else {
        
        $msgContent = $_GET['message_content'];
        if($msgContent == 'message1'){
            $IsContent = $message1;
        }else if($msgContent == 'message2'){
            $IsContent = $message2;
        }else if($msgContent == 'message3'){
            $IsContent = $message3;
        }else if($msgContent == 'message4'){
            $IsContent = $message4;
        }else if($msgContent == 'message5'){
            $IsContent = $message5;
        }else if($msgContent == 'message6'){
            $IsContent = $message6;
        }else if($msgContent == 'message7'){
            $IsContent = $message7;
        }else if($msgContent == 'message8'){
            $IsContent = $message8;
        }else if($msgContent == 'message9'){
            $IsContent = $message9;
        }else if($msgContent == 'message10'){
            $IsContent = $message10;
        }
		if ($IsContent) {
			global $wpdb;
			$campTitleName = $_GET['campagin_title'];
			$phoneNUM = $_GET['phone'];
			$previous_url = wp_get_referer();
			if (($previous_url && isset($_GET['message_content'])) || (isset($_GET['message_content']))) {
				$string_to_find  = 'page';
				$position = strpos($previous_url, $string_to_find);
				if ($position !== false) {
					$updated_url = substr($previous_url, -1, $position + strlen($string_to_find));
				} else {
					$updated_url = $previous_url;
				}
				$html .= '<a href="' . $updated_url . '"><button class="back-page" style="padding-bottom:10px;"> Back 	</button></a>';
			}
	
			if (isset($_GET['campagin_title']) && isset($_GET['phone']) ){
				$html .="<button type='button' class='send_cronjob_ten_single btn btn-primary' data-phone='$phoneNUM' data-msg='$msgContent' data-url='$campID' style='margin-bottom: 10px; float: right;'>Send</button>";
			} else {
				$html .= "<button class='send_all_msg_ten' data-msg='$msgContent' style='margin-bottom: 10px; float: right;'> Send </button>";
			}
				$html .= "<table class='table table-responsive' id='form_results10'>
				<thead>
				<tr>
					<th scope='col'>#</th>
					<th scope='col' style='width: 15%;'>Phone</th>
					<th scope='col' style='width: 15%;'>Campaign Title</th>
					<th scope='col'>Message Content</th>
				</tr>
				</thead>
					<tbody>";
					$i=0;
					foreach($campaign_ary as $querys){
                        $camp_user = [];
                        $author_id = $querys->post_author;
                        $author_obj = get_user_by('id', $author_id);
                        $author_phone_number = $author_obj->phone_number;  
                        if($author_phone_number){
                            array_push($camp_user, $querys);
                        }
                        foreach($camp_user as $query){
                            $i++;
                            $postID = $query->ID;
                            $Camp_title = get_the_title($query->ID);
                            
                            $createDate = new DateTime($query->post_date);
                            $campaign_date = $createDate->format('Y-m-d');
                            
                            $author_id = $query->post_author;
                            $author_obj = get_user_by('id', $author_id);
                            $author_phone = $author_obj->phone_number;  
                            $author_name = $author_obj->display_name;
                            if(!$author_name){
                                $author_name = $author_obj->user_nicename;
                            }
                            if($author_phone){
                                // if ($organization_data && !empty($organization_data)) {
                                    $camp_data = get_campaign_start_date();
                                    $pages = $wpdb->get_results( "SELECT ID FROM $wpdb->posts WHERE post_title = '" . $Camp_title . "'" );
                                    $postID = $pages[0]->ID;
                                    
                                    $post_meta = get_post_meta($postID);
                                    $camp_url = get_permalink($postID);
                                    $camp_goal = get_post_meta($postID, '_campaign_goal', true);
                                    if($camp_goal == ''){
                                    $camp_goal = get_post_meta($postID, '_campaign_fundraiser_default_goal', true);
                                    }
                                    if($camp_goal) {
                                        $campGgoal = "$$camp_goal";
                                    }else {
                                        $campGgoal = "$0";
                                    }
                                    $author_id = get_post_field( 'post_author', $postID );
                                    $author_obj = get_user_by('id', $author_id);
                                    $author_phone = $author_obj->phone_number;
                                    $camp_title = get_the_title($postID);
                                    $author = get_the_author_meta( 'display_name', $author_id );
                                    $args = array(
                                        'post_type' => 'donation',
                                        'post_status' => 'charitable-completed, charitable-pending, charitable-failed, charitable-cancelled, charitable-refunded',
                                        );
                                    $arr_post = get_posts($args);
                                    if ($arr_post) {
                                        foreach ($arr_post as $post) {
                                            $post_id = $post->ID;
                                            $donation = charitable_get_donation($post_id);
                                            $campaign_id = current($donation->get_campaign_donations())->campaign_id;
                                            if ($campaign_id == $postID) {
                                                $amtRaised = $donation->get_total_donation_amount();
                                                if($amtRaised){
                                                    $amtraised = number_format((float)$amtRaised, 2, '.', '');
                                                    $amt_raised = "$$amtraised";
                                                }else{
                                                    $amt_raised = "$0";
                                                }
                                            }else {
                                                $amt_raised = "$0"; 
                                            }
                                        }
                                    }
                                    if (isset($_GET['message_content'])) {
                                    $message_content = $_GET['message_content'];
                                    if($message_content == 'message1'){
                                        $keywords = ["{Campaign Owner}", "{Campaign Goal}", "{Organization}", "{Campaign Title}", "{Campaign URL}", '{Amount Raised}'];
                                        $values   = [$author, $campGgoal, $organization_data['name'], $camp_title, $camp_url, $amt_raised];
                                        $message = str_replace($keywords, $values, $message1);
                                        $messageContent = $message;
                                    }else if($message_content == 'message2'){
                                        $keywords = ["{Campaign Owner}", "{Campaign Goal}", "{Organization}", "{Campaign Title}", "{Campaign URL}", '{Amount Raised}'];
                                        $values   = [$author, $campGgoal, $organization_data['name'], $camp_title, $camp_url, $amt_raised];
                                        $message = str_replace($keywords, $values, $message2);
                                        $messageContent = $message;
                                    }else if($message_content == 'message3'){
                                        $keywords = ["{Campaign Owner}", "{Campaign Goal}", "{Organization}", "{Campaign Title}", "{Campaign URL}", '{Amount Raised}'];
                                        $values   = [$author, $campGgoal, $organization_data['name'], $camp_title, $camp_url, $amt_raised];
                                        $message = str_replace($keywords, $values, $message3);
                                        $messageContent = $message;
                                    }else if($message_content == 'message4'){
                                        $keywords = ["{Campaign Owner}", "{Campaign Goal}", "{Organization}", "{Campaign Title}", "{Campaign URL}", '{Amount Raised}'];
                                        $values   = [$author, $campGgoal, $organization_data['name'], $camp_title, $camp_url, $amt_raised];
                                        $message = str_replace($keywords, $values, $message4);
                                        $messageContent = $message;
                                    }else if($message_content == 'message5'){
                                        $keywords = ["{Campaign Owner}", "{Campaign Goal}", "{Organization}", "{Campaign Title}", "{Campaign URL}", '{Amount Raised}'];
                                        $values   = [$author, $campGgoal, $organization_data['name'], $camp_title, $camp_url, $amt_raised];
                                        $message = str_replace($keywords, $values, $message5);
                                        $messageContent = $message;
                                    }else if($message_content == 'message6'){
                                        $keywords = ["{Campaign Owner}", "{Campaign Goal}", "{Organization}", "{Campaign Title}", "{Campaign URL}", '{Amount Raised}'];
                                        $values   = [$author, $campGgoal, $organization_data['name'], $camp_title, $camp_url, $amt_raised];
                                        $message = str_replace($keywords, $values, $message6);
                                        $messageContent = $message;
                                    }else if($message_content == 'message7'){
                                        $keywords = ["{Campaign Owner}", "{Campaign Goal}", "{Organization}", "{Campaign Title}", "{Campaign URL}", '{Amount Raised}'];
                                        $values   = [$author, $campGgoal, $organization_data['name'], $camp_title, $camp_url, $amt_raised];
                                        $message = str_replace($keywords, $values, $message7);
                                        $messageContent = $message;
                                    }else if($message_content == 'message8'){
                                        $keywords = ["{Campaign Owner}", "{Campaign Goal}", "{Organization}", "{Campaign Title}", "{Campaign URL}", '{Amount Raised}'];
                                        $values   = [$author, $campGgoal, $organization_data['name'], $camp_title, $camp_url, $amt_raised];
                                        $message = str_replace($keywords, $values, $message8);
                                        $messageContent = $message;
                                    }else if($message_content == 'message9'){
                                        $keywords = ["{Campaign Owner}", "{Campaign Goal}", "{Organization}", "{Campaign Title}", "{Campaign URL}", '{Amount Raised}'];
                                        $values   = [$author, $campGgoal, $organization_data['name'], $camp_title, $camp_url, $amt_raised];
                                        $message = str_replace($keywords, $values, $message9);
                                        $messageContent = $message;
                                    }else if($message_content == 'message10'){
                                        $keywords = ["{Campaign Owner}", "{Campaign Goal}", "{Organization}", "{Campaign Title}", "{Campaign URL}", '{Amount Raised}'];
                                        $values   = [$author, $campGgoal, $organization_data['name'], $camp_title, $camp_url, $amt_raised];
                                        $message = str_replace($keywords, $values, $message10);
                                        $messageContent = $message;
                                    }
                                }
                                // }
                                
                                if (!isset($_GET['campagin_title'])){	
                                    $html .="<tr>
                                                <td scope='row'>".$i."</td>
                                                <td>".$author_phone."</td>
                                                    <td>".$camp_title."</td>
                                                <td>$messageContent</td>
                                            </tr>";   
                                }
                                
                            }
                        }
					}
					if (isset($_GET['campagin_title']) && isset($_GET['message_content']) ){
                        $postTitle = get_the_title($PostiD);
                        $html .="<tr>
                                    <td scope='row'>1</td>
                                    <td>".$phoneNUM."</td>
                                    <td>".$campTitleName."</td>
                                    <td><b>$messageContent</td>
                                </tr>";            
                	} 
					$html .= "</tbody>
						</table>";
					// Pagination
					$total_posts = count($campaign_ary);
					if (!isset($_GET['campagin_title'])) {
					$html .= '<div class="pagination">';
						$html .= paginate_links(array(
							'base'    => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
							'format'  => '/paged=%#%',
							'current' => max(1, get_query_var('paged')),
							'total'   => $total_posts-1,
							
						));
						$html .= '</div>';
					}
					wp_reset_postdata();
		} else {
			$previous_url = wp_get_referer();

			if (($previous_url && isset($_GET['message_content'])) || (isset($_GET['message_content']))) {
				
				$html .= '<a href="' . $previous_url . '"><button class="back-page btn" style="margin-bottom:10px;"> Back 	</button></a>';
			}
			$html .=  '<div class="alert alert-danger" role="alert">
						Oops! No Message Content is Found !!!
						</div>';
		}
		
	}

    return $html;

}


/*
*remove phone number array contain not a US
*
*/
function remove_NonUSPhoneNumber(&$array) {
    $pattern = '/^\+?[^1][0-9]+$/';
    foreach ($array as $key => $value) {
        if (preg_match($pattern, $value)) {
            unset($array[$key]); // Remove the phone number from the array
        }
    }
}

/*
* Ajax call function
*/
add_action('wp_ajax_send_message_ten_all', 'send_message_ten_all');
function send_message_ten_all() {
    global $wpdb;
    $table_name = $wpdb->prefix. 'formidable_copy';
    $organization_data = get_organization_data();
   
    $phone = $_POST['phone'];
    $message_key = $_POST['message_key'];
    $campaign_title = $_POST['campaign_title'];
    $decode_num = json_decode(stripslashes($phone),true);
    $decode_campaign_title = json_decode(stripslashes($campaign_title),true);
    
    $camp_data = get_campaign_start_date();
    $field_id_settings = get_option('field_id_settings');
    $std_formID = $field_id_settings['std_formID'];
    $message1 = $field_id_settings['ten_message1'];
    $message2 = $field_id_settings['ten_message2'];
    $message3 = $field_id_settings['ten_message3'];
    $message4 = $field_id_settings['ten_message4'];
    $message5 = $field_id_settings['ten_message5'];
    $message6 = $field_id_settings['ten_message6'];
    $message7 = $field_id_settings['ten_message7'];
    $message8 = $field_id_settings['ten_message8'];
    $message9 = $field_id_settings['ten_message9'];
    $message10 = $field_id_settings['ten_message10'];
    if ($organization_data && !empty($organization_data)) {
        foreach ($camp_data as $value) {
            if($value->form_id = $std_formID){

                if($value->id == $message1 && $message_key == 'message1') {
                    $messsages = $value->meta_value; 
                    $messsage_status = "Message 1 has been send Sucessfully!";

                }else if($value->id == $message2 && $message_key == 'message2'){
                    $messsages = $value->meta_value; 
                    $messsage_status = "Message 2 has been send Sucessfully!";

                }else if($value->id == $message3 && $message_key == 'message3'){
                    $messsages = $value->meta_value; 
                    $messsage_status = "Message 3 has been send Sucessfully!";

                }else if($value->id == $message4 && $message_key == 'message4'){
                    $messsages = $value->meta_value; 
                    $messsage_status = "Message 4 has been send Sucessfully!";

                }else if($value->id == $message5 && $message_key == 'message5'){
                    $messsages = $value->meta_value; 
                    $messsage_status = "Message 5 has been send Sucessfully!";

                }else if($value->id == $message6 && $message_key == 'message6'){
                    $messsages = $value->meta_value; 
                    $messsage_status = "Message 6 has been send Sucessfully!";

                }else if($value->id == $message7 && $message_key == 'message7'){
                    $messsages = $value->meta_value; 
                    $messsage_status = "Message 7 has been send Sucessfully!";

                }else if($value->id == $message8 && $message_key == 'message8'){
                    $messsages = $value->meta_value; 
                    $messsage_status = "Message 8 has been send Sucessfully!";

                }else if($value->id == $message9 && $message_key == 'message9'){
                    $messsages = $value->meta_value; 
                    $messsage_status = "Message 9 has been send Sucessfully!";

                }else if($value->id == $message10 && $message_key == 'message10'){
                    $messsages = $value->meta_value; 
                    $messsage_status = "Message 10 has been send Sucessfully!";

                }
            }
        } 
        
        $account_sid =  get_option('twilio_account_sid');
        $auth_token =  get_option('twilio_auth_token');
        $twilio_number =  get_option('twilio_number');
        
        $sms_bodies = [];
        $i = 0;
        
        foreach ($decode_num as $ph_no) {
        
            $query = $wpdb->get_results ( "SELECT campagin_url, organization_name FROM $table_name WHERE phone='$ph_no' AND campagin_url='$decode_campaign_title[$i]'");
            // $query = $wpdb->get_results ( "SELECT campagin_url, organization_name FROM $table_name WHERE phone='$ph_no'");

            foreach($query as $value) {
                $page = $wpdb->get_results( "SELECT ID FROM $wpdb->posts WHERE post_title = '" . $value->campagin_url . "'" );
                // $organization = $value->organization_name;
                $postID = $page[0]->ID; 
                
                $post_meta = get_post_meta($postID);
                $camp_url = get_permalink($postID);
      
                
                // $amt_raised = '0';
                $args = array(
                    'post_type' => 'donation',
                    'post_status' => 'charitable-completed, charitable-pending, charitable-failed, charitable-cancelled, charitable-refunded',
                    );
                $arr_post = get_posts($args);
                if ($arr_post) {
                    foreach ($arr_post as $post) {
                        $post_id = $post->ID;
                        $donation = charitable_get_donation($post_id);
                        $campaign_id = current($donation->get_campaign_donations())->campaign_id;
                        if ($campaign_id == $postID) {
                            $amtRaised = $donation->get_total_donation_amount();
                            if($amtRaised){
                                $amtraised = number_format((float)$amtRaised, 2, '.', '');
                                $amt_raised = "$$amtraised";
                            }else{
                                $amt_raised = "$0";
                            }
                        }else {
                            $amt_raised = "$0"; 
                        }
                    }
                }

                $camp_goal = get_post_meta($postID, '_campaign_goal', true);
                if($camp_goal == ''){
                    $camp_goal = get_post_meta($postID, '_campaign_fundraiser_default_goal', true);
                }
                if($camp_goal) {
                    $campGgoal = "$$camp_goal";
                }else {
                    $campGgoal = "$0";
                }
                $author_id = get_post_field( 'post_author', $postID );
                $camp_title = get_the_title($postID);

                $author = get_the_author_meta( 'display_name', $author_id );
               
                
                $keywords = ["{Campaign Owner}", "{Campaign Goal}", "{Organization}", "{Campaign Title}", "{Campaign URL}", '{Amount Raised}'];
                $values   = [$author, $campGgoal, $organization_data['name'], $camp_title, $camp_url, $amt_raised];
                $message = str_replace($keywords, $values, $messsages);
                $sms_body = $message;
                
                array_push($sms_bodies,$sms_body);
               
            }
        $i++;
        } 
        
        
      //  print_r($camp_titles);die;
        if(!$account_sid){
            // Your Account SID and Auth Token from twilio.com/console
            $account_sid = 'ACc8221e6caae950d54570cde698e89361';
            $auth_token = 'f0b2462208b4cba2e1d71008710a695b';
            // In production, these should be environment variables. E.g.:
            // $auth_token = $_ENV["TWILIO_AUTH_TOKEN"]

            // A Twilio number you own with SMS capabilities
            $twilio_number = "+15005550006";
        }
    
        $client = new Client($account_sid, $auth_token);
        $j=0;  
        // remove_us_phone_numbers($myArray)
        // $status['decode_num'] = $decode_num;
        // remove_NonUSPhoneNumber($decode_num);  
        // $status['phoneNumber'] = $decode_num;
        foreach ($decode_num as $to) {
            //print_r($to);
            $phone_number = str_replace(array( '(', ')', ' ', '+1', '–' ), '', $to);
                
            
                $status['message'] = 'The phone number is a US phone number.';
                
                    $msg_sent = $client->messages->create(
                        //     Where to send a text message (your cell phone?)
                            '+1' . $phone_number,
                            array(
                                'from' => $twilio_number,
                                'body' => $sms_bodies[$j]
                         )
                         );
                    $j++;
                 
                $status['status twilio'] = $msg_sent->status;
                $status['errorCode twilio'] = $msg_sent->errorCode;
                $status['errorMessage twilio'] = $msg_sent->errorMessage;

                if ($msg_sent->sid){
                    $status['status'] = 200;
                    $status['message'] = $messsage_status;
                    $status['sms_body'] = $sms_bodies;
                }else{
                    
                    $status['status'] = 400;
                    $status['message'] = "Failed to send the message to '$phone_number'. Invalid Number";
                    $status['values'] = $sms_bodies;  
                }
           
        }
        
       
    } else {
        $status['status'] = 400;
        $status['message'] = "Organization name is required";
    }
    print_r(json_encode($status));
    exit(); 
}

/*
* Single message send
*/
add_action('wp_ajax_single_tenmsg_sent', 'single_tenmsg_sent_callback');
function single_tenmsg_sent_callback() {
    global $wpdb; // this is how you get access to the database
    $organization_data = get_organization_data();

    $phone = $_POST['phone'];
    $campaignID = $_POST['campaign'];
    // $msgContent = $_POST['message_data'];
    $message_data = $_POST['message_data'];
    // $message_data = '';
    $get_list =get_campaign_start_date();
    $field_id_settings = get_option('field_id_settings');
    $formID = $field_id_settings['std_formID'];
    $message1ID = $field_id_settings['message1'];
    $message2ID = $field_id_settings['message2'];
    $message3ID = $field_id_settings['message3'];
    foreach ($get_list as $value) {
        if($value->form_id = $formID){
            if($value->id == $message1ID ) {
                $message1 = $value->meta_value;
            }
            if($value->id == $message2ID ) {
                $message2 = $value->meta_value;
            }
            if($value->id == $message3ID ) {
                $message3 = $value->meta_value;
            }
        }
    }

    if($msgContent == 'message1'){
        $message_data == $message1;
    }else if($msgContent == 'message2'){
        $message_data == $message2;
    }else if($msgContent == 'message3'){
        $message_data == $message3;
    }
   
    
    // $organization = $_POST['organization'];
    
    $account_sid =  get_option('twilio_account_sid');
    $auth_token =  get_option('twilio_auth_token');
    $twilio_number =  get_option('twilio_number');

    // $args = array("post_type" => "campaign", 'posts_per_page' => -1);
    
    // $query = get_posts( $args );
    // foreach($query as $post){
        // print_r($post->post_title);
        // if($post->ID == $campaignID){
            $post_title = get_the_title($campaignID);
            $post_meta = get_post_meta($campaignID);
            $camp_url = get_permalink($campaignID);
            $camp_title = get_the_title($campaignID);
            // $amt_raised = '0';

            $args = array(
                'post_type' => 'donation',
                'post_status' => 'charitable-completed, charitable-pending, charitable-failed, charitable-cancelled, charitable-refunded',
                );
            $arr_post = get_posts($args);
            if ($arr_post) {
                foreach ($arr_post as $post) {
                    $post_id = $post->ID;
                    $donation = charitable_get_donation($post_id);
                    $campaign_id = current($donation->get_campaign_donations())->campaign_id;
                    if ($campaign_id == $campaignID) {
                        $amtRaised = $donation->get_total_donation_amount();
                        if($amtRaised){
                            $amtraised = number_format((float)$amtRaised, 2, '.', '');
                            $amt_raised = "$$amtraised";
                        }else{
                            $amt_raised = "$0";
                        }
                    }else {
                        $amt_raised = "$0"; 
                    }
                }
            }

            $camp_goal = get_post_meta($campaignID, '_campaign_goal', true);
            if($camp_goal == ''){
                $camp_goal = get_post_meta($campaignID, '_campaign_fundraiser_default_goal', true);
            }
            if($camp_goal) {
                $campGgoal = "$$camp_goal";
            }else {
                $campGgoal = "$0";
            }
            $author_id = get_post_field( 'post_author', $campaignID );
            $author_name = get_the_author_meta( 'display_name', $author_id );
        // }
    // }
      
    if(!$account_sid){
        // Your Account SID and Auth Token from twilio.com/console
        $account_sid = 'ACc8221e6caae950d54570cde698e89361';
        $auth_token = 'f0b2462208b4cba2e1d71008710a695b';
        // In production, these should be environment variables. E.g.:
        // $auth_token = $_ENV["TWILIO_AUTH_TOKEN"]

        // A Twilio number you own with SMS capabilities
        $twilio_number = "+15005550006";
    }
  
    $client = new Client($account_sid, $auth_token);
      
    if ($organization_data && !empty($organization_data)) {
        if (strpos($message_data, "{Campaign Title}") !== false) {
            $keywords = ["{Campaign Owner}", "{Campaign Goal}", "{Organization}", "{Campaign Title}", "{Campaign URL}", '{Amount Raised}'];
            $values   = [$author_name, $campGgoal, $organization_data['name'], $camp_title, $camp_url, $amt_raised];
        }else{
            $keywords = ["{Campaign Owner}", "{Campaign Goal}", "{Organization}", "{Campaign Title}\'s", "{Campaign URL}", '{Amount Raised}'];
            $campTitle = "$camp_title's";
            $values   = [$author_name, $campGgoal, $organization_data['name'], $campTitle, $camp_url, $amt_raised];
        }

        $message = str_replace($keywords, $values, $message_data);
        $sms_body = $message;

        $phone_number = str_replace(array( '(', ')', ' ', '+1', '–' ), '', $phone);
        
        if (is_us_phone_number($phone_number)) {
            $status['message'] = 'The phone number is a US phone number.';
            
                $msg_sent = $client->messages->create(
                    // Where to send a text message (your cell phone?)
                    '+1' . $phone_number,
                    array(
                        'from' => $twilio_number,
                        'body' => $sms_body
                    )
                );
            
            if ($msg_sent){
                $status['status'] = 200;
                $status['message'] = "Message has been send Sucessfully!";
            }else {
                $status['status'] = 400;
                $status['message'] = "Message sent failed";
            }
        } else {
            $status['status'] = 202;
            $status['message'] = 'The phone number is not a US phone number.';
          
        }
    } else {
        $status['status'] = 400;
        $status['message'] = "Organization name is required";
    }
    print_r(json_encode($status));
    exit(); 
}