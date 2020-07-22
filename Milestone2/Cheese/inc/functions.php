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

               
               
               
                echo '<article class="block text-left mb-3 shadow">
                            <div class="row">
                                <div class="col-sm-3">
                                    <img class="img-fluid rounded-circle" style="width:150px" alt="" src="default-picture.jpg">
                                    <h5 class="text-center">'. $username . '</h5>
                                </div>
                               
                                <div class="col-sm-9 form'. $post_id .'">
                                <form action="./inc/update-post-handler.php" method="POST" class="d-none">
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
                                    <a href="./post.php?id='.$post_id.'" class="button-style btn btn-info btn-sm"><i class="fa fa-comment-o" aria-hidden="true"></i></a>'
                                    . 
                                    ($current_user_id === $user_id ? '<a href="/~cen4010s2020_g04/Milestone2/Cheese/inc/delete-handler.php?delete='.$post_id.'" class="button-style btn btn-info btn-sm"><i class="fa fa-trash-o" aria-hidden="true"></i></a>

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
        
    function getPost($post_id){
        require "connection.php";
        
        if(!is_int($post_id)){
            $_SESSION['error'] = 'Page not found';
            header('location: index.php');
            exit();
        }


        $sql = "SELECT * FROM posts WHERE post_id = '$post_id'";
        $post_result = mysqli_query($con, $sql);
        if($row = mysqli_fetch_assoc($post_result)){
            echo '<div class="row">
            <div class="col-sm-3">
                <img class="img-fluid rounded-circle" style="width:150px" alt="" src="default-picture.jpg">
            </div>
            <div class="col-sm-9">
                <h3> '.$row['title'].'</h3>
                <p>'.$row['body'].'</p>
                <div class="user-post-share">
                <button class="button-style btn btn-info btn-sm"><i class="fa fa-caret-square-o-up" aria-hidden="true"></i></button>
                <button class="button-style btn btn-info btn-sm"><i class="fa fa-caret-square-o-down" aria-hidden="true"></i></button>
                </div>
            </div>
        </div>';
        }
        else{
            $_SESSION['error'] = 'post not found';
            header('location: index.php');
            exit();
        }
        
    }

    function getComments($post_id){
        require "connection.php";
        
        if(!is_int($post_id)){
            $_SESSION['error'] = 'Page not found';
            header('location: index.php');
            exit();
        }

        $sql = "SELECT u.username, c.date, c.body, c.likes 
        FROM users AS u, posts AS p, comment AS c 
        WHERE p.post_id = '$post_id' AND p.post_id = c.post_id AND u.user_id = p.user_id;";
        $post_result = mysqli_query($con, $sql);
        
        if($row = mysqli_fetch_assoc($post_result)){
            echo '
            <div class="commented-section mt-4">
            <div class="d-flex flex-row align-items-center commented-user">
                <h5 class="mr-2">'.$row['username'].'</h5>
                <span class="dot mb-1"></span>
                <span class="mb-1 ml-2">'.$row['date'].'</span>
            </div>
            <div class="comment-text-sm">
                <span>'.$row['body'].'</span>
            </div>
                <div class="reply-section">
                    <div class="d-flex flex-row align-items-center voting-icons">
                    <button class="button-style btn btn-info btn-sm mr-2"><i class="fa fa-caret-square-o-up"></i></button>
                    <button class="button-style btn btn-info btn-sm"><i class="fa fa-caret-square-o-down"></i></button>
                    <span class="ml-2">12</span>
                    <span class="dot ml-2"></span>
                    <h6 class="ml-2 mt-1">Reply</h6>
                    </div>
                </div>
        </div>
    ';
        }
        else{
            echo "";
        }
    }
?>