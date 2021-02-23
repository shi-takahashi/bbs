<h1>ひと言掲示板 管理ページ（投稿の編集）</h1>

<?php if( !empty($this->form_validation->error_array()) ): ?>
	<ul class="error_message">
  		<?php echo validation_errors('<li>・', '</li>'); ?>
	</ul>
<?php endif; ?>

<?php $attributes = []; ?>
<?php $hidden['message_id'] = $bbs_row['id']; ?>
<?php echo form_open('admin/edit', $attributes, $hidden); ?>
	<div>
		<?php echo form_label('表示名', 'view_name'); ?>
		<?php $view_name = ($bbs_row['view_name'] ? $bbs_row['view_name'] : ''); ?>
		<?php echo form_input('view_name', $view_name); ?>
	</div>
	<div>
		<?php echo form_label('ひと言メッセージ', 'message'); ?>
        <?php $message = $bbs_row['message'] ? $bbs_row['message'] : '' ?>
		<?php echo form_textarea('message', $message); ?>
	</div>
    <a class="btn_cancel" href="/admin">キャンセル</a>
	<?php 
		$btn_submit = [
			'type'  => 'submit',
			'name'  => 'btn_submit',
			'id'    => 'btn_submit',
			'value' => '更新',
		];
		echo form_input($btn_submit); 
	?>
</form>
