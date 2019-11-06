<?php
//class use for all general requirement
Class Admintype_model extends CI_Model {
    public function get_user_type($data) {
        if ($data == '1') {
            $cond = "id >" . "'" . $data . "'";
        } else if ($data == '4') {
            $cond = "id >" . "'" . $data . "'";
        } else if ($data == '5') {
            $cond = "id >" . "'" . $data . "'";
        } else {
            $cond = "id >=" . "'" . $data . "'";
        }
        $this->db->select('*');
        $this->db->from('role');
        if ($data != '') {
            $this->db->where($cond);
        }
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }
    public function fetch_per_user_masterlist_role($ajdevice) {
        $data = array();
        // $data[permsn_id]="";
        // $data[permsn_name]="";
        $permsn_id;
        $permsn_name;
        $cond = "user_role_id =" . "'" . $ajdevice . "'";
        $cond1 = "is_active ='1'";
        $this->db->select('*');
        $this->db->from('acl_master');
        $this->db->where($cond);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data2 = $query->result();
            $menu_optionuser = explode(",", $data2[0]->acl);
            $this->db->select('*');
            $this->db->from('permission');
            $this->db->where($cond1);
            $query1 = $this->db->get();
            if ($query1->num_rows() > 0) {
                $data1 = $query1->result();
                //print_r($data1);
                foreach ($data1 as & $value1) {
                    $permsn_id = $value1->id;
                    $permsn_name = $value1->name;
                    foreach ($menu_optionuser as & $value) {
                        // print $value;
                        if ($value == $permsn_id) {
                            $data[$permsn_id] = $permsn_name;
                        }
                    }
                }
            }
            return $data;
        } else {
            return false;
        }
    }
    public function get_role_per_user_as_change($ajdevice, $user_id) {
        $data = array();
        $permsn_id;
        $permsn_name;
        $cond = "user_role_id =" . $ajdevice . " and user_id=" . $user_id . "";
        $this->db->select('*');
        $this->db->from('acl_user');
        $this->db->where($cond);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data2 = $query->result();
            $menu_optionuser = explode(",", $data2[0]->acl);
            $this->db->select('*');
            $this->db->from('permission');
            $query1 = $this->db->get();
            if ($query1->num_rows() > 0) {
                $data1 = $query1->result();
                //print_r($data1);
                foreach ($data1 as & $value1) {
                    $permsn_id = $value1->id;
                    $permsn_name = $value1->name;
                    foreach ($menu_optionuser as & $value) {
                        // print $value;
                        if ($value == $permsn_id) {
                            $data[$permsn_id] = $permsn_name;
                        }
                    }
                    $data['id_user'] = '1';
                }
            }
            return $data;
        } else {
            $cond = "user_role_id =" . "'" . $ajdevice . "'";
            $this->db->select('*');
            $this->db->from('acl_master');
            $this->db->where($cond);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                $data2 = $query->result();
                $menu_optionuser = explode(",", $data2[0]->acl);
                $this->db->select('*');
                $this->db->from('permission');
                $query1 = $this->db->get();
                if ($query1->num_rows() > 0) {
                    $data1 = $query1->result();
                    //print_r($data1);
                    foreach ($data1 as & $value1) {
                        $permsn_id = $value1->id;
                        $permsn_name = $value1->name;
                        foreach ($menu_optionuser as & $value) {
                            // print $value;
                            if ($value == $permsn_id) {
                                $data[$permsn_id] = $permsn_name;
                            }
                        }
                    }
                }
                return $data;
            } else {
                return false;
            }
        }
    }
    function randomPassword() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0;$i < 7;$i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
        
    }
    public function registration_insert($data) {
        //for user table
        $rand_str = $this->randomPassword();
        $user_Email = $data['email'];
        $user_id = $this->session->userdata('user_id');
        $insdatauser = array('f_name' => $data['f_name'], 'l_name' => $data['l_name'], 'u_email' => $data['email'], 'gender' => $data['gender'], 'u_password' => md5($rand_str), 'cuser' => $user_id, 'date' => $data['cdate']);
        $this->db->insert('user', $insdatauser);
        if ($this->db->affected_rows() > 0) {
            $user_id = $this->db->insert_id();
            // for usergroup
            $insdatausergrp = array('user_id' => $user_id, 'role_id' => $data['user_type']);
            $this->db->insert('users_groups', $insdatausergrp);
            // set suer role as per selection
            $insdataacluser = array('user_id' => $user_id, 'user_role_id' => $data['user_type'], 'acl' => $data['permsn_name']);
            $this->db->insert('acl_user', $insdataacluser);
            // set uers project
            $selcd_proj = explode(",", $data['selcd_proj']);
            // $selcd_proj[]=explode(",",$data['selcd_proj']);
            foreach ($selcd_proj as & $value) {
                $insdataprjusers = array('user_id' => $user_id, 'user_role_id' => $data['user_type'], 'project_id' => $value, 'is_active' => '1');
                $this->db->insert('project_users', $insdataprjusers);
            }
            //code for email when new user register
            //response mail
            $message1 = "<div style='Margin: 0; padding-top: 0; padding-bottom: 0; -webkit-text-size-adjust: 100%; padding-right: 0; padding-left: 0; width: 100%; direction: ltr; background-color: #f5f5f5'>
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
                                              <td align='left' style='border: 0; padding-top: 18px;font-size: 31px;'><p style= margin: 0 0 0px 0; padding: 0'>Access a new Tapouts dashboard account</p></td>
                                          </tr>
                                          <tr style='border: 0'>
                                              <td align='left' style='border: 0; padding-top: 8px; padding-bottom: 8px;'><p style='color: #444444; font-family: 'Open Sans', sans-serif; font-size: 16px; line-height: 25px; margin: 10 0 10px 0; padding: 0'>To access this account below is login detail for Tapouts Dashboard<a style='color: #444444; text-decoration: none; cursor: text; pointer-events: none'   rel='noreferrer'><font style='color: #444444'></font></a>.</p></td>
                                         </tr>
                                      </tbody>
                                  </table>
                                  <table border='0' cellspacing='0' cellpadding='0'>
                                      <tbody>
                                          <tr>
                                                <td width='80px'style='padding-top: 5px;padding-bottom: 5px;'><strong>Email</strong></td>
                                                <td width='20px'style='padding-top: 5px;padding-bottom: 5px;'><strong>:</strong></td>
                                                <td width='80px'style='padding-top: 5px;padding-bottom: 5px;'>$user_Email</td>
                                            </tr>
                                            <tr>
                                            <td width='80px'style='padding-top:5px;padding-bottom: 5px;'><strong>Password</strong></td>
                                            <td width='20px'style='padding-top: 5px;padding-bottom: 5px;'><strong>:</strong></td>
                                            <td width='80px'style='padding-top: 5px;padding-bottom: 5px;'>$rand_str</td>
                                        </tr>
                                      </tbody>
                                  </table>
                                  <table cellpadding='0' cellspacing='0' border='0' width='100%'>
                                      <tbody>
                                          <tr style='border: 0'>
                                              <td align='left' style='border: 0; padding-top: 8px; padding-bottom: 8px;'><p style='color: #444444; font-family: 'Open Sans', sans-serif; font-size: 16px; line-height: 25px; margin: 10 0 10px 0; padding: 0'>Bear in mind that the access level you're granted determines what features you can view or edit.<a style='color: #444444; text-decoration: none; cursor: text; pointer-events: none'   rel='noreferrer'><font style='color: #444444'></font></a>.</p></td>
                                         </tr>
                                         <tr style='border: 0'>
                                         <td align='left' style='border: 0; padding-top: 8px; padding-bottom: 8px;'><p style='color: #58a2e2; font-family: 'Open Sans', sans-serif; font-size: 16px; line-height: 25px; margin: 10 0 10px 0; padding: 0'><a href='http://dashboard.tapouts.online' target='_blank' style='color: #444444; text-decoration: none; cursor: text; pointer-events: none' rel='noreferrer'><font style='color: #444444'>Click Here To Login</font></a>.</p></td>
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
            $sent = send_email($user_Email, 'Welcome to Tapouts Dashboard', $message1);
            return true;
        } else {
            return false;
        }
    }
    //add new webiste
    public function web_registration_insert($data) {
        //for user table
        $rand_str = $this->randomPassword();
        $user_id = $this->session->userdata('user_id');
        $insdatauser = array('pname' => $data['pname'], 'account_id' => $data['account_id'], 'website' => $data['website'], 'google_a_id' => $data['google_a_id'], 'face_analytic_id' => $data['face_analytic_id'], 'country_code' => $data['country_code'], 'time_zone' => $data['time_zone'], 'currency_id' => $data['currency_id'], 'accountnumber' => md5($rand_str), 'cuser' => $user_id, 'flag' => $data['flag'], 'cdate' => $data['cdate']);
        //     print_r($insdatauser);
        //    // die;
        $this->db->insert('project_details', $insdatauser);
        if ($this->db->affected_rows() > 0) {
            $project_id = $this->db->insert_id();
            // for project group
            $insdatausergrp = array('user_id' => $user_id, 'user_role_id' => '', 'is_active' => $data['flag'], 'project_id' => $project_id);
            $this->db->insert('project_users', $insdatausergrp);
            return true;
        } else {
            return false;
        }
    }
    public function fetch_user_under_user($data, $limit, $offset) {
        $user_id = $this->session->userdata('user_id');
        $role_id = $this->session->userdata('role_id');
        if ($role_id == '1') {
            $where = "project_details.id !='' and project_details.flag='1' and project_users.project_id in ( SELECT project_details.id FROM project_users as project_users LEFT JOIN project_details as project_details ON project_users.project_id = project_details.id where project_users.user_role_id='5')";
        } else if ($role_id == '5') {
            $where = "project_users.is_active ='1' and project_users.user_id !=" . $user_id . " and project_details.id !='' and project_details.flag='1' and project_users.user_role_id >" . $role_id . "  and project_users.project_id in ( SELECT project_details.id FROM project_users as project_users LEFT JOIN project_details as project_details ON project_users.project_id = project_details.id where project_users.user_id='$user_id')";
        } else if ($role_id == '2') {
            $where = "project_users.is_active ='1' and project_users.user_id !=" . $user_id . " and project_details.id !='' and project_details.flag='1' and project_users.user_role_id >" . $role_id . "  and project_users.project_id in ( SELECT project_details.id FROM project_users as project_users LEFT JOIN project_details as project_details ON project_users.project_id = project_details.id where project_users.user_id='$user_id')";
        } else {
            $where = "project_users.is_active ='1' and project_users.user_id !=" . $user_id . " and project_details.id !='' and project_details.flag='1' and project_users.user_role_id >=" . $role_id . "  and project_users.project_id in ( SELECT project_details.id FROM project_users as project_users LEFT JOIN project_details as project_details ON project_users.project_id = project_details.id where project_users.user_id='$user_id')";
        }
        $where12 = "user.id !='$user_id'";
        $this->db->distinct();
        $this->db->select('user.*');
        $this->db->select('role.name as role_name');
        $this->db->from('user');
        $this->db->join('users_groups', 'user.id =users_groups.user_id');
        $this->db->join('project_users', 'project_users.user_id =user.id');
        $this->db->join('project_details', 'project_details.id =project_users.project_id');
        $this->db->join('role', 'users_groups.role_id =role.id');
        $this->db->where($where);
        $this->db->where($where12);
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data = $query->result();
            return $data;
        } else {
            return false;
        }
    }
    public function read_count_fetch_user_under_user($data) {
        $user_id = $this->session->userdata('user_id');
        $role_id = $this->session->userdata('role_id');
        if ($role_id == '1') {
            $where = "project_details.id !='' and project_details.flag='1' and project_users.project_id in ( SELECT project_details.id FROM project_users as project_users LEFT JOIN project_details as project_details ON project_users.project_id = project_details.id where project_users.user_role_id='5')";
        } else if ($role_id == '5') {
            $where = "project_users.is_active ='1' and project_users.user_id !=" . $user_id . " and project_details.id !='' and project_details.flag='1' and project_users.user_role_id >" . $role_id . "  and project_users.project_id in ( SELECT project_details.id FROM project_users as project_users LEFT JOIN project_details as project_details ON project_users.project_id = project_details.id where project_users.user_id='$user_id')";
        } else if ($role_id == '2') {
            $where = "project_users.is_active ='1' and project_users.user_id !=" . $user_id . " and project_details.id !='' and project_details.flag='1' and project_users.user_role_id >" . $role_id . "  and project_users.project_id in ( SELECT project_details.id FROM project_users as project_users LEFT JOIN project_details as project_details ON project_users.project_id = project_details.id where project_users.user_id='$user_id')";
        } else {
            $where = "project_users.is_active ='1' and project_users.user_id !=" . $user_id . " and project_details.id !='' and project_details.flag='1' and project_users.user_role_id >=" . $role_id . "  and project_users.project_id in ( SELECT project_details.id FROM project_users as project_users LEFT JOIN project_details as project_details ON project_users.project_id = project_details.id where project_users.user_id='$user_id')";
        }
        $this->db->distinct();
        $this->db->select('user.*');
        $this->db->select('role.name as role_name');
        $this->db->from('user');
        $this->db->join('users_groups', 'user.id =users_groups.user_id');
        $this->db->join('project_users', 'project_users.user_id =user.id');
        $this->db->join('project_details', 'project_details.id =project_users.project_id');
        $this->db->join('role', 'users_groups.role_id =role.id');
        $this->db->where($where);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $num = $query->num_rows();
            return $num;
        } else {
            return false;
        }
    }
    public function check_webistediplicay($date1, $data2) {
        $where = "pname =" . $date1 . " and website =" . $data2;
        $this->db->select('*');
        $this->db->from('project_details');
        $this->db->where($where);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data = $query->result();
            $data3 = "1";
            return $data3;
        } else {
            $data3 = "0";
            return $data3;
        }
    }
    public function fetch_webiste_under_user($data, $limit, $offset) {
        $user_id = $this->session->userdata('user_id');
        $role_id = $this->session->userdata('role_id');
        if ($role_id != '1') {
            $where = "project_users.is_active ='1' and project_users.user_id =" . $user_id . " and project_details.id !=''";
        }
        if ($role_id == '1') {
            $where = "project_details.id !=''";
        }
        $this->db->distinct();
        $this->db->select('project_details.*');
        $this->db->from('project_details');
        $this->db->join('project_users', 'project_users.project_id =project_details.id');
        $this->db->where($where);
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data = $query->result();
            return $data;
        } else {
            return false;
        }
    }
    public function read_count_fetch_webiste_under_user($data) {
        $user_id = $this->session->userdata('user_id');
        $role_id = $this->session->userdata('role_id');
        if ($role_id != '1') {
            $where = "project_users.is_active ='1' and project_users.user_id =" . $user_id . " and project_details.id !=''";
        }
        if ($role_id == '1') {
            $where = "project_details.id !=''";
        }
        $this->db->distinct();
        $this->db->select('project_details.*');
        $this->db->from('project_details');
        $this->db->join('project_users', 'project_users.project_id =project_details.id');
        $this->db->where($where);
        //$this->db->limit($limit, $offset);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $num = $query->num_rows();
            return $num;
        } else {
            return false;
        }
    }
    public function fetch_webiste_under_user_active_proj($data) {
        $user_id = $this->session->userdata('user_id');
        $role_id = $this->session->userdata('role_id');
        if ($role_id != '1') {
            $where = "project_users.is_active ='1' and project_users.user_id =" . $user_id . " and project_details.id !='' and project_details.flag='1'";
        }
        if ($role_id == '1') {
            $where = "project_details.id !='' and project_details.flag='1'";
        }
        $this->db->distinct();
        $this->db->select('project_details.id, project_details.website');
        $this->db->from('project_details');
        $this->db->join('project_users', 'project_users.project_id =project_details.id');
        $this->db->where($where);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data = $query->result();
            return $data;
        } else {
            return false;
        }
    }
    public function usr_my_project() {
        $user_id = $this->session->userdata('user_id');
        $role_id = $this->session->userdata('role_id');
        if ($role_id == '1') {
            $where = "project_users.is_active ='1' and  project_details.id !='' and project_details.flag='1'";
        } else {
            $where = "project_users.is_active ='1' and project_users.user_id =" . $user_id . " and project_details.id !='' and project_details.flag='1'";
        }
        $this->db->distinct();
        $this->db->select('project_details.website,project_details.id,project_details.pname');
        $this->db->from('project_details');
        $this->db->join('project_users', 'project_users.project_id =project_details.id');
        $this->db->where($where);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data = $query->result();
            return $data;
        } else {
            return false;
        }
    }
    public function usr_my_project_for_upload($data) {
        $user_id = $this->session->userdata('user_id');
        $role_id = $this->session->userdata('role_id');
        if ($role_id == '1') {
            $where = "project_users.is_active ='1' and  project_details.id !='' and project_details.flag='1'";
        } else {
            $where = "project_users.is_active ='1' and project_users.user_id =" . $user_id . " and project_details.id !='' and project_details.flag='1'";
        }
        $this->db->distinct();
        $this->db->select('project_details.website,project_details.id,project_details.pname');
        $this->db->from('project_details');
        $this->db->join('project_users', 'project_users.project_id =project_details.id');
        $this->db->where($where);
        $this->db->where('project_details.accountnumber', $data);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data = $query->result();
            return $data;
        } else {
            return false;
        }
    }
    public function fetch_webiste_under_user_active_projselected($data, $edit_id) {
        $user_id = $this->session->userdata('user_id');
        $role_id = $this->session->userdata('role_id');
        if ($role_id == '5' || $role_id == '6' || $role_id == '7' || $role_id == '8') {
            $where = "project_users.is_active ='1' and project_users.user_id =" . $edit_id . " and project_details.id !='' and project_details.flag='1'";
        }
        if ($role_id == '2' || $role_id == '3' || $role_id == '4') {
            $where = "project_details.id !='' and project_details.flag='1' and project_users.user_id =" . $edit_id . " and project_users.project_id in (SELECT project_id FROM project_users where user_id=" . $user_id . ")";
        }
        if ($role_id == '1') {
            $where = "project_details.id !='' and project_details.flag='1' and project_users.user_id =" . $edit_id . "";
        }
        $this->db->select('project_details.website,project_details.id');
        $this->db->from('project_details');
        $this->db->join('project_users', 'project_users.project_id =project_details.id');
        $this->db->where($where);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data = $query->result();
            return $data;
        } else {
            return false;
        }
    }
    public function fetch_webiste_under_user_active_proj_for_edit($data, $edit_id, $user_role) {
        $user_id = $this->session->userdata('user_id');
        $role_id = $this->session->userdata('role_id');
        if ($role_id == '5') {
            $where = "project_users.is_active ='1' and project_users.user_id =" . $user_id . " and project_details.id !='' and project_details.flag='1' and project_details.id not in (SELECT `project_details`.`id` FROM `project_details` JOIN `project_users` ON `project_users`.`project_id` =`project_details`.`id` WHERE `project_users`.`is_active` = '1' and `project_users`.`user_id` =" . $edit_id . " and `project_details`.`id` != '' and `project_details`.`flag` = '1') ";
        }
        if ($role_id == '2' || $role_id == '3' || $role_id == '4') {
            $where = "project_details.id !='' and project_details.flag='1' and project_users.user_id in (SELECT user_id FROM project_users WHERE project_id in( SELECT project_id from project_users where user_id=" . $edit_id . ") and user_role_id='5') and project_details.id not in (SELECT `project_details`.`id` FROM `project_details` JOIN `project_users` ON `project_users`.`project_id` =`project_details`.`id` WHERE `project_users`.`is_active` = '1' and `project_users`.`user_id` =" . $edit_id . " and `project_details`.`id` != '' and `project_details`.`flag` = '1')  and project_users.project_id in (SELECT project_id from project_users where user_id=" . $user_id . ") ";
        }
        if ($role_id == '1') {
            if ($user_role == '2' || $user_role == '3' || $user_role == '4') {
                $where = "project_details.id !='' and project_details.flag='1' and project_details.id not in (SELECT `project_details`.`id` FROM `project_details` JOIN `project_users` ON `project_users`.`project_id` =`project_details`.`id` WHERE `project_users`.`is_active` = '1' and `project_users`.`user_id` =" . $edit_id . " and `project_details`.`id` != '' and `project_details`.`flag` = '1')";
            } else {
                $where = "project_details.id !='' and project_details.flag='1' and project_users.user_id in (SELECT user_id FROM project_users WHERE project_id in( SELECT project_id from project_users where user_id=" . $edit_id . ") and user_role_id='5') and project_details.id not in (SELECT `project_details`.`id` FROM `project_details` JOIN `project_users` ON `project_users`.`project_id` =`project_details`.`id` WHERE `project_users`.`is_active` = '1' and `project_users`.`user_id` =" . $edit_id . " and `project_details`.`id` != '' and `project_details`.`flag` = '1') ";
            }
        }
        $this->db->distinct();
        $this->db->select('project_details.website,project_details.id');
        $this->db->from('project_details');
        $this->db->join('project_users', 'project_users.project_id =project_details.id');
        $this->db->where($where);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data = $query->result();
            return $data;
        } else {
            return false;
        }
    }
    public function fetch_view_edit_admin($data) {
        $where = "users_groups.user_id=" . $data;
        $this->db->select('user.*');
        $this->db->select('acl_user.user_role_id');
        $this->db->select('acl_user.acl as acluser');
        $this->db->select('acl_master.acl as aclmaster');
        $this->db->from('user');
        $this->db->join('users_groups', 'user.id =users_groups.user_id');
        $this->db->join('acl_user', 'user.id =acl_user.user_id');
        $this->db->join('acl_master', 'acl_user.user_role_id =acl_master.user_role_id');
        $this->db->where($where);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data = $query->result();
            return $data;
        } else {
            return false;
        }
    }
    public function permision_list($limit, $offset) {
        $this->db->select('*');
        $this->db->from('permission');
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }
    public function read_count_permision_list() {
        $this->db->select('*');
        $this->db->from('permission');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $num = $query->num_rows();
            return $num;
        } else {
            return false;
        }
    }
    public function fetch_per_country_zone($data) {
        $where = "country_code='" . $data . "'";
        $this->db->select('*');
        $this->db->from('zone');
        $this->db->where($where);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }
    public function get_uaerrole($id) {
        $where = "user_id=" . $id;
        $this->db->select('role_id');
        $this->db->from('users_groups');
        $this->db->where($where);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }
    public function update_user_flag_status($data, $id) {
        $insdatauser = array('flag' => $data);
        $this->db->where('id', $id);
        $this->db->update('user1', $insdatauser);
        if ($this->db->affected_rows() > 0) {
            return true;
        }
    }
    public function update_project_flag_status($data, $id) {
        $insdataproj = array('flag' => $data);
        $this->db->where('id', $id);
        $this->db->update('project_details', $insdataproj);
        if ($this->db->affected_rows() > 0) {
            $insdataprojgrp = array('is_active' => $data);
            $this->db->where('project_id', $id);
            $this->db->update('project_users', $insdataprojgrp);
            return true;
        }
    }
    public function update_admin_user($data, $id) {
        $insdatauser = array('f_name' => $data['f_name'], 'l_name' => $data['l_name'], 'gender' => $data['gender'], 'euser' => $data['euser'], 'edate' => $data['edate'], 'flag' => $data['admin_status']);
        $this->db->where('id', $id);
        $this->db->update('user', $insdatauser);
        // if ($this->db->affected_rows() > 0) {
        $this->db->where('user_id', $id);
        $this->db->where('user_id !=', null);
        $this->db->delete('acl_user');
        $insdataacluser = array('user_id' => $id, 'user_role_id' => $data['role_id'], 'acl' => $data['menu_option']);
        $this->db->insert('acl_user', $insdataacluser);
        $this->db->where('user_id', $id);
        $this->db->where('user_id !=', null);
        $this->db->delete('users_groups');
        $insdataacluser = array('user_id' => $id, 'role_id' => $data['role_id']);
        $this->db->insert('users_groups', $insdataacluser);
        $this->db->where('user_id', $id);
        $this->db->where('user_id !=', null);
        $this->db->delete('project_users');
        // set uers project
        $selcd_proj = explode(",", $data['selcd_proj']);
        // $selcd_proj[]=explode(",",$data['selcd_proj']);
        foreach ($selcd_proj as & $value) {
            $insdataprjusers = array('user_id' => $id, 'user_role_id' => $data['role_id'], 'project_id' => $value, 'is_active' => '1');
            $this->db->insert('project_users', $insdataprjusers);
        }
        return true;
        // }
        
    }
    public function update_user_info($data, $id) {
        $insdatauser = array('f_name' => $data['f_name'], 'l_name' => $data['l_name'], 'gender' => $data['gender'], 'euser' => $data['euser'], 'edate' => $data['edate']);
        $this->db->where('id', $id);
        $this->db->update('user', $insdatauser);
        if ($this->db->affected_rows() > 0) {
            return true;
        }
    }
    public function update_user_info_pass($data, $id) {
        $old_pass = md5($data['old_pass']);
        $cond = "id=" . $id;
        $cond = "id=" . $id;
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where($cond);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            // print $query->u_password;
            $data1 = $query->result();
            if ($data1[0]->u_password == $old_pass) {
                $new_pass = md5($data['con_pass']);
                $insdatauser = array('u_password' => $new_pass, 'euser' => $data['euser'], 'edate' => $data['edate']);
                $this->db->where('id', $id);
                $this->db->update('user', $insdatauser);
                if ($this->db->affected_rows() > 0) {
                    return true;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    public function update_user_info_pass_peruser($data, $id) {
        $cond = "id=" . $id;
        $password = $data['con_pass'];
        $new_pass = md5($password);
        $insdatauser = array('u_password' => $new_pass, 'edate' => $data['edate']);
        $this->db->where('id', $id);
        $this->db->update('user1', $insdatauser);
        if ($this->db->affected_rows() > 0) {
            $this->db->where('id', $id);
            $query = $this->db->get('user');
            if ($query->num_rows() > 0) {
                $data = $query->result();
                $user_Email = $data[0]->u_email;
            }
            $message1 = "<div style='Margin: 0; padding-top: 0; padding-bottom: 0; -webkit-text-size-adjust: 100%; padding-right: 0; padding-left: 0; width: 100%; direction: ltr; background-color: #f5f5f5'>
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
                                                              <td align='left' style='border: 0; padding-top: 18px;font-size: 31px;'><p style= margin: 0 0 0px 0; padding: 0'>Tapouts Dashboard Password</p></td>
                                                          </tr>
                                                      </tbody>
                                                  </table>
                                                  <table border='0' cellspacing='0' cellpadding='0'>
                                                      <tbody>
                                                            <tr>
                                                            <td width='80px'style='padding-top:5px;padding-bottom: 5px;'><strong>Password</strong></td>
                                                            <td width='20px'style='padding-top: 5px;padding-bottom: 5px;'><strong>:</strong></td>
                                                            <td width='80px'style='padding-top: 5px;padding-bottom: 5px;'>$password</td>
                                                        </tr>
                                                      </tbody>
                                                  </table>
                                                  <table cellpadding='0' cellspacing='0' border='0' width='100%'>
                                                      <tbody>
                                                          <tr style='border: 0'>
                                                              <td align='left' style='border: 0; padding-top: 8px; padding-bottom: 8px;'><p style='color: #444444; font-family: 'Open Sans', sans-serif; font-size: 16px; line-height: 25px; margin: 10 0 10px 0; padding: 0'>Bear in mind that the access level you're granted determines what features you can view or edit.<a style='color: #444444; text-decoration: none; cursor: text; pointer-events: none'   rel='noreferrer'><font style='color: #444444'></font></a>.</p></td>
                                                         </tr>
                                                         <tr style='border: 0'>
                                                         <td align='left' style='border: 0; padding-top: 8px; padding-bottom: 8px;'><p style='color: #58a2e2; font-family: 'Open Sans', sans-serif; font-size: 16px; line-height: 25px; margin: 10 0 10px 0; padding: 0'><a href='http://dashboard.tapouts.online' target='_blank' style='color: #444444; text-decoration: none; cursor: text; pointer-events: none' rel='noreferrer'><font style='color: #444444'>Click Here To Login</font></a>.</p></td>
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
            $sent = send_email($user_Email, 'Tapouts Dashboard Password', $message1);
            return true;
        } else {
            return false;
        }
    }
    public function get_country_info($limit, $offset) {
        $this->db->select('*');
        $this->db->from('countries');
        if ((!empty($limit)) && (!empty($limit))) {
            $this->db->limit($limit, $offset);
        }
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }
    public function read_count_get_country_info() {
        $this->db->select('*');
        $this->db->from('countries');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $num = $query->num_rows();
            return $num;
        } else {
            return false;
        }
    }
    public function get_currency_info() {
        $this->db->select('*');
        $this->db->from('currency');
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }
    public function get_zone_info() {
        $this->db->select('*');
        $this->db->from('zone');
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }
    public function get_zone_name($data) {
        $where = "zone_id=" . $data;
        $this->db->select('*');
        $this->db->from('zone');
        $this->db->where($where);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }
    public function get_currency_code($data) {
        $where = "id=" . $data;
        $this->db->select('*');
        $this->db->from('currency');
        $this->db->where($where);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }
    public function fetch_view_edit_web_project($data) {
        $where = "project_details.id=" . $data;
        $this->db->select('project_details.*');
        $this->db->from('project_details');
        $this->db->where($where);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data = $query->result();
            return $data;
        } else {
            return false;
        }
    }
    //update project webiste
    public function update_web_project_info($data, $id) {
        $this->db->where('id', $id);
        $this->db->update('project_details', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        }
    }
}
?>