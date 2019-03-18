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
            <div id="contact-form" class="sticky" data-sticky data-anchor="contact-ended">
                <div class="card">
                    <div class="card-divider">
                        <h4>Leave a Comment:</h4>
                    </div>
                    <div class="card-section">
                        <div id="contact-notification"></div>

                        <form>
                            <div class="form-content">
                                <label for="author">Authors Name</label>
                                <input class="form-control" required type="text" id="commentAuthor" value=""
                                       placeholder="Please enter your name"/>
                            </div>
                            <div class="form-content">
                                <label for="author">Authors Email</label>
                                <input class="form-control" required type="email" id="commentEmail" value=""
                                       placeholder="Please enter your email"/>
                            </div>
                            <div class="form-content">
                                <label for="body">Leave a Comment</label>
                                <textarea class="form-control" required cols="30" rows="7" id="commentBody"
                                          placeholder="Write a contact"></textarea>
                            </div>
                            <div class="form-content">
                                <button type="submit" name="submit" id="commentSubmit" value="true"
                                        data-show_id="{{$id['id']}}"
                                        data-csrftoken="{{\Classes\Core\CSRFToken::_SetToken()}}"
                                        class="button success stretched">Submit
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Posted Comments -->

        <!-- Comment -->
        <div class="split-6 right" id="contact-ended">
            @foreach( $comments as $contact )
                <figure class="figure-comment">

                    <div class="thumbnail">
                        <a class="pull-left" href="http://via.placeholder.com/120x120&text=image">
                            <img style="width:120px" src="http://via.placeholder.com/120x120&text=image" alt="">
                        </a>
                    </div>

                    <div class="text-box">
                        <h4 class="h4">{{$contact->author}}
                            <small>@php $date = new DateTime($contact->created_at);
                                echo $date->format('l jS \of F Y \@ h:i:s A'); @endphp</small>
                        </h4>
                        <p>{{$contact->body}}</p>
                    </div>
                </figure>


            @endforeach
        </div>
    </div>

</div>
<div class="container">
    <hr />
</div>
