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
                $post_id = $row['post_id'];
                $title = $row['title'];
                $body  = $row['body'];
                if(isset($_SESSION['user_id'])){
                    $current_user_id = $_SESSION['user_id'];
                }else{
                    $current_user_id = '';
                }

               
               
               
                echo '<article class="block mb-3 shadow">
                            <div class="row">
                                <div class="col-sm-3">
                                    <img class="img-fluid rounded-circle" style="width:150px" alt="" src="default-picture.jpg">
                                    <h5>'. $username . '</h5>
                                </div>
                               
                                <div class="col-sm-9 form'. $post_id .'">
                                <form action="./inc/update.php" method="POST" class="d-none">
										<div class="form-group">
											<label for="title">Title</label>
											<input name="title" type="text" class="title form-control" id="blockTitle">
										</div>
										<div class="form-group">
											<label for="textareaBlock">Write Post</label>
											<textarea name="body" class="body form-control" id="blockTextArea" rows= "5"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <input style="display: none;" name="post_id" type="text" class="form-control"
                                            value="'.$post_id.'" >
                                        </div>
                                        <button type="submit" name="update" class="btn btn-success btn-md" data-toggle="tooltip" data-placement="bottom" title="Login!">
                                            Submit
                                        </button>
                                        <div
                                        class="cancelButton"
                                        onclick="editPost('. $post_id .');"
                                        class="btn btn-danger btn-md">
                                            Cancel
                                        </div>
                                    </form>
                                    
                                    <div class="post-container">
                                    <h3 class="'. $post_id .'">'. $title .'</h3>
                                    <p>'. $body .
                                    '</p>
                                    <div class="user-post-share">
                                    <button class="button-style btn btn-info btn-sm"><i class="fa fa-comment-o" aria-hidden="true"></i></button>'
                                    . 
                                    ($current_user_id === $user_id ? '<a href="/test/Milestone2/Cheese/inc/delete-handler.php?delete='.$post_id.'" class="button-style btn btn-info btn-sm"><i class="fa fa-trash-o" aria-hidden="true"></i></a>

                                    <button onclick="editPost('. $post_id .');" class="button-style btn btn-info btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                    </div>' : '') 
                                    .
                                    '<div class="user-likes">
                                    <button onClick="like('. $post_id . ');" name="" class="button-style btn btn-info btn-sm"><i class="fa fa-caret-square-o-up" aria-hidden="true"></i></button>
                                    <button onClick="dislike('. $post_id . ');" class="button-style btn btn-info btn-sm"><i class="fa fa-caret-square-o-down" aria-hidden="true"></i></button>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </article>';
            }
        }
        
    }
        
        
        
            
            
                
            
            
                
               
        
            


?>