<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{	
		$this->load->view('header');
		$data['events']=$this->db->select('*')->from('tbl_events')->get()->result_array();
		$this->load->view('list_event',$data);
	}

	public function event_add(){
		$this->load->view('header');
		$this->load->view('form_event');
	}
	public function submit_event(){

		$content=array();
		$content['status']=404;
		$content['message']='something went to wrong';

		$post=$this->input->post();
		$start_date=date('Y-m-d',strtotime($post['start_date']));
		$end_date='';
		if($post['event_end']=='on'){
			$end_date=date('Y-m-d',strtotime($post['end_date']));
		}

		$insert_array=array(
			'event_title' => $post['event_title'],
		);

		if($post['repeatEvery']=='day'){
			$repeatDaycount=$post['number'];
			$day=date('Y-m-d', strtotime($start_date. ' + '.$repeatDaycount.' days'));
			$date_cal= ' + '.$repeatDaycount.' days';
		}
		if($post['repeatEvery']=='week'){
			$repeatDaycount=$post['number'];
			$day=date('Y-m-d', strtotime($start_date. ' + '.$repeatDaycount.' week'));
			$date_cal= ' + '.$repeatDaycount.' week';
		}
		
		if($post['repeatEvery']=='month'){
			$repeatDaycount=$post['number'];
			$day=date('Y-m-d', strtotime($start_date. ' + '.$repeatDaycount.' month'));
			$date_cal= ' + '.$repeatDaycount.' month';
		}
		
		if($post['repeatEvery']=='year'){
			$repeatDaycount=$post['number'];
			$day=date('Y-m-d', strtotime($start_date. ' + '.$repeatDaycount.' year'));
			$date_cal= ' + '.$repeatDaycount.' year';
		}


		$newstartdate=str_replace('-','/', $start_date);
		$newenddate=str_replace('-','/', $day);

		$dateArray[]=array('date'=>str_replace('/','-', $start_date),'days'=>date('l', strtotime($start_date)));

		if($newstartdate <= $newenddate){
			for ($i=0; $i <= $post['occurrences']; $i++) { 
				$newstartdate=$newstartdate .$date_cal;
				$dateArray[]=array('date'=>str_replace('/','-',date('Y-m-d',strtotime($newstartdate))),'days'=>date('l', strtotime($newstartdate)));
			}
		}
		

		$json_eventstart=json_encode($dateArray);
		$insert_array['event_start_date']=$json_eventstart;
		$insert_array['event_recurrence']=$post['occurrences'];
		$insert_array['event_end_date']=$end_date;
		$this->db->insert('tbl_events',$insert_array);
		$last_event_id=$this->db->insert_id();
		if($last_event_id){
			$content['status']=200;
			$content['message']='Event Add successfully';
		}
		echo json_encode($content);
		exit();			
	}

	public function event_details(){
		$event_id=$this->uri->segment('3');
		$data['event_details']=$this->db->select('*')->from('tbl_events')->where('event_id',$event_id)->get()->row();
		$data['event_days']=json_decode($data['event_details']->event_start_date);
		$this->load->view('details_event',$data);
	}

	public function event_delete(){
		$event_id=$this->uri->segment('3');
		$this->db->where('event_id',$event_id);
		$this->db->delete('tbl_events');
		$affected_rows=$this->db->affected_rows();
		if($affected_rows){
			$this->session->set_flashdata('message','event was deleted');
			redirect('welcome','refresh');
		}
	}
}
