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
                $likes = getLikes($post_id);
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
                                    '<form action="" method="POST">
                                    <button name="increment" class="button-style btn btn-info btn-sm"><i class="fa fa-caret-square-o-up" aria-hidden="true"></i></button>
                                    '.$likes.'
                                    <button name="decrement" class="button-style btn btn-info btn-sm"><i class="fa fa-caret-square-o-down" aria-hidden="true"></i></button>
        
                                    <input style="display: none;" name="post_id" type="text" class="form-control"
                                                    value="'.$post_id.'" >
                                </form>
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

        $likes = getLikes($post_id);
        $sql = "SELECT * FROM posts WHERE post_id = '$post_id'";
        $post_result = mysqli_query($con, $sql);
        if($row = mysqli_fetch_assoc($post_result)){
            echo '
            <article class="block text-left mb-3 shadow">
                <div class="row">
                    <div class="col-sm-3">
                        <img class="img-fluid rounded-circle" style="width:150px" alt="" src="default-picture.jpg">
                    </div>
                    <div class="col-sm-9">
                        <h3> '.$row['title'].'</h3>
                        <p>'.$row['body'].'</p>
                        <div class="user-post-share">
                        <form action="" method="POST">
                            <button name="increment" class="button-style btn btn-info btn-sm"><i class="fa fa-caret-square-o-up" aria-hidden="true"></i></button>
                            '.$likes.'
                            <button name="decrement" class="button-style btn btn-info btn-sm"><i class="fa fa-caret-square-o-down" aria-hidden="true"></i></button>

                            <input style="display: none;" name="post_id" type="text" class="form-control"
                                            value="'.$post_id.'" >
                        </form>
                        </div>
                    </div>
                </div>
            </article>';
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
        getLikes($post_id);
        $sql = "SELECT u.username, c.date, c.body, c.likes 
        FROM users AS u, posts AS p, comment AS c 
        WHERE p.post_id = '$post_id' AND p.post_id = c.post_id AND u.user_id = c.user_id;";
        $post_result = mysqli_query($con, $sql);
        
        while($row = mysqli_fetch_assoc($post_result)){
            $date = get_time_ago(strtotime($row['date']));
            echo '
            <div class="commented-section mt-4">
            <div class="d-flex flex-row align-items-center commented-user">
                <h5 class="mr-2">'.$row['username'].'</h5>
                <span class="dot mb-1"></span>
                <span class="mb-1 ml-2">'.$date.'</span>
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
        </div>';
        }
    }

    function getPosts(){
        if(isset($_SESSION['user_id'])){
            require "connection.php";
            $user_id = $_SESSION['user_id'];

            $sql = "SELECT * FROM posts WHERE user_id = '$user_id'";
            $post_result = mysqli_query($con, $sql);
            if(mysqli_num_rows($post_result) > 0){
                while($row = mysqli_fetch_assoc($post_result)){
                    echo '
                <article class="block text-left mb-3 shadow">
                    <div class="row">
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
                    </div>
                </article>';
                }
            }else{
                echo '<p>No Posts made from this account</p>';
            }
        }else{
            echo '';
        }
    }

    function get_time_ago( $time ){
    date_default_timezone_set('America/New_York');
    $time_difference = time() - $time;

    if( $time_difference < 1 ) { return 'less than 1 second ago'; }
    $condition = array( 12 * 30 * 24 * 60 * 60 =>  'year',
                30 * 24 * 60 * 60       =>  'month',
                24 * 60 * 60            =>  'day',
                60 * 60                 =>  'hour',
                60                      =>  'minute',
                1                       =>  'second'
    );

    foreach( $condition as $secs => $str )
    {
        $d = $time_difference / $secs;

        if( $d >= 1 )
        {
            $t = round( $d );
            return 'about ' . $t . ' ' . $str . ( $t > 1 ? 's' : '' ) . ' ago';
        }
    }
}

function increment($post_id){
    //Query the likes table
    require "connection.php";
    $user_id = $_SESSION['user_id'];

    $sql = "SELECT * FROM likes WHERE user_id = '$user_id' AND post_id='$post_id'";
    $post_result = mysqli_query($con, $sql);
    if($row = mysqli_fetch_assoc($post_result)){
        //if entry UPDATE and is 1 change to 0
        //if entry UPDATE and is not 1 make 1
        $current_likes = (int)$row['likes'];
        if($current_likes == 1){
            $sql = "UPDATE likes SET likes='0' WHERE post_id='$post_id' AND user_id='$user_id'";

            if (!mysqli_query($con, $sql)) {
                $_SESSION['error'] = "ERROR";
            }
        }
        elseif($current_likes == 0 || $current_likes == -1){
            $sql = "UPDATE likes SET likes='1' WHERE post_id='$post_id' AND user_id='$user_id'";

            if (!mysqli_query($con, $sql)) {
                $_SESSION['error'] = "ERROR";
            }
        }

    }else{
        //if no entry available then INSERT one with a 1 for the like
        $likes = 1;
        $sql = "INSERT INTO likes (user_id, post_id, likes) VALUES (?, ?, ?)";

        $stmt = mysqli_stmt_init($con);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            $_SESSION['error'] = "ERROR";
        }
        else{ //ADD POST INTO DATABASE
            mysqli_stmt_bind_param($stmt, "iii", $user_id, $post_id, $likes);
            mysqli_stmt_execute($stmt);
        }
        mysqli_stmt_close($stmt);
        mysqli_close($con);
    }

    //if no entry available then INSERT one with a 1 for the like
    //if entry UPDATE and is 1 change to 0
    //if entry UPDATE and is not 1 make 1
}

function decrement($post_id){
    //Query the likes table
    require "connection.php";
    $user_id = $_SESSION['user_id'];

    $sql = "SELECT * FROM likes WHERE user_id = '$user_id' AND post_id='$post_id'";
    $post_result = mysqli_query($con, $sql);
    if($row = mysqli_fetch_assoc($post_result)){
        //if entry UPDATE and is -1 change to 0
        //if entry UPDATE and is not -1 make -1
        $current_likes = (int)$row['likes'];
        if($current_likes == -1){
            $sql = "UPDATE likes SET likes='0' WHERE post_id='$post_id' AND user_id='$user_id'";

            if (!mysqli_query($con, $sql)) {
                $_SESSION['error'] = "ERROR";
            }
        }
        elseif($current_likes == 0 || $current_likes == 1){
            $sql = "UPDATE likes SET likes='-1' WHERE post_id='$post_id' AND user_id='$user_id'";

            if (mysqli_query($con, $sql)) {
            } else {
            }
        }

    }else{
        //if no entry available then INSERT one with a 1 for the like
        $likes = -1;
        $sql = "INSERT INTO likes (user_id, post_id, likes) VALUES (?, ?, ?)";

        $stmt = mysqli_stmt_init($con);
        if(!mysqli_stmt_prepare($stmt, $sql)){
        }
        else{ //ADD POST INTO DATABASE
            mysqli_stmt_bind_param($stmt, "iii", $user_id, $post_id, $likes);
            mysqli_stmt_execute($stmt);
        }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }

    //if no entry available then INSERT one with a 1 for the like
    //if entry UPDATE and is 1 change to 0
    //if entry UPDATE and is not 1 make 1
}

function getLikes($post_id){
    require "connection.php";
    $sql = "SELECT SUM(likes) FROM likes WHERE post_id = '$post_id'";
    $post_result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($post_result);
    return $row['SUM(likes)'];

}
?>