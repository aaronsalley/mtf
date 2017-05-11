<form>
	<?php
	if( is_user_logged_in() ) {
		$wp_user_id = get_currentuserinfo()->ID;
		$customer_id = $wpdb->get_row("SELECT c_id FROM " . $wpdb->prefix . "wc_crm_customer_list WHERE user_id = {$wp_user_id}")->c_id;
		$user = new WC_CRM_Customer;
		$user->get_customer($customer_id);
		$user->init_general_fields();
		
		$fields = array_merge( $user->general_fields, get_field_objects('user_'.$wp_user_id) );
		
// 		print_r($fields);
				
		if( $fields ) {
			foreach( $fields as $field_name => $field ) {
				$type = $field[type];
				
				switch ( $type ) {
					case "select" :
						$input = "<label>{$field[label]}</label><select>";
						foreach( $field[choices] as $choice => $value ){
							$input .= "<option>{$value}</option>";
						}
						$input .= "</select>";
						
						echo $input;
					break;
					
					case "checkbox" :
						$input = "<fieldset class='fieldset'>";
						$input .= "<input type='hidden' name='{$field[key]}' value/>";
						$input .= "<ul>";
						foreach( $field[choices] as $choice => $value ){
							$checked = 'no';
							
							if( in_array($value, $field[value]) ){
								$checked = 'yes';
							}
							
							$input .= "<li>";
								$input .= "<input type='{$field[type]}' name='{$field[key]}[]' value='{$value}' checked='{$checked}' />";
								$input .= "<label>{$choice}</label>";
							$input .= "</li>";
						}
						$input .= "</ul>";
						$input .= "</fieldset>";
						echo $input;
					break;
					
					case "true_false" :
							$checked = 'no';
							if( isset($field[value]) ){
								$checked = 'yes';
							}
							
							$input .= "<input type='checkbox' name='{$field[key]}' value='{$field[value]}' checked='{$checked}' />";
							$input = "<label>{$field[label]}</label>";
						
						echo $input;
					break;
					
					case "image" :
					break;
	
					case "file" :
					break;
	
					case "relationship" :
					break;
	
					default :
						$input = "<label>{$field[label]}</label><input type='{$field[type]}' value='{$field[value]}' />";
						
						echo $input;
				}
			}
		}
	}
	?>
</form>