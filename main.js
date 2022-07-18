
const audio = document.querySelector('audio');
const playlist = document.getElementById('playlist');
let img = playlist.querySelectorAll('img');
let div2 = playlist.querySelectorAll('.div2');
const playlist2 = document.getElementById('playlist2');
let img2 = playlist2.querySelectorAll('img');
const prt_title = document.querySelector('.prt_title');
const btn_local_add = document.querySelectorAll('.btn_local_add');
const btn_local_del = document.querySelectorAll('.btn_local_del');

let key;
let key2;
let temp_img;
let temp_div2;
let temp_div3;
let temp_img2;
let temp_local;
let song;
let txt
let local_array = [];
let tl = 0;
let data = 'list';
let div3;

function print_local() {
    // if (data === ""){return}
    local_array = localStorage.getItem(data) ? JSON.parse(localStorage.getItem(data)) : localStorage.setItem(data, JSON.stringify([]));
    if (local_array){local_array.sort(function () { return 0.5 - Math.random() })};
    playlist2.innerHTML = '';

    if (local_array)local_array.forEach((file, key) => {
        if (!file) { return }
        txt = file.split("-");
        txt[0] = txt[0].toUpperCase();
        txt[1] = txt[1].toUpperCase();
        if (txt[2] == undefined) txt[2] = "";
        playlist2.innerHTML += `
        
        <div class='media' id='A${key}'>
        <div class='div1'>
        <img class='media-object' data-song='${file}' data-key='${key}'       
        src='${fileDir}${file}.jpg'>
        <div class='div2'></div></div>
        <div class='media-body'>
        <h3 class='media-heading'>${txt[0]}</h3>
        <p class='media-heading'>${txt[1]}</p>
        <button class='btn_local_del' onclick='local_del(${key});'>Del Song</button>
        <span class='nummering'>${key}</span>
        </div> </div>`;
    })

    img = playlist.querySelectorAll('img');
    img2 = playlist2.querySelectorAll('img');
    div3 = playlist2.querySelectorAll('.div2');
};


local_array = localStorage.getItem(data) ? JSON.parse(localStorage.getItem(data)) : localStorage.setItem(data, JSON.stringify([]));
if (tl == 2){ print_local()}; // !!!!!!!!!!!!!!!!!!!  SORT 
print_local();

img.forEach(element => {
    element.addEventListener("click", (e) => {
        remove_class();
        tl = 1;
        temp_img2 = '';
        key = e.target.dataset.key;
        key = Number(key);
        song = songs[key];
        if (!song) { return };
        audio.src = `${fileDir}${song}.mp3`;
        audio.play();
        prt_title.innerText = song.toUpperCase();
        temp_img = img[key];
        temp_div2 = div2[key];

        goto_song();
    })
});


playlist2.addEventListener('click', (e) => {
    remove_class();
    key2 = e.target.dataset.key;
    if (!key2) { console.log(key2); return }
    song = '';
    key2;
    img2.forEach(() => {
        Number(key2);
        song = local_array[key2];
        if (!song) { return };
    })
    tl = 2;
    temp_img = '';
    audio.src = `${fileDir}${song}.mp3`;
    audio.play();
    prt_title.innerText = song.toUpperCase();
    temp_img2 = img2[key2];
    temp_div3 = div3[key2];
    goto_song();
})


audio.addEventListener('ended', () => {
    prt_title.innerText = '';
    key++;
    if (tl == 2) { key2++ };
    song = songs[key];
    if (tl == 2) { song = local_array[key2]; }
    if (!song) { return };
    src = `${fileDir}${song}.mp3`;
    audio.src = src;
    audio.play();
    prt_title.innerText = song.toUpperCase();
    temp_img = img[key];
    temp_div2 = div2[key];
    temp_div3 = div3[key2];
    if (tl === 2) { temp_img2 = img2[key2] };
    if (tl === 2) { temp_div3 = div3[key2] };
});


audio.addEventListener('pause', () => {
    remove_class();
})
audio.addEventListener('play', () => {
    if (tl === 1 && temp_img) {
        temp_img.classList.add('rotate');
        if (temp_div2){temp_div2.classList.add('punt_img')};
    }
    if (tl === 2 && temp_img2) {
        temp_img2.classList.add('rotate');
        if (temp_div2){temp_div2.classList.add('punt_img')};
        if (temp_div3){temp_div3.classList.add('punt_img')};
    }
    goto_song();
})

// ? LOCALSTORAGE  Maken en Song toevoegen--------------------
function local_add(nr) {

    if (local_array.includes(songs[nr]) || local_array.length > 24) {
        prt_title.innerText = "already exsist or length is more ten 25 ";  // !!!!!!!!!!!!!!!!!!! PRT
        return;
    }
    local_array.push(songs[nr]);
    prt_title.innerText = "Toegevoegd aan Playlist: " + data + (songs[nr]);
    localStorage.setItem(data, JSON.stringify(local_array));
    local_array = localStorage.getItem(data) ? JSON.parse(localStorage.getItem(data)) : '';
    btn_local_add[nr].style.backgroundColor = 'rgb(246, 241, 92)';
    print_local();
}

function local_del(nr) {
    let del_song = local_array[nr];
    prt_title.innerText = "local_delete = " + del_song; // !!!!!!!!!!!!!!!!! PRT
    local_array = local_array.filter((local_array) => local_array != del_song);
    localStorage.setItem(data, JSON.stringify(local_array));
    print_local();
}

// ? **********************************************************************************

function remove_class() {
    if (temp_img) temp_img.classList.add('extra');
    if (temp_img2) temp_img2.classList.add('extra');
    if (temp_img) temp_img.classList.remove('rotate');
    if (temp_div2) temp_div2.classList.remove('punt_img');
    if (temp_div3) temp_div3.classList.remove('punt_img');
    if (temp_img2) temp_img2.classList.remove('rotate');
}

function remove_active() {
    let a = document.querySelectorAll('.a');
    a.forEach((element, tel) => {
        a[tel].classList.remove('active');
    });
}

function goto_song() {
    if(tl ===1 ){key3 = key-10;window.location.href = `#B${key3}`};
    if(tl ===2 ){key4 = key2 -10;window.location.href = `#A${key4}`};
    return;
}







  // window.location.reload();
  // local_array.sort(function () { return 0.5 - Math.random() }); // !!!!!!!!!!!!!!!!!!!  SORT 

