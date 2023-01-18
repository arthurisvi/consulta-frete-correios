# Consulta Frete 
API construída em PHP para consulta de preço e prazo de entregas fazendo integração com Correios.

Basicamente, a intenção da aplicação é facilitar o consumo da API dos Correios, visto que a mesma retorna um XML em sua consulta. 
Esse WebService possui um endpoint que recebe um JSON e retorna um JSON convertido com os dados XML buscados nos Correios. 

## [POST] /freight/calculate
### Exemplo de entrada
```json
{
	"company_code": "",
	"company_password": "",
	"service_code": "04014",
	"origin_cep": "09010100",
	"destination_cep": "31845010",
	"weight": 2,
	"width": 15,
	"format": 1,
	"height": 15,
	"length": 15,
	"diameter": 0,
	"own_hand": 1,
	"declared_value": 0,
	"receipt": 0
}
```

#### Informações relevantes
Código dos serviços:
* SEDEX  = '04014';
* SEDEX 12 = '04782';
* SEDEX 10 = '04790';
* SEDEX_TODAY_SERVICE = '04804';
* PAC = '04510';

Formato do pacote
* Caixa/pacote = 1;
* Rolo/Prisma = 2;
* Envelope = 3;

### Exemplo de retorno

```json
{
	"Codigo": "04014",
	"Valor": "54,05",
	"PrazoEntrega": "1",
	"ValorSemAdicionais": "45,80",
	"ValorMaoPropria": "8,25",
	"ValorAvisoRecebimento": "0,00",
	"ValorValorDeclarado": "0,00",
	"EntregaDomiciliar": "S",
	"EntregaSabado": "S",
	"obsFim": {},
	"Erro": "0",
	"MsgErro": {}
}
```
