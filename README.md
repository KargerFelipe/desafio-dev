# Desafio programação - para vaga desenvolvedor

Aplicação criada em PHP(Laravel) + Vuejs


# Pré-requisitos

1 - Ter docker instalado no seu ambiente

2- Portas utilizadas:

- **nginx** - `:80`
- **mysql** - `:3306`
- **php** - `:9000`


3 - Faça o passo a passo em ordem 

- `git clone git@github.com:KargerFelipe/desafio-dev.git bycoders_karger`
- `cd bycoders_karger/app`
- `sudo docker-compose up -d --build app`
- `sudo docker-compose run --rm composer update`
- `sudo docker-compose run --rm artisan migrate`
- `sudo docker-compose run --rm npm install`
- `sudo docker-compose run --rm npm run dev`


Obs: sudo não necessário dependendo da forma que vc tem o docker instalado

# Depois de feito isso, a aplicação deverá estar rodando em localhost:80
