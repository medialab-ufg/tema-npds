# Estrutura da Informação no WordPress

## Post Types

Usaremos os post types padrão para blog (notícias) páginas institucionais

### Post type NPD

Haverá um Post type chamado NPD, que terá um post para cada NPD.

Cada NPD configurará sua página também com o Gutenberg, editando o seu post desse post type

Esse post type terá:

* metabox - Link para o Mapas Culturais: Link para o espaço no Mapas Culturais. Isso nos permitirá fazer o link para esta plataforma, e buscar automaticamente informações sobre o NPD, como posição geográfica e agenda de eventos.


## Home (front-page.php)

A home será montada com o Gutenberg. Blocos de conteúdo padrão.

Usaremos também alguns blocos de conteúdo específicos do tainacan, como o de listagem de coleções

## Página dos NPDs (single-npd.php)

É a single do post type NPD.

No início da página vamos avaliar a melhor solução:

1. Utilizar o Gutenberg e seus blocos padrão, permitindo que o usuário crie links para outras páginas e tudo mais
2. Criar algum tipo de regra, que liste automaticamente o excerpt de todas as páginas marcadas com algum metadado que se relacionem com este NPD, ou, ainda, fazemos o post type ser hierárquico e listamos as páginas filhas do NPD

Ela gerará automaticamente a lista de eventos ao final da página, puxando do Mapas Culturais

## Listagem de NPDs (archive-npd.php)

Será um template que mostrará a lista de NPDs por cidade e com mapa.

## URLs personalizadas

haverá uma URL `/eventos/` que listará automaticamente todos os eventos do Mapas que acontecem nos NPDs

e també uma URL `/eventos/ID-DO-EVENTO`, que mostrará os detalhes do evento.

`/npd/nome-do-npd/eventos/` usará o mesmo template, mas listará apenas os eventos de um NPD

## Integração com Mapas

referências:

Esta página: http://fnm.cultura.gov.br/eventos/ utiliza este shortcode: https://github.com/culturagovbr/list-events-shortcode

Podemos usar como base e incorporar o código desse shortcode no nosso tema

