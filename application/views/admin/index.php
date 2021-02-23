<h1>ひと言掲示板 管理ページ</h1>

<?php if( !empty($this->form_validation->error_array()) ): ?>
	<ul class="error_message">
  		<?php echo validation_errors('<li>・', '</li>'); ?>
	</ul>
<?php endif; ?>

<section>

<?php if(isset($_SESSION['admin_login'])): ?>

<?php $attributes = ['method' => 'get']; ?>
<?php echo form_open('admin/download', $attributes); ?>
<?php $option_values = [
    ''   => '全て',
    '10' => '10件',
    '30' => '30件',
]; ?>
<?php $btn_download = [
    'name'  => 'download',
    'value' => 'ダウンロード',
    'type'  => 'submit'
]; ?>
<?php echo form_dropdown('limit', $option_values); echo form_input($btn_download); ?>

</form>

<?php if( !empty($message_array) ): ?>
<?php foreach( $message_array as $value ): ?>
<article>
    <div class="info">
        <h2><?php echo $value['view_name']; ?></h2>
        <time><?php echo date('Y年m月d日 H:i', strtotime($value['post_date'])); ?></time>
		<p><a href="admin/edit?message_id=<?php echo $value['id']; ?>">編集</a> <a href="admin/delete?message_id=<?php echo $value['id']; ?>">削除</a></p>
    </div>
    <p><?php echo nl2br($value['message']); ?></p>
</article>
<?php endforeach; ?>
<?php endif; ?>

<?php $attributes = ['method' => 'get']; ?>
<?php echo form_open('admin', $attributes) ?>
<?php $btn_logout = [
		'type'  => 'submit',
		'id'    => 'btn_logout',
		'name'  => 'btn_logout',
		'value' => 'ログアウト',
	];
?>
<?php echo form_input($btn_logout) ?>
</form>

<?php else: ?>

<?php echo form_open('admin'); ?>
	<div>
    <?php echo form_label('ログインパスワード', 'admin_password'); ?>
	<?php 
		$password = [
			'type'  => 'password',
			'name'  => 'admin_password',
			'id'    => 'admin_password',
			'value' => '',
		];
		echo form_input($password); 
	?>
	</div>
	<?php 
		$btn_submit = [
			'type'  => 'submit',
			'name'  => 'btn_submit',
			'id'    => 'btn_submit',
			'value' => 'ログイン',
		];
		echo form_input($btn_submit); 
	?>
</form>

<?php endif; ?>

</section>
