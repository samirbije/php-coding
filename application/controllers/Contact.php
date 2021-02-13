<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
  * ContactController
  * contactform(input/comfirm) Controller for contactform
  * 
  * @filesource	  Contact.php
  * @package 	  Controller 
  */
 
class Contact extends CI_Controller {
	
	 protected $_view_data = array();
	 private $_upload_dir='csv/';
	/**
	 * Constructor
	 *
	 * @return ContactController
	 */
	 public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->helper('convert_helper');

		$this->config->load('contact');
		$this->form_validation->set_rules($this->config->item('validation', 'contact'));
		
		if ($this->input->post()) {
			$this->_view_data['post'] = $this->input->post();
		}
	}
	/**
	 * @see inputform()
	 *
	 */
	public function index()
	{
			return redirect ( base_url ( 'contact/input' ));
	}
	/**
	 * inputform the 
	 *
	 */
	public function input(){
		
		if($this->session->userdata('post_data')) {
        // Set POST array from session data
        $this->_view_data = $this->session->userdata('post_data');
        // Clear the session
        $this->session->unset_userdata('post_data');
    	}
		// validation
		$this->form_validation->run('contact');
		return	$this->load->view('contact/input', $this->_view_data);
	}
	/**
	 * Confirmpage 
	 *
	 */
	public function confirm()
	{
		
		if ( ! $this->input->post()) {
			return redirect( base_url('contact/input'));
		}

		if ( ! $this->form_validation->run('contact')) {
			return $this->load->view('contact/input', $this->_view_data);
			
		}
		
		$url = $this->input->post('url'); //'http://www.npr.org/rss/rss.php?id=1001';
		$feed_array = convert_rss_array($url);
		

		$replaceTextFrom = 'uzabase';
		$replaceTextTo = 'Uzabase, Inc.';
		$config['upload_path']=$this->_upload_dir;
        $config['allowed_types']='txt|csv';
        $this->load->library('upload', $config);
		$this->upload->do_upload('csv');
		$arrCsv = array();
		if($this->upload->do_upload('csv')) {
			$data = $this->upload->data();
		
		$csv=$data['full_path'];
		$handle = fopen($csv,"r");
	
		while (($row = fgetcsv($handle, 10000, ",")) != FALSE) //get row vales
		{
			$arr['firstCol']=$row[0];
			$arr['secondCol']=str_replace($replaceTextFrom,$replaceTextTo,$row[1]);
			$arrCsv[] = $arr;

		}
	}


		 $filepath=$this->_upload_dir."/article_".date('Y-m-d').".csv";
		 array_to_csv($feed_array,'',$filepath);


		$filepath=$this->_upload_dir."/result_".date('Y-m-d').".csv";
		array_to_csv($arrCsv,'',$filepath);
		 	
		return $this->load->view('contact/confirm',$this->_view_data);

	}

	public function downloadArticleFile($csv='result'){
		
		$filepath = $this->_upload_dir.$csv."_".date('Y-m-d').".csv";
		ob_start();
		$var =$csv=='result' ? 'result_csv':'article_csv';
		$extension='csv';
		header("Content-type: application/$extension");
		header("Content-Disposition: attachment; filename=".$var."-".date('Y-m-d_H-i-s').".$extension");
		ob_end_flush();
		$handle=@fopen($filepath,"r");
		$contents=@fread($handle,filesize($filepath));
		echo $contents;	
	}	
	
}
