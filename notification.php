<?php
	
	session_start();
	include 'connect.php';

    if($_SESSION['uname']=="")
    {
        ?>
        <script type="text/javascript">
            alert("Please Login!..");
            window.location.assign('index.html');
        </script>
        <?php
    }
	
	$from_user = $_SESSION["uname"];



    $res_users = "SELECT DISTINCT from_user,to_user FROM messages WHERE to_user='$from_user' OR from_user='$from_user' ";
    $rec_res = mysqli_query($conn,$res_users);

    $temp_users = array();
    $i = 0 ;

    while ($rec_users=mysqli_fetch_assoc($rec_res)) 
    {	

        if( !(array_search($rec_users['to_user'],$temp_users)) && $rec_users['from_user']==$from_user)
        {
            array_push($temp_users, $rec_users['to_user']);
        }
        elseif( !(array_search($rec_users['from_user'],$temp_users)) && $rec_users['to_user']==$from_user)
        {
            array_push($temp_users, $rec_users['from_user']);
        }
        elseif($rec_users['to_user']==$from_user && $rec_users['from_user']==$from_user)
        {
            array_push($temp_users, $rec_users['from_user']);
        }
    }

    $op_users = array_unique($temp_users);
    sort($op_users);

    $final_users = array();
    $l=0;

    foreach($op_users as $op)
    {
        $final_users[$l] = $op;
        $l=$l+1;
    }

    if(count($final_users)!=0)
    {
        for ($i=0; $i < count($final_users); $i++)
        {
            $temp = $final_users[$i];

            $get_notifications = "SELECT COUNT(`message`) as total FROM messages WHERE `from_user`='$temp' AND `to_user`='$from_user' AND `status`='unseen' ";
            $noti_result = mysqli_query($conn,$get_notifications);

            while ($notifications=mysqli_fetch_assoc($noti_result))
            {
               ?>

                <form id='users_form' method="GET" action="userchat.php">
                    
                    <button type="submit"  id="user_blimp" name="recent_click" value=<?php echo $temp;?>><?php echo $temp;?>
                    <span id="notification">
                    <?php
                        if($notifications['total']!=0)
                        {
                            echo $notifications['total'];
                        }

                     ?></span></button>
                    
                </form>

               <?php
            }
        }
    }
    else
    {
       ?>
        <p id="no_recent">No recent chat found</p>
       <?php
    }
	
?>	

<style type="text/css">
    #notification
    {   
        position: relative;
        bottom: : 10px;
        left: 8px;
        float: right;
        border: none;
        height: 88%;
        border-left: 2px solid black;
        
        padding-top: 5px;
        padding-left: 17px;
        padding-right: 13px;
        color: white;
        font-size: 25px;
        font-weight: bold;
    }
</style>							