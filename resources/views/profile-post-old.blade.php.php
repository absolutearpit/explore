<div class="post_card" id="{{$userPost->post_id}}">
                                                <div class="row" style="margin-bottom: 15px;">
                                                    <div class="col-md-3" >
                                                        <img src='{{ URL::asset("images/$avatar") }}' class="avatar">  
                                                    </div>
                                                    <div class="col-md-6" >
                                                        <h5>{{$fullName}}</h5>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <p class='post_content' id="post-{{$userPost->post_id}}"><?php echo  $userPost->post?></p>                                    
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <?php
                                                            $createdAt = $userPost->created_at;
                                                            $createdAt = explode(' ',$createdAt);
                                                            $createdDate = $createdAt[0];
                                                            $likedUsers = $userPost->liked_users;
                                                            if (preg_match('/[,]/', $likedUsers)){
                                                                $likedUsers = explode(',',$likedUsers);
                                                            } else {
                                                                $likedUsers = array($likedUsers);
                                                            }                                      
                                                        ?>
                                                        <p>{{$createdDate}}</p>                                    
                                                    </div>
                                                    <div class="col-md-2"></div>
                                                    @if($values->email == $email)
                                                        <div class="col-md-2">
                                                            <img src='{{ URL::asset("images/edit.png") }}' id="edit:{{$userPost->post_id}}" onclick="editPost(this.id)" class="post_action demo_open"> 
                                                        </div>                                
                                                        <div class="col-md-2">
                                                            <img src='{{ URL::asset("images/delete.png") }}' id="delete:{{$userPost->post_id}}" onclick="deletePost(this.id)" class="post_action">                               
                                                        </div>
                                                        @if(in_array($values->id,$likedUsers) || $values->id == $likedUsers)
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
                                                        @if(in_array($values->id,$likedUsers) || $values->id == $likedUsers)
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