<?php
    session_start();
    include 'connect.php';

    if($conn)
    {
        if($_SESSION['uname']=="")
        {
            ?>
            <script type="text/javascript">
                alert("Please Login!..");
                window.location.assign('index.html');
            </script>
            <?php
        }
        
        $sender = $_SESSION['uname'];
        $receiver = $_SESSION['touname'];
        
        $display_chat ="SELECT * FROM `messages` WHERE from_user='$sender' AND to_user='$receiver' OR to_user='$sender' AND from_user='$receiver' ORDER BY id ";
    
        $chat_result = mysqli_query($conn,$display_chat);
        $chat_count = mysqli_num_rows($chat_result);
    
        while ($chat_rows=mysqli_fetch_assoc($chat_result))
        {
            
            if($chat_rows['from_user'] == $_SESSION['uname'])
            {
                ?>
                <br>
                <div id="sender_message_body">
    
                    <div id="message_of_sender">
    
                        <?php echo $chat_rows['message'];  ?>
                        
                    </div>
    
                    <div id="sender_time_of_message">
    
                        <?php echo $chat_rows['time']  ?>
    
                    </div>
                </div>
                <br>
                
                

                <?php
            }
            else
            {
                ?>
                <br>
                <div id="receiver_message_body">
    
                    <div id="message_of_user">
    
                        <?php echo $chat_rows['message'];  ?>
                        
                    </div>
    
                    <div id="receiver_time_of_message">
    
                        <?php echo $chat_rows['time']  ?>
    
                    </div>
                </div>
                <br>
                
               
                <?php
            }
        }
        mysqli_close($conn);
    }

?>

