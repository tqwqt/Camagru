



function likeImg(id) {

    var photo_like = document.getElementById(id);//ClassName('photo_list');
   // document.location.assign('/like/' + id);
  //  (photo_like.nextElementSibling);

    ajaxPost('http://localhost:8101/like/' + id,function (data) {
        var status = data.match(/\D+/);//data.substring(0,data.length - 1);
     //   ('status='+status);
        var likes = data.match(/\d+/);
      //  ('likes='+likes);
        if (status.toString().localeCompare("liked".toString()) === 0)
        {
            document.getElementById(id).setAttribute('src',  '../resources/lkd.svg');
        }
        else if (status.toString().localeCompare('unliked') === 0)
        {
            document.getElementById(id).setAttribute('src', '../resources/camalike.svg');
        }
        else {
            return;
        }
        photo_like.nextElementSibling.innerHTML = likes;
    });
}
function showComments(commentPrevId, loggedInUser=false, added=false ) {

    var parent = document.getElementById(commentPrevId).parentNode.parentNode.nextElementSibling;
    var area = parent.getElementsByClassName('commentArea')[0];
    var btn = parent.getElementsByClassName('commentBtn')[0];
   // (parent.getElementsByClassName('commentArea')[0]);
    //(parent.getElementsByClassName('commentBtn')[0]);
    ('inshow');
    if (!added){
        (area.style.display);
        if (!loggedInUser)
            return;
        if (area.style.display === 'none' && loggedInUser)
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
                (data);
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
                 (prevComBlock);
                 showComments(prevComBlock,loggedUser, true);
                 ("added");
             }
             else
             {
                // alert('http://localhost:8101/addComment/'+btn+"="+text);
                 ('data='+data+';');
                 //alert("Something goes wrong!");
             }
         }, {comment:text, photoId:btn});
     }
}

function removeComment(target) {

   // var toRemove = parent.getAnonymousElementByAttribute(parent, 'com-id', id);
   // (target.parentNode);
    //target.parentNode.removeChild(target);

    ajaxPost('http://localhost:8101/removeComment',function (data) {

        if (data.toString().localeCompare('OK') === 0)
        {

            var par = target.parentNode;
            par.remove(target);
            ("removed");
        }
        else
        {
            ('data='+data+';');
        }
    }, {commentId : target.parentNode.getAttribute('com-id')});
}

function setNotifications() {
    ajaxPost('http://localhost:8101/cabinet/setNS', function (data) {

    }, {});
    // document.location.assign('/cabinet/setNS');
}

function changePassword() {
   document.location.assign('cabinet/change');
    // document.location.assign('/cabinet/setNS');
}


function changeLogin() {
    document.location.assign('cabinet/changeLogin');
    // document.location.assign('/cabinet/setNS');
}
function changeEmail() {
    document.location.assign('cabinet/changeEmail');
}

function deleteImage(id) {
    ('DELETE', id);
    ajaxPost('http://localhost:8101/home/deleteImage', function (data) {
        if (data.toString().localeCompare('OK') === 0)
        {
            var del = document.querySelector('#p'+id);
            del = del.parentNode;
            (del);
            del.parentNode.removeChild(del);
        }
        else {
            (data);
        }
    }, {photoId:id})
}

function tipoScroll() {

    var f = document.querySelector('.cont');
    f = f.lastElementChild;
    f = f.previousElementSibling;
    f = f.firstElementChild.nextElementSibling;
    // document.location.replace('home/last_'+f.id);
    ajaxPost('http://localhost:8101/home', function (data) {

        // document.location.reload(true);

        (data);
        var jsonObj = JSON.parse(data);
        var area = parent.firstElementChild;
        for(var com in jsonObj)
        {
            addPhotoListBlock(jsonObj[com].id, jsonObj[com].url, jsonObj[com].likes, jsonObj[com].logged, jsonObj[com].islike,
                jsonObj[com].login);
        }
        // location.hash = "";
        // location.hash = f.id;
        (f.id);
        (f);

    }, {limId:parseInt(f.id.substr(1))});

}

function addPhotoListBlock(id, src, likes, logged, islike, whoPosted) {
    var main = document.querySelector('.cont');
    var f  = main.lastElementChild;
    f = f.previousElementSibling;
    // (f);
    var item = f.cloneNode(true);
    var photoInfo = item.firstElementChild;
    var photoList = photoInfo.nextElementSibling;
    var likeDiv = photoList.nextElementSibling;
    var commnetBlock = likeDiv.nextElementSibling;

    ///--comBlock----//
    commnetBlock.firstElementChild.id = 'ta'+id;
    commnetBlock.firstElementChild.nextElementSibling.id = 'btnc_'+id;
    ///--comBlock----//
    ///---photoInfo--//
    photoInfo.firstElementChild.textContent = whoPosted;
    var img = photoInfo.querySelector('img');
    var t = photoInfo.querySelector('.lil');
    if (img !== null)
        img.parentNode.removeChild(img);
    if (logged && logged.toString().localeCompare(whoPosted.toString()) === 0)
    {
        img = document.createElement('img');
        img.src = '../../resources/delete-photo.svg';
        img.classList = 'like_img';
        photoInfo.onclick = function(event){
            var target = event.target;
            var tId = target.parentNode;
            if (target.tagName !== "IMG")
                return;
            deleteImage(id);
        };
        photoInfo.appendChild(img);
    }
    ///---photoInfo--//
    likeDiv.firstElementChild.firstElementChild.id = 'comm_'+id;
    likeDiv.firstElementChild.nextElementSibling.id = 'like_'+id;
    if (parseInt(islike) === 1)
        likeDiv.firstElementChild.nextElementSibling.src = '../resources/lkd.svg';
    else
        likeDiv.firstElementChild.nextElementSibling.src = '../resources/camalike.svg';
    likeDiv.lastElementChild.textContent = likes;
    photoList.firstElementChild.src = src;
    photoList.id = 'p'+id;
    main.insertBefore(item, main.lastElementChild);

}

