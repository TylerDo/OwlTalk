<?php 
    include("./server/server.php");
    if(isset($_SESSION['username'])) 
         {
             include("./inc/logged-out-header.php");
         } //IF LOGGED IN 
      else
         {
             include("./inc/logged-in-header.php");
         } //IF LOGGED IN       
               ?>
		
		<!-- Main Block Section -->
		<section class="block-posts text-center mt-4">
			<div class="container">
			<div class="row">
				<div class="col-md-12">
						<article class="block mb-3 shadow">
							<div class="row">
								<div class="col-sm-3">
									<img class="img-fluid rounded-circle" style="width:150px" alt="" src="TylerDo.jpg">
								</div>
								<div class="col-sm-9">
									<h3> My Block Post Title</h3>
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit,
									sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
									Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi
									ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit 
									in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur 
									sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt
									mollit anim id est laborum.
									</p>
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
						</article>
						<article class="block mb-3 shadow">
							<div class="row">
								<div class="col-sm-3">
									<img class="img-fluid rounded-circle" style="width:150px" alt="" src="TylerDo.jpg">
								</div>
								<div class="col-sm-9">
									<h3> My Block Post Title</h3>
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit,
									sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
									Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi
									ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit 
									in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur 
									sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt
									mollit anim id est laborum.
									</p>
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
						</article>
						<article class="block mb-3 shadow">
							<div class="row">
								<div class="col-sm-3">
									<img class="img-fluid rounded-circle" style="width:150px" alt="" src="TylerDo.jpg">
								</div>
								<div class="col-sm-9">
									<h3> My Block Post Title</h3>
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit,
									sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
									Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi
									ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit 
									in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur 
									sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt
									mollit anim id est laborum.
									</p>
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
						</article>
						<article class="block mb-3 shadow">
							<div class="row">
								<div class="col-sm-3">
									<img class="img-fluid rounded-circle"  style="width:150px"alt="" src="TylerDo.jpg">
								</div>
								<div class="col-sm-9">
									<h3> My Block Post Title</h3>
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit,
									sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
									Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi
									ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit 
									in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur 
									sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt
									mollit anim id est laborum.
									</p>
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
						</article>
				</div>
			</div>
		</section>
	</body>
</html>