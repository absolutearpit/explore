<?php use App\Http\Controllers\HomeController; ?>
<div class="row" id="{{$userPost['id']}}" style="margin-top: 20px; margin-bottom: 20px;">
<?php
    $postAvatar = $userPost['user']['avatar'];
    $postExploreName = $userPost['user']['explore_name'];
    $likedUsers = $userPost['liked_users'];
    if (preg_match('/[,]/', $likedUsers)){
        $likedUsers = explode(',',$likedUsers);
    } else {
        $likedUsers = array($likedUsers);
    }

    $createdAt = $userPost['created_at'];

    $postUploadedTime = HomeController::getPostTime($createdAt);
?>
<!-- /.col -->
<div class="col-md-12">
  <!-- Box Comment -->
  <div class="box box-widget">
    <div class="box-header with-border">
      <div class="user-block">
        <img class="img-circle" src='{{ URL::asset("images/$postAvatar") }}' alt="User Image">
        <span class="username"><a href="profile/{{$userPost['user']['explore_name']}}/">{{$userPost['user']['fullname']}}</a></span>
        <span class="description">Shared publicly - {{$postUploadedTime}}</span>
      </div>
      <!-- /.user-block -->
      <div class="box-tools">
      <?php
        $currentPath = Request::path();
      ?>
      @if(strpos($currentPath, 'profile') !== false || $currentPath == '/')
        @if($postAvatar == $values->avatar)
          <button type="button" class="btn btn-box-tool my_popup_open" id="edit:{{$userPost['id']}}" onClick="editPost(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true" title="Edit Post"></i></button>
        @endif
        <button type="button" id="expand:{{$userPost['id']}}" onClick='expandPost(this.id)' class="btn btn-box-tool" data-toggle="tooltip" title="Expand Post">
          <i class="fa fa-expand"></i></button>
      @else
        <button type="button" id="compress:{{$userPost['id']}}" onClick='compressPost()' class="btn btn-box-tool" data-toggle="tooltip" title="Compress Post">
          <i class="fa fa-compress"></i></button>
      @endif      
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
        </button>
        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
      </div>
      <!-- /.box-tools -->
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <!-- post text -->
      <?php  $post = $userPost['post']; ?>
      @if(strpos($post, "\n") !== FALSE)
      <pre class="post_content"><?php echo $post; ?></pre>
      @else
      <p class="post_content" >{{$post}}</p>
      @endif
      <!-- Social sharing buttons -->
      <a class="" href="https://twitter.com/intent/tweet?text=Hey..+I+Have+donated.+http://goo.gl/SslIQ0" data-size="large"><button type="button" class="btn btn-default btn-xs"><i class="fa fa-share"></i> Share</button></a>

      @if(in_array($active,$likedUsers) || $active == $likedUsers)
        <button type="button" id="like-{{$userPost['id']}}" class="btn btn-info btn-xs"><i class="fa fa-thumbs-o-up"></i> Like</button>
      @else
         <button type="button" id="like-{{$userPost['id']}}" class="btn btn-default btn-xs" onclick="likePost(this.id)"><i class="fa fa-thumbs-o-up"></i> Like</button>                                           
      @endif
      
      <span class="pull-right text-muted"><span>{{$userPost['likes']}}</span> likes - <span class="comment">{{$userPost['comments']}}</span> comments</span>
    </div>
    <!-- /.box-body -->
    <div class="box-footer box-comments">
        @foreach($allComments as $allComment)
          @if($allComment['post_id'] == $userPost['id'])
            <?php
              $commentUserAvatar = $allComment['user']['avatar'];
              $commentUserExploreName = $allComment['user']['explore_name'];
              $commentCreatedAt = $allComment['created_at'];
              $postUploadedTime = HomeController::getPostTime($commentCreatedAt);
            ?>
            <div class="box-comment">
              <a href="/profile/{{$commentUserExploreName}}" ><img class="img-circle img-sm" src='{{ URL::asset("images/$commentUserAvatar") }}' alt="User Image"></a>
              <div class="comment-text">
                    <span class="username">
                      <a href="/profile/{{$commentUserExploreName}}" >{{$allComment['user']['fullname']}}</a>
                      <span class="text-muted pull-right">{{$postUploadedTime}}</span>
                    </span><!-- /.username -->
                    {{$allComment['comment']}}
              </div>
            </div> 
          @endif                          
        @endforeach      
    </div>
    <!-- /.box-footer -->
    <div class="box-footer">
      @if(!empty($avatar))
        <img class="img-responsive img-circle img-sm" src='{{ URL::asset("images/$avatar") }}' alt="Alt Text">
      @else
        <img class="img-responsive img-circle img-sm" src='{{ URL::asset("images/default-avatar.png") }}' alt="Alt Text">
      @endif
        <!-- .img-push is used to add margin to elements next to floating images -->
        <div class="img-push">
          <input type="text" class="form-control input-sm comment-box" id="comment-{{$userPost['id']}}" placeholder="Press enter to post comment">
        </div>
    </div>
    <!-- /.box-footer -->
  </div>
  <!-- /.box -->
</div>
<!-- /.col -->
</div>


<?php
/*
       <?php
          $title=urlencode('Explore');
          $url=urlencode('http://localhost:8000/single'.$userPost['id']);
          $image=urlencode("http://localhost:8000/images/$postAvatar");
      ?>
      <a onClick="window.open('http://www.facebook.com/sharer.php?s=100&amp;p[title]=<?php echo $title;?>&amp;p[url]=<?php echo $url; ?>&amp;&p[images][0]=<?php echo $image;?>', 'sharer', 'toolbar=0,status=0,width=548,height=325');" target="_parent" href="javascript: void(0)">
          
      </a>
*/
?>