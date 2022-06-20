<form action="/news/search" method="post"> 
<?= csrf_field() ?> 
    <input type="input" name="search" /><input type="submit" value="Search" />
</form>
<h2><a href="/news/create">Create data</a></h2>
<table style="width:100%">
  <tr>
    <th>Title</th>
    <th>Body</th>
    <th>Img</th>
    <th>Action</th>
  </tr>
  <?php if (! empty($news) && is_array($news)): ?>
	<?php foreach ($news as $news_item): ?>
  <tr>
    <td><?= esc($news_item['title']) ?></td>
    <td><?= esc($news_item['body']) ?></td>   
    <td><img src="<?php echo base_url('asstes/'.$news_item['userfile']);?>" width="200px"/></td>
    <td><a href="/news/<?= esc($news_item['slug'], 'url') ?>">View</a> | <a href="/news/edit/<?= esc($news_item['slug'], 'url') ?>">Edit</a> | <a href="/news/delete/<?= esc($news_item['id'], 'url') ?>">Delete</a> </td>
  </tr>
	<?php endforeach ?>   
	<?php else: ?>
		<h3>No News</h3>
		<p>Unable to find any news for you.</p>
	<?php endif ?>
</table>
<br/>
<br/>
<br/>


<form action="<?php echo site_url('news/dosearch'); ?>" method="get">  
    <input type="input" name="q" /><input type="submit" value="Search" />
</form>




<br/>
<br/>
<br/>
<br/>