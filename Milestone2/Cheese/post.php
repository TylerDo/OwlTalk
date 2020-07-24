<?php
    include('./inc/functions.php');
    session_start();
    if(isset($_SESSION['user_id'])) 
    {
        include('./inc/headers/logged-in-header.php');
    } //IF LOGGED IN 
    else
    {
        include("./inc/headers/logged-out-header.php");
    } //IF LOGGED IN      

    if(isset($_POST['increment'])){
        if(isset($_SESSION['user_id'])){
            if(isset($_POST['post_id'])){
                
                $post_id = (int)$_POST['post_id'];
                if($post_id != 0){
                    increment($post_id, "p");
                }
            }
            elseif(isset($_POST['comment_id'])){
                $comment_id = (int)$_POST['comment_id'];
                if($comment_id != 0){
                    increment($comment_id, "c");
                }
            }
            
        }
    }

    if(isset($_POST['decrement'])){
        if(isset($_SESSION['user_id'])){
            if(isset($_POST['post_id'])){
                $post_id = (int)$_POST['post_id'];
                if($post_id != 0){
                    decrement($post_id, "p");
                }
            }
            elseif(isset($_POST['comment_id'])){
                $comment_id = (int)$_POST['comment_id'];
                if($comment_id != 0){
                    decrement($comment_id, "c");
                }
            }
            
        }
    }
    
    
    if(isset($_GET['id'])):
?>

<?php if(isset($_SESSION['success'])) : ?>
               <div class="alert alert-success text-center">
                   <?php echo $_SESSION['success']; 
						unset($_SESSION['success'])
						//SUCCESSFUL CREATION OF ACCOUNT?> 
               </div>
<?php endif ?>

<?php if(isset($_SESSION['error'])) : ?>
    <div class="alert alert-danger text-center">
        <?php echo $_SESSION['error']; 
            unset($_SESSION['error'])
            //SUCCESSFUL CREATION OF ACCOUNT?> 
    </div>

<?php endif ?>

<section class="block-posts mt-4">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <article class="block mb-3 shadow">
                    <!--POST-->
                    <?php 
                        $post_id = (int)$_GET['id'];
                        getPost($post_id);
                    ?>
                    <div class="coment-bottom p-2 px-4">
                        <!--COMMENT FORM-SHOW IF LOGGED IN-->
                        <?php if(isset($_SESSION['user_id'])): ?>
                        <form method="POST" action="./inc/create-comment-handler.php" class="d-flex flex-row add-comment-section mt-4 mb-4">
                            <img class="img-fluid img-responsive rounded-circle mr-2" src="default-picture.jpg" width="38">
                            <input name="body" type="text" class="form-control mr-3" placeholder="Add comment">
                            <input style="display: none;" name="post_id" type="text" value="<?php echo $post_id; ?>">
                            <button name="create-comment" class="button-style btn btn-info btn-sm" type="submit">Comment</button>
                        </form>
                        <?php endif?>
                        <div class="dropdown-divider"></div>
                        <!--COMMENT SECTION-->
                        <?php getComments($post_id);?>
                    </div>
                </article>
            </div>
        </div>
    </div>
</section>

<?php endif?>