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
        font-size: 11pt;
        font-family: Calibri;
        word-wrap: normal;
    }
    .Texto_Justificado {
        font-size: 11pt;
        font-family: Calibri;
        text-align: justify;
        word-wrap: normal;
        text-indent: 0;
        margin: 6pt;
    }
    .Texto_Justificado_Negrito {
        font-weight: bold;
        font-size: 11pt;
        font-family: Calibri;
        text-align: justify;
        word-wrap: normal;
        text-indent: 0;
        margin: 6pt;
    }
    .Tabela_Justificado_Negrito {
        font-weight: bold;
        font-size: 11pt;
        font-family: Calibri;
        text-align: justify;
        word-wrap: normal;
        text-indent: 0;
        margin: 6pt;
    }
</style>
<p class="Texto_Justificado_Negrito" style="margin-left: 6pt;@p_estilo_substituido">Dados da Vincula��o Encerrada</p>
<table class="comBordaSimples Tabela_Justificado_Negrito" width="100%" style="font-weight: bold;@table_estilo_substituido">
    <tr>
        <td class="cinza" style="width: 40%; padding-left: 35px;">Data e Hor�rio da Vincula��o:</td>
        <td>@dtHorarioVinculacao</td>
    </tr>
    <tr>
        <td class="cinza" style="width: 40%; padding-left: 35px;">N�mero do Processo:</td>
        <td>@numProcesso</td>
    </tr>
    <tr>
        <td class="cinza" style="width: 40%; padding-left: 35px;">N�mero do Documento da Vincula��o Substitu�da:</td>
        <td>@numDocumento</td>
    </tr>
    <tr>
        <td class="cinza" style="width: 40%; padding-left: 35px;">Respons�vel Legal Substitu�do:</td>
        <td>@responsavelLegal</td>
    </tr>
</table>
<p class="Texto_Justificado_Negrito" style="margin-left: 6pt;@p_estilo_substituido">Dados da Pessoa Jur�dica</p>
<table class="comBordaSimples Tabela_Justificado_Negrito" width="100%" style="font-weight: bold;@table_estilo_substituido">
    <tr>
        <td class="cinza" style="width: 40%; padding-left: 35px;">Raz�o Social:</td>
        <td>@razaoSocial</td>
    </tr>
    <tr>
        <td class="cinza" style="width: 40%; padding-left: 35px;">CNPJ:</td>
        <td>@cnpj</td>
    </tr>
</table>
<p class="Texto_Justificado_Negrito" style="margin-left: 6pt;@p_estilo_substituido">Motivo</p>
<table class="comBordaSimples Tabela_Justificado_Negrito" width="100%" style="font-weight: bold;@table_estilo_substituido">
    <tr>
        <td>@motivo</td>
    </tr>
</table>
<p>
    Pelo presente instrumento de Encerramento de Vincula��o a Pessoa Jur�dica, o Usu�rio Externo indicado deixa de figurar como Respons�vel pelo cadastro da Pessoa Jur�dica acima citada no SEI-@sigla-orgao@, n�o podendo ser responsabilizado por quaisquer atos administrativos praticados em nome da mesma junto ao @sigla-orgao@ a contar da presente data.
    O referido Usu�rio Externo firma o presente instrumento de Encerramento de Vincula��o � Pessoa Jur�dica como fruto de sua vontade e, por meio deste ato, se declara ciente de que qualquer ato por ele praticado em nome da referida Pessoa Jur�dica anteriormente a este Encerramento de V�nculo preserva sua validade jur�dica e pode resultar em responsabiliza��o Administrativa, Civil ou Criminal, n�o servindo o presente Instrumento como excusa de tais responsabilidades.
    A validade deste Encerramento de Vincula��o � Pessoa Jur�dica e os n�meros do processo e dos documentos acima indicados pode ser conferidos no Portal na Internet do(a) @descricao_orgao@.
</p>
<!--<p>@cidade@, @data_por_extenso@.</p>-->