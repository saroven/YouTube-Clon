function subscribe(userTo,userFrom, button){
    if (userTo == userFrom){
        alert("You can't subscribe yourself");
        return;
    }
    $.post("ajax/subscribe.php", {userTo: userTo, userFrom: userFrom})
        .done(function (data){
        console.log("done", data);
    })
}