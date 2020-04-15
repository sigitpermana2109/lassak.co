<?php 
function is_logged_in()
{
	$ci = get_instance();
	if (!$ci->session->userdata('email_admin')) {
		redirect('admin/Auth_admin');
	} else {
		$id_admin 	= $ci->session->userdata('id_admin');
		$email		= $ci->session->userdata('email_admin');

		$userAccess =  $ci->db->get_where('t_admin', [
			'id_admin' 	=> $id_admin,
			'email' 	=> $email
		]);

		// if($userAccess->num_rows() < 1){
		// 	redirect('auth/blocked');
		// }
	}
}
?>