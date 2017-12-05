<div id="content">
  <title>Display Projectlist</title>
  <div class="row">
   <div style="width:500px;margin:50px;">
   <br><br>
   <a href="<?php echo BASE_URL."/welcome/addproject/";?>">Back</a></td>
    <h4>Display projectlist </h4>
    <table id="table">
      <thead>
     <tr>
        <th><strong>project name</strong></th>
        <th><strong>project status</strong></th>
        <th><strong>project rating</strong></th>
        <th><strong>project head</strong></th>
        <th><strong>project date</strong></th>
        <th><strong>Assignedusers</strong></th>
        <th><strong>delete</strong></th>
        <th><strong>Update/view</strong></th>
        <th><strong>downloadfile</strong></th>
        <th><strong>Address</strong></th>
       
       
    </tr>
</thead> 
<tbody>
     <?php foreach($projectdata as $i){?>
     <tr><td><?=$i->projectname;?></td><td><?=$i->projectstatus;?></td><td><?=$i->projectrating;?></td><td><?=$i->projecthead;?></td><td><?=$i->projectdate;?></td><td><?=$i->duser;?></td>
    
     <td><a href="<?php echo BASE_URL."/welcome/deleteproject/".$i->projectid;?>"onclick="return confirm('Are you sure you want to delete this item?');">Delete</a></td>
     
     <td><a href="<?php echo BASE_URL."/welcome/viewproject/".$i->projectid;?>">Update/view</a></td> 
    
     <!-- <td><?=$i->filename;?></td> -->
     <td><a href="<?php echo BASE_URL."/welcome/downloadfile/".$i->projectid;?>">downloadfile</a></td> 
     
     <td><?=$i->address;?>
     
        <!-- <?php foreach($joindata as $i){?>
      <?=$i->duser;?>
      <?php }?> 
      </td>  -->
    
        <?php }?>  
        
      </tr>
</tbody>
        </table> 
   </div> 
  </div> 
  
  </div> 

