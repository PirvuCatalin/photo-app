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
                            that.parent().parent().remove();
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