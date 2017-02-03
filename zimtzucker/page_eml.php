<?php 
/*
Template Name: ThankYou for Order
*/



// If post is not valid, this is error. Redirect to the home page.
if (!dataIsValid($_POST)) {
	echo '<script>window.location.replace("'.get_bloginfo('url').'");</script>';
	die;
} 


$orderData = $_POST;

get_header(); 

the_post(); 

?>


		
			<?php the_content(); ?>


<?php 
function textHtmlFilter() { return 'text/html'; }
add_filter('wp_mail_content_type', 'textHtmlFilter');
$to = 'jeanravel@gmx.de';
$subject = "ZZDelivery Order From: ".$orderData[address][email];
$message = '<table><thead><tr><td style="border: 1px solid black; padding: 0px 5px; font-weight: 700; text-transform: capitalize; background-color: #cadece; color: black;">Field Name</td><td style="border: 1px solid black; padding: 0px 5px; font-weight: 700; text-transform: capitalize; background-color: #cadece; color: black;">Value</td></tr></thead><tbody>';

	foreach ($orderData[address] as $key => $value) : 
		$message .= '
			<tr>
				<td style="border: 1px solid black; padding: 0px 5px; font-weight: 700; text-transform: capitalize; background-color: #bbb; color: rgb(68, 68, 68);">'.$key.'</td>
				<td style="border: 1px solid black; padding: 0px 5px; background-color: #f5f5f5; color: rgb(68, 68, 68);">'.$value.'</td>
			</tr>';
	endforeach;
	$message .='<tr><td>ORDER DATA:</td></tr>';
	foreach ($orderData[order] as $key => $value) : 
		$message .= '
			<tr>
				<td style="border: 1px solid black; padding: 0px 5px; font-weight: 700; text-transform: capitalize; background-color: #bbb; color: rgb(68, 68, 68);">'.$key.'</td>
				<td style="border: 1px solid black; padding: 0px 5px; background-color: #f5f5f5; color: rgb(68, 68, 68);">'.get_the_title($value).'</td>
			</tr>';
	endforeach;

$message .= '</tbody></table>';

wp_mail($to, $subject, $message);
remove_filter('wp_mail_content_type', 'textHtmlFilter');

get_footer(); 




// LIBRARY

function dataIsValid($data) {
	$state = true;

	// If address or order is missing, FALSE
	if (!isset($_POST['address']) || !isset($_POST['order'])) {
		$state = false;
	}
	// If order array is empty, FALSE
	if (count($_POST['order']) <= 0) {
		$state = false;
	}
	// If any of these fields are empty, FALSE
	if ($_POST[address][name] == "" || !isset($_POST[address][name])) { $state = false; }
	if ($_POST[address][phone] == "" || !isset($_POST[address][phone])) { $state = false; }
	if ($_POST[address][email] == "" || !isset($_POST[address][email])) { $state = false; }
	if ($_POST[address][address] == "" || !isset($_POST[address][address])) { $state = false; }

	return $state;
}



?>


