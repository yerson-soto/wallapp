const APP_URL='http://127.0.0.1:8000/';
// /**
//  * First we will load all of this project's JavaScript dependencies which
//  * includes Vue and other libraries. It is a great starting point when
//  * building robust, powerful web applications using Vue and Laravel.
//  */

// require('./bootstrap');

// window.Vue = require('vue');

// /**
//  * The following block of code may be used to automatically register your
//  * Vue components. It will recursively scan this directory for the Vue
//  * components and automatically register them with their "basename".
//  *
//  * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
//  */

// // const files = require.context('./', true, /\.vue$/i)
// // files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

// /**
//  * Next, we will create a fresh Vue application instance and attach it to
//  * the page. Then, you may begin adding components to this application
//  * or customize the JavaScript scaffolding to fit your unique needs.
//  */

// const app = new Vue({
//     el: '#app',
// });

//submit the form once loaded the file input
const imageInput = document.querySelector('#image');
const formImage = document.querySelector('#avatarForm');
if (imageInput != null) {
    imageInput.addEventListener('change', e => {
        formImage.submit();
    });
}

//change the button content once loaded the image
const postImgInput = document.querySelector('#post_image');
const postimgBtn = document.querySelector('#post_image_btn');
if (postImgInput != null ) {
    postImgInput.addEventListener('change', e => {
        if (postImgInput.value != '') {
            postimgBtn.querySelector('span').textContent = 'Imagen cargada';
            postimgBtn.classList.add('opacity-1');
        }
    });
}

//upvote or downvote post
document.querySelectorAll('.vote').forEach(voteBtn => {
    voteBtn.addEventListener('click', e => {
        e.preventDefault();
        e.stopPropagation();
        let postId = Number(voteBtn.getAttribute('data-id'));

        fetch(`${APP_URL}post/vote/${postId}`)
            .then(res => res.json())
            .then(data => {
                let likeCount;
                switch(data.action) {
                    case 'upvote':
                        voteBtn.querySelector('img').setAttribute('src', `${APP_URL}img/upvote.svg`);
                        likeCount = Number(voteBtn.querySelector('.like-count').textContent);
                        voteBtn.querySelector('.like-count').textContent = ++likeCount;
                        break;
                    case 'downvote':
                        voteBtn.querySelector('img').setAttribute('src', `${APP_URL}img/downvote.svg`);
                        likeCount = Number(voteBtn.querySelector('.like-count').textContent);
                        voteBtn.querySelector('.like-count').textContent = --likeCount;
                        break;
                }
            });

    });

});

//disable add comment btn if comment content if empty
document.querySelectorAll('.add-comment-btn').forEach(btn => {
    btn.classList.add('pointer-events-none');
    btn.disabled = true;
});

document.querySelectorAll('.comment-content').forEach(comment => {
    comment.addEventListener('input', e => {
        let commentContent = e.target.value;
        let addBtn =  comment.parentElement.querySelector('.add-comment-btn');
        if (!commentContent == '' && !/\s+$/.test(commentContent)) {
            addBtn.disabled = false;
            addBtn.classList.remove('pointer-events-none');
        } else {
            addBtn.disabled = true;
            addBtn.classList.add('pointer-events-none');
        }
    });
});

//add comment
const addCommentForms = document.querySelectorAll('.add-comment-form');
addCommentForms.forEach(form => {
    form.addEventListener('submit', (e) => {
        e.preventDefault();
        const comment = form.querySelector('.comment-content').value;
        const postId = form.querySelector('.post-id').value;
        if (!comment == '' && !/\s+$/.test(comment)) {
            const formData = new FormData();
            formData.append('content', comment);
            formData.append('post_id', postId);

            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            const xhr = new XMLHttpRequest();

            xhr.open('POST', `${APP_URL}comment/store`, true);
            xhr.setRequestHeader('X-CSRF-TOKEN', token);
            xhr.onload = function() {
                if (this.status == 200) {
                    const response = JSON.parse(this.responseText);
                    if (response.status == 'success') {
                        console.log(response);
                        const comments = form.parentElement.previousElementSibling.lastElementChild;

                        //create comment
                        const commentContainer = document.createElement('div');
                        commentContainer.classList.add('pl-2', 'ml-5', 'pr-4', 'mb-2', 'border-left', 'font-sm');

                        const commentInfo = document.createElement('p');
                        commentInfo.className = 'm-0';

                        const commentUser = document.createElement('span');
                        commentUser.className = 'font-weight-bold';
                        commentUser.textContent = response.user + ': ';
                        commentInfo.appendChild(commentUser);

                        const commentContent = document.createElement('span');
                        commentContent.textContent = response.data.content;
                        commentInfo.appendChild(commentContent);
                        commentContainer.appendChild(commentInfo);

                        const commentDate = document.createElement('span');
                        commentDate.classList.add('text-muted', 'font-sm', 'd-block');
                        commentDate.textContent = 'Justo ahora';
                        commentContainer.appendChild(commentDate);
                        console.log(commentContainer);

                        comments.insertBefore(commentContainer, comments.firstChild);
                        form.reset();

                        commentsCount = Number(comments.parentElement.querySelector('.comments-count').textContent);
                        comments.parentElement.querySelector('.comments-count').textContent = ++commentsCount;

                        if (comments.children.length > 2) {
                            comments.lastElementChild.remove();
                        }
                    }
                }
            }
            xhr.send(formData);
        }
    });
});
