<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Teste Pratica Internet</title>
    <link rel="icon" type="image/x-icon" href="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="bg-primary w-100 text-center p-2">
        <h1 class="text-light">
            Noticias Clinic Mais
        </h1>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mt-5">
                <div class="card-header text-center">
                    <h3>
                        Cadastrar Notícia
                    </h3>
                </div>
                <div class="card-body">
                    <form class="" method="">
                        <div class="row">
                            <div class="col-12 mt-1">
                                <label for="titulo" class="form-label">Título</label>
                                <input id="titulo" type="text" placeholder="Digite o título da notícia..." class="form-control w-100" required>
                            </div>
                            <div class="col-12 mt-1">
                                <label for="conteudo" class="form-label">Conteúdo</label>
                                <textarea class="form-control w-100" placeholder="Digite a descrição da notícia..." rows="5" required id="conteudo"></textarea>
                            </div>
                            <div class="col-12 mt-1">
                                <button type="button" onclick="recuperarFormulario()" class="btn btn-sm btn-success w-100 mt-3">Cadastrar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-3 text-center mb-2">
        <h3>
            Notícias
        </h3>
    </div>
    <div class="container">
        <div class="row justify-content-center" id="noticias">
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

<script>
    const baseUrl = 'http://localhost:8000/api/'
    let noticias;

    function recuperarFormulario() {
        let titulo = document.getElementById('titulo').value;
        let conteudo = document.getElementById('conteudo').value;
        let payload = {
            titulo: titulo,
            conteudo: conteudo
        }

        fetch(baseUrl + 'criar-noticia', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(payload)
        }).then(response => {
            if (!response.ok) {
                throw new Error('Erro: ' + response.statusText);
            }
            return response.json();
        }).then(data => {
            lerNoticias();
        }).catch(error => {
            console.error('Erro: ', error);
        });
    }

    function lerNoticias() {
        fetch(baseUrl + 'ler-noiticias', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            }
        }).then(response => {
            if (!response.ok) {
                throw new Error('Erro: ' + response.statusText);
            }
            return response.json();
        }).then(data => {
            noticias = data;
            iterarNoticias(noticias);
        }).catch(error => {
            console.error('Erro: ' + error);
        })
    }

    function iterarNoticias(noticia) {
        let divNoticias = document.getElementById('noticias');
        divNoticias.innerHTML = '';
        noticia.forEach(item => {
            let card = document.createElement('div');
            card.classList.add('card', 'p-0', 'col-6');

            let cardHeader = document.createElement('div');
            cardHeader.classList.add('card-header');

            let h1 = document.createElement('p')
            h1.innerText = item.titulo
            cardHeader.appendChild(h1);

            let cardBody = document.createElement('div');
            cardBody.classList.add('card-body');

            let p = document.createElement('p');
            p.innerText = item.conteudo;
            cardBody.appendChild(p);

            let divButton = document.createElement('div');
            divButton.classList.add('d-flex');

            let button = document.createElement('button');
            button.classList.add('btn', 'btn-sm', 'btn-primary', 'w-100', 'm-2');
            button.innerHTML = 'Editar';
            button.addEventListener('click', () => editarNoticia(item.id));
            divButton.appendChild(button);


            card.appendChild(cardHeader);
            card.appendChild(cardBody);
            card.appendChild(divButton);

            divNoticias.appendChild(card);
        });
    }

    function editarNoticia(id) {
        window.location.href = `http://localhost:8000/editar/${id}`;
    }

    lerNoticias();
</script>

</html>