



function likeImg(id) {

    var photo_like = document.getElementById(id);//ClassName('photo_list');


   // document.location.assign('/like/' + id);

    var req = new XMLHttpRequest();

    req.onreadystatechange = function () {
        if (req.readyState === 4 && req.status === 200)
        {
            console.log("scs");
            console.log(req.responseText);
            if (req.responseText === 'liked')
            {
                document.getElementById(id).setAttribute('src',  '../resources/lkd.svg');
            }
            else if (req.responseText === 'unliked')
            {

                document.getElementById(id).setAttribute('src', '../resources/camalike.svg');
            }
        }
    };

    req.open('POST', 'http://localhost:8101/like/' + id);
    req.send();
}