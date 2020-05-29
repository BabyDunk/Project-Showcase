<?php
	/**
	 * Created by Chris Wilkinson.
	 * Title: showcase_app
	 * Date: 06/07/2018
	 * Time: 19:11
	 */


?>
<div id="showcase-comments" class="clearfix">
    <div class="container">
        <!-- Comments Form -->
        <div class="split-6 left">
            <div id="contact-form" class="sticky" data-anchored="contact-ended">
                <div class="card">
                    <h4>Leave a Comment:</h4>

                    <div id="comment-notification"></div>

                    <form>
                        <div class="form-content">
                            <label for="commentAuthor">Authors Name</label>
                            <input class="form-control" required type="text" id="commentAuthor" value=""
                                   placeholder="Please enter your name"/>
                        </div>
                        <div class="form-content">
                            <label for="commentEmail">Authors Email</label>
                            <input class="form-control" required type="email" id="commentEmail" value=""
                                   placeholder="Please enter your email"/>
                        </div>
                        <div class="form-content">
                            <label for="commentBody">Leave a Comment</label>
                            <textarea class="form-control" required cols="30" rows="7" id="commentBody"
                                      placeholder="Write a contact"></textarea>
                        </div>
                        <div class="form-content">
                            <div></div>
                            <button type="submit" name="submit" id="commentSubmit" value="true"
                                    data-show_id="{{$id['id']}}"
                                    data-csrftoken="{{\Classes\Core\CSRFToken::_SetToken()}}"
                                    class="button success">Submit
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <!-- Posted Comments -->

        <!-- Comment -->
        <div class="split-6 right" id="contact-ended">
            @if(empty($comments))
                <figure class="leave-us-a-comment">
                    <div class="luac-box">
                        <h3>Leave us a Comment</h3>
                        <p>Why not be the first to leave us a comment. We appreciate all interaction whether it's to share what you think of the product or if you have some criticism.</p>
                        <p>Constructive criticism only makes us better and improvements are always welcome</p>
                        <p>We only ask that you be civil.</p>
                        <p>With best regards {{sca_get_preference('showcase', 'sca_sitename')}}</p>
                    </div>
                </figure>

            @else
                @foreach( $comments as $comment )
                    <figure class="figure-comment">

                        <div class="thumbnail">
                            <div class="avatar comment-media-object" data-author="{{$comment->author}}"></div>
                            {{--<a class="pull-left" href="//via.placeholder.com/120x120&text=image">
                                <img style="width:120px"  src="//via.placeholder.com/120x120&text=image" alt="">
                            </a>--}}
                        </div>

                        <div class="text-box">
                            <h4 class="h4">{{$comment->author}}
                                <small>@php $date = new DateTime($comment->created_at);
                                echo $date->format('l jS \of F Y \@ h:i:s A'); @endphp</small>
                            </h4>
                            <p>{{$comment->body}}</p>
                        </div>
                    </figure>


                @endforeach
            @endif
        </div>
    </div>

</div>
<div class="container">
    <hr/>
</div>
