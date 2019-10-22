# Sessão

Uma característica do HTTP é ser stateless, ou seja, as requisições são independentes umas das outras e não armazenam informações do estado da aplicação. 

Quando armazenamos essas informações no cliente, temos o que chamamos de Cookies. Quando esses dados são armazenados no lado do Servidor, temos as Sessions. Por exemplo, quando fazemos login a classe interna de autenticação guarda os dados do usuário autenticado na sessão, assim na próxima vez que solicitamos uma página o Laravel consulta essa sessão e verifica que já estamos logado.

# Métodos de Sessão

Para manipularmos os dados nas sessões precisamos usar alguns métodos que o próprio Laravel fornece, veja alguns:

1. **put('key', 'value')** : Inclui um novo item na sessão;
2. **get('key')** : recupera um valor gravado na sessão a partir da chave;
3. **has('key')** : Verifica se existe o item key em nossa session e se não é null;
4. **exists('key')** : Verifica se o item key existe na sessão;
5. **push('key.array', 'field')** : Inclui um novo item em um array de Session já existente;
6. **forget('key')** **: Remove o item key da session;
7. **flush()** : Remove todos os itens da session;
8. **regenerate()** : Regenera o ID interno da session.

Para acessarmos esses métodos temos duas formas, a primeira é pelo Request e a segunda é pelo helper session():

- Acessando pela Request: **$value = $request->session()->get('key');**
- Acessando pelo helper session(): **$value = session('key');**
