<?php
    

    function getAllPosts(){
        require "connection.php";
        
        $sql = "SELECT * FROM posts ORDER BY date DESC LIMIT 30";
        $posts_result = mysqli_query($con, $sql);
        
        if(mysqli_num_rows($posts_result) > 0){
           while($row = mysqli_fetch_assoc($posts_result)){
                $user_id = $row['user_id'];
                //GET USERNAME 
                $sql = "SELECT username FROM users WHERE user_id='$user_id'";
                $username_results = mysqli_query($con, $sql);
                $username = mysqli_fetch_assoc($username_results);
                $username = array_shift($username);
               
               $title = $row['title'];
               $body  = $row['body'];
               
               
               
                echo '<article class="block mb-3 shadow">
                            <div class="row">
                                <div class="col-sm-3">
                                    <img class="img-fluid rounded-circle" style="width:150px" alt="" src="default-picture.jpg">
                                    <h5>'. $username . '</h5>
                                </div>
                                <div class="col-sm-9">
                                    <h3>'. $title .'</h3>
                                    <p>'. $body .
                                    '</p>
                                    <div class="user-post-share">
                                    <button class="button-style btn btn-info btn-sm"><i class="fa fa-comment-o" aria-hidden="true"></i></button>
                                    <button class="button-style btn btn-info btn-sm"><i class="fa fa-share-square-o" aria-hidden="true"></i></button>
                                    <button class="button-style btn btn-info btn-sm"><i class="fa fa-bookmark-o" aria-hidden="true"></i></button>
                                    </div>
                                    <div class="user-likes">
                                    <button class="button-style btn btn-info btn-sm"><i class="fa fa-caret-square-o-up" aria-hidden="true"></i></button>
                                    <button class="button-style btn btn-info btn-sm"><i class="fa fa-caret-square-o-down" aria-hidden="true"></i></button>
                                    </div>
                                </div>
                            </div>
                        </article>';
            }
        }
        
    }
        
        
        
            
            
                
            
            
                
               
        
            


?>