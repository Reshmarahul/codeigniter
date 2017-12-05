


    
     
  
<div id ="content">
        <?php $attributes = array('id' => 'form'); ?>
        <!-- <form id="form" method="post" action="<?php echo BASE_URL."/welcome/do_upload";?>"> -->
       <?php echo form_open_multipart('welcome/do_upload',$attributes);?> 
        project name:<br>
       <input type="text" name="projectname" required ><br> 
        project status:<br>
        <input type="text" name="projectstatus" required><br>
        project rating:<br>
        <input type="text" name="projectrating" required><br>
        project head:<br>
        <input type="text" name="projecthead" required><br>
        <!-- project date:<br>
        <input type="text" name="projectdate" required><br>
         -->
         project date:<br>
         <!-- <label for="checkdate"> Date (dd-mm-yyyy)</label><br/> -->
     <input name="projectdate" type="date" value="dd-mm-yyyy"  size="20"/>

           
          
                <label> Upload Your file </label>
                <input type="file" name="userfile" size="20" >
                <input type="submit"id="submitaddproject" name="submit" value="submit"style="width:6%">
                </form>
                
                
                <form method="post" action=<?php echo BASE_URL."/welcome/projectview";?>>
                <button id="b1" type="submit">viewproject</button>
                </form>
               
</div>