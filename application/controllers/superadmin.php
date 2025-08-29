<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class superadmin extends CI_Controller {

	public function dashboard(){
		$this->load->view('superadmin/dashboard');
	}
	public function Sidebar(){
		$this->load->view('superadmin/Sidebar');
	}
	public function Navbar(){
		$this->load->view('superadmin/Navbar');
	}
	public function Login(){
		$this->load->view('superadmin/Login');
	}
public function SignUp(){
		$this->load->view('superadmin/SignUp');
	}

		public function Superadmin_profile(){
		$this->load->view('superadmin/Superadmin_profile');
	}
		public function CenterManagement(){
		$this->load->view('superadmin/CenterManagement');
	}
			public function CenterManagement2(){
		$this->load->view('superadmin/CenterManagement2');
	}
			public function New_admission(){
		$this->load->view('superadmin/New_admission');
	}
		public function receipt(){
		$this->load->view('superadmin/receipt');
	}
		public function Re_admission(){
		$this->load->view('superadmin/Re_admission');
	}
		public function Students(){
		$this->load->view('superadmin/Students');
	}
	public function Renew_admission(){
		$this->load->view('superadmin/Renew_admission');
	}
	public function View_Re_Admission(){
		$this->load->view('superadmin/View_Re_Admission');
	}
	public function View_Renew_Students(){
		$this->load->view('superadmin/View_Renew_Students');
	}
	public function EvenetList(){
		$this->load->view('superadmin/EvenetList');
	}
	public function Report(){
		$this->load->view('superadmin/Report');
	}

	public function Finance(){
		$this->load->view('superadmin/Finance');
	}

	public function Expenses(){
		$this->load->view('superadmin/Expenses');
	}

	public function EventAndNotice(){
		$this->load->view('superadmin/EventAndNotice');
	}	


}