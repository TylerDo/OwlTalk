<?php
    function getAllPosts(){
        require "connection.php";
        
        $sql = "SELECT post_id FROM posts ORDER BY date DESC LIMIT 30";
        $posts_result = mysqli_query($con, $sql);
        
        if(mysqli_num_rows($posts_result) > 0){
           while($row = mysqli_fetch_assoc($posts_result)){
               $post_id = (int)$row['post_id'];
               if($post_id != 0){
                    getPost($post_id);
               }
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
            $title = $row['title'];
            $body = $row['body'];
            $likes = getLikes($post_id, 'p');
            $user_id = $row['user_id'];
            //GET USERNAME 
            $sql = "SELECT username FROM users WHERE user_id='$user_id'";
            $username_results = mysqli_query($con, $sql);
            $username = mysqli_fetch_assoc($username_results);
            $username = array_shift($username);
            date_default_timezone_set('America/New_York');
            $date = get_time_ago(strtotime($row['date']));

            if(isset($_SESSION['user_id'])){
                $current_user_id = $_SESSION['user_id'];
            }else{
                $current_user_id = '';
            }

            echo '<article class="block text-left mb-3 shadow">
            <div class="row">
                <div class="col-sm-3 text-center">
                    <div>
                    <img class="img-fluid rounded-circle" style="width:150px" alt="" src="default-picture.jpg">
                    </div>
                    <div>
                    <a href="profile.php?id='.$user_id.'" class="text-center text-dark h5">'. $username . '</a>
                    </div>
                </div>
               
                <div class="col-sm-9 d-flex flex-column align-items-stretch form'. $post_id .'">
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
                    
                    <h3 class="'. $post_id .'">'. $title .'</h3>
                    <p>'. $body .
                    '</p>
                    <div class="d-flex justify-content-end mt-auto user-post-share mb-2 mr-2">
                    <div class="mr-auto">'.$date.'</div>
                    <div class="mt-auto"><a href="./post.php?id='.$post_id.'" class="button-style btn btn-info btn-sm"><i class="fa fa-comment-o" aria-hidden="true"></i></a></div>'
                    . 
                    ($current_user_id === $user_id ? '<div class="mt-auto"><a href="/~cen4010s2020_g04/Milestone2/Cheese/inc/delete-post-handler.php?delete='.$post_id.'" class="button-style btn btn-info btn-sm"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                    
                    <button onclick="editPost('. $post_id .');" class="button-style btn btn-info btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></div>' : '') 
                    .
                    '<form action="" method="POST" class="mb-0">

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
        else{
            $_SESSION['error'] = 'post not found';
        }
        
    }

    function getComments($post_id){
        require "connection.php";
        
        if(!is_int($post_id)){
            $_SESSION['error'] = 'Page not found';
            header('location: index.php');
            exit();
        }

        getLikes($post_id, 'c');
        $sql = "SELECT u.username, c.date, c.body, c.likes, c.comment_id, c.user_id
        FROM users AS u, posts AS p, comment AS c 
        WHERE p.post_id = '$post_id' AND p.post_id = c.post_id AND u.user_id = c.user_id;";
        $post_result = mysqli_query($con, $sql);
        
        while($row = mysqli_fetch_assoc($post_result)){
            $comment_id = $row['comment_id'];
            $user_id = $row['user_id'];
            $date = get_time_ago(strtotime($row['date']));
            $likes = getLikes($comment_id, 'c');
            if(isset($_SESSION['user_id'])){
                $current_user_id = $_SESSION['user_id'];
            }else{
                $current_user_id = '';
            }
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
                    <div class="d-flex flex-row align-items-center voting-icons">'
                    . 
                    ($current_user_id === $user_id ? '<div class="mt-auto"><a href="/~cen4010s2020_g04/Milestone2/Cheese/inc/delete-comment-handler.php?delete='.$comment_id.'" class="button-style btn btn-info btn-sm"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                    <button onclick="editPost('.$comment_id .');" class="button-style btn btn-info btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></div>' : '') 
                    .
                    '<form action="" method="POST" class="mb-0">
                    <button name="increment" class="button-style btn btn-info btn-sm"><i class="fa fa-caret-square-o-up" aria-hidden="true"></i></button>
                    <button name="decrement" class="button-style btn btn-info btn-sm"><i class="fa fa-caret-square-o-down" aria-hidden="true"></i></button>
                    <input style="display: none;" name="comment_id" type="text" class="form-control"
                    value="'.$comment_id.'" >
                    </form>
                    <span class="ml-2">'.$likes.'</span>
                    <span class="dot ml-2"></span>
                    <h6 class="ml-2 mt-1">Reply</h6>
                    </div>
                </div>
                
        </div>';
        }
    }

    function getPosts($user_id){
        require "connection.php";

        $sql = "SELECT post_id FROM posts WHERE user_id = '$user_id'";
        $post_result = mysqli_query($con, $sql);
        if(mysqli_num_rows($post_result) > 0){
            while($row = mysqli_fetch_assoc($post_result)){
                $post_id = (int)$row['post_id'];
                if($post_id != 0){
                    getPost($post_id);
                }
            }
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

function increment($id, $switch){
    //Query the likes table
    require "connection.php";
    $user_id = $_SESSION['user_id'];
    if($switch == 'p'){
        $name_field = 'post_id';
        $comment_field = null;
        $post_field = $id;
    }elseif($switch == 'c'){
        $name_field = 'comment_id';
        $comment_field = $id;
        $post_field = null;
    }
    
    $sql = "SELECT * FROM likes WHERE user_id = '$user_id' AND $name_field = $id";
    $post_result = mysqli_query($con, $sql);
    if($row = mysqli_fetch_assoc($post_result)){
        //if entry UPDATE and is 1 change to 0
        //if entry UPDATE and is not 1 make 1
        $current_likes = (int)$row['likes'];
        if($current_likes == 1){
            $sql = "UPDATE likes SET likes='0' WHERE $name_field= $id AND user_id=$user_id";

            if (!mysqli_query($con, $sql)) {
                $_SESSION['error'] = "ERROR, oh jeez";
            }
        }
        elseif($current_likes == 0 || $current_likes == -1){
            $sql = "UPDATE likes SET likes='1' WHERE $name_field=$id AND user_id='$user_id'";

            if (!mysqli_query($con, $sql)) {
                $_SESSION['error'] = "ERROR, poopie";
            }
        }

    }else{
        //if no entry available then INSERT one with a 1 for the like
        $likes = 1;
        $sql = "INSERT INTO likes (user_id, post_id, comment_id, likes) VALUES (?, ?, ?, ?)";

        $stmt = mysqli_stmt_init($con);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            $_SESSION['error'] = "ERROR, blub". mysqli_error($con);
        }
        else{ //ADD POST INTO DATABASE
            mysqli_stmt_bind_param($stmt, "iiii", $user_id, $post_field, $comment_field, $likes);
            mysqli_stmt_execute($stmt);
        }
        // mysqli_stmt_close($stmt);
        // mysqli_close($con);
    }

    //if no entry available then INSERT one with a 1 for the like
    //if entry UPDATE and is 1 change to 0
    //if entry UPDATE and is not 1 make 1
}

function decrement($id, $switch){
    //Query the likes table
    require "connection.php";
    $user_id = $_SESSION['user_id'];

    if($switch == 'p'){
        $name_field = 'post_id';
    }elseif($switch == 'c'){
        $name_field = 'comment_id';
    }

    $sql = "SELECT * FROM likes WHERE user_id = $user_id AND $name_field=$id";
    $post_result = mysqli_query($con, $sql);
    if($row = mysqli_fetch_assoc($post_result)){
        //if entry UPDATE and is -1 change to 0
        //if entry UPDATE and is not -1 make -1
        $current_likes = (int)$row['likes'];
        if($current_likes == -1){
            $sql = "UPDATE likes SET likes='0' WHERE $name_field=$id AND user_id=$user_id";

            if (!mysqli_query($con, $sql)) {
                $_SESSION['error'] = "ERROR blub";
            }
        }
        elseif($current_likes == 0 || $current_likes == 1){
            $sql = "UPDATE likes SET likes='-1' WHERE $name_field=$id AND user_id=$user_id";
            if (!mysqli_query($con, $sql)) {
                $_SESSION['error'] = "ERROR asd";
            } else {
            }
        }

    }else{
        //if no entry available then INSERT one with a 1 for the like
        $likes = -1;
        $sql = "INSERT INTO likes (user_id, '$name_field', likes) VALUES (?, ?, ?)";

        $stmt = mysqli_stmt_init($con);
        if(!mysqli_stmt_prepare($stmt, $sql)){
        }
        else{ //ADD POST INTO DATABASE
            mysqli_stmt_bind_param($stmt, "iii", $user_id, $id, $likes);
            mysqli_stmt_execute($stmt);
        }
    }

    //if no entry available then INSERT one with a 1 for the like
    //if entry UPDATE and is 1 change to 0
    //if entry UPDATE and is not 1 make 1
}

function getLikes($id, $switch){
    require "connection.php";
    if($switch == 'p'){
        $sql = "SELECT SUM(likes) FROM likes WHERE post_id = '$id'";
        $post_result = mysqli_query($con, $sql);
        if($row = mysqli_fetch_assoc($post_result)){
            return $row['SUM(likes)'];
        }else{
            return 0;
        }
    }elseif($switch == 'c'){
        $sql = "SELECT SUM(likes) FROM likes WHERE comment_id = '$id'";
        $post_result = mysqli_query($con, $sql);
        if($row = mysqli_fetch_assoc($post_result)){
            return $row['SUM(likes)'];
        }else{
            return 0;
        }
    }
    
    
}

function getProfile($user_id){
    require "connection.php";
    $user_id = (int)$user_id;
    $sql = "SELECT * FROM profiles WHERE user_id= '$user_id'";
    $post_result = mysqli_query($con, $sql);
    if($row = mysqli_fetch_assoc($post_result)){
        echo '<div class="row">
        <!-- Left side for user profile -->
            <div class="col-md-4">
                <div id="userProfile" class="card" style="max-width: 100%; min-width: 208px;">
                    <img src="default-picture.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">
                        ' . ($row['name'] ? $row['name'] : 'Firstname Lastname') .  '</h5>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li id="location" class="list-group-item">' .    ($row['location'] ? 'Location: ' . $row['location'] : 'Location') .  '</li>
                        <li id="major" class="list-group-item">' .    ($row['major'] ? 'Major: '. $row['major'] : 'Major') .  '</li>
                        <li id="hobbies" class="list-group-item">' .    ($row['hobbies'] ? 'Hobbies: '. $row['hobbies'] : 'Hobbies') .  '</li>
                    </ul>
                    <div class="card-body">
                        <a href="post.html" class="card-link">Bookmarked Posts</a>
                    </div>
                    <!-- Create a new block button with modal -->
                    <button type="button" class="button-style btn btn-info btn-sm" id="updateProfileButton" data-toggle="modal" data-target="#updateProfile">Edit Profile</button>
                </div>
        </div>';
    }
    else{
        echo '<div class="row flex-nowrap">
    <!-- Left side for user profile -->
        <div class="col-md-4">
            <div id="userProfile" class="card" style="width: 18rem;">
                <img src="default-picture.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Firstname LastName</h5>
                </div>
                <ul class="list-group list-group-flush">
                    <li id="location" class="list-group-item">Location</li>
                    <li id="major" class="list-group-item">Major</li>
                    <li id="hobbies" class="list-group-item">Hobbies</li>
                </ul>
                <div class="card-body">
                    <a href="post.html" class="card-link">Bookmarked Posts</a>
                </div>
                <!-- Create a new block button with modal -->
                <button type="button" class="button-style btn btn-info btn-sm" id="updateProfileButton" data-toggle="modal" data-target="#updateProfile">Edit Profile</button>
            </div>
    </div>';
    }
}
?>