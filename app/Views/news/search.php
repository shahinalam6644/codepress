<table style="width:100%">
  <tr>
    <th>Title</th>
    <th>Body</th>
    <th>Img</th> 
  </tr>
  <?php if (! empty($news) && is_array($news)): ?>
	<?php foreach ($news as $news_item): ?>
  <tr>
    <td><?= esc($news_item['title']) ?></td>
    <td><?= esc($news_item['body']) ?></td>   
    <td><img src="<?php echo base_url('asstes/'.$news_item['userfile']);?>" width="200px"/></td>
  </tr>
	<?php endforeach ?>   
	<?php else: ?>
		<h3>No News</h3>
		<p>Unable to find any news for you.</p>
	<?php endif ?>
</table>
