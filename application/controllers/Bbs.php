<?php
class Bbs extends CI_Controller {

    public function __construct()
    {
    	parent::__construct();
		$this->load->library('session');
		$this->load->model('bbs_model');
    }

	public function index()
	{
	    $this->load->helper('form');
	    $this->load->library('form_validation');

	    $this->form_validation->set_rules('view_name', '表示名', 'required');
	    $this->form_validation->set_rules('message', 'ひと言メッセージ', 'required');
		$this->form_validation->set_message('required', '{field}を入力してください。');

	    if ($this->form_validation->run())
	    {
	        $this->bbs_model->set_bbs();
			$data['success_message'] = 'メッセージを書き込みました。';
			redirect('/');
	    }

	    $data['message_array'] = $this->bbs_model->get_bbs_list();

		$this->load->view('templates/header');
		$this->load->view('bbs/index', $data);
		$this->load->view('templates/footer');
	}
}
