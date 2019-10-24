

        <!-- page content -->
        <div class="right_col clearfix reduce_gap" role="main">
			<div class="page-title">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?=base_url(); ?>dashboard">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">Accounts</li>
            
					</ol>
				</nav>
				<div class="title_left col-md-6">
					<h3>All Account</h3>
				</div>
      
       
			</div>
            <div class="clearfix"></div>
         <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                     <div class="x_title">
                    <ul class="nav navbar-right panel_toolbox text-center">
                      <li><a class="collapse-link with-icon common-btn"><i class="fa fa-download"></i><p>Download</p></a>
                      </li>
                      <!--li><a class="close-link"><i class="fa fa-filter"></i><p>Filter</p></a>
                      </li-->
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="table-responsive reduce-height">
                      <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                          <tr class="headings">                           
                            <th width="7%" class="column-title text-center">S.NO. </th>
														<th width="10%" class="column-title">Account </th> 
                            <th width="15%" class="column-title">Website Title </th>  
                            <th width="20%" class="column-title">Website URL </th>  
														<th width="20%" class="column-title">Direct Manager </th>  
														<th width="20%" class="column-title">Relationship Manager </th>  
													
                          </tr>
                        </thead>

                        <tbody>
												<?php 
													
												
													//echo '<option value="'.$value.'" '.(($value=='United States')?'selected="selected"':"").'>'.$value.'</option>';
														 $sl='1';
														 $full_name="";
														 if (!empty($results)) 
														 {
                        	foreach($results as $row) {
														$status='';
														if($row->flag=='1')
														{
															$status="1";
														}
														else
														{
															$status="0";
														}
														$direct_manger_namediret="";
														$direct_manger_name="";
														$rela_manger_name="";
														$relation_exu_name="";
														$rel_client_manager="";
														$rel_client_admin="";
														$loginrole_id=$this->session->userdata('role_id');
														$loginuser_id=$this->session->userdata('user_id');
if($loginrole_id=='1')
{
								$sql= "SELECT f_name,l_name FROM user JOIN users_groups ON user.id =users_groups.user_id JOIN project_users ON project_users.user_id =users_groups.user_id JOIN project_details ON project_users.project_id =project_details.id WHERE project_details.id != '' and project_details.id = ".$row->id." and users_groups.role_id = '2' order by user.last_login DESC  LIMIT 0,1";
								$query = $this->db->query($sql);
								if ($query->num_rows() > 0) {
								foreach ($query->result() as $row11) {

									$direct_manger_name=$row11->f_name." ".$row11->l_name;
								}}



								$rela_manger_name="";

								$sql1= "SELECT f_name,l_name FROM user JOIN users_groups ON user.id =users_groups.user_id JOIN project_users ON project_users.user_id =users_groups.user_id JOIN project_details ON project_users.project_id =project_details.id WHERE project_details.id != '' and project_details.id = ".$row->id." and users_groups.role_id = '5' order by user.last_login DESC  LIMIT 0,1";
							$query1 = $this->db->query($sql1);
							if ($query1->num_rows() > 0) {
							foreach ($query1->result() as $row112) {

									$rela_manger_name=$row112->f_name." ".$row112->l_name;
							}}

						}
						elseif($loginrole_id=='2')
						{
							$sql= "SELECT f_name,l_name FROM user JOIN users_groups ON user.id =users_groups.user_id JOIN project_users ON project_users.user_id =users_groups.user_id JOIN project_details ON project_users.project_id =project_details.id WHERE project_details.id != '' and project_details.id = ".$row->id." and users_groups.role_id = '3' order by user.last_login DESC  LIMIT 0,1";
							$query = $this->db->query($sql);
							if ($query->num_rows() > 0) {
							foreach ($query->result() as $row11) {

								$direct_manger_name=$row11->f_name." ".$row11->l_name;
							}}



							$rela_manger_name="";

							$sql1= "SELECT f_name,l_name FROM user JOIN users_groups ON user.id =users_groups.user_id JOIN project_users ON project_users.user_id =users_groups.user_id JOIN project_details ON project_users.project_id =project_details.id WHERE project_details.id != '' and project_details.id = ".$row->id." and users_groups.role_id = '4' order by user.last_login DESC  LIMIT 0,1";
						$query1 = $this->db->query($sql1);
						if ($query1->num_rows() > 0) {
						foreach ($query1->result() as $row112) {

								$rela_manger_name=$row112->f_name." ".$row112->l_name;
						}}
						}

						elseif($loginrole_id=='3')
						{

							
							$sql= "SELECT f_name,l_name FROM user JOIN users_groups ON user.id =users_groups.user_id JOIN project_users ON project_users.user_id =users_groups.user_id JOIN project_details ON project_users.project_id =project_details.id WHERE project_details.id != '' and project_details.id = ".$row->id." and users_groups.role_id = '3' and user.id !=".$loginuser_id." order by user.last_login DESC  LIMIT 0,1";
							$query = $this->db->query($sql);
							if ($query->num_rows() > 0) {
							foreach ($query->result() as $row11) {

								$direct_manger_namediret=$row11->f_name." ".$row11->l_name;
							}}



							$rela_exu_namesupport="";

							$sql1= "SELECT f_name,l_name FROM user JOIN users_groups ON user.id =users_groups.user_id JOIN project_users ON project_users.user_id =users_groups.user_id JOIN project_details ON project_users.project_id =project_details.id WHERE project_details.id != '' and project_details.id = ".$row->id." and users_groups.role_id = '8' and user.id !=".$loginuser_id." order by user.last_login DESC  LIMIT 0,1";
						$query1 = $this->db->query($sql1);
						if ($query1->num_rows() > 0) {
						foreach ($query1->result() as $row112) {

								$rela_exu_namesupport=$row112->f_name." ".$row112->l_name;
						}}

						if($rela_exu_namesupport !='')
						{
							$relation_exu_name="<br>Support Contact- ".$rela_exu_namesupport;
						}

					$direct_manger_name=$direct_manger_namediret." ".$relation_exu_name ;



					$sql2= "SELECT f_name,l_name FROM user JOIN users_groups ON user.id =users_groups.user_id JOIN project_users ON project_users.user_id =users_groups.user_id JOIN project_details ON project_users.project_id =project_details.id WHERE project_details.id != '' and project_details.id = ".$row->id." and users_groups.role_id = '5' and user.id !=".$loginuser_id." order by user.last_login DESC  LIMIT 0,1";
							$query2 = $this->db->query($sql2);
							if ($query2->num_rows() > 0) {
							foreach ($query2->result() as $row112) {

								$rel_client_admin=$row112->f_name." ".$row112->l_name;
							}}

							$sql3= "SELECT f_name,l_name FROM user JOIN users_groups ON user.id =users_groups.user_id JOIN project_users ON project_users.user_id =users_groups.user_id JOIN project_details ON project_users.project_id =project_details.id WHERE project_details.id != '' and project_details.id = ".$row->id." and users_groups.role_id = '7' and user.id !=".$loginuser_id." order by user.last_login DESC  LIMIT 0,1";
							$query3 = $this->db->query($sql3);
							if ($query3->num_rows() > 0) {
							foreach ($query3->result() as $row3) {

								$rel_client_manager=$row3->f_name." ".$row3->l_name;
							}}

							if($rela_exu_namesupport !='')
						{
							$relation_exu_name="<br>Client Executive- ".$rela_exu_namesupport;
						}
						if($rel_client_manager !='')
						{
							$rel_client_manager="<br>Client Manager- ".$rel_client_manager;
						}
						

							$rela_manger_name=$rel_client_admin." ".$rel_client_manager." ".$relation_exu_name ;
						
				}


				elseif($loginrole_id=='4')
						{

							
							$sql= "SELECT f_name,l_name FROM user JOIN users_groups ON user.id =users_groups.user_id JOIN project_users ON project_users.user_id =users_groups.user_id JOIN project_details ON project_users.project_id =project_details.id WHERE project_details.id != '' and project_details.id = ".$row->id." and users_groups.role_id = '3' and user.id !=".$loginuser_id." order by user.last_login DESC  LIMIT 0,1";
							$query = $this->db->query($sql);
							if ($query->num_rows() > 0) {
							foreach ($query->result() as $row11) {

								$direct_manger_namediret=$row11->f_name." ".$row11->l_name;
							}}



							$rela_exu_namesupport="";

							$sql1= "SELECT f_name,l_name FROM user JOIN users_groups ON user.id =users_groups.user_id JOIN project_users ON project_users.user_id =users_groups.user_id JOIN project_details ON project_users.project_id =project_details.id WHERE project_details.id != '' and project_details.id = ".$row->id." and users_groups.role_id = '8' and user.id !=".$loginuser_id." order by user.last_login DESC  LIMIT 0,1";
						$query1 = $this->db->query($sql1);
						if ($query1->num_rows() > 0) {
						foreach ($query1->result() as $row112) {

								$rela_exu_namesupport=$row112->f_name." ".$row112->l_name;
						}}

					

					$direct_manger_name=$direct_manger_namediret ;



					$sql2= "SELECT f_name,l_name FROM user JOIN users_groups ON user.id =users_groups.user_id JOIN project_users ON project_users.user_id =users_groups.user_id JOIN project_details ON project_users.project_id =project_details.id WHERE project_details.id != '' and project_details.id = ".$row->id." and users_groups.role_id = '5' and user.id !=".$loginuser_id." order by user.last_login DESC  LIMIT 0,1";
							$query2 = $this->db->query($sql2);
							if ($query2->num_rows() > 0) {
							foreach ($query2->result() as $row112) {

								$rel_client_admin=$row112->f_name." ".$row112->l_name;
							}}

							$sql3= "SELECT f_name,l_name FROM user JOIN users_groups ON user.id =users_groups.user_id JOIN project_users ON project_users.user_id =users_groups.user_id JOIN project_details ON project_users.project_id =project_details.id WHERE project_details.id != '' and project_details.id = ".$row->id." and users_groups.role_id = '7' and user.id !=".$loginuser_id." order by user.last_login DESC  LIMIT 0,1";
							$query3 = $this->db->query($sql3);
							if ($query3->num_rows() > 0) {
							foreach ($query3->result() as $row3) {

								$rel_client_manager=$row3->f_name." ".$row3->l_name;
							}}

							if($rela_exu_namesupport !='')
						{
							$relation_exu_name="<br>Client Executive- ".$rela_exu_namesupport;
						}
						if($rel_client_manager !='')
						{
							$rel_client_manager="<br>Client Manager- ".$rel_client_manager;
						}
						

							$rela_manger_name=$rel_client_admin." ".$rel_client_manager." ".$relation_exu_name ;
						
				}


				elseif($loginrole_id=='5')
						{

							
							$sql= "SELECT f_name,l_name FROM user JOIN users_groups ON user.id =users_groups.user_id JOIN project_users ON project_users.user_id =users_groups.user_id JOIN project_details ON project_users.project_id =project_details.id WHERE project_details.id != '' and project_details.id = ".$row->id." and users_groups.role_id = '3' and user.id !=".$loginuser_id." order by user.last_login DESC  LIMIT 0,1";
							$query = $this->db->query($sql);
							if ($query->num_rows() > 0) {
							foreach ($query->result() as $row11) {

								$direct_manger_namediret=$row11->f_name." ".$row11->l_name;
							}}



							$rela_exu_namesupport="";

							$sql1= "SELECT f_name,l_name FROM user JOIN users_groups ON user.id =users_groups.user_id JOIN project_users ON project_users.user_id =users_groups.user_id JOIN project_details ON project_users.project_id =project_details.id WHERE project_details.id != '' and project_details.id = ".$row->id." and users_groups.role_id = '4' and user.id !=".$loginuser_id." order by user.last_login DESC  LIMIT 0,1";
						$query1 = $this->db->query($sql1);
						if ($query1->num_rows() > 0) {
						foreach ($query1->result() as $row112) {

								$rela_exu_namesupport=$row112->f_name." ".$row112->l_name;
						}}
						if($rela_exu_namesupport !='')
						{
							$relation_exu_name="<br>Support Contact- ".$rela_exu_namesupport;
						}

					$direct_manger_name=$direct_manger_namediret." ".$relation_exu_name ;
				



					$sql2= "SELECT f_name,l_name FROM user JOIN users_groups ON user.id =users_groups.user_id JOIN project_users ON project_users.user_id =users_groups.user_id JOIN project_details ON project_users.project_id =project_details.id WHERE project_details.id != '' and project_details.id = ".$row->id." and users_groups.role_id = '8' and user.id !=".$loginuser_id." order by user.last_login DESC  LIMIT 0,1";
							$query2 = $this->db->query($sql2);
							if ($query2->num_rows() > 0) {
							foreach ($query2->result() as $row112) {

								$rel_client_admin=$row112->f_name." ".$row112->l_name;
							}}

							$sql3= "SELECT f_name,l_name FROM user JOIN users_groups ON user.id =users_groups.user_id JOIN project_users ON project_users.user_id =users_groups.user_id JOIN project_details ON project_users.project_id =project_details.id WHERE project_details.id != '' and project_details.id = ".$row->id." and users_groups.role_id = '7' and user.id !=".$loginuser_id." order by user.last_login DESC  LIMIT 0,1";
							$query3 = $this->db->query($sql3);
							if ($query3->num_rows() > 0) {
							foreach ($query3->result() as $row3) {

								$rel_client_manager=$row3->f_name." ".$row3->l_name;
							}}

						
						if($rel_client_manager !='')
						{
							$rel_client_manager="<br>Client Manager- ".$rel_client_manager;
						}

						if($rel_client_admin !='')
						{
						
							$rel_client_admin="<br>User- ".$rel_client_admin;
						}
						

							$rela_manger_name=$rel_client_manager." ".$rel_client_admin ;
						
				}

				elseif($loginrole_id=='6')
				{

					
					$sql= "SELECT f_name,l_name FROM user JOIN users_groups ON user.id =users_groups.user_id JOIN project_users ON project_users.user_id =users_groups.user_id JOIN project_details ON project_users.project_id =project_details.id WHERE project_details.id != '' and project_details.id = ".$row->id." and users_groups.role_id = '3' and user.id !=".$loginuser_id." order by user.last_login DESC  LIMIT 0,1";
					$query = $this->db->query($sql);
					if ($query->num_rows() > 0) {
					foreach ($query->result() as $row11) {

						$direct_manger_namediret=$row11->f_name." ".$row11->l_name;
					}}



					$rela_exu_namesupport="";

					$sql1= "SELECT f_name,l_name FROM user JOIN users_groups ON user.id =users_groups.user_id JOIN project_users ON project_users.user_id =users_groups.user_id JOIN project_details ON project_users.project_id =project_details.id WHERE project_details.id != '' and project_details.id = ".$row->id." and users_groups.role_id = '4' and user.id !=".$loginuser_id." order by user.last_login DESC  LIMIT 0,1";
				$query1 = $this->db->query($sql1);
				if ($query1->num_rows() > 0) {
				foreach ($query1->result() as $row112) {

						$rela_exu_namesupport=$row112->f_name." ".$row112->l_name;
				}}
				if($rela_exu_namesupport !='')
				{
					$relation_exu_name="<br>Support Contact- ".$rela_exu_namesupport;
				}

			$direct_manger_name=$direct_manger_namediret." ".$relation_exu_name ;
		



			$sql2= "SELECT f_name,l_name FROM user JOIN users_groups ON user.id =users_groups.user_id JOIN project_users ON project_users.user_id =users_groups.user_id JOIN project_details ON project_users.project_id =project_details.id WHERE project_details.id != '' and project_details.id = ".$row->id." and users_groups.role_id = '8' and user.id !=".$loginuser_id." order by user.last_login DESC  LIMIT 0,1";
					$query2 = $this->db->query($sql2);
					if ($query2->num_rows() > 0) {
					foreach ($query2->result() as $row112) {

						$rel_client_admin=$row112->f_name." ".$row112->l_name;
					}}

					$sql3= "SELECT f_name,l_name FROM user JOIN users_groups ON user.id =users_groups.user_id JOIN project_users ON project_users.user_id =users_groups.user_id JOIN project_details ON project_users.project_id =project_details.id WHERE project_details.id != '' and project_details.id = ".$row->id." and users_groups.role_id = '7' and user.id !=".$loginuser_id." order by user.last_login DESC  LIMIT 0,1";
					$query3 = $this->db->query($sql3);
					if ($query3->num_rows() > 0) {
					foreach ($query3->result() as $row3) {

						$rel_client_manager=$row3->f_name." ".$row3->l_name;
					}}

				
				if($rel_client_manager !='')
				{
					$rel_client_manager="<br>Client Manager- ".$rel_client_manager;
				}

				if($rel_client_admin !='')
				{
				
					$rel_client_admin="<br>User- ".$rel_client_admin;
				}
				

					$rela_manger_name=$rel_client_manager." ".$rel_client_admin ;
				
		}

		elseif($loginrole_id=='7')
				{

					
					$sql= "SELECT f_name,l_name FROM user JOIN users_groups ON user.id =users_groups.user_id JOIN project_users ON project_users.user_id =users_groups.user_id JOIN project_details ON project_users.project_id =project_details.id WHERE project_details.id != '' and project_details.id = ".$row->id." and users_groups.role_id = '5' and user.id !=".$loginuser_id." order by user.last_login DESC  LIMIT 0,1";
					$query = $this->db->query($sql);
					if ($query->num_rows() > 0) {
					foreach ($query->result() as $row11) {

						$direct_manger_namediret=$row11->f_name." ".$row11->l_name;
					}}




			$direct_manger_name=$direct_manger_namediret;
		



			$sql2= "SELECT f_name,l_name FROM user JOIN users_groups ON user.id =users_groups.user_id JOIN project_users ON project_users.user_id =users_groups.user_id JOIN project_details ON project_users.project_id =project_details.id WHERE project_details.id != '' and project_details.id = ".$row->id." and users_groups.role_id = '8' and user.id !=".$loginuser_id." order by user.last_login DESC  LIMIT 0,1";
					$query2 = $this->db->query($sql2);
					if ($query2->num_rows() > 0) {
					foreach ($query2->result() as $row112) {

						$rel_client_admin=$row112->f_name." ".$row112->l_name;
					}}

					$sql3= "SELECT f_name,l_name FROM user JOIN users_groups ON user.id =users_groups.user_id JOIN project_users ON project_users.user_id =users_groups.user_id JOIN project_details ON project_users.project_id =project_details.id WHERE project_details.id != '' and project_details.id = ".$row->id." and users_groups.role_id = '3' and user.id !=".$loginuser_id." order by user.last_login DESC  LIMIT 0,1";
					$query3 = $this->db->query($sql3);
					if ($query3->num_rows() > 0) {
					foreach ($query3->result() as $row3) {

						$rel_client_manager=$row3->f_name." ".$row3->l_name;
					}}

				
				if($rel_client_manager !='')
				{
					$rel_client_manager="<br>Client Manager- ".$rel_client_manager;
				}

				if($rel_client_admin !='')
				{
				
					$rel_client_admin="<br>User- ".$rel_client_admin;
				}
				

					$rela_manger_name=$rel_client_manager." ".$rel_client_admin ;
				
		}

		elseif($loginrole_id=='8')
		{

			
			$sql= "SELECT f_name,l_name FROM user JOIN users_groups ON user.id =users_groups.user_id JOIN project_users ON project_users.user_id =users_groups.user_id JOIN project_details ON project_users.project_id =project_details.id WHERE project_details.id != '' and project_details.id = ".$row->id." and users_groups.role_id = '7' and user.id !=".$loginuser_id." order by user.last_login DESC  LIMIT 0,1";
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0) {
			foreach ($query->result() as $row11) {

				$direct_manger_namediret=$row11->f_name." ".$row11->l_name;
			}}




	$direct_manger_name=$direct_manger_namediret;





			$sql3= "SELECT f_name,l_name FROM user JOIN users_groups ON user.id =users_groups.user_id JOIN project_users ON project_users.user_id =users_groups.user_id JOIN project_details ON project_users.project_id =project_details.id WHERE project_details.id != '' and project_details.id = ".$row->id." and users_groups.role_id = '3' and user.id !=".$loginuser_id." order by user.last_login DESC  LIMIT 0,1";
			$query3 = $this->db->query($sql3);
			if ($query3->num_rows() > 0) {
			foreach ($query3->result() as $row3) {

				$rel_client_manager=$row3->f_name." ".$row3->l_name;
			}}

		
		if($rel_client_manager !='')
		{
			$rel_client_manager="<br>Relationship Manager- ".$rel_client_manager;
		}

	
		

			$rela_manger_name=$rel_client_manager ;
		
}


														
													//	$full_name=$row->f_name." ".$row->l_name;
														
													echo "
                                                
													<tr class=\"gradeU\">
													".form_open('admin/Dashboard/view_edit_proj_web')."
													<td hidden > <input type=\"text\" id=\"proj_id\" name=\"proj_id\"  value='".$row->id."' onchange=\"getdirectmanager($row->id,$row->id)\" ></td>
															<td>".$sl++."</td>
															<td>".$row->accountnumber."</td>
															<td>".$row->pname."</td>
															<td>".$row->website."</td>
															<td ><span id=\"$row->id\">".$direct_manger_name ."</span></td>
															<td >".$rela_manger_name."</td>
														
															".				
											form_close()."
													</tr>
													
													";
													
													}}?>

                        </tbody>

                      </table>
					  <b>Result Showing : <?php echo $all_count?></b>
                                <nav aria-label="Page navigation example" style="float: right;">
                                    <?php echo $this->pagination->create_links(); ?>
                                </nav>
                  </div>
                </div>
              </div>
        </div>


        <!-- /page content -->
		


     
      </div>
    </div>
	
		<script type="text/javascript">

function getdirectmanager(projid,rowid)
{


	var rowid=rowid;

	$.ajax({
		type: 'post',
		url: '<?=base_url(); ?>admin/Account/get_directmanagerporj',
		data: 'project_id='+projid, 
			success:function(data) {
	
			$.each(data, function(key, value) {

			$('#'+rowid).html("");
			$('#'+rowid).append(document.createTextNode(value.direct_manager_name));
							
					return value;
			
			}); 
		}
		});
}
</script>