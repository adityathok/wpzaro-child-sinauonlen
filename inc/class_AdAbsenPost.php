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
            id INT UNSIGNED NOT NULL AUTO_INCREMENT,
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
        return $getdata;
    }

    public function add($user=null,$post_id=null,$posttype=null,$date=null){
        if($post_id) {
            $user_id    = empty($user)?$user:get_current_user_id();
            $date       = $date?$date:date( 'Y-m-d H:i:s', current_time( 'timestamp', 0 ) );
            $getdata    = $this->wpdb->get_results("SELECT * FROM $this->table WHERE user_id = $user_id and post_id = $post_id");
            if(empty($getdata)) {

                //create detail                
                $detail                         = [];
                $user_info                      = get_userdata($user_id);
                $detail['user']['display_name'] = $user_info->display_name;
                $detail['user']['user_login']   = $user_info->user_login;
                $detail['user']['kelas']        = $user_info->kelas;
                $detail['post']['title']        = get_the_title($post_id);
                $author_id                      = get_post_field( 'post_author', $post_id );
                $detail['post']['author_id']    = $author_id;
                $detail['post']['author_name']  = get_the_author_meta( 'display_name', $author_id );

                $this->wpdb->insert($this->table, array(
                    'user_id'   => $user_id,
                    'post_id'   => $post_id,
                    'post_type' => $posttype,
                    'detail'    => json_encode($detail),
                    'date'      => $date,
                ) );
            }
        }
    }

    public function fetch($args=null){ 
        $args       = $args?'WHERE '.$args:'';   
        $getdata    = $this->wpdb->get_results("SELECT * FROM $this->table $args");
        return $getdata;
    }
       
    public function count_byuser($user_id,$date){ 
        $getdata    = $this->wpdb->get_var("SELECT COUNT(*) FROM $this->table WHERE user_id = $user_id and date like '%$date%'");
        return $getdata;
    } 

    public function count_byauthor($user_id,$date){ 
        $dataar     = '"author_id":"'.$user_id.'"';
        $getdata    = $this->wpdb->get_var("SELECT COUNT(*) FROM $this->table WHERE detail like '%$dataar%' and date like '%$date%'");
        return $getdata;
    }

    public function count_bydate($date){ 
        $getdata    = $this->wpdb->get_var("SELECT COUNT(*) FROM $this->table WHERE date like '%$date%'");
        return $getdata;
    }

    public function delete($id){ 
        return $this->wpdb->delete( $this->table, array( 'id' => $id ) );
    }

}

$AdAbsenPost = new AdAbsenPost();