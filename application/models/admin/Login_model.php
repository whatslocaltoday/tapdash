<?php



Class Login_model extends CI_Model {





	function randomPassword() {

		$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';

		$pass = array(); //remember to declare $pass as an array

		$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache

		for ($i = 0; $i < 10; $i++) {

			$n = rand(0, $alphaLength);

			$pass[] = $alphabet[$n];

		}

		return implode($pass); //turn the array into a string

	}

	

	function forgotPassword() {

		$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';

		$pass = array(); //remember to declare $pass as an array

		$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache

		for ($i = 0; $i < 20; $i++) {

			$n = rand(0, $alphaLength);

			$pass[] = $alphabet[$n];

		}

		return implode($pass); //turn the array into a string

	}



		// Insert registration data in database

		public function registration_insertclientadmin($data) {



				// Query to check whether username already exist or not

				

				//for user table

				$insdatauser=array(

					'f_name'=>$data['f_name'],

					'l_name'=>$data['l_name'],

					'u_email'=>$data['u_email'],

					'u_password'=>md5($data['n_password']),

					'date'=>$data['cdate']

				);



				



				// Query to insert data in database 

				$this->db->insert('user', $insdatauser);

				if ($this->db->affected_rows() > 0) {

					$user_id = $this->db->insert_id();



					// for project table data

					$rand_str=$this->randomPassword();

					

					$insdataproject=array(

						'pname'=>$data['proj_name'],

						'website'=>$data['proj_website'],

						'cdate'=>$data['cdate'],

						'cuser'=>$user_id,

						'accountnumber'=>$rand_str

					);



					$this->db->insert('project_details', $insdataproject);

					$project_id = $this->db->insert_id();



					// for usergroup 

					$insdatausergrp=array(

						'user_id'=>$user_id,

						'role_id'=>5

					);

					$this->db->insert('users_groups', $insdatausergrp);



					//for project user



					$insdataprojctusr=array(

						'user_id'=>$user_id,

						'user_role_id'=>5,

						'is_active'=>1,

						'project_id'=>$project_id

					);

					//print_r($insdataprojctusr);

					

					$this->db->insert('project_users', $insdataprojctusr);

					

					//for project user



					$condition = "user_role_id ='5'";

				

					$this->db->select('*');

					$this->db->from('acl_master');

					$this->db->where($condition);

					$this->db->limit(1);

					$query = $this->db->get();

					if ($query->num_rows() == 1) {

					$result=$query->result();

					foreach($result as $rs)

					{

						$acl=$rs->acl;

					}
					$insdataacluser=array(

						'user_id'=>$user_id,

						'user_role_id'=>5,

						'acl'=>$acl

					);
					$this->db->insert('acl_user', $insdataacluser);	

					}

				return true;

					}

					else {

						return false;

			}
		}
		public function send_reset_password($data) {

			$rand_str=$this->randomPassword();

			$updt_pass=array(

                'u_password'=>md5($rand_str)

            );

			$this->db->where('u_email',$data);

			$this->db->update('user',$updt_pass);

			if ($this->db->affected_rows() > 0) {


				//response mail 

		  $message1="<div style='Margin: 0; padding-top: 0; padding-bottom: 0; -webkit-text-size-adjust: 100%; padding-right: 0; padding-left: 0; width: 100%; direction: ltr; background-color: #f5f5f5'>

		  <center style='width: 100%; table-layout: fixed; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; background-color: #f5f5f5;' >

			  <div style='max-width: 600px; margin: 0 auto; padding: 0'>

				  <table cellspacing='0' cellpadding='0' border='0' width='600' align='center' style='border-spacing: 0; border: 0; border-collapse: collapse; font-family: 'Open Sans', sans-serif; color: #444444; Margin: 0 auto; width: 600px; max-width: 600px'>

					  <tbody>

						  <tr>

							  <td align='center' width='600' style='padding-top: 0; padding-bottom: 0; text-align: left; max-width: 600px'>

								  <table width='100%' cellspacing='0' cellpadding='0' border='0' style='border-spacing: 0; font-family: 'Open Sans', sans-serif; color: #444444; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%'>

									  <tbody>

										  <tr>

											  <td style='border-width: 0; border-collapse: collapse; border-spacing: 0; font-family: 'Open Sans', sans-serif; font-size: 12px; font-weight: 400; line-height: 16px; text-align: right; padding:13px;'>

											  &nbsp;

											  </td>

										  </tr>

									  </tbody>

								  </table>

								  <table cellpadding='0' cellspacing='0' border='0' width='100%' align='center' bgcolor='#ffffff' style='border-width: 0; border-collapse: collapse; border-spacing: 0; font-family: 'Open Sans', sans-serif; font-size: 12px; font-weight: 400; line-height: normal; color: #ffffff;border-top:solid 1px #d6d6d6;'>

								  <tbody>

								  

								  <tr bgcolor='#fff' style='border-width: 0; background-color: #fff; background-image: none; background-repeat: repeat; background-position: top left; background-attachment: scroll'>

									  <td style='padding:30px 0 0 50px;'><img src='https://tapouts.online/admin-assets/build/images/tapout-logo.png' width='70' alt='whats local today' /></td>

								  </tr>

								  

								  </tbody>

								  </table>

								  

								  <table cellpadding='0' cellspacing='0' border='0' width='100%' align='center' bgcolor='#ffffff' style='border: 0; border-collapse: collapse; border-spacing: 0; font-family: 'Open Sans', sans-serif; font-size: 21px; font-weight: 400; line-height: 21px;'>

								  <tbody>

									  <tr>

										  <td style='border: 0; color: #444444; padding: 15px 50px'>

											  <table cellpadding='0' cellspacing='0' border='0' width='100%'>

												  <tbody>

													  <tr style='border: 0'>

														  <td align='left' style='border: 0; padding-top: 18px;font-size: 31px;'><p style= margin: 0 0 0px 0; padding: 0'>Reset Password</p></td>

													  </tr>

													  <tr style='border: 0'>

														  <td align='left' style='border: 0; padding-top: 8px; padding-bottom: 8px;'><p style='color: #444444; font-family: 'Open Sans', sans-serif; font-size: 16px; line-height: 25px; margin: 10 0 10px 0; padding: 0'>Seems like you forgot your password for Tapouts Dashboard<a style='color: #444444; text-decoration: none; cursor: text; pointer-events: none'   rel='noreferrer'><font style='color: #444444'></font></a>.</p></td>

													 </tr>

													 

												  </tbody>

											  </table>

											  

											  <table border='0' cellspacing='0' cellpadding='0'>

												  <tbody>

													  <tr>

															<td width='80px'style='padding-top: 5px;padding-bottom: 5px;'><strong>Email</strong></td>

															<td width='20px'style='padding-top: 5px;padding-bottom: 5px;'><strong>:</strong></td>

															<td width='80px'style='padding-top: 5px;padding-bottom: 5px;'>$data</td>

														</tr>

														<tr>

														<td width='80px'style='padding-top:5px;padding-bottom: 5px;'><strong>Password</strong></td>

														<td width='20px'style='padding-top: 5px;padding-bottom: 5px;'><strong>:</strong></td>

														<td width='80px'style='padding-top: 5px;padding-bottom: 5px;'>$rand_str</td>

													</tr>

												  </tbody>

											  </table>

											  

											

											  

										  </td>

									  </tr>

								  </tbody>

								  </table>

								  

								  <table width='100%' style='border-spacing: 0; font-family: 'Open Sans', sans-serif; color: #999999; width: 100%'>

									  <tbody>

										  <tr>

											  <td align='center' valign='top'  style='padding-top: 25px; padding-bottom: 25px'>

												  

												  <table width='100%' style='border-width: 0; border-collapse: collapse; border-spacing: 0; font-family: 'Open Sans', sans-serif; font-size: 12px; font-weight: 400; line-height: normal; color: #444444'>

													  <tbody>

														  

														  

														  <tr style='border-width: 0'>

															  <td align='center' style='border-width: 0; color: #333333; font-family: 'Open Sans', sans-serif; font-size: 10px; font-weight: 400; line-height: 11px; padding-top: 0px; padding-bottom: 0px; padding-right: 0; padding-left: 0; word-break: break-word'><img src='https://tapouts.online/admin-assets/build/images/tapout-logo.png?x45764' width='50' alt='whats local today' /></td>

														  </tr>

														  

														  <tr style='border-width: 0'>

															  <td  align='center' style='border-width: 0; font-family: 'Open Sans', sans-serif; font-size: 11px; font-weight: 400; line-height: 15px; padding-top: 9px; padding-bottom: 35px; padding-right: 0; padding-left: 0; word-break: break-word; color: #a7a7a7'>

																  <span class='optout_region'>

																	  <a style='color: #a7a7a7; cursor: text; text-decoration: none; pointer-events: none; font-weight: normal' href='#' onclick='return false' rel='noreferrer'>

																		  <strong style='color: #a7a7a7; cursor: text; font-weight: normal'>

																			  <span style='color: #a7a7a7; cursor: text; font-weight: normal'>

																				  <font style='color: #a7a7a7; cursor: text'>Tapout LTD is Head Quartered in the UK.<br>KEMP HOUSE 160 CITY ROAD<br>LONDON EC1V 2NX.</font>

																			  </span>

																		  </strong>

																	  </a>

																  </span>

															  </td>

														  </tr>

														  

													  </tbody>

												  </table>

												  

											  </td>

										  </tr>

									  </tbody>

								  </table>

								  

							  </td>

						  </tr>

					  </tbody>

				  </table>

			  </div>

		  </center>

	  </div>";


	  $sent = send_email($data, 'Forgot Password Tapouts Dashboard', $message1);		

		 	return true;

																	

			}

			else

			{

				return false;

			}

		}



	// Read data using username and password

	function email_exists($key)

	{

			$this->db->where('u_email',$key);

			$query = $this->db->get('user');

			if ($query->num_rows() > 0){

					return true;

			}

			else{

					return false;

			}

	}







		public function login($data) {



		 $condition = "u_email =" . "'" . $data['u_email'] . "' AND " . "u_password =" . "'" . $data['u_password'] . "' AND flag='1'";

		

		$this->db->select('*');

		$this->db->from('user');

		$this->db->where($condition);

		$this->db->limit(1);

		$query = $this->db->get();



		if ($query->num_rows() == 1) {

			 $rsedata=$query->result();

			

			$lastlogin=array(

                'last_login'=>time()

            );

    

    

      $this->db->where('id',$rsedata[0]->id);

			$this->db->update('user',$lastlogin);


			//select user role id from user group table

			$data=$query->result();

			

			$condition1 = "user_id =" . "'" . $data[0]->id  . "'";

		

			$this->db->select('*');

			$this->db->from('users_groups');

			$this->db->where($condition1);

			$this->db->limit(1);

			$query1 = $this->db->get();

			if ($query1->num_rows() == 1) {

				$data1=$query1->result();

				
				//use role 

				$condition2 = "user_id =". $data[0]->id . " AND user_role_id =" . $data1[0]->role_id." and project_id in (select id from project_details where flag='1' order by id asc) " ;

				$this->db->select('*');

				$this->db->from('project_users');

				$this->db->where($condition2);

				$this->db->order_by("id", "asc");

				$this->db->limit(1);

				$query2 = $this->db->get();

				$data2=$query2->result();

				$session_data = array(

					'user_name' => $data[0]->f_name,

					'uemail' => $data[0]->u_email,

					);


				$condition8 = "id =". $data1[0]->role_id  ;

				

				$this->db->select('*');

				$this->db->from('role');

				$this->db->where($condition8);

				$query8 = $this->db->get();

				$data8=$query8->result();


				$this->session->set_userdata('user_name', $data[0]->f_name);

				if($data[0]->last_web=='0')
				{	
					$this->session->set_userdata('projID', $data2[0]->project_id);
				}
				else
				{
					$this->session->set_userdata('projID', $data[0]->last_web);
				}
				

				$this->session->set_userdata('user_id', $data[0]->id);

				$this->session->set_userdata('uemail', $data[0]->u_email);

				$this->session->set_userdata('role_id', $data1[0]->role_id);

				$this->session->set_userdata('session_role_name', $data8[0]->name);

				$this->session->set_userdata('logged_in', $session_data);


				// fetch data about acl

				$condition3 = "user_id =". $data[0]->id . " AND user_role_id =" . $data1[0]->role_id ;

				$this->db->select('*');

				$this->db->from('acl_user');

				$this->db->where($condition3);

				$query3 = $this->db->get();

				$data3=$query3->result();



				$this->session->set_userdata('user_ap', $data3[0]->acl);

			}
				return true;

			} else {

				

				return false;

					}

		}



	// Read data from database to show data in admin page

	public function read_user_information($username) {



		$condition = "u_email =" . "'" . $username . "'";

		$this->db->select('*');

		$this->db->from('user');

		$this->db->where($condition);

		$this->db->limit(1);

		$query = $this->db->get();



		if ($query->num_rows() == 1) {

			return $query->result();

			} else {

			return false;

					}

			}

}



?>