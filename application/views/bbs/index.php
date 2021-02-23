<h1>ひと言掲示板</h1>

<?php if( !empty($this->form_validation->error_array()) ): ?>
	<ul class="error_message">
  		<?php echo validation_errors('<li>・', '</li>'); ?>
	</ul>
<?php endif; ?>

<?php if( !empty($success_message) ): ?>
    <p class="success_message"><?php echo $success_message; ?></p>
<?php endif; ?>

<?php echo form_open('bbs/index'); ?>
	<div>
		<?php echo form_label('表示名', 'view_name'); ?>
		<?php echo form_input('view_name', $this->session->view_name); ?>
	</div>
	<div>
		<?php echo form_label('ひと言メッセージ', 'message'); ?>
		<?php echo form_textarea('message', ''); ?>
	</div>
	<?php 
		$btn_write = [
			'type'  => 'submit',
			'name'  => 'btn_submit',
			'id'    => 'btn_submit',
			'value' => '書き込む',
		];
		echo form_input($btn_write); 
	?>
</form>

<hr>

<section>
<?php if( !empty($message_array) ): ?>
<?php foreach( $message_array as $value ): ?>
<article>
    <div class="info">
        <h2><?php echo $value['view_name']; ?></h2>
        <time><?php echo date('Y年m月d日 H:i', strtotime($value['post_date'])); ?></time>
    </div>
    <p><?php echo $value['message']; ?></p>
</article>
<?php endforeach; ?>
<?php endif; ?>
</section>
