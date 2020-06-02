function str_replace ( search, replace, subject ) {
    if(!(replace instanceof Array)){
        replace=new Array(replace);
        if(search instanceof Array){
            while(search.length>replace.length){
                replace[replace.length]=replace[0];
            }
        }
    }

    if(!(search instanceof Array))search=new Array(search);
    while(search.length>replace.length){
        replace[replace.length]='';
    }

    if(subject instanceof Array){
        for(k in subject){
            subject[k]=str_replace(search,replace,subject[k]);
        }
        return subject;
    }

    for(var k=0; k<search.length; k++){
        var i = subject.indexOf(search[k]);
        while(i>-1){
            subject = subject.replace(search[k], replace[k]);
            i = subject.indexOf(search[k],i);
        }
    }

    return subject;

}

function explode( delimiter, string ) {
    var emptyArray = { 0: '' };

    if ( arguments.length != 2
        || typeof arguments[0] == 'undefined'
        || typeof arguments[1] == 'undefined' )
    {
        return null;
    }

    if ( delimiter === ''
        || delimiter === false
        || delimiter === null )
    {
        return false;
    }

    if ( typeof delimiter == 'function'
        || typeof delimiter == 'object'
        || typeof string == 'function'
        || typeof string == 'object' )
    {
        return emptyArray;
    }

    if ( delimiter === true ) {
        delimiter = '1';
    }

    return string.toString().split ( delimiter.toString() );
}

function getNodeObject(str, object, ret){
    if(typeof object != 'object' && typeof object != 'array'){
        return ret;
    }

    var exp = explode('.', str);

    for(var i in exp){
        if(!object[exp[i]]){
            return ret;
        }

        object = object[exp[i]];
    }

    return object;
}

function preg_match_all(regex, haystack) {
    var globalRegex = new RegExp(regex, 'g');
    var globalMatch = haystack.match(globalRegex);
    matchArray = new Array();
    for (var i in globalMatch) {
        nonGlobalRegex = new RegExp(regex);
        nonGlobalMatch = globalMatch[i].match(nonGlobalRegex);
        matchArray.push(nonGlobalMatch[1]);
    }
    return matchArray;
}

function parseStringArgs(str, object){
    var si = 0, search = [], replace = [];
    preg_match_all("%(.*?)%", str).forEach(function(s){
        replace[si] = getNodeObject(s, object);
        search[si] = '%'+s+'%';
        si++;
    });
    return str_replace(search, replace, str);
}

var tweetMaket = '' +
    '<div class="tweet" data-tid="%Id%">' +
    '<span class="tweetTitle">%Category.Title%</span>' +
    '<span class="tweetCreateAt">%CreatedAt%</span>' +
    '<div class="tweetContent">%Content%</div>' +
    '<div class="tweetUsername">%Username%</div>' +
    '</div>';

function updateTweetsTable(){
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '/Tweets/GetTweets', false);
    xhr.send();

    var data = JSON.parse(xhr.response);

    var html = '';
    for(var i in data.result.items){
        var item = data.result.items[i];
        html += parseStringArgs(tweetMaket, item);
    }

    document.getElementsByClassName('tweets')[0].innerHTML = html;
}

function showTweetsNoRead(){
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '/Tweets/GetTweetsNoRead', false);
    xhr.send();

    var data = JSON.parse(xhr.response);

    var html = '';
    for(var i in data.result.items){
        var item = data.result.items[i];
        document.getElementsByClassName('tweets')[0].insertAdjacentHTML('afterbegin', parseStringArgs(tweetMaket, item));
        document.querySelectorAll('[data-tid="'+item.Id+'"]')[0].classList.add('tweetNew');
    }
}
setInterval(showTweetsNoRead, 500);


document.addEventListener('DOMContentLoaded', function(){
    var wrapPanel = document.createElement('div');
    wrapPanel.id = 'panel';
    document.body.append(wrapPanel);

    document.getElementById('formSendTweet').addEventListener('submit', function(e){
        e.preventDefault();

        var err = '';
        if(!document.getElementsByName('CategoryId')[0].value)
            err += "Выберите ратегорию\n";
        if(!document.getElementsByName('Username')[0].value)
            err += "Введите имя пользователя\n";
        if(!document.getElementsByName('Content')[0].value)
            err += "Введите текст твита\n";
        if(err){
            alert(err);
            return ;
        }

        var data = new FormData(this);
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '/TweetAdd', false);
        xhr.send(data);
        var res = JSON.parse(xhr.response);
        if(xhr.status == 200 && res.result === true){
            this.reset();
        } else
            alert('Произошла ошибка. '+xhr.status);
    });

    updateTweetsTable();
});