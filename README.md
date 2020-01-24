# API Pesquisar Seminovos BH

## Proposta

Desenvolver endpoints RESTful em PHP com a finalidade de extrair dados do site [seminovos.com.br].

Os endpoints propostos devem:
- Procurar por carros de acordo com os filtros existentes

## Especificações

- PHP ^7.3.12
- Laravel 6.12.0

## Como testar

1. Após baixar o código deste repositório, extraia os arquivos e mova-os para onde desejar
2. Abra o terminal de comandos, aponte para a pasta escolhida e rode o comando [composer install]
3. Rode o comando [php artisan serve] para que o servidor de desenvolvimento do Laravel seja iniciado
4. Utilize um ambiente de desenvolvimento de APIs (como o Postman) para efetuar requisições para o endereço [localhost:8000/api/] Exemplo: "http://127.0.0.1:8000/api/Buscar/carro/fiat/palio/ano-2019-2019/km-2000-20000"

## Rotas

### [GET] api/Buscar/{veiculo}/{marca}/{modelo}/{anos}/{km}
Rota utilizada para buscar a lista de anúncios que correspondem aos parâmetros fornecidos.

#### Entrada
- veiculo: "carro" || "moto" || "caminhao" (*)
- marca: string
- modelo: string
- anos: string "ano-YYYY-YYYY"
- km: string "km-num-num"

#### Saída
<pre>
Json: {
        [int]{
            "sku": [int],
            "url": [string],
            "bodyType": [string],
            "brand": [string],
            "model": [string],
            "name": [string],
            "description": [string],
            "mileageFromOdometer": [int],
            "ano_fabricacao": [string],
            "price": [float],
            "priceCurrency": [string],
            "priceValidUntil": [string],
            "image": [string]
        }
    ...
}
</pre>


### Renan Toledo

