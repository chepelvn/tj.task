document.addEventListener('DOMContentLoaded', function(){
    var wrapPanel = document.createElement('div');
    wrapPanel.id = 'panel';
    document.body.append(wrapPanel);
    wrapPanel.append();

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
        xhr.open('POST', '/Tweets/AddTweet', false);
        xhr.send(data);
        var res = JSON.parse(xhr.response);
        if(xhr.status == 200 && res.result === true){
            this.reset();
            alert('Твит отправлен')
        } else
            alert('Произошла ошибка. '+xhr.status);
    });
});