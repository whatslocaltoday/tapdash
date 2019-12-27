<?php
Class Google_analytics_tp extends CI_Model {

    public function insert_google_account_detail($accountId,$accountName,$projIDpop) {
       $condition = "g_account_id =$accountId";
            $this->db->select('*');
            $this->db->from('google_analytics_tp');
            $this->db->where($condition);
            $this->db->limit(1);
            $query = $this->db->get();
            if ($query->num_rows() == 1) {

                $updt_pass = array('g_account_name' => $accountName,'project_id' => $projIDpop);
                $this->db->where('g_account_id', $accountId);
                $this->db->update('google_analytics_tp', $updt_pass);
                if ($this->db->affected_rows() > 0) {
                    return true;
                }
                return false;
            }
            else
            {
                $insdatauser = array('g_account_id' => $accountId, 'g_account_name	' => $accountName, 'project_id	' => $projIDpop);
    
                $this->db->insert('google_analytics_tp', $insdatauser);
                if ($this->db->affected_rows() > 0) {
                    return true;
                }
                return false;
            }
       
    }


    public function insert_google_account_webproperty($web_Id,$web_Name,$account_id) {

        $condition1 = "g_account_id ='$account_id'";
        $this->db->select('*');
        $this->db->from('google_analytics_tp');
        $this->db->where($condition1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data2 = $query->result();
            $google_analytics_tp_id= $data2[0]->id;

            $condition = "web_prop_id ='$web_Id'";
            $this->db->select('*');
            $this->db->from('google_analytics_web_tp');
            $this->db->where($condition);
            $this->db->limit(1);
            $query = $this->db->get();
            if ($query->num_rows() == 1) {

                $updt_pass = array('web_prop_name' => $web_Name);
                $this->db->where('web_prop_id', $web_Id);
                $this->db->update('google_analytics_web_tp', $updt_pass);
                if ($this->db->affected_rows() > 0) {
                    return true;
                }
                return false;
            }
            else
            {
                $insdatauser = array('google_analytics_tp_id' => $google_analytics_tp_id, 'web_prop_id	' => $web_Id, 'web_prop_name' => $web_Name);
    
                $this->db->insert('google_analytics_web_tp', $insdatauser);
                if ($this->db->affected_rows() > 0) {
                    return true;
                }
                return false;
            }
        }
        
        
     }


     public function insert_google_account_profileproperty($profile_Id,$profile_Name,$web_property_ID) {

       // google_analytics_web_tp
        $condition1 = "web_prop_id ='$web_property_ID' ";
        $this->db->select('*');
        $this->db->from('google_analytics_web_tp');
        $this->db->where($condition1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data2 = $query->result();
           $google_analytics_web_id= $data2[0]->id;
           $google_analytics_tp_id= $data2[0]->google_analytics_tp_id;

           $condition = "web_profile_id ='$profile_Id'";
           $this->db->select('*');
           $this->db->from('google_analytics_profile_tp');
           $this->db->where($condition);
           $this->db->limit(1);
           $query1 = $this->db->get();
           if ($query1->num_rows() == 1) {

               $updt_pass = array('web_profile_name' => $profile_Name);
               $this->db->where('web_profile_id', $profile_Id);
               $this->db->update('google_analytics_profile_tp', $updt_pass);
               $projIDpop=$this->session->userdata('projID');
               $updt_pass = array('analytics_view_id' => $profile_Id);
               $this->db->where('id', $projIDpop);
               $this->db->update('project_details', $updt_pass);
            //    if ($this->db->affected_rows() > 0) {
            //        return true;
            //    }

               if ($this->db->affected_rows() > 0) {
                return true;
               }
               return false;
           }
           else
           {
               $insdatauser = array('google_analytics_web_tp_id' => $google_analytics_web_id, 'web_profile_id' => $profile_Id, 'web_profile_name' => $profile_Name);
   
               $this->db->insert('google_analytics_profile_tp', $insdatauser);
               if ($this->db->affected_rows() > 0) {
                $projIDpop=$this->session->userdata('projID');
                $updt_pass = array('analytics_view_id' => $profile_Id);
                $this->db->where('id', $projIDpop);
                $this->db->update('project_details', $updt_pass);
                   return true;
               }
               return false;
           }
        }
        
      
        
     }


     public function get_google_account_profileproperty($projIDpop) {
       
        $condition = "id ='$projIDpop'";
        $this->db->select('*');
        $this->db->from('project_details');
        $this->db->where($condition);
        $this->db->order_by("id", "desc");
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data2 = $query->result();
           $google_analytics_profile_id= $data2[0]->analytics_view_id;
            return $google_analytics_profile_id;
        }

        // $this->db->select('*');
        // $this->db->from('google_analytics_profile_tp');
        // $this->db->join('users_groups', 'user.id =users_groups.user_id');
        // $this->db->order_by("id", "desc");
        // $this->db->limit(1);
        // $query = $this->db->get();
        // if ($query->num_rows() > 0) {
        //     $data2 = $query->result();
        //    $google_analytics_profile_id= $data2[0]->web_profile_id;
        //     return $google_analytics_profile_id;
        // }
     }


     public function get_analytics_token_session_by_project($project_Id) {
         $condition1 = "id ='$project_Id' and analytics_session_token !=''";
        $this->db->select('*');
        $this->db->from('project_details');
        $this->db->where($condition1);
        $this->db->order_by("id", "desc");
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data2 = $query->result();
           $analytics_session_token= $data2[0]->analytics_session_token;
            return $analytics_session_token;
        }
        return false;
     }

     public function update_analytics_token_session_by_project($token_sessopn,$projIDpop) {
        

        $updt_pass = array('analytics_session_token' => $token_sessopn,'analytics_view_id'=>'');
                $this->db->where('id', $projIDpop);
                $this->db->update('project_details', $updt_pass);
                if ($this->db->affected_rows() > 0) {
                    return true;
                }
                return false;
    }
    

}
?>