# Executar

Clonar o repositório

```
git clone git@github.com:wkarita/perfect_pay.git
```

Na pasta backend, copie o arquivo .env.example para o arquivo .env

```
cd backend
cp .env.example .env
```

No arquivo .env altere os valores API_HOST= e o valor API_KEY= conforme necessário

```
API_HOST=https://sandbox.asaas.com/
API_KEY=*Chaves da API(Assas)*
```

Em seguida, execute o Docker Compose na raiz do projeto.

```
docker compose --env-file ./backend/.env up -d
```

## A API pode ser acessada em

```
http://api.localhost:9090/api
```

## O Sistema pode ser acessada em

```
http://app.localhost:9090/
```
