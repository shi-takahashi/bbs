<?php
class Admin extends CI_Controller 
{
    public function __construct()
    {
    	parent::__construct();
		$this->load->library('session');
		$this->load->model('bbs_model');
    }

	/**
	 * 管理画面トップ
	 */
	public function index()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');

		$data = [];

		if ($this->input->get('btn_logout')) {
			unset($_SESSION['admin_login']);
		} else {

			$password = PASSWORD;
			$this->form_validation->set_rules('admin_password', 'ログインパスワード', "required|regex_match[/${password}/]");
			$this->form_validation->set_message('required', '{field}を入力してください。');
			$this->form_validation->set_message('regex_match', 'ログインに失敗しました。');

			if ($this->form_validation->run())
			{
				$admin_password = html_escape($this->input->post('admin_password'));
				$_SESSION['admin_login'] = $admin_password;
			}

			$data['message_array'] = $this->bbs_model->get_bbs_list();
		}

		$this->load->view('templates/header');
		$this->load->view('admin/index', $data);
		$this->load->view('templates/footer');
	}

	/**
	 * csvダウンロード
	 */
	public function download()
	{
		$csv_data = '"id","表示名","メッセージ","投稿日時”' . "\n";
		
		$limit = $this->input->get('limit');
		$message_array = $this->bbs_model->get_bbs_list($limit);

		foreach ($message_array as $value) {
			$csv_data .= $value['id'] . "," . $value['view_name']. "," . $value['message'] . "," . $value['post_date'] . "\n";
		}

		$this->output->set_header("Content-Disposition: attachment; filename=メッセージデータ.csv");
		$this->output->set_header("Content-Transfer-Encoding: binary");
		$this->output->set_content_type('application/octet-stream')->set_output($csv_data);
	}

	/**
	 * 投稿編集
	 */
	public function edit()
	{
		// 管理者かどうか確認
		if (!isset($_SESSION['admin_login'])) {
			redirect('/admin');
			return;
		}

		$this->load->library('form_validation');

		if ($this->input->post('message_id')) {
			$message_id = $this->input->post('message_id');

			$this->form_validation->set_rules('view_name', '表示名', 'required');
			$this->form_validation->set_rules('message', 'ひと言メッセージ', 'required');
			$this->form_validation->set_message('required', '{field}を入力してください。');

			if ($this->form_validation->run()) {
				$view_name = html_escape($this->input->post('view_name'));
				$message   = html_escape($this->input->post('message'));
				$this->bbs_model->update($message_id , $view_name, $message);
				redirect('/admin');
				return;
			}

			$data['bbs_row'] = [
				'id'        => $message_id,
				'view_name' => $this->input->post('view_name'),
				'message'   => $this->input->post('message'),
			];

		} else if ($this->input->get('message_id')) {
			$message_id = $this->input->get('message_id');
			$data['bbs_row'] = $this->bbs_model->row($message_id);

		} else {
			redirect('/admin');
			return;
		}
		
		$this->load->view('templates/header');
		$this->load->view('admin/edit', $data);
		$this->load->view('templates/footer');
	}

	/**
	 * 投稿削除
	 */
	public function delete()
	{
		if (isset($_SESSION['admin_login'])) {
			$this->load->helper('form');

			if ($this->input->post('message_id')) {
				$this->bbs_model->delete($this->input->post('message_id'));

			} else if ($this->input->get('message_id')) {
				$data['bbs_row'] = $this->bbs_model->row($this->input->get('message_id'));

				$this->load->view('templates/header');
				$this->load->view('admin/delete', $data);
				$this->load->view('templates/footer');
				return;
			}
		}

		redirect('/admin');
	}
}
