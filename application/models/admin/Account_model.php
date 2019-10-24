<?php

Class Account_model extends CI_Model {

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

	public function fetch_webiste_under_useraccount($data,$limit, $offset)

    {

        $user_id=$this->session->userdata('user_id');

        $role_id=$this->session->userdata('role_id');

        if($role_id !='1')

        {

            $where="project_users.is_active ='1' and project_users.user_id =".$user_id ." and project_details.id !=''";

        }

        if($role_id =='1')

        {

            $where="project_details.id !=''";

        }

        $this->db->distinct();

        $this->db->select('project_details.*');

        $this->db->from('project_details');

		$this->db->join('project_users', 'project_users.project_id =project_details.id');

        $this->db->where($where);

        $this->db->limit($limit, $offset);
        $query = $this->db->get();
            if($query->num_rows()>0){

                $data=$query->result();

                return $data;

            }

            else{

                return false;

            }

    }

    public function read_count_fetch_webiste_under_useraccount($data)

    {

        $user_id=$this->session->userdata('user_id');

        $role_id=$this->session->userdata('role_id');

        if($role_id !='1')

        {

            $where="project_users.is_active ='1' and project_users.user_id =".$user_id ." and project_details.id !=''";

        }

        if($role_id =='1')

        {

            $where="project_details.id !=''";

        }

        $this->db->distinct();

        $this->db->select('project_details.*');

        $this->db->from('project_details');

		$this->db->join('project_users', 'project_users.project_id =project_details.id');
            $this->db->where($where);

            $query = $this->db->get();

            if($query->num_rows()>0){
                $num = $query->num_rows();
                        return $num;
                     }
                     else{
                         return false;
             }

    }

    public function fetch_webiste_under_useraccount_dashboard()

    {

        $user_id=$this->session->userdata('user_id');

        $role_id=$this->session->userdata('role_id');

        if($role_id !='1')

        {

            $where="project_details.id in(select distinct project_id from project_users where is_active ='1' and user_id =".$user_id .")   GROUP BY userplanprocess.proj_id LIMIT 3";

        }

        if($role_id =='1')

        {

            $where="project_details.id !=''  GROUP BY userplanprocess.proj_id LIMIT 3";

        }

        $this->db->select_sum('userplanprocess.traffic');

        $this->db->select_sum('userplanprocess.lead');

        $this->db->select('userplanprocess.proj_id,project_details.pname,project_details.flag');

        $this->db->from('userplanprocess');

        $this->db->join('project_details', 'userplanprocess.proj_id =project_details.id');

        $this->db->where($where);

        $query = $this->db->get();

            if($query->num_rows()>0){

                $data=$query->result();

		// print_r($data);

		// die;

                return $data;

            }

            else{

                return false;

            }

    }

    public function get_directmanagerasper_proj($data)

    {

        $user_id=$this->session->userdata('user_id');

        $role_id=$this->session->userdata('role_id');

        if($role_id !='1')

        {

            $where="project_users.is_active ='1' and project_users.user_id =".$user_id ." and project_details.id !=''";

        }

        if($role_id =='1')

        {

            $where="project_details.id !='' and project_details.id='$data' and users_groups.role_id ='2'";

        }

        $this->db->select('concat(user.f_name," ",user.l_name) as direct_manager_name');

        $this->db->from('user');

        $this->db->join('users_groups', 'user.id =users_groups.user_id');

        $this->db->join('project_users', 'project_users.user_id =users_groups.user_id');

        $this->db->join('project_details', 'project_users.project_id =project_details.id');

         $this->db->where($where);

        $query = $this->db->get();

            if($query->num_rows()>0){

                $data=$query->result();

                return $data;

            }

            else{

                return false;

            }

    }

    // function for Plan process

    public function insert_new_daily_plan_process($data)

    {

        $this->db->insert('userplanprocess',$data);

        if ($this->db->affected_rows() > 0) {

     return true;

     } else {

     return false;

     }

    }

    public function update_daily_plan_process($data,$id)

    {

        $this->db->where('id',$id);

        $this->db->update('userplanprocess',$data);

        if ($this->db->affected_rows() > 0) {

        return true;

        }

        else

        {

            return false;

        }

    }

	public function record_countview_project_plan_process($proj_id,$from_date,$to_date,$social_id)

   		{

               $user_id=$this->session->userdata('user_id');

               $role_id=$this->session->userdata('role_id');

               if($role_id !='1')

               {

                   $where="project_users.is_active ='1' and project_users.user_id =".$user_id ." and project_details.id !=''";

               }

               if($role_id =='1')

               {

                   $where="project_details.id !=''";

               }

               $this->db->distinct();

               $this->db->select('userplanprocess.id');

               $this->db->from('userplanprocess');

               $this->db->join('project_users', 'project_users.project_id =userplanprocess.proj_id');

               $this->db->join('project_details', 'project_details.id =project_users.project_id ');

                $this->db->where($where);

                if($from_date){

                    $this->db->where('userplanprocess.plan_date >=',$from_date);

                }

                if($to_date){

                    $this->db->where('userplanprocess.plan_date <=',$to_date);

                }

                if($proj_id !='')

                {

                    $this->db->where('userplanprocess.proj_id =',$proj_id);

                }
                $this->db->where('userplanprocess.social_id =',$social_id);

               $query = $this->db->get();

               if($query->num_rows()>0){

               $num = $query->num_rows();

                       return $num;

                    }

                    else{

                        return false;

                    }

           }

    public function view_project_plan_process($limit,$offset,$proj_id,$from_date,$to_date,$social_id)

    {

    $user_id=$this->session->userdata('user_id');

        $role_id=$this->session->userdata('role_id');

        if($role_id !='1')

        {

            $where="project_users.is_active ='1' and project_users.user_id =".$user_id ." and project_details.id !=''";

        }

        if($role_id =='1')

        {

            $where="project_details.id !=''";

        }

		$this->db->distinct();

        $this->db->select('userplanprocess.*,project_details.pname,project_details.website,currency.symbol');

        $this->db->from('userplanprocess');

        $this->db->join('project_users', 'project_users.project_id =userplanprocess.proj_id');

        $this->db->join('project_details', 'project_details.id =project_users.project_id ');

        $this->db->join('currency', 'project_details.currency_id =currency.id ');

        $this->db->where($where);

        if($from_date){

            $this->db->where('userplanprocess.plan_date >=',$from_date);

        }

        if($to_date){

            $this->db->where('userplanprocess.plan_date <=',$to_date);

        }

        if($proj_id !='')

       {

        $this->db->where('userplanprocess.proj_id =',$proj_id);

        }
        $this->db->where('userplanprocess.social_id =',$social_id);
            $this->db->limit($limit, $offset);

        $query = $this->db->get();

            if($query->num_rows()>0){

                $data=$query->result();

                return $data;

            }

            else{

                return false;

            }

        }

        public function view_project_plan_process_slected($plan_id)

        {

            $user_id=$this->session->userdata('user_id');

            $role_id=$this->session->userdata('role_id');

            if($role_id !='1')

            {

                $where="project_users.is_active ='1' and project_users.user_id =".$user_id ." and project_details.id !='' and userplanprocess.id=".$plan_id;

            }

            if($role_id =='1')

            {

                $where="project_details.id !='' and userplanprocess.id=".$plan_id;

            }

            $this->db->distinct();

            $this->db->select('userplanprocess.*,project_details.pname,project_details.website');

            $this->db->from('userplanprocess');

            $this->db->join('project_users', 'project_users.project_id =userplanprocess.proj_id');

            $this->db->join('project_details', 'project_details.id =project_users.project_id ');

            $this->db->where($where);

            $query = $this->db->get();

                if($query->num_rows()>0){

                    $data=$query->result();

                    return $data;

                }

                else{

                    return false;

                }

        }

    public function fn_delete_plan_progress_selected($data)

    {  

        $this->db->where('id',$data);

        $this->db->where('proj_id !=', null);

        $this->db->delete('userplanprocess');

        if ($this->db->affected_rows() > 0) {

            return true;

        }

    }

    public function get_prject_account_no($data)

    {  

        $this->db->where('accountnumber',$data);

        $this->db->select('id');

        $this->db->from('project_details');

        $query=$this->db->get();

            if($query->num_rows()>0){

                $data=$query->result();

                return $data;

            }

            else{

                return false;

            }

    }

    public function insert_day_wise_adwordtata($data)

    {  

        $this->db->insert('userplanprocess',$data);

        if ($this->db->affected_rows() > 0) {

            return true;

        }

    }

    public function fetch_total_view_under_useraccount()

    {

        $user_id=$this->session->userdata('user_id');

        $role_id=$this->session->userdata('role_id');

        if($role_id !='1')

        {

            if(!empty($_SESSION['projID']))

            {

             $proj_idsesion=$_SESSION['projID'];

             $project_query="and project_details.id=".$proj_idsesion."";

            }

            else

            {

                $project_query="";

            }

            $where="project_users.is_active ='1' ".$project_query." and project_users.user_id =".$user_id. " and project_details.id !=''";

        }

        if($role_id =='1')

        {

            if(!empty($_SESSION['projID']))

            {

             $proj_idsesion=$_SESSION['projID'];

             $project_query="and userplanprocess.proj_id=".$proj_idsesion."";

            }

            else

            {

                $project_query="";

            }

            $where="userplanprocess.id !=''" .$project_query;

        }

        $this->db->distinct();

        $this->db->select_sum('userplanprocess.view');

       // $this->db->select('userplanprocess.view');

        $this->db->from('userplanprocess');

        if($role_id !='1')

        {

        $this->db->join('project_users', 'project_users.project_id =userplanprocess.proj_id');

		$this->db->join('project_details', 'project_users.project_id =project_details.id');

        }

            $this->db->where($where);

        $query = $this->db->get();

            if($query->num_rows()>0){

                $data=$query->result();

                return $data;

            }

            else{

                return false;

            }

    }

    public function fetch_total_traffic_under_useraccount()

    {

        $user_id=$this->session->userdata('user_id');

        $role_id=$this->session->userdata('role_id');

        if($role_id !='1')

        {

            if(!empty($_SESSION['projID']))

            {

             $proj_idsesion=$_SESSION['projID'];

             $project_query="and project_details.id=".$proj_idsesion."";

            }

            else

            {

                $project_query="";

            }

            $where="project_users.is_active ='1' ".$project_query." and project_users.user_id =".$user_id ." and project_details.id !=''";

        }

        if($role_id =='1')

        {

            if(!empty($_SESSION['projID']))

            {

             $proj_idsesion=$_SESSION['projID'];

             $project_query="and userplanprocess.proj_id=".$proj_idsesion."";

            }

            else

            {

                $project_query="";

            }

            $where="userplanprocess.id !=''" .$project_query;

        }

        $this->db->distinct();

        $this->db->select_sum('userplanprocess.traffic');

       // $this->db->select('userplanprocess.view');

        $this->db->from('userplanprocess');

        if($role_id !='1')

        {

        $this->db->join('project_users', 'project_users.project_id =userplanprocess.proj_id');

		$this->db->join('project_details', 'project_users.project_id =project_details.id');

        }

            $this->db->where($where);

        $query = $this->db->get();

            if($query->num_rows()>0){

                $data=$query->result();

                return $data;

            }

            else{

                return false;

            }

    }

    public function fetch_total_lead_under_useraccount()

    {

        $user_id=$this->session->userdata('user_id');

        $role_id=$this->session->userdata('role_id');

        if($role_id !='1')

        {

            if(!empty($_SESSION['projID']))

            {

             $proj_idsesion=$_SESSION['projID'];

             $project_query="and project_details.id=".$proj_idsesion."";

            }

            else

            {

                $project_query="";

            }

            $where="project_users.is_active ='1' ".$project_query." and project_users.user_id =".$user_id ." and project_details.id !=''";

        }

        if($role_id =='1')

        {

            if(!empty($_SESSION['projID']))

            {

             $proj_idsesion=$_SESSION['projID'];

             $project_query="and userplanprocess.proj_id=".$proj_idsesion."";

            }

            else

            {

                $project_query="";

            }

            $where="userplanprocess.id !=''" .$project_query;

        }

        $this->db->distinct();

        $this->db->select_sum('userplanprocess.lead');

       // $this->db->select('userplanprocess.view');

        $this->db->from('userplanprocess');

        if($role_id !='1')

        {

        $this->db->join('project_users', 'project_users.project_id =userplanprocess.proj_id');

		$this->db->join('project_details', 'project_users.project_id =project_details.id');

        }

            $this->db->where($where);

        $query = $this->db->get();

            if($query->num_rows()>0){

                $data=$query->result();

                return $data;

            }

            else{

                return false;

            }

    }

    public function fetch_graph_data_under_useraccount()

    {

        $user_id=$this->session->userdata('user_id');

        $role_id=$this->session->userdata('role_id');

        if($role_id !='1')

        {

            if(!empty($_SESSION['projID']))

            {

             $proj_idsesion=$_SESSION['projID'];

             $project_query="and project_details.id=".$proj_idsesion."";

            }

            else

            {

                $project_query="";

            }

            $where="project_users.is_active ='1' ".$project_query." and project_users.user_id =".$user_id ." and project_details.id !='' GROUP BY DATE(plan_date)";

        }

        if($role_id =='1')

        {

            if(!empty($_SESSION['projID']))

            {

             $proj_idsesion=$_SESSION['projID'];

             $project_query="and userplanprocess.proj_id=".$proj_idsesion."";

            }

            else

            {

                $project_query="";

            }

            $where="userplanprocess.id !='' ".$project_query."  GROUP BY DATE(plan_date)";

        }

        //$this->db->distinct();

        $this->db->select_sum('userplanprocess.view');

        $this->db->select_sum('userplanprocess.traffic');

        $this->db->select_sum('userplanprocess.lead');

        $this->db->select('userplanprocess.plan_date');

        $this->db->from('userplanprocess');

        if($role_id !='1')

        {

        $this->db->join('project_users', 'project_users.project_id =userplanprocess.proj_id');

		$this->db->join('project_details', 'project_users.project_id =project_details.id');

        }

            $this->db->where($where);

        $query = $this->db->get();

            if($query->num_rows()>0){

                $data=$query->result();

                return $data;

            }

            else{

                return false;

            }

    }

}

?>