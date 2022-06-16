let id = null;
async function getPosts() {
    let res = await fetch('http://api.rest/posts');
    let data = await res.json();
    document.querySelector('.post-list').innerHTML = ``;

    data.forEach((post) => {
       document.querySelector('.post-list').innerHTML += `
    <div class="col-4">
        <div class="card">
           <div class="card-body">
                <h5 class="card-title">${post.title}</h5>
                <p class="card-text">${post.body}</p>
                <a href="#" class="btn btn-primary">Подробнее</a>
                <a class="btn btn-primary" onclick="deletePost(${post.id})" id="delete">Удалить</a>
                <a class="btn btn-primary" onclick="selectPost('${post.id}', '${post.title}', '${post.body}')" id="delete">Редактировать</a>
            </div>
        </div>
    </div>`;
    });
}


async function addPost() {
    const title = document.getElementById('title').value,
        body = document.getElementById('body').value;
    let formData = new FormData();
    formData.append('title', title);
    formData.append('body', body);

    let res = await fetch('http://api.rest/posts', {
        method: 'POST',
        body: formData
    });

    const data = await res.json();

    if (data.status === true) {
        await getPosts();
    }
}

const addpost = document.querySelector('#add-post');
addpost.addEventListener('click', () => {
    addPost();
});

async function deletePost(id) {
    const res = await fetch(`http://api.rest/posts/${id}`, {
        method: 'DELETE'
    });
    const data = await res.json();

    if (data.status === true) {
        await getPosts();
    }
}

function selectPost(idPost, title, body) {
    id = idPost;
    document.querySelector('#edit-title').value = title;
    document.querySelector('#edit-body').value = body;

}

async function updatePost() {
    const title = document.querySelector('#edit-title').value,
        body = document.querySelector('#edit-body').value;

    const data = {
        title: title,
        body: body
    };

    const res = await fetch(`http://api.rest/posts/${id}`, {
        method: 'PATCH',
        body: JSON.stringify(data)
    });

    let resData = await res.json();

    if (resData.status === true) {
        await getPosts();
    }
}

function cancelUpdate() {
    const title = document.querySelector('#edit-title').value = '',
        body = document.querySelector('#edit-body').value = '';
}


getPosts();

