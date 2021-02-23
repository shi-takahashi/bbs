<h1>ひと言掲示板 管理ページ（投稿の削除）</h1>

<p class="text-confirm">以下の投稿を削除します。<br>よろしければ「削除」ボタンを押してください。</p>
<?php $attributes = []; ?>
<?php $hidden['message_id'] = $bbs_row['id']; ?>
<?php echo form_open('admin/delete', $attributes, $hidden); ?>
	<div>
		<?php echo form_label('表示名', 'view_name'); ?>
        <?php $view_name = ($bbs_row['view_name'] ? $bbs_row['view_name'] : ''); ?>
		<?php $extra = ['disabled' => '']; ?>
		<?php echo form_input('view_name', $view_name, $extra); ?>
	</div>
	<div>
		<?php echo form_label('ひと言メッセージ', 'message'); ?>
		<?php $message = ($bbs_row['message'] ? $bbs_row['message'] : ''); ?>
		<?php $extra = ['disabled' => '']; ?>
		<?php echo form_textarea('message', $message, $extra); ?>
	</div>
    <a class="btn_cancel" href="/admin">キャンセル</a>
	<?php 
		$btn_submit = [
			'type'  => 'submit',
			'name'  => 'btn_submit',
			'id'    => 'btn_submit',
			'value' => '削除',
		];
		echo form_input($btn_submit); 
	?>
</form>
