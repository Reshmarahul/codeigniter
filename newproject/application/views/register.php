

  
  <div id="content">

    <form id="validate" method="post" action="<?php echo BASE_URL."/welcome/getuserdata";?>">
            Enter the first name:<br>
        <input type="text" name="firstname"><br>
        <?php echo form_error('firstname');?> 
        enter the last name:<br>
        <input type="text" name="lastname"><br>
        <?php echo form_error('lastname');?> 
        Email-id:<br>
        <input type="text" placeholder="Enter Username" name="email" required><br>
         <?php echo form_error('email');?> 
        Password:<br>
        <input type="password"id="pass" placeholder="Enter Password" name="password" required><br>
        <?php echo form_error('password');?> 
       ConfirmPassword:<br>
        <input type="password" placeholder="Enter Password" name="confirmpassword" required><br>
        <?php echo form_error('confirmpassword');?>
       
        <br>
        <br>
       
        <input id="submitbutton" type="submit" name='save' value="submit"><br>
        </form>
       
</div>  
    
        
        
        
                    