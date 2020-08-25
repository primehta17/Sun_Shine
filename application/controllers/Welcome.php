<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {

    public function index() {
        $this->load->view('header');
        $this->load->view('welcome_message');
        $this->load->view('footer');
        
    }
   //payment gateway
   public function __construct() {
    parent::__construct();
    $this->load->library("session");
    $this->load->helper('url');
 }
    
 /**
  * Get All Data from this method.
  *
  * @return Response
 */
 public function stripePost()
 {
     require_once('application/libraries/stripe-php/init.php');
 
     \Stripe\Stripe::setApiKey($this->config->item('stripe_secret'));
  
     \Stripe\Charge::create ([
             "amount" => 10 * 10,
             "currency" => "rupees",
             "source" => $this->input->post('stripeToken'),
             "description" => "Test payment from itsolutionstuff.com." 
     ]);
         
     $this->session->set_flashdata('success', 'Payment made successfully.');
     // $this->db->select('(SELECT SUM(payments.amount) FROM payments WHERE payments.invoice_id=4) AS amount_paid', FALSE);
     // $query = $this->db->get('users');
          
     redirect('/my-stripe', 'refresh');
 }

    //image uload
    public function image_upload()  
    {  
         $data['title'] = "Upload Image using Ajax JQuery in CodeIgniter";  
         $this->load->view('welcome_message', $data);  
    }  
    public function ajax_upload()  
    {  
         if(isset($_FILES["image_file"]["name"]))  
         {  
              $config['upload_path'] = './upload/';  
              $config['allowed_types'] = 'jpg|jpeg|png|gif';  
              $this->load->library('upload', $config);  
              if(!$this->upload->do_upload('image_file'))  
              {  
                   echo $this->upload->display_errors();  
              }  
              else  
              {  
                   $data = $this->upload->data();  
                   echo '<img src="'.base_url().'upload/'.$data["file_name"].'" width="300" height="225" class="img-thumbnail" />';  
              }  
         }  
    }  
}