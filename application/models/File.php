<?php  
defined('BASEPATH') OR exit('No direct script access allowed'); 
 
class File extends CI_Model{ 
    function __construct() { 
        $this->tableName = 'files'; 
    } 
     
    /* 
     * Fetch files data from the database 
     * @param id returns a single record if specified, otherwise all records 
     */ 
    public function getRows($id = ''){ 
        $this->db->select('id,file_name,uploaded_on,likes'); 
        $this->db->from('files'); 
        if($id){ 
            $this->db->where('id',$id); 
            $query = $this->db->get(); 
            $result = $query->row_array(); 
        }else{ 
            $this->db->order_by('likes','desc'); 
            $this->db->limit(10);
            $query = $this->db->get(); 
            
            $result = $query->result_array(); 
        } 
        return !empty($result)?$result:false; 
    } 
     
    /* 
     * Insert file data into the database 
     * @param array the data for inserting into the table 
     */ 
    public function insert_file($data = array()){ 
        
        $insert = $this->db->insert_batch('files',$data); 
        return $insert?true:false;
    } 


    public function get_data(){
        $query=$this->db->query("SELECT likes
                                 FROM files
                                 ORDER BY id ASC");
        return $query->result_array();
    }

}