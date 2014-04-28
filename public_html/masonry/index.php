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
		}
 		.item {
		margin: auto;
		width: 200px;
		margin: 5px;
		border: 1px solid;
		float: left;
		width: 25%;
		}
		.item-container {
			
		}
		.top-item {
			margin: auto;
			height: 60px;
			border-bottom: 1px solid;
			
		}

		.profile_pic {
			float: left;
			
		}

		.store_name {

		}

		.mid-item {
			padding-top:5px;
			border-bottom: 1px solid;
		}

		.mid-item img {
			border: none;
			display: block;
			margin: 0 auto;
			padding-bottom: 5px;

		}

		.mid-item details {
			border: none;
			display: block;
			margin: 0 auto;
			padding-bottom: 5px;
		}

		.clear {
			clear: both;
		}
	</style>
</head>

<body>


<div class="container">
	<div class="top-bar">
		<div class="top-left" style="width:15%; float:left;">
			<h1 style="color:#B00000  ;">ClipR</h1>
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
		<div class="top-right" id="top-right" style="width:35%;float:left;padding-top:15px;">
		</div>
    </div>
</div>
<hr/>
<div class="container">
<nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->

      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Recommended Clips</a></li>
        <li><a href="#">All Clips</a></li>
        <li><a href="#">My Clips</a></li>
      </ul>
  </div><!-- /.container-fluid -->
</nav>
	<div id="page" class="page">
	</div>
</div>

		<script type="text/template" id="user-this-template">
		      <ul class="nav navbar-nav" style="float:left;">
		        <li class="dropdown">
		          <c class="dropdown-toggle" data-toggle="dropdown"><%= user.get('name') %> <b class="caret"></b></c>
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
			<img src="<%= user.get('imgurl') %>" width="40" style="padding-left:10px;">
		</script>

		<script type="text/template" id="user-list-template">
				<% _.each(posts, function(post) { %>
							<div class="item">
								<div class="item-container">
									<div class="top-item">
										<div class="profile_pic">
											<img src=<%=post.get('store').imgurl %> width="40">
										</div>
										<div class="non_pic">
											<span class="store_name" style="padding-left:10px;">
												<a href="#"><%= post.get('store').name %></a>
											</span>
											<div class="non_name" style="padding-top:5px;">
												<span class="location" style="float:left;padding-left:10px;">
													<%= post.get('store').city %>
												</span>
												<span class="distance" style="float:right; padding-right:10px;">
													3 miles
												</span>
											</div>
										</div>
									</div>

									<div class="mid-item">
										<div class="title" align="center" style="padding-bottom:5px;">
											<%= post.get('title') %>
										</div>
										<img src=<%=post.get('imgurl') %>>
										<div class="details" align="center">
											<div class="validity" style="float:left;padding-left:10px;">
												<font size="2">Valid : Today, <%= post.get('validity') %></font>
											</div>
											<div class="cost" style="float:right;padding-right:10px;">
												<font size="2"><%= post.get('cost') ? "$"+post.get('cost') : '' %></font>
											</div>
										</div>
										<div class="clear"></div>
									</div>
									<div class="bottom-item">
										<div class="reviews" style="float:left;padding-left:15px;width:30%;padding-top:10px;">
											<img src="../static/img/reviews.jpeg" width="80">
											<div style="float:right;"><font size="2">170</font></div>
										</div>
										<div class="likes" style="float:left;padding-left:25px;padding-top:5px;">
											<img src="../static/img/fblike.jpeg" width="30">
											<div style="float:right;"><font size="2">19</font></div>
										</div>
										<div class="clips" style="float:left;padding-left:25px;padding-top:5px;" 
										onclick="saveClip('<%= post.id %>');">
												<img src="../static/img/scissor.jpeg" width="40">
												<div id="clipcount" name="clipcount" style="float:right;">
													<font size="2">
														<%= post.get('clipcount')!=0 ? post.get('clipcount') : '' %>
													</font>
												</div>
										</div>
									</div>
							</div>
						</div>
				<% }); %>
		</script>

	<script type="text/javascript" src="../static/js/lib/jquery/jquery-1.10.2.min.js"></script>
	<script type="text/javascript" src="../static/lib/bootstrap/js/bootstrap.min.js"></script>
	<script src="../static/js/lib/masonry/jquery.masonry.min.js"></script>
	<script src="../static/js/lib/underscore/underscore-min.js"></script>
	<script src="../static/js/lib/backbone/backbone-min.js"></script>

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


		var Posts = Backbone.Collection.extend({
			url: 'http://127.0.0.1:8000/api/v1/post/'
			//url: '/users/'
		});

		var Post = Backbone.Model.extend({
			urlRoot: 'http://127.0.0.1:8000/api/v1/post/'
		});

		var User = Backbone.Model.extend({
			urlRoot: 'http://127.0.0.1:8000/api/v1/users/'
			//url: '/users/'
		});

		var Clips = Backbone.Collection.extend({
			url: 'http://127.0.0.1:8000/api/v1/clips/'
		});

		var Clip = Backbone.Model.extend({
			urlRoot: 'http://127.0.0.1:8000/api/v1/clips/'
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

		var Router = Backbone.Router.extend({
			routes: {
				'': 'home',
			}
		});

		var postList = new PostList();
		var userThis = new UserThis();
		var router = new Router();

		router.on('route:home', function () {
			var $_GET = <?php echo json_encode($_GET); ?>;
			var userid = $_GET['userid'];

			userThis.render({id:userid});
			postList.render();
		});

		function saveClip(pid) {
			var $_GET = <?php echo json_encode($_GET); ?>;
			var userid = $_GET['userid'];
			postList.saveclip(pid, userid);
		}


		Backbone.history.start();

		$(document).ready(function(){
		var $page = $('#page');
		$('img').imagesLoaded(function(){
			$page.masonry({
			itemSelector : '.item',
			columnWidth : 1,
			});
		});
	});

	</script>

</body>
</html>
