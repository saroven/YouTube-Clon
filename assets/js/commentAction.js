function postComment(button, postedBy, videoId, replyTo, containerClass)
{
    let textarea = $(button).siblings('textarea');
    let commentText = textarea.val();
    textarea.val("");

    if (commentText){
        $.post("ajax/postComment.php", { commentText: commentText, postedBy: postedBy, videoId: videoId, responseTo: replyTo})
            .done(function (comment) {
                $("." + containerClass).prepend(comment);
            })
    }else{
        alert("You can't post empty comment.");
    }
}

function toggleReply(button) {
    let parent = $(button).closest(".itemContainer");
    let commentForm = parent.find(".commentForm").first();
    commentForm.toggleClass('hidden');
}