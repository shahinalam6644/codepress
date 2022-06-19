<?= session()->getFlashdata('error') ?>
<?= service('validation')->listErrors() ?>

<form action="/news/create" method="post" enctype="multipart/form-data">
    <?= csrf_field() ?> 
    <label for="title">Title</label>
    <input type="input" name="title" /><br /> 
    <label for="body">Body</label>
    <textarea name="body" ></textarea><br />     
    <label for="title">Image</label>
    <input type="file" name="userfile" /><br /> 
    <input type="submit" name="submit" value="Create news item" />
</form>
