<?php

class Register_model extends CI_Model {
    
    public function insert($data) {
        $this->db->insert('users', $data);
        // returns last insert record id
        return $this->db->insert_id();
    }

    public function verify_email($key) {
        $this->db->where('verification_key', $key);
        $this->db->where('is_email_verified', 'no');
        $query = $this->db->get('users');

        if($query->num_rows() > 0) {
            $data = array(
                'is_email_verified' => '1' 
            );
            // change verification status inside db
            $this->db->where('verification_key', $key);
            $this->db->update('users', $data);
            return true;
        } else {
            // already verified
            return false;
        }
    }
}

?>