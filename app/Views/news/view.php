<table style="width:100%">
  <tr>
    <th>Title</th>
    <th>Body</th>
    <th>Img</th>
    <th>Slug</th>
  </tr>
  <tr>
    <td><?= esc($news['title']) ?></td>
    <td><?= esc($news['body']) ?></td>    
    <td><img src="<?php echo base_url('asstes/'.$news['userfile']);?>" width="100px"/></td>
    <td><?= esc($news['slug']) ?></td>
  </tr>
  
</table> 
