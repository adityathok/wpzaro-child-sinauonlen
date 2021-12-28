<?php
/**
 * Belajar OOP, mohon maaf.
 * Basic Member Ad Absens Post 
 */

class AdAbsenPost {

    public $wpdb;
    public $table;

    public function __construct($table='ad_absen_post'){
        global $wpdb;
        $this->wpdb     = $wpdb; 
        $this->table    = $wpdb->prefix.$table;

        if(get_option( 'db_ad_absen_post', 1 ) < 2 ) {
            require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
            $this->create_table();
            update_option( 'db_ad_absen_post', 3 );
        }
    }

    public function create_table(){
        $sql = "CREATE TABLE IF NOT EXISTS $this->table
        (
            id INT NOT NULL,
            user_id INT NOT NULL,
            post_id INT NOT NULL,
            post_type varchar(50) NOT NULL,
            detail longtext NOT NULL,
            date datetime NOT NULL,
            PRIMARY KEY  (id)
        );  
        ";
        dbDelta($sql);
    }  
        
    public function check($user_id=null,$post_id=null){
        $getdata = $this->wpdb->get_results("SELECT * FROM $this->table WHERE user_id = $user_id and post_id = $post_id");
        if($getdata) {
            return true;
        } else {
            return false;
        }
    }

    public function add($user=null,$post_id=null){
        if($post_id) {
            $user_id = empty($user)?$user:get_current_user_id();
            $getdata = $this->wpdb->get_results("SELECT * FROM $this->table WHERE user_id = $user_id and post_id = $post_id");
            if(empty($getdata)) {
                $this->wpdb->insert($this->table, array(
                    'user_id'   => $user_id,
                    'post_id'   => $post_id,
                    'post_type' => $post_type,
                    'detail'    => $detail,
                    'date'      => $date,
                ) );
            }
        }
    }

}

$AdAbsenPost = new AdAbsenPost();