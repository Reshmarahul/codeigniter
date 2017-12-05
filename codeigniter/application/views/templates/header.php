<html>
        <head>
                <title>CodeIgniter</title>
                <link rel="stylesheet" type="text/css" href="<?php echo  css_url.'/userslist.css'?>">
        </head>
        <body>
                
        <a href="http://192.168.20.246/codeigniterproject/index.php/";>Dashboard</a>
                
                <div id="header">
                        <h1><?php echo 'WELCOME'; ?></h1>
                        <?php if($home==1): ?>
                                <div align="right"><a href='<?php echo BASE_URL."/home";?>'>Home</a></div>
                        <?php endif?>
                        <?php if($logout==1): ?>        
                               <div align="right"><a href='<?php echo BASE_URL."/home/do_logout";?>'>Logout</a></div>
                        <details align="right">
                                <summary>Admin Profile</summary>
                                <p id="p2"><?php $user_data = $this->session->userdata('useremail');echo 'Username: '.$user_data;?></p>
                                <p id="p2"><?php $user_data = $this->session->userdata('fname');echo 'Firstname: '. $user_data;?></p>
                                <p id="p2"><?php $user_data = $this->session->userdata('lname');echo 'Lastname: '. $user_data;?></p>
                        </details>
                        <?php endif?> 
</div>
               