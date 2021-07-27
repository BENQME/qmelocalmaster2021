<?php
    class Login_model extends CI_Model {

        function can_login($email, $password) {
            $this->db->where('email', $email);
            $this->db->from('users');
            $query = $this->db->get();
            if($query->num_rows() > 0) {

                foreach($query->result() as $row) {
                    if($row->is_email_verified == 'yes') {
                        // $store_password = $this->encryption->decrypt($row->password);
                        if($password == $row->password) {
                            // store session details
                            $this->session->set_userdata('id', $row->userID);
                        } else {
                            return "Wrong";
                        }
                    } else {
                        return 'please Verified your email address';
                    }
                }

            } else {
                return 'Wrong Email Address';
            }
        }
    }
?>
