



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
function showComments(commentPrevId) {

    var parent = document.getElementById(commentPrevId).parentNode.parentNode.nextElementSibling;
    var area = parent.getElementsByClassName('commentArea')[0];
    var btn = parent.getElementsByClassName('commentBtn')[0];
    console.log(parent.getElementsByClassName('commentArea')[0]);
    console.log(parent.getElementsByClassName('commentBtn')[0]);
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
                addCommentBlock(parent, jsonObj[com].text, area);
                console.log(jsonObj[com].login);
            }
        });

    }
}

function ajaxPost(url, callback, toSend, index) {
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
        fd.append(index,toSend);
        req.send(fd);
    }
    else
        req.send()
}

function sendComment(btn) {

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
                 var prevComBlock = btn.parentNode.parentNode;
                 prevComBlock = prevComBlock.previousSibling;
                 showComments(prevComBlock);
                 console.log("added");
             }
             else
             {
                // alert('http://localhost:8101/addComment/'+btn+"="+text);
                 console.log('data='+data+';');
                 //alert("Something goes wrong!");
             }
         }, text, 'comment');
     }
   // var photoId = commentsDiv.parentNode.firstChild;
    // ajaxPost('http://lacalhost:8101/addComment/'+photoId, function (data) {
    //     if (data.toString().localeCompare('OK') === 0)
    //     {
    //         //showComments()
    //     }
    // });
}
// function getLikeCount(id) {
//
//     var req = new XMLHttpRequest();
//     console.log('id='+id);
//     req.onreadystatechange = function () {
//         if (req.readyState === 4 && req.status === 200)
//         {
//             console.log("response="+req.responseText);
//             return req.responseText;
//             // if (req.responseText !== 'false')
//             // {
//             //     document.getElementById(id).setAttribute('src',  '../resources/lkd.svg');
//             //     photo_like.nextElementSibling.innerHTML = likes;
//             //     // document.getElementById(id).nextSibling.innerHTML = likes;
//             // }
//             // else if (req.responseText === 'false')
//             // {
//             //     document.getElementById(id).setAttribute('src', '../resources/camalike.svg');
//             //     photo_like.nextElementSibling.innerHTML = likes;
//             //     // document.getElementById(id).nextSibling.innerHTML = likes;
//             // }
//         }
//     };
//
//     req.open('POST', 'http://localhost:8101/showLikes/'+id);
//     req.send();
// }