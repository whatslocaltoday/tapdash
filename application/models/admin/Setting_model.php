<?php
//class use for all general requirement
Class Setting_model extends CI_Model {
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
    public function permission_insert($data) {
        $data = array('name' => $data['permsn_name']);
        $this->db->insert('permission', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function permision_list($id) {
        $where = "id='" . $id . "'";
        $this->db->select('*');
        $this->db->from('permission');
        $this->db->where($where);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }
    public function get_country_info($id) {
        $where = "id='" . $id . "'";
        $this->db->select('*');
        $this->db->from('countries');
        $this->db->where($where);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }
    public function permission_name_update($data, $id) {
        $this->db->where('id', $id);
        $this->db->update('permission', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function country_name_update($data, $id) {
        $this->db->where('id', $id);
        $this->db->update('countries', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function countery_insert($data) {
        $this->db->insert('countries', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function get_currency_info_based_on_countery($limit, $offset) {
        $this->db->select('currency.*,countries.name as counutry_name');
        $this->db->from('currency');
        $this->db->join('countries', 'currency.code =countries.currency');
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }
    public function read_count_currency_info_based_on_countery() {
        $this->db->select('currency.*,countries.name as counutry_name');
        $this->db->from('currency');
        $this->db->join('countries', 'currency.code =countries.currency');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $num = $query->num_rows();
            return $num;
        } else {
            return false;
        }
    }
    public function get_currency_info($id) {
        $where = "id='" . $id . "'";
        $this->db->select('*');
        $this->db->from('currency');
        $this->db->where($where);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }
    public function currency_name_update($data, $id) {
        $this->db->where('id', $id);
        $this->db->update('currency', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
?>