$('.cameraLike').click(function (el) {
    var that = $(this);
    var photoId = that.data("photo-id");
    $.ajax({
        url: "/photoapp/dislike.php?photoId=" + photoId,
        type: 'GET',
        success: function (response) {
            if(response === "disliked") {
                that.hide();
                that.parent().find('.cameraDislike').show();
                // update number of likes
                var res = that.parent().find('.numberOfLikes')[0].innerHTML.split(" ");
                var newNumberOfLikes = parseInt(res[0]) - 1;
                if(newNumberOfLikes === 1) {
                    that.parent().find('.numberOfLikes')[0].innerHTML = newNumberOfLikes + " like";
                } else {
                    that.parent().find('.numberOfLikes')[0].innerHTML = newNumberOfLikes + " likes";
                }
            }
        }
    });
});

$('.cameraDislike').click(function (el) {
    var that = $(this);
    var photoId = that.data("photo-id");
    $.ajax({
        url: "/photoapp/like.php?photoId=" + photoId,
        type: 'GET',
        success: function (response) {
            if(response === "liked") {
                that.hide();
                that.parent().find('.cameraLike').show();
                // update number of likes
                var res = that.parent().find('.numberOfLikes')[0].innerHTML.split(" ");
                var newNumberOfLikes = parseInt(res[0]) + 1;
                if(newNumberOfLikes === 1) {
                    that.parent().find('.numberOfLikes')[0].innerHTML = newNumberOfLikes + " like";
                } else {
                    that.parent().find('.numberOfLikes')[0].innerHTML = newNumberOfLikes + " likes";
                }
            }
        }
    });
});

$('.xmark').click(function(el){
    var that = $(this);
    var photoId = that.data("photo-id");
    bootbox.confirm({
        message: "Do you really want to delete the photo?",
        callback: function (result) {
            if(result) {
                $.ajax({
                    url: "/photoapp/delete.php?photoId=" + photoId,
                    type: 'GET',
                    success: function (response) {
                        if(response === "deleted") {
                            that.parent().parent().parent().remove();
                        }
                    }
                });
            }
        },
        buttons: {
            cancel: {
                label: 'No',
                className: 'btn-default'
            },
            confirm: {
                label: 'Yes',
                className: 'btn-danger'
            }
        },
        size: 'small',
        backdrop: true
    })
});

//bind this dynamic as it added dynamically
$(document).on('click', '.xmark-comment', function(el){
    var that = $(this);
    var commentId = that.data("comment-id");
    bootbox.confirm({
        message: "Do you really want to delete the comment?",
        callback: function (result) {
            if(result) {
                $.ajax({
                    url: "/photoapp/delete-comment.php?commentId=" + commentId,
                    type: 'GET',
                    success: function (response) {
                        if(response === "deleted") {
                            if(that.parent().parent().find('.js-addcomment').length < 2) {
                                that.parent().after("<div class='text-center js-addcomment js-dummy-comment' style='opacity: 0.5'>No comments available</div>");
                            }
                            that.parent().remove();
                        }
                    }
                });
            }
        },
        buttons: {
            cancel: {
                label: 'No',
                className: 'btn-default'
            },
            confirm: {
                label: 'Yes',
                className: 'btn-danger'
            }
        },
        size: 'small',
        backdrop: true
    })
})


$('.newCommentText').bind('input', function(){
    var that = $(this);
    var comment = that.val().trim();

    if(comment) {
        that.parent().find('.commentButton')[0].disabled = false;
    } else {
        that.parent().find('.commentButton')[0].disabled = true;
    }

});

function addComment(el) {
    var that = $(el);
    var comment = that.parent().find('.newCommentText').val();

    var commentTrimmed = comment.trim();

    if(commentTrimmed.length > 0) {
        var photoId = that.data("photo-id");
        $.ajax({
            url: "/photoapp/add-comment.php?photoId=" + photoId + "&comment=" + commentTrimmed,
            type: 'GET',
            success: function (response) {
                var json = JSON.parse(response);
                if(!json.bad) {
                    that.parent().find('.newCommentText').val("");
                    that[0].disabled = true;
                    var test = that.parent().parent().find('.commentsTab .js-addcomment').last();

                    //add new comment
                    var newComment =  "<div class='photoComment js-addcomment'>";
                    newComment += "<div class='photoCommentHeader'>";
                    newComment += "<div class='commentOwner'>" + json.username +  "</div>";
                    newComment += "<div class='commentDatetime'>" + json.dataTime +  "</div>";
                    newComment += "</div>";
                    newComment += "<img data-comment-id='" + json.commentId + "' class='xmark-comment' src='img/xmark.png'/>";
                    newComment += "<div class='commentText'>" + json.comment +  "</div>";
                    newComment += "</div>";
                    test.after(newComment);

                    if(test.hasClass("js-dummy-comment")) {
                        //remove dummy "no comments" text
                        test.remove();
                    }

                    //scroll down
                    var objDiv = that.parent().parent().find('.commentsTab')[0];
                    objDiv.scrollTop = objDiv.scrollHeight;
                }
            }
        });
    } else {
        that.parent().find('.newCommentText').val("");
        that[0].disabled = true;
    }
}