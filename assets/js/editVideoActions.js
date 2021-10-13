function setNewThumbnail(thumbnailId,videoId, itemElement) {
    $.post("ajax/updateThumbnail.php", {videoId: videoId, thumbnailId: thumbnailId})
        .done(function (){
            let item = $(itemElement);
            let itemClass = item.attr("class");
            $('.' + itemClass).removeClass("selected");

            item.addClass("selected");
            alert("Thumbnail Updated");
        })
}