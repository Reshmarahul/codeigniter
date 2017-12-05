<!-- <!DOCTYPE html>
<html>
    <head>
        <title>LOGIN</title>
    </head>
    <body> -->
        <div id="content" align="center">
            <form id="login_form" action='<?php echo BASE_URL."/login/verify";?>' method='post' name='process'>
                <h2>User Login</h2>
                <!-- display message if entered value and database value are not equal -->
                <span><?php if(! is_null($msg)) echo $msg;?></span>
                <span id="logerror"></span>
                <br/>
                <label>Username</label>
                <br/>
                <input class="logbox" type="email" name="useremail" placeholder="useremail" id="useremail" value="<?php echo set_value('useremail');?>"/><br/>
                <span><?php echo form_error('useremail');?></span>
                <br/>
                <label>Password</label>
                <br/>
                <input class="logbox" type="password" name="password" placeholder="*******" id="password" value="<?php echo set_value('password');?>"/><br/>
                <span><?php echo form_error('password');?></span>
                <br/>
                <input id="login_button" type="submit" value="Login"/>
            </form>
        </div>
    <!-- </body>
</html> -->