<!-- <!DOCTYPE html>
<html>
    <head>
        <title>Add new user</title>
    </head>
    <body> -->
        <div id="content">
        <h2>Add New User</h2>
        <?php $attributes=array('id'=>'add_user_form');?>
        <?php echo form_open_multipart('home/do_upload',$attributes);?>
                <p class="p3">Username:<input type="text" name="username" placeholder="username" value="<?php echo set_value('username');?>"/></p>
                <span><?php echo form_error('username');?></span>
                <p class="p3">Email:<input type="email" name="email" placeholder="email" value="<?php echo set_value('email');?>"/></p>
                <span><?php echo form_error('email');?></span>
                <p class="p3">Password:<input id="pass" type="password" name="password" placeholder="password" value="<?php echo set_value('password');?>"/></p>
                <span><?php echo form_error('password');?></span>
                <p class="p3">Confirm Password:<input type="password" name="confirmpassword" placeholder="confirmpassword" value="<?php echo set_value('confirmpassword');?>"/></p>
                <span><?php echo form_error('confirmpassword');?></span>
                <p class="p3">Department:<input type="text" name="department" placeholder="department" value="<?php echo set_value('department');?>"/></p>
                <span><?php echo form_error('department');?></span>
                <p class="p3">Designation:<input type="text" name="designation" placeholder="designation" value="<?php echo set_value('designation');?>"/></p>
                <span><?php echo form_error('designation');?></span>
                <p class="p3">Upload Your Photo:<input type="file" name="image" size="20"/></p>
                <input id="add_button" type="submit" name="submit" value="submit"/><br/>
        </form>
        </div>
    <!-- </body>
</html> -->