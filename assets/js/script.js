if(document.getElementById('newAuthorForm')){

const newAuthorForm = document.getElementById('newAuthorForm');

newAuthorForm.addEventListener('submit', function (event) {
    event.preventDefault();

    const form = new FormData(newAuthorForm);
    fetch('/author/admin', {
        method: 'POST',
        body: form
    })
    .then(function() {
        loadAuthors();
        document.getElementById('lastname').value = '';
        document.getElementById('firstname').value = '';
    })
    
    ;
});

function loadAuthors() {
    const tbody = document.getElementById('listContent');

    fetch('/author/admin/list')
    .then(response => response.text())
    .then(content => tbody.innerHTML = content)
    ;
}

loadAuthors();
}