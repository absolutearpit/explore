<div class="post_card" id="{{$userPost->post_id}}">
						                            <?php
						                                $postAvatar = $userPost->avatar;
						                                $postExploreName = $userPost->explore_name;
						                                $likedUsers = $userPost->liked_users;
						                                if (preg_match('/[,]/', $likedUsers)){
						                                    $likedUsers = explode(',',$likedUsers);
						                                } else {
						                                    $likedUsers = array($likedUsers);
						                                }
						                            ?>
						                            <div class="row" style="margin-bottom: 15px;">
						                                <div class="col-md-3" >
						                                    <img src='{{ URL::asset("images/$postAvatar") }}' class="avatar">  
						                                </div>
						                                <div class="col-md-6" >
						                                    <a href="http://localhost:8000/profile/{{$postExploreName}}"><h5>{{$userPost->fullname}}</h5></a>
						                                </div>
						                            </div>
						                            <div class="row">
						                                <div class="col-md-12">
						                                    <p class='post_content' id="post-{{$userPost->post_id}}"><?php echo $userPost->post; ?></p>                                    
						                                </div>
						                            </div>
						                            <div class="row">
						                                <div class="col-md-4">
						                                    <?php
						                                      $createdAt = $userPost->created_at;
						                                      $createdAt = explode(' ',$createdAt);
						                                      $createdDate = $createdAt[0];
						                                    ?>
						                                    <p>{{$createdDate}}</p>                                    
						                                </div>
						                                <div class="col-md-2"></div>
						                                @if($postAvatar == $avatar)
						                                    <div class="col-md-2">
						                                        <img src='{{ URL::asset("images/edit.png") }}' id="edit:{{$userPost->post_id}}" onclick="editPost(this.id)" class="post_action demo_open"> 
						                                    </div>
						                                    <div class="col-md-2">
						                                        <img src='{{ URL::asset("images/delete.png") }}' id="delete:{{$userPost->post_id}}" onclick="deletePost(this.id)" class="post_action">                               
						                                    </div>
						                                    @if(in_array($active,$likedUsers) || $active == $likedUsers)
						                                        <div class="col-md-2">
						                                            <img src='{{ URL::asset("images/like.png") }}' id="like-{{$userPost->post_id}}" class="post_action">
						                                        </div>
						                                    @else
						                                        <div class="col-md-2">
						                                            <img src='{{ URL::asset("images/like.png") }}' id="like-{{$userPost->post_id}}" onclick="likePost(this.id)" class="post_action">         
						                                        </div>
						                                    @endif
						                                @else
						                                    <div class="col-md-2"></div>                                
						                                    <div class="col-md-2"></div>
						                                    @if(in_array($active,$likedUsers) || $active == $likedUsers)
						                                        <div class="col-md-2">
						                                            <img src='{{ URL::asset("images/like.png") }}' id="like-{{$userPost->post_id}}" class="post_action">
						                                        </div>
						                                    @else
						                                        <div class="col-md-2">
						                                            <img src='{{ URL::asset("images/like.png") }}' id="like-{{$userPost->post_id}}" onclick="likePost(this.id)" class="post_action">         
						                                        </div>
						                                    @endif
						                                @endif
						                            </div>
						                            <div class="row">
						                                <div class="col-md-9"></div>
						                                <div class="col-md-3"><p class="likes"><span class="likes_count" >{{$userPost->likes}}</span> Likes</p></div>
						                            </div>
						                        </div>