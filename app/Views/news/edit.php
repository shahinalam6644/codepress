<?= session()->getFlashdata('error') ?>
<?= service('validation')->listErrors() ?>
<form action="/news/update/<?= esc($news['id']) ?>" method="post" enctype="multipart/form-data">
    <?= csrf_field() ?>
    <label for="title">Title</label>
    <input type="input" name="title" value="<?= esc($news['title']) ?>"/><br /> 
    <label for="body">Body</label>
    <textarea name="body" value="<?= esc($news['body']) ?>"><?= esc($news['body']) ?></textarea><br />
    <label for="title">Image</label>
    <input type="file" name="userfile" value="<?= esc($news['userfile']) ?>"/><br />    
    <input type="hidden" name="userfile" value="<?= esc($news['userfile']) ?>"/><br />
    <img src="<?php echo base_url('asstes/'.$news['userfile']);?>" width="200px"/><br />
    <input type="submit" name="submit" value="Update news item" />
</form>
