# Instrução para uso do Tema dos NPDs

## O que há de diferente?

O site de NPDs é uma instalação de Tainacan e WordPress com algumas poucas coisas específicas.

Em primeiro lugar, há um tipo de conteúdo chamado NPD. Estes servem para criar as páginas de cada NPD no site.

Também há outro tipo de conteúdo chamado Profissionais, que serve para criar o banco de profisionais.

### Criando um NPD

Para gerenciar as páginas dos NPDs, visite o Menu NPD no painel de controle

![alt text](https://raw.githubusercontent.com/medialab-ufg/tema-npds/master/assets/images/imagem_001.png)

Para criar um NPD novo, clique em `Adicionar novo`.

![alt text](https://raw.githubusercontent.com/medialab-ufg/tema-npds/master/assets/images/imagem_002.png)

A página de um NPD pode ser composta de qualquer coisa. Texto, fotos, vídeos etc. Para construí-la, basta utilizar o construtor de páginas do WordPress. (Gutenberg)

![alt text](https://raw.githubusercontent.com/medialab-ufg/tema-npds/master/assets/images/imagem_003.png)

Além disso, a página de um NPD pode ser composta de subpáginas. Essas serão listadas automaticamente na página do NPD.

Para criar uma subpágina para um NPD, clique em `Adicionar novo` e, na barra lateral direita, escolha de qual NPD esse conteúdo que está sendo criado é filho.

![alt text](https://raw.githubusercontent.com/medialab-ufg/tema-npds/master/assets/images/imagem_004.png)

Dessa maneira, você pode ter um NPD com um conteúdo em sua página principal e links para subpáginas. veja um exemplo:

![alt text](https://raw.githubusercontent.com/medialab-ufg/tema-npds/master/assets/images/imagem_005.png)

#### Relacionando um NPD com os Mapas Culturais

Algumas informações dos NPDs serão "puxadas" automaticamente da plataforma Mapas Culturais.

Além dos eventos, tambẽm serão recuperadas informações de endereço, cidade e estado, coordenadas geográficas e informações de contato.

Para isso, é necessário informar o WordPress qual é o `Espaço` na plataforma Mapas Cuturais que corresponde a este NPD.

Para isso, visite a página de um NPD na plataforma Mapas Culturais e copie seu endereço. Por exemplo: `http://mapas.cultura.gov.br/espaco/1234`. (Note que o endereço precisa ter esse formato, com o `/espaco/`).

Agora edite um NPD no WordPress e informe este endereço no campo correspondente na barra lateral direita.

![alt text](https://raw.githubusercontent.com/medialab-ufg/tema-npds/master/assets/images/imagem_006.png)

Com isso, será montada automaticamente a listagem de eventos e a seção de contatos da página do NPD.

![alt text](https://raw.githubusercontent.com/medialab-ufg/tema-npds/master/assets/images/imagem_007.png)


### Cadastrando profissionais

Para gerenciaar a lista de profissionais, basta acessar o menu `Profissionais`.

Os profissionais podem ser classificados em dois tipos de categorias:
* Área (ex: áudio, fotografia)
* Especialisdade (ex: som direto)


### Lista geral de eventos 

Também existe uma listagem geral de todos os eventos de todos os NPDS. Para acessá-la, basta visitar o endereço do site seguido de `/eventos`.

### Colocando tudo isso no Menu

Para colocar NPDs no menu, não esqueça de habilitar a opção em `Opções de Tela` na página de edição de Menus.

![alt text](https://raw.githubusercontent.com/medialab-ufg/tema-npds/master/assets/images/imagem_008.png)

Para adicionar um link para a listagem de NPDs:
* abra a aba de NPDs ao lado esquerdo
* Clique em `Ver Todos` 
* Marque a opção `Todos os NPDs` e adicione ao menu

![alt text](https://raw.githubusercontent.com/medialab-ufg/tema-npds/master/assets/images/imagem_009.png)

Para adicionar um link para a listagem de profissionais siga os mesmos passos.
