<?php
class Bbs_model extends CI_Model 
{
		/**
		 * コンストラクタ
		 */
        public function __construct()
        {
        	$this->load->database();
        }

		/**
		 * 掲示板に投稿します
		 * 
		 * @return bool
		 */
        public function set_bbs()
		{
			$view_name = html_escape($this->input->post('view_name'));
			$view_name = preg_replace( '/\\r\\n|\\n|\\r/', '', $view_name);

			$message   = html_escape($this->input->post('message'));
			$message   = preg_replace( '/\\r\\n|\\n|\\r/', '<br>', $message);

			$this->session->view_name = $view_name;

		    $data = [
		        'view_name' => $view_name,
		        'message'   => $message
		    ];

			return $this->db->insert('bbs', $data);			
		}

		/**
		 * 掲示板の一覧を取得します
		 * 
		 * @param int $limit 件数
		 * @return array
		 */
        public function get_bbs_list($limit = null)
		{
			if ($limit) {
				$query = $this->db->order_by('id desc')->limit($limit)->get('bbs');
			} else {
				$query = $this->db->order_by('id desc')->get('bbs');
			}

	        return $query->result_array();
		}

		/**
		 * 掲示板の特定の投稿を取得します
		 * 
		 * @param int $message_id
		 * @return array
		 */
		public function row($message_id)
		{
			$query = $this->db->where('id', $message_id)->get('bbs');
			return $query->row_array();
		}

		/**
		 * 投稿を更新します
		 * 
		 * @param int $message_id
		 * @param string $view_name
		 * @param string $message
		 */
		public function update($message_id, $view_name, $message)
		{
			$this->db->set('view_name', $view_name);
			$this->db->set('message', $message);
			$this->db->where('id', $message_id);
			$this->db->update('bbs');
		}

		/**
		 * 投稿を削除します
		 * @param int $message_id
		 */
		public function delete($message_id)
		{
			$this->db->where('id', $message_id);
			$this->db->delete('bbs');
		}
}
