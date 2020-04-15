<?php 
function is_login()
{
	$ci = get_instance();
	if (!$ci->session->userdata('email')) {
		redirect('Auth_member');
	} else {
		$id_member 	= $ci->session->userdata('id_member');
		$email		= $ci->session->userdata('email');

		$userAccess =  $ci->db->get_where('t_member', [
			'id_member'	=> $id_member,
			'email' 	=> $email
		]);

		// if($userAccess->num_rows() < 1){
		// 	redirect('auth/blocked');
		// }
	}
}
?>