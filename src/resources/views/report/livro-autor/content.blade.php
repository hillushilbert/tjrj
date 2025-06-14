<div class="content">
    <!-- dados do veiculo  -->
    <table class="dados_autor">
        @foreach($dados as $autor)
        <tr>
            <td class="dados_autor_primeira_linha">
                {{$autor->nome}}
            </td>
        </tr>
        <tr>
            <td>
                <table class="dados_livro">
                    <tr>
                        <th>Titulo</th>
                        <th>Editora</th>
                        <th>Edição</th>
                        <th>Assuntos</th>
                        <th>Valor R$</th>
                    </tr>
                @foreach($autor->livros as $livro)
                    <tr>
                        <td class="dados_livro_titulo">{{$livro->titulo}}</td>
                        <td class="dados_livro_editora">{{$livro->editora}}</td>
                        <td class="dados_livro_edicao">{{$livro->edicao}}</td>
                        <td class="dados_livro_assuntos">
                            <ul>
                            @foreach($livro->assuntos as $assunto)
                                <li>{{$assunto}}</li>
                            @endforeach
                            </ul>
                        </td>
                        <td class="dados_livro_valor">R$ {{$livro->valor}}</td>
                    </tr>                
                @endforeach
                </table>
            </td>
        </tr>
        @endforeach
    </table>
</div>
