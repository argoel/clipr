<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>ClipR</title>
	<link rel="stylesheet" href="../static/lib/bootstrap/css/bootstrap.min.css">
	<style>
		body  {
		    margin: 0; 
		    padding: 0;
		    background-color: #F3EEEE;
		}

		.top-bar {
			padding-left:30px;
		}
 		.item {
		/*width: 230px;*/
		margin:24px 7px 0 7px;
		/*
		border: 2px dotted;
		border-color: #d1d1d1;
		*/
		float: left;
		background-color: #ffffff;
		/*width: 18%;*/
		cursor: pointer; 
		cursor: hand;

		}
		.item-container {
			
		}
		.top-item {
			margin: auto;
			height: 60px;
			border-bottom: 1px solid;
			
		}

		.dropdown-toggle{
			cursor: pointer; 
			cursor: hand;
		}

		.profile_pic {
			float: left;
		}

		.reviews{
			display: none;
		}

		.clips{
			display: none;
		}

		.store_name {

		}

		.mid-item {
			/*padding-top:5px;*/
			padding-bottom:10px;
			border-bottom: 1px solid;
			border-color: #d1d1d1;
		}

		.mid-item img {
			border: none;
			display: block;
			margin: 0 auto;
			padding-bottom: 5px;
			width: 225px;
			height: 225px;
		}

		.mid-item details {
			border: none;
			display: block;
			margin: 0 auto;
			padding-bottom: 5px;
		}

		.bottom-item {
			padding-left:10px;
			padding-top:10px;
			padding-bottom:10px;
		}

		.clear {
			clear: both;
		}

		.clips {
			float:left;
			padding-left:25px;
			padding-top:5px;
			cursor: pointer; 
			cursor: hand;
		}

		.likes {
			float:left;
			padding-left:25px;
			padding-top:5px;
			cursor: pointer; 
			cursor: hand;
		}

		body .modal {
			width: 250px;
			margin-left: -150px;
		}

		body .modal .modal-body {
			margin:auto;
		}

	</style>
</head>

<body>


<div class="container" style="width:100%">
	<div class="top-bar">
		<div class="top-left" style="width:15%;float:left;">
			<h1 style="color:#B00000;cursor: pointer;cursor: hand;">ClipR</h1>
		</div>
		<div class="top-mid" style="float:left;width:50%;">
			<form class="form-horizontal" role="search">
		        <div class="form-group" style="padding-top:15px;">
		          <input type="text" class="form-control span3" placeholder="Find: Restaurant, Party, etc" style="float:left;">
		          <input type="text" class="form-control span2" placeholder="Near: Palo Alto, CA " style="float:left;">
		        </div>
		        <button type="submit" class="btn btn-default">Search</button>
		    </form>
		</div>
		<div class="top-right" id="top-right" style="width:25%;float:right;padding-top:15px;">
		</div>
    </div>
</div>
<hr/>
<div class="container" style="background-color:; width:100%;padding-left:20px;padding-right:20px;">
<nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->

      <ul class="nav navbar-nav">
        <li class="active"><a href="#" data-toggle="pill" onclick="postList.render();">Recommended Clips</a></li>
        <li><a href="#" data-toggle="pill" onclick="postList.render();">All Clips</a></li>
        <li><a href="#"  data-toggle="pill" onclick="myclips();">My Clips</a></li>
      </ul>
  </div><!-- /.container-fluid -->
</nav>
	<div id="page" class="page">
	</div>
</div>

		<script type="text/template" id="user-this-template">
		      <ul class="nav navbar-nav" style="float:left;padding-top:10px;">
		        <li class="dropdown">
		          <c class="dropdown-toggle" onclick='data-toggle="dropdown"'><%= user.get('name') %> <b class="caret"></b></c>
		          <ul class="dropdown-menu">
		            <li><a href="#">Action</a></li>
		            <li><a href="#">Another action</a></li>
		            <li><a href="#">Something else here</a></li>
		            <li class="divider"></li>
		            <li><a href="#">Separated link</a></li>
		            <li class="divider"></li>
		            <li><a href="#">One more separated link</a></li>
		          </ul>
		        </li>
		      </ul>
			<img src="<%= user.get('imgurl') %>" width="60" style="padding-left:10px;">
		</script>

		<script type="text/template" id="user-list-template">
				<% _.each(posts, function(post) { %>
							<div class="item" href="#item" data-toggle="modal" data-post='<%= JSON.stringify(post) %>'>
								<div class="item-container">
									<div class="reviews" style="float:left;padding-left:15px;width:30%;padding-top:10px;">
										<img src="../static/img/reviews.jpeg" width="80" height="">
									</div>
									<div class="clips" style="float:right;padding-right:15px;width:10%;padding-top:5px;">
										<img src="../static/img/scissor.jpeg" width="40" height="">
									</div>
									<div class="mid-item">
										<img src=<%=post.get('imgurl') %>>
										<div class="details" style="padding-left:10px;">
											<div class="title" style="padding-bottom:5px;">
												<%= post.get('title').length > 30 ?	post.get('title').substring(0,30) + '...' : post.get('title')%>
											</div>
											<div class="non_name">
												<span class="store_name" style="float:left;">
													<%= post.get('store').name %>
												</span>
												<span class="location" style="float:right;padding-right:10px;">
													3 mi
												</span>
											</div>
										</div>
										<div class="clear"></div>
									</div>
									<div class="bottom-item">
											<div class="validity" style="float:left;">
												<font size="2">Valid : Today, <%= post.get('validity') %></font>
											</div>
											<div class="cost" style="float:right;padding-right:10px;">
												<font size="2"><%= post.get('cost') ? "$"+post.get('cost') : '' %></font>
											</div>
											<div class="clear"></div>
									</div>
							</div>
						</div>
				<% }); %>
		</script>

		<div class="modal fade" id="item" role = "dialog">
			<div class = "modal-dialog">
				<div class = "modal-content">
					<div class="modal-header">
						<p>Clip It</p>
					</div>
					<div class = "modal-body">
						<img id="image" style="width:225px; height:225px;">
						<div class="details" style="padding-left:10px;">
							<div class="title" id = "title" style="padding-bottom:5px;"></div>
							<div class="non_name">
								<span class="store_name" id="store_name" style="float:left;"></span>
								<span class="location" style="float:right;padding-right:10px;">3 mi</span>
							</div>
						</div>
						<div class="clear"></div>
						<div class="bottom-item">
							<div class="validity" style="float:left;">
							<font size="2" id="valid"></font>
							</div>
							<div class="cost" style="float:right;padding-right:10px;">
							<font size="2" id="cost"></font>
							</div>
							<div class="clear"></div>
						</div>
					</div>
					<div class = "modal-footer">
						<input type="hidden" name="pid" id="pid"/>
						<a class="btn btn-primary" data-dismiss = "modal" onclick="saveclip($('#pid').val())">Clip</a>
						<a class="btn btn-default" data-dismiss = "modal"> Close</a>
					</div>
				</div>
			</div>
		</div>
	<script type="text/javascript" src="../static/js/lib/jquery/jquery-1.10.2.min.js"></script>
	<script type="text/javascript" src="../static/lib/bootstrap/js/bootstrap.min.js"></script>
	<script src="../static/js/lib/masonry/jquery.masonry.min.js"></script>
	<script src="../static/js/lib/underscore/underscore-min.js"></script>
	<script src="../static/js/lib/backbone/backbone-min.js"></script>

	<script>

		$(document).on("click", ".item", function () {
			var post = $(this).data('post');
			$(".modal-body #title").html(post['title']);
			$(".modal-body #image").attr({
				src: post['imgurl']
			})
			$(".modal-body #store_name").html(post['store']['name']);
			$(".modal-footer #pid").val(post['id']);
		});
	</script>

	<script>

		$.ajaxPrefilter( function( options, originalOptions, jqXHR ) {
			//options.url = 'http://backbonejs-beginner.herokuapp.com' + options.url;
			//options.url = 'http://127.0.0.1:8000/' + options.url;
		});

		$.fn.serializeObject = function() {
			var o = {};
			var a = this.serializeArray();
			$.each(a, function() {
				if (o[this.name] !== undefined) {
					if (!o[this.name].push) {
						o[this.name] = [o[this.name]];
					}
					o[this.name].push(this.value || '');
				} else {
					o[this.name] = this.value || '';
				}
			});
			return o;
		};

		var cururl = window.location.host;
		var dataurl = '';
		var imurl = '';
		var hosturl = '';

		if (cururl=='pagekite') {
			dataurl = 'http://data-clipr.pagekite.me';
			imurl = 'http://img-clipr.pagekite.me';
			hosturl = 'http://clipr.pagekite.me';			
		}
		else {
			dataurl = 'http://127.0.0.1:8000';
			imurl = 'http://127.0.0.1:8080';
			hosturl = 'http://localhost';
		}

		var Posts = Backbone.Collection.extend({
			url: dataurl+'/api/v1/post/'
			//url: '/users/'
		});

		var Post = Backbone.Model.extend({
			urlRoot: dataurl+'/api/v1/post/'
		});

		var User = Backbone.Model.extend({
			urlRoot: dataurl+'/api/v1/users/'
			//url: '/users/'
		});

		var Clips = Backbone.Collection.extend({
			url: dataurl+'/api/v1/clips/'
		});

		var Clip = Backbone.Model.extend({
			urlRoot: dataurl+'/api/v1/clips/'
		});

		var Like = Backbone.Model.extend({
			urlRoot: dataurl+'/api/v1/likes/'
		});


		var UserThis = Backbone.View.extend({
			el: '.top-right',
			render: function (options) {
				var that = this;
				if (options.id) {
					that.user = new User({id: options.id});
					that.user.fetch({
						success: function (user) {
							var template = _.template($('#user-this-template').html(), {user: user});
							that.$el.html(template);
						}
					});
				}
				else {
					var template = _.template($('#user-this-template').html(), {user: null});
					this.$el.html(template);
				}
			}
		});

		var PostList = Backbone.View.extend({
			el: '.page',
			render: function () {
				var that = this;
				var posts = new Posts();
				posts.fetch({
					success: function (posts) {
						var template = _.template($('#user-list-template').html(), {posts: posts.models});
						that.$el.html(template);
					}
				});
			},
			saveclip: function (pid, uid) {
				var post = new Post({id: pid});
				var user = new User({id: uid});
				post.fetch({
					success: function(post) {
						user.fetch({
							success: function(user) {
								var data = {'user': user, 'post': post};
								var clip = new Clip();
								clip.save(data, {
									dataType:"text",
									success: function () {
										var clipcount = post.get('clipcount')+1;
										var postData = {'id':post.id, 'clipcount':clipcount};
										post.save(postData, {
											dataType:"text",
											success: function () {
												postList.render();
											}
										})
									}
								});
							}
						});
					}
				});
			},
			savelike: function (pid, uid) {
				var post = new Post({id: pid});
				var user = new User({id: uid});
				post.fetch({
					success: function(post) {
						user.fetch({
							success: function(user) {
								var data = {'user': user, 'post': post};
								var like = new Like();
								like.save(data, {
									dataType:"text",
									success: function () {
										var likecount = post.get('likecount')+1;
										var postData = {'id':post.id, 'likecount':likecount};
										post.save(postData, {
											dataType:"text",
											success: function () {
												postList.render();
											}
										})
									}
								});
							}
						});
					}
				});
			}

		});

		var ClipList = Backbone.View.extend({
			el: '.page',
			myclipsrender: function (userid) {
				var that = this;
				var clips = new Clips();
				clips.fetch({
					data: $.param({ user: userid, post_only: 'True'}),
					success: function (posts) {
						var template = _.template($('#user-list-template').html(), {posts: posts.models});
						that.$el.html(template);
					}
				});
			}
		});

		var Router = Backbone.Router.extend({
			routes: {
				'': 'home',
			}
		});

		var postList = new PostList();
		var clipList = new ClipList();
		var userThis = new UserThis();
		var router = new Router();


		router.on('route:home', function () {
			var $_GET = <?php echo json_encode($_GET); ?>;
			var userid = $_GET['userid'];

			userThis.render({id:userid});
			postList.render();
		});

		function saveclip(pid) {
			var $_GET = <?php echo json_encode($_GET); ?>;
			var userid = $_GET['userid'];
			//alert(pid);
			postList.saveclip(pid, userid);
		}

		function saveLike(pid) {
			var $_GET = <?php echo json_encode($_GET); ?>;
			var userid = $_GET['userid'];
			postList.savelike(pid, userid);
		}

		Backbone.history.start();

		$(document).ready(function(){
			var $page = $('#page');
			$('img').imagesLoaded(function(){
				$page.masonry({
				itemSelector : '.item',
				columnWidth : 100,
				});
			});
		});

		function myclips() {
			var $_GET = <?php echo json_encode($_GET); ?>;
			var userid = $_GET['userid'];
			clipList.myclipsrender(userid);
		}
	</script>

</body>
</html>
