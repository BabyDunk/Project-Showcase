<?php
	/**
	 * Created by Chris Wilkinson.
	 * Title: showcase_app
	 * Date: 06/07/2018
	 * Time: 19:11
	 */



	?>
<div id="showcase-comments">
    <hr/>
    <div class="grid-x grid-padding-x">
        <!-- Comments Form -->
        <div class="small-6 cell left"  data-sticky-container>
            <div id="comment-form" class="sticky" data-sticky data-anchor="comment-ended" >
                <div class="card">
                    <div class="card-divider">
                        <h4>Leave a Comment:</h4>
                    </div>
                    <div class="card-section">
                        <div id="comment-notification"></div>

                        <form>
                            <label for="author">Authors Name</label>
                            <input class="form-control" type="text"  id="commentAuthor" value="" placeholder="Please enter your name" />

                            <label for="author">Authors Email</label>
                            <input class="form-control" type="email"  id="commentEmail" value="" placeholder="Please enter your email" />

                            <label for="body">Leave a Comment</label>
                            <textarea class="form-control" cols="30" rows="7" id="commentBody"  placeholder="Write a comment" ></textarea>

                            <button type="submit" name="submit" id="commentSubmit" value="true" data-show_id="{{$id['id']}}" data-csrftoken="{{\Classes\Core\CSRFToken::_SetToken()}}" class="button success">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Posted Comments -->

        <!-- Comment -->
        <div class="small-6 cell right" id="comment-ended">
        @foreach( $comments as $comment )
            <div class="media-object">
                <div class="media-object-section">
                    <div class="thumbnail">
                        <a class="pull-left" href="http://via.placeholder.com/120x120&text=image">
                            <img style="width:120px" src="http://via.placeholder.com/120x120&text=image" alt="">
                        </a>
                    </div>
                </div>
                <div class="media-object-section">
                    <h4 class="h4">{{$comment->author}}
                        <small>@php $date = new DateTime($comment->created_at);
                                echo $date->format('l jS \of F Y \@ h:i:s A'); @endphp</small>
                    </h4>
                    {{$comment->body}}
                </div>
            </div>
            <hr />

        @endforeach
        </div>
    </div>
    <hr/>
</div>
