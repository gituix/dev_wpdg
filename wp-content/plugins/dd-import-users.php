<?php
/*
Plugin Name: Dagon Design Import Users
Plugin URI: http://www.dagondesign.com/articles/import-users-plugin-for-wordpress/
Description: Import list of users into WordPress. To use, go to 'Manage -> DDImport Users'.
Author: Dagon Design
Version: 1.2
Author URI: http://www.dagondesign.com/
Contributor: Nicholas LaRacuente, http://www.sccs.swarthmore.edu/users/10/ndl
*/

/*
	2009-01-24 - Modified by Robert McKenzie (rmckenzi@rpmdp.com) http://www.gammaray-tech.com

	Modifications to this script include the ability to specify a password as well as first and last names.

	Firstname, Lastname and Password are optional but the fields must be delimited, ie:

	bill|Bill|Smith|blahblah|bill.smith@blah.com
	jim|Jim|||Jim@blah.com

	In the case of a missing password the script will generate one as the original script did and email that
	password to the new user.  If the password has been specified it will also be sent to the user

*/

$ddui_version = '1.2';

function ddiu_add_management_pages() {
	if (function_exists('add_management_page')) {
		add_management_page('Import Users', 'DDImportUsers', 8, __FILE__, 'ddiu_management_page');
	}		
}

#can specify how to parse submitted file by editing this function
function fileParseFunction($filename){
	return file($filename);
}

#modify this function to specify how to parse text in field
#could change format or add validation
function fieldParseFunction($text){
	return explode("\n", trim($text));
}

#specify format information to be displayed to the user
$formatinfo = '<p><strong>The data you enter MUST be in the following format:</strong><br />
			&nbsp;&nbsp;&nbsp;username(delimiter)firstname(delimiter)lastname(delimiter)password(delimiter)email(delimiter)role<br />
			&nbsp;&nbsp;&nbsp;username(delimiter)firstname(delimiter)lastname(delimiter)password(delimiter)email(delimiter)role<br />
			&nbsp;&nbsp;&nbsp;etc...<br />
		</p>';

function ddiu_management_page() {

	global $wpdb, $wp_roles, $formatinfo, $ddui_version;

	$result = "";

	if (isset($_POST['info_update'])) {

		?><div id="message" class="updated fade"><p><strong><?php 

		echo "Processing Complete - View Results Below";

	    ?></strong></p></div><?php


		//
		// START Processing
		//


		$the_role = (string)$_POST['ddui_role'];
		$delimiter = (string)$_POST['delimiter'];

		// get data from form and turn into array
		$u_temp = array();
		if(trim((string)$_POST["ddui_data"]) != ""){
			$u_temp = array_merge($u_temp, fieldParseFunction(((string) ($_POST["ddui_data"]))));
		}
		else{
			$result .= "<p>No names entered in field.</p>";
		}
		if ($_FILES['ddui_file']['error'] != UPLOAD_ERR_NO_FILE){#Earlier versions of PHP may use $HTTP_POST_FILES
			$file = $_FILES['ddui_file'];
			if($file['error']){
				$result .= '<h4 style="color: #FF0000;">Errors!</h4><p>';
				switch ($file['error']){
					case UPLOAD_ERR_INI_SIZE:
						$result .= "File of ".$file['size']."exceeds max size ".upload_max_filesize;
						break;
					case UPLOAD_ERR_FORM_SIZE:
						$result .= "File of ".$file['size']."exceeds max size ".upload_max_filesize;
						break;
					case UPLOAD_ERR_PARTIAL:
						$result .= "File not fully uploaded";
						break;
					default:
				}
				$result.='.</p>';
			}
			elseif(!is_uploaded_file($file['tmp_name'])){
				$result = "File ".$file['name']." was not uploaded via the form.";
			}
			else{ #should be ok to read the file now
				$u_temp = array_merge($u_temp, fileParseFunction($file['tmp_name']));
			}
		} else{
			$result .= "<p>No file submitted.</p>";
		}

		$u_data = array();
		$i = 0;

		foreach ($u_temp as $ut) {

			if (trim($ut) != '') {

				if (! (list($u_n, $u_f, $u_l, $u_p, $u_e, $u_r)  = @split($delimiter, $ut, 6))){
					$result .= "<p>Regex ".$delimiter." not valid.</p>";
				}
				
				$u_n = trim($u_n);
				$u_f = trim($u_f);
				$u_l = trim($u_l);
				$u_p = trim($u_p);
				$u_e = trim($u_e);
				$u_r = trim($u_r);

				//if (($u_n != '') && ($u_f != '') && ($u_l != '') && ($u_p != '') && ($u_e != '')) {
				if (($u_n != '') && ($u_e != '')) {

					$u_data[$i]['username'] = $u_n;
					$u_data[$i]['firstname'] = $u_f;
					$u_data[$i]['lastname'] = $u_l;
					$u_data[$i]['password'] = $u_p;
					$u_data[$i]['email'] = $u_e;
					$u_data[$i]['role'] = $u_r;
					$i++;

				}

			}

		}
		
		// print_r($u_data);

		// process each user

		$errors = array();
		$complete = 0;

		foreach ($u_data as $ud) {

			// check for errors
			$u_errors = 0;

			$user_line = '<b>' . htmlspecialchars($ud['username']) . '|' . htmlspecialchars($ud['firstname']) . '|' . htmlspecialchars($ud['lastname']) . '|' . htmlspecialchars($ud['password']) . '|' . htmlspecialchars($ud['email']) . '|' . htmlspecialchars($ud['role']) . '</b>';

			if (!is_email($ud['email'])) {
				$errors[] = 'Invalid email address: ' . $user_line;
				$u_errors++;
			}

			if (!validate_username($ud['username'])) {
				$errors[] = 'Invalid username: ' . $user_line;
				$u_errors++;
			}

			if (username_exists($ud['username'])) {
				$errors[] = 'Username already exists: ' . $user_line;
				$u_errors++;
			}

			
			$email_exists = $wpdb->get_row("SELECT user_email FROM $wpdb->users WHERE user_email = '" . $ud['email'] . "'");
			if ($email_exists) {
				$errors[] = 'Email address already in use: ' . $user_line;
				$u_errors++;
			}

			
			if ($u_errors == 0) {

				// generate passwords if none were provided in the import
				if ($u_p == '') {
					$password = substr(md5(uniqid(microtime())), 0, 7);
				} else {
					$password = $ud['password'];
				}

				// create user
				$user_id = wp_insert_user(array(
								"user_login" => $ud['username'],
								"first_name" => $ud['firstname'],
								"last_name" => $ud['lastname'],
								"user_pass" => $password,
								"user_email" => $ud['email'])
								);
				if (!$user_id) {
					$errors[] = 'System error! Could not add: ' . $user_line;
				} else {
					wp_new_user_notification($user_id, $password);
					$complete++;

					// set role
					if ($ud['role'] == '') {
						$ruser = new WP_User($user_id);
						$ruser->set_role($the_role);
					} else {
						$ud['role'] = strtolower($ud['role']);
						$ruser = new WP_User($user_id);
						$ruser->set_role($ud['role']);
					}
				}



			}

		}




		// show result

		if ($complete > 0) {

			$result .= "<p>Processing complete: <b>" . $complete . " users imported!</b></p>";
			$result .= "<p>Role: <b>" . $the_role . "</b></p>";
			$result .= "<p>(These users will receive an email notification with their assigned password.)</p>";

		}
		
		if ($errors) {

			$result .= '<h4 style="color: #FF0000;">Errors!</h4><ul>';
			foreach ($errors as $er) {
				$result .= '<li>' . $er . '</li>';
			}
			$result .= '</ul>';

		}
		


		//
		// END Processing
		//





	} ?>

	<div class=wrap>

	<h2>Import Users v<?php echo $ddui_version; ?></h2>

	<p>For information and updates, please visit:<br />
	<a href="http://www.dagondesign.com/articles/import-users-plugin-for-wordpress/">http://www.dagondesign.com/articles/import-users-plugin-for-wordpress/</a></p>

	<?php 
		if ($result != "") { 
			echo '<div style="border: 1px solid #000000; padding: 10px;">';
			echo '<h4>Results</h4>';
			echo trim($result); 
			echo '</div>';
		} 
	?>


	<form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>"  >
	<input type="hidden" name="info_update" id="info_update" value="true" />


	<div style="padding: 0 0 15px 12px;">

		<?php print $formatinfo; ?>
		<h3>User Data</h3>
		May specify the (regex) delimiter between name, email and password (default "[|]").
		<input type="text" name="delimiter" value="[|]" />
		<br />
		May type username|password|email pairs directly.<br />
		<textarea name="ddui_data" cols="100" rows="12"></textarea>
		<br />
		May submit a file.
		<input type="file" id="ddui_file" name="ddui_file" value="TestInput" />

		<div style="margin: 6px 0 0 0;">
		<br /><b>Role for these users:</b> 			
		<select name="ddui_role">		
		<?php
			if ( !isset($wp_roles) ) 
				$wp_roles = new WP_Roles();
			foreach ($wp_roles->get_names() as $role=>$roleName) {
			echo '<option value="'.$role.'">'.$roleName.'</option>';
			}
		?>	
		</select>
		</div>
	</div>


	<div class="submit">
		<input type="submit" name="info_update" value="<?php _e('Import Users'); ?> &raquo;" />
	</div>
	</form>
	</div><?php
}


add_action('admin_menu', 'ddiu_add_management_pages');

?>
