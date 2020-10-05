<style>
    #descritivo{
        text-align: justify;
        line-height: 1.6;
    }
    table.comBordaSimples {
        border-collapse: collapse;/* CSS2 */

    }
    table.comBordaSimples td {
        text-align: left;
        padding: 8px;
    }
    table.comBordaSimples th {
        border: 1px solid #b2b2b2;
        background: #cccccc;
        text-align: left;
        padding: 8px;
    }
    td  {
        font-weight: normal;
        background: #ffffff;
    }
    td.cinza  {
        font-weight: bold;
    }

    .Texto {
        font-size: 12pt;
        font-family: Calibri;
        word-wrap: normal;
    }
    .Texto_Justificado {
        font-size: 12pt;
        font-family: Calibri;
        text-align: justify;
        word-wrap: normal;
        text-indent: 0;
        margin: 6pt;
    }
    .Texto_Justificado_Negrito {
        font-weight: bold;
        font-size: 12pt;
        font-family: Calibri;
        text-align: justify;
        word-wrap: normal;
        text-indent: 0;
        margin: 6pt;
    }
    .Tabela_Justificado_Negrito {
        font-weight: bold;
        font-size: 12pt;
        font-family: Calibri;
        text-align: justify;
        word-wrap: normal;
        text-indent: 0;
        margin: 6pt;
    }
</style>

<div id="descritivo">
<p class="Texto_Justificado">@vinculacao_substituicao@</p>
</div>

<div id="descritivo">
<p class="Texto_Justificado">O Usu�rio Externo declarou ser o Respons�vel Legal pela Pessoa Jur�dica e ter ci�ncia de que o ato de inserir ou fazer inserir declara��o falsa ou diversa da que devia ser escrita � crime, conforme disposto no art. 299 do C�digo Penal Brasileiro. Com isso, concordou que ter� poderes para:</p>
<label>
    <ol>
        <li><p class="Texto_Justificado">Gerenciar o cadastro da Pessoa Jur�dica;</p></li>
		<li><p class="Texto_Justificado">Receber Intima��es Eletr�nicas e realizar Peticionamento Eletr�nico em nome da Pessoa Jur�dica, com todos os poderes previstos no sistema;</p></li>
        <li><p class="Texto_Justificado">Conceder Procura��es Eletr�nicas Especiais a outros Usu�rios Externos, bem como revog�-las quando lhe convier;</p></li>
        <li><p class="Texto_Justificado">Conceder Procura��es Eletr�nicas Simples a outros Usu�rios Externos, em �mbito geral ou para processos espec�ficos, conforme poderes estabelecidos, para representa��o da Pessoa Jur�dica Outorgante, bem como revog�-las quando lhe convier.</p></li>
    </ol>
</label>
</div>

<p class="Texto_Justificado_Negrito" style="margin-left: 6pt;@p_estilo_substituido">Usu�rio Externo Substitu�do como Respons�vel Legal:</p>
<table class="comBordaSimples Tabela_Justificado_Negrito" width="100%" style="font-weight: bold;@table_estilo_substituido">
   <tr>
     <td class="cinza" style="width: 20%; padding-left: 35px;">Nome:</td>
     <td>@nomeSubstituido</td>
   </tr>
</table>

<p class="Texto_Justificado_Negrito" style="margin-left: 6pt;margin-top: 1.5%">Usu�rio Externo indicado como Respons�vel Legal:</p>
<table class="comBordaSimples Tabela_Justificado_Negrito" width="100%" style="font-weight: bold;">
   <tr>
     <td class="cinza" style="width: 20%; padding-left: 35px;">Nome:</td>
     <td>@nome</td>
   </tr>
</table>

<p class="Texto_Justificado_Negrito" style="margin-left: 6pt;margin-top: 1.5%">Pessoa Jur�dica:</p>
<table class="comBordaSimples Tabela_Justificado_Negrito" width="100%" >
    <tbody>
    <tr>
        <td class="cinza" style="width: 20%; padding-left: 35px;">CNPJ:</td>
        <td>@cnpjVinculo</td>
    </tr>
    <tr >
        <td class="cinza" style="padding-left: 35px;">Raz�o Social:</td>
        <td>@razaoSocial</td>
    </tr>
    <tr>
        <td class="cinza" style="padding-left: 35px;">UF:</td>
        <td>@uf</td>
    </tr>
    <tr >
        <td class="cinza" style="padding-left: 35px;">Cidade:</td>
        <td>@cidade</td>
    </tr>
    </tbody>
</table>
<p class="Texto_Justificado">Os atos constitutivos anexados ao presente documento de Vincula��o pelo o Usu�rio Externo para comprova��o dos poderes a ele concedidos para atuar em nome da Pessoa Jur�dica constam no correspondente Recibo Eletr�nico de Protocolo gerado.</p>
@motivo