



function likeImg(id) {
    var photo_like = document.getElementById(id);//ClassName('photo_list');


   // document.location.assign('/like/' + id);
  //  console.log(photo_like.nextElementSibling);

    ajaxPost('http://localhost:8101/like/' + id,function (data) {
        var status = data.match(/\D+/);//data.substring(0,data.length - 1);
     //   console.log('status='+status);
        var likes = data.match(/\d+/);
      //  console.log('likes='+likes);
        if (status.toString().localeCompare("liked".toString()) === 0)
        {
            document.getElementById(id).setAttribute('src',  '../resources/lkd.svg');
        }
        else if (status.toString().localeCompare('unliked') === 0)
        {
            document.getElementById(id).setAttribute('src', '../resources/camalike.svg');
        }
        photo_like.nextElementSibling.innerHTML = likes;
    });
}
function showComments(commentPrevId, loggedInUser=false, added=false ) {

    var parent = document.getElementById(commentPrevId).parentNode.parentNode.nextElementSibling;
    var area = parent.getElementsByClassName('commentArea')[0];
    var btn = parent.getElementsByClassName('commentBtn')[0];
   // console.log(parent.getElementsByClassName('commentArea')[0]);
    //console.log(parent.getElementsByClassName('commentBtn')[0]);
    console.log('inshow');
    if (!added){
        if (area.style.display === 'none')
        {
            area.style.display = 'inline';
            btn.style.display = 'inline';

        }
        else{
            area.style.display = 'none';
            btn.style.display = 'none';
        }

        if (parent.childElementCount > 2)
        {
            while (parent.childElementCount > 2)
            {
                parent.removeChild(parent.firstChild);
            }

        }
        else {
            ajaxPost('http://localhost:8101/showComments/'+commentPrevId, function (data) {
                console.log(data);
                var jsonObj = JSON.parse(data);
                var area = parent.firstElementChild;
                for(var com in jsonObj)
                {
                    addCommentBlock(parent,jsonObj[com].text, area, jsonObj[com].login, jsonObj[com].id, loggedInUser );
                }
            });

        }
    }
    else {
        ajaxPost('http://localhost:8101/showComments/'+commentPrevId, function (data) {
            var jsonObj = JSON.parse(data);
            var area = parent.lastElementChild.previousElementSibling;
            addCommentBlock(parent,jsonObj[jsonObj.length - 1].text, area, jsonObj[jsonObj.length - 1].login, jsonObj[jsonObj.length - 1].id, loggedInUser);
        });
    }
}

function ajaxPost(url, callback, toSend) {
    var f = callback || function (data) {};

    var req = new XMLHttpRequest();

    req.onreadystatechange = function () {
        if(req.readyState == 4 && req.status == 200)
        {
            f(req.responseText);
        }
    };

    req.open('POST', url);

    if (toSend)
    {
        var fd = new FormData();
        for (var key in toSend)
        {
            fd.append(key+"",toSend[key]);
        }
        req.send(fd);
    }
    else
        req.send()
}

function sendComment(btn, loggedUser) {

     var area = document.getElementById(btn).parentNode.getElementsByClassName('commentArea')[0];
     var text = area.value.toString();
     if (text !== "")
     {
         var jstext = {text:text};
         jstext =  JSON.stringify(text);

         ajaxPost('http://localhost:8101/addComment',function (data) {

     //+btn+'='+text, function (data) {
             if (data.toString().localeCompare('OK') === 0)
             {
                 var prevComBlock = document.getElementById(btn).parentNode;
                 prevComBlock = prevComBlock.previousElementSibling;
                 prevComBlock = prevComBlock.firstElementChild.firstElementChild.id;
                 console.log(prevComBlock);
                 showComments(prevComBlock,loggedUser, true);
                 console.log("added");
             }
             else
             {
                // alert('http://localhost:8101/addComment/'+btn+"="+text);
                 console.log('data='+data+';');
                 //alert("Something goes wrong!");
             }
         }, {comment:text, photoId:btn});
     }
}

function removeComment(target) {

   // var toRemove = parent.getAnonymousElementByAttribute(parent, 'com-id', id);
   // console.log(target.parentNode);
    //target.parentNode.removeChild(target);

    ajaxPost('http://localhost:8101/removeComment',function (data) {

        if (data.toString().localeCompare('OK') === 0)
        {

            var par = target.parentNode;
            par.remove(target);
            console.log("removed");
        }
        else
        {
            console.log('data='+data+';');
        }
    }, {commentId : target.parentNode.getAttribute('com-id')});
}
