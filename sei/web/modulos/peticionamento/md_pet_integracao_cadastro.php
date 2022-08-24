<?

/**
 * TRIBUNAL REGIONAL FEDERAL DA 4� REGI�O
 *
 * 25/01/2018 - criado por Usu�rio
 *
 * Vers�o do Gerador de C�digo: 1.41.0
 *
 * Vers�o no SVN: $Id$
 */

try {
    require_once dirname(__FILE__) . '/../../SEI.php';

    session_start();

    //////////////////////////////////////////////////////////////////////////////
    //InfraDebug::getInstance()->setBolLigado(false);
    //InfraDebug::getInstance()->setBolDebugInfra(true);
    //InfraDebug::getInstance()->limpar();
    ///////////////////////////////////////////////////////////////////////pree///////

    SessaoSEI::getInstance()->validarLink();

    PaginaSEI::getInstance()->verificarSelecao('md_pet_integracao_selecionar');

    SessaoSEI::getInstance()->validarPermissao($_GET['acao']);

    PaginaSEI::getInstance()->salvarCamposPost(array('selMdPetIntegFuncionalid'));


    $objMdPetIntegracaoDTO = new MdPetIntegracaoDTO();

    //Recuperando prazo se existir
    $mes = array();
    $objMdPetIntegParametroDTO = new MdPetIntegParametroDTO();
    $objMdPetIntegParametroDTO->retTodos();
    $objMdPetIntegParametroDTO->setNumIdMdPetIntegracao($_GET['id_md_pet_integracao']);
    $objMdPetIntegParametroRN = new MdPetIntegParametroRN();
    $arrMdPetIntegParametroRN = $objMdPetIntegParametroRN->listar($objMdPetIntegParametroDTO);
    $mes = InfraArray::converterArrInfraDTO($arrMdPetIntegParametroRN, 'ValorPadrao');

    $strDesabilitar = '';

    $arrComandos = array();

    switch ($_GET['acao']) {
        case 'md_pet_integracao_cadastrar':
            $strTitulo = 'Nova Integra��o';
            $arrComandos[] = '<button type="submit" accesskey="S" name="sbmCadastrarMdPetIntegracao" value="Salvar" class="infraButton"><span class="infraTeclaAtalho">S</span>alvar</button>';
            $arrComandos[] = '<button type="button" accesskey="C" name="btnCancelar" id="btnCancelar" value="Cancelar" onclick="location.href=\'' . SessaoSEI::getInstance()->assinarLink('controlador.php?acao=' . PaginaSEI::getInstance()->getAcaoRetorno() . '&acao_origem=' . $_GET['acao']) . '\';" class="infraButton"><span class="infraTeclaAtalho">C</span>ancelar</button>';

            $objMdPetIntegracaoDTO->setNumIdMdPetIntegracao(null);
            $numIdMdPetIntegFuncionalid = PaginaSEI::getInstance()->recuperarCampo('selMdPetIntegFuncionalid');
            if ($numIdMdPetIntegFuncionalid !== '') {
                $objMdPetIntegracaoDTO->setNumIdMdPetIntegFuncionalid($numIdMdPetIntegFuncionalid);
            } else {
                $objMdPetIntegracaoDTO->setNumIdMdPetIntegFuncionalid(null);
            }

            $objMdPetIntegracaoDTO->setStrNome($_POST['txtNome']);
            $objMdPetIntegracaoDTO->setStrStaUtilizarWs($_POST['rdStaUtilizarWs']);
            if ($_POST['rdStaUtilizaWs'] == 'N') {
                $objMdPetIntegracaoDTO->setStrEnderecoWsdl('');
                $objMdPetIntegracaoDTO->setStrOperacaoWsdl('');
                $objMdPetIntegracaoDTO->setStrSinCache('');
                $objMdPetIntegracaoDTO->setStrSinAtivo('S');
            } else {
                $objMdPetIntegracaoDTO->setStrTpClienteWs($_POST['rdStaTpClienteWs']);
                $objMdPetIntegracaoDTO->setDblNuVersao($_POST['selNuVersao']);
                $objMdPetIntegracaoDTO->setStrEnderecoWsdl($_POST['txtEnderecoWsdl']);
                $objMdPetIntegracaoDTO->setStrOperacaoWsdl($_POST['selOperacaoWsdl']);
                $objMdPetIntegracaoDTO->setStrSinCache('');
                $objMdPetIntegracaoDTO->setStrSinAtivo('S');
            }


            if (isset($_POST['sbmCadastrarMdPetIntegracao'])) {
                try {

                    $objMdPetIntegracaoRN = new MdPetIntegracaoRN();
                    $objMdPetIntegracaoDTO->setStrSinCache(PaginaSEI::getInstance()->getCheckbox($_POST['chkSinCache']));
                    $objMdPetIntegracaoDTO->setStrSinTpLogradouro(PaginaSEI::getInstance()->getCheckbox($_POST['chkSinTipo']));
                    $objMdPetIntegracaoDTO->setStrSinNuLogradouro(PaginaSEI::getInstance()->getCheckbox($_POST['chkSinNumero']));
                    $objMdPetIntegracaoDTO->setStrSinCompLogradouro(PaginaSEI::getInstance()->getCheckbox($_POST['chkSinComplemento']));
                    $objMdPetIntegracaoDTO = $objMdPetIntegracaoRN->cadastrarCompleto($objMdPetIntegracaoDTO);

                    PaginaSEI::getInstance()->adicionarMensagem('Integra��o "' . $objMdPetIntegracaoDTO->getStrNome() . '" cadastrada com sucesso.');
                    header('Location: ' . SessaoSEI::getInstance()->assinarLink('controlador.php?acao=' . PaginaSEI::getInstance()->getAcaoRetorno() . '&acao_origem=' . $_GET['acao'] . '&id_md_pet_integracao=' . $objMdPetIntegracaoDTO->getNumIdMdPetIntegracao() . PaginaSEI::getInstance()->montarAncora($objMdPetIntegracaoDTO->getNumIdMdPetIntegracao())));
                    die;
                } catch (Exception $e) {
                    PaginaSEI::getInstance()->processarExcecao($e);
                }
            }
            break;

        case 'md_pet_integracao_alterar':

            $strTitulo = 'Alterar Integra��o';
            $arrComandos[] = '<button type="submit" accesskey="S" name="sbmAlterarMdPetIntegracao" value="Salvar" class="infraButton"><span class="infraTeclaAtalho">S</span>alvar</button>';
            $strDesabilitar = 'disabled="disabled"';

            if (isset($_GET['id_md_pet_integracao'])) {
                $objMdPetIntegracaoDTO->setNumIdMdPetIntegracao($_GET['id_md_pet_integracao']);
                $objMdPetIntegracaoDTO->setBolExclusaoLogica(false);
                $objMdPetIntegracaoDTO->retTodos();
                $objMdPetIntegracaoRN = new MdPetIntegracaoRN();
                $objMdPetIntegracaoDTO = $objMdPetIntegracaoRN->consultar($objMdPetIntegracaoDTO);
                if ($objMdPetIntegracaoDTO == null) {
                    throw new InfraException("Registro n�o encontrado.");
                }
            } else {
                $objMdPetIntegracaoDTO->setNumIdMdPetIntegracao($_POST['hdnIdMdPetIntegracao']);
                $objMdPetIntegracaoDTO->setNumIdMdPetIntegFuncionalid($_POST['selMdPetIntegFuncionalid']);
                $objMdPetIntegracaoDTO->setStrNome($_POST['txtNome']);
                $objMdPetIntegracaoDTO->setStrStaUtilizarWs($_POST['rdStaUtilizarWs']);
                if ($_POST['rdStaUtilizarWs'] == 'N') {
                    $objMdPetIntegracaoDTO->setStrEnderecoWsdl('');
                    $objMdPetIntegracaoDTO->setStrOperacaoWsdl('');
                    $objMdPetIntegracaoDTO->setStrSinCache('');
                    $objMdPetIntegracaoDTO->setStrSinAtivo('S');
                } else {
                    $objMdPetIntegracaoDTO->setStrTpClienteWs($_POST['rdStaTpClienteWs']);
                    $objMdPetIntegracaoDTO->setDblNuVersao($_POST['selNuVersao']);
                    $objMdPetIntegracaoDTO->setStrEnderecoWsdl($_POST['txtEnderecoWsdl']);
                    $objMdPetIntegracaoDTO->setStrOperacaoWsdl($_POST['selOperacaoWsdl']);
                    $objMdPetIntegracaoDTO->setStrSinCache(PaginaSEI::getInstance()->getCheckbox($_POST['chkSinCache']));
                    $objMdPetIntegracaoDTO->setStrSinTpLogradouro(PaginaSEI::getInstance()->getCheckbox($_POST['chkSinTipo']));
                    $objMdPetIntegracaoDTO->setStrSinNuLogradouro(PaginaSEI::getInstance()->getCheckbox($_POST['chkSinNumero']));
                    $objMdPetIntegracaoDTO->setStrSinCompLogradouro(PaginaSEI::getInstance()->getCheckbox($_POST['chkSinComplemento']));
                    $objMdPetIntegracaoDTO->setStrSinAtivo('S');
                }
            }

            $arrComandos[] = '<button type="button" accesskey="C" name="btnCancelar" id="btnCancelar" value="Cancelar" onclick="location.href=\'' . SessaoSEI::getInstance()->assinarLink('controlador.php?acao=' . PaginaSEI::getInstance()->getAcaoRetorno() . '&acao_origem=' . $_GET['acao'] . PaginaSEI::getInstance()->montarAncora($objMdPetIntegracaoDTO->getNumIdMdPetIntegracao())) . '\';" class="infraButton"><span class="infraTeclaAtalho">C</span>ancelar</button>';

            if (isset($_POST['sbmAlterarMdPetIntegracao'])) {

                try {
                    $objMdPetIntegracaoRN = new MdPetIntegracaoRN();
                    $objMdPetIntegracaoRN->alterarCompleto($objMdPetIntegracaoDTO);
                    PaginaSEI::getInstance()->adicionarMensagem('Integra��o "' . $objMdPetIntegracaoDTO->getStrNome() . '" alterada com sucesso.');
                    header('Location: ' . SessaoSEI::getInstance()->assinarLink('controlador.php?acao=' . PaginaSEI::getInstance()->getAcaoRetorno() . '&acao_origem=' . $_GET['acao'] . PaginaSEI::getInstance()->montarAncora($objMdPetIntegracaoDTO->getNumIdMdPetIntegracao())));
                    die;
                } catch (Exception $e) {
                    PaginaSEI::getInstance()->processarExcecao($e);
                }
            }
            break;

        case 'md_pet_integracao_consultar':
            $strTitulo = 'Consultar Integra��o';
            $arrComandos[] = '<button type="button" accesskey="c" name="btnFechar" value="Fechar" onclick="location.href=\'' . SessaoSEI::getInstance()->assinarLink('controlador.php?acao=' . PaginaSEI::getInstance()->getAcaoRetorno() . '&acao_origem=' . $_GET['acao'] . PaginaSEI::getInstance()->montarAncora($_GET['id_md_pet_integracao'])) . '\';" class="infraButton">Fe<span class="infraTeclaAtalho">c</span>har</button>';
            $objMdPetIntegracaoDTO->setNumIdMdPetIntegracao($_GET['id_md_pet_integracao']);
            $objMdPetIntegracaoDTO->setBolExclusaoLogica(false);
            $objMdPetIntegracaoDTO->retTodos();
            $objMdPetIntegracaoRN = new MdPetIntegracaoRN();
            $objMdPetIntegracaoDTO = $objMdPetIntegracaoRN->consultar($objMdPetIntegracaoDTO);
            if ($objMdPetIntegracaoDTO === null) {
                throw new InfraException("Registro n�o encontrado.");
            }
            break;

        default:
            throw new InfraException("A��o '" . $_GET['acao'] . "' n�o reconhecida.");
    }
    $numNuVersao = 1.2;
    $tpLogradouro = '';
    $nuLogradouro = '';
    $compLogradouro = '';
    if ($objMdPetIntegracaoDTO) {
        if ($objMdPetIntegracaoDTO->getStrStaUtilizarWs() == 'N') {
            $staUtilizarWsNao = "checked='checked'";
            $staUtilizarWsSim = "";
        } elseif ($objMdPetIntegracaoDTO->getStrStaUtilizarWs() == 'S') {
            $staUtilizarWsNao = "";
            $staUtilizarWsSim = "checked='checked'";
        }

        if ($objMdPetIntegracaoDTO->getStrTpClienteWs() == 'S') {
            $staTpClienteWs = "checked='checked'";
        }

        $numNuVersao = $objMdPetIntegracaoDTO->getDblNuVersao();

        if ($objMdPetIntegracaoDTO->isSetStrSinTpLogradouro()) {
            $tpLogradouro = $objMdPetIntegracaoDTO->getStrSinTpLogradouro() == 'S' ? $objMdPetIntegracaoDTO->getStrSinTpLogradouro() : '';
        } else {
            $objMdPetIntegracaoDTO->setStrSinTpLogradouro('N');
        }

        if ($objMdPetIntegracaoDTO->isSetStrSinNuLogradouro()) {
            $nuLogradouro = $objMdPetIntegracaoDTO->getStrSinNuLogradouro() == 'S' ? $objMdPetIntegracaoDTO->getStrSinNuLogradouro() : '';
        } else {
            $objMdPetIntegracaoDTO->setStrSinNuLogradouro('N');
        }

        if ($objMdPetIntegracaoDTO->isSetStrSinCompLogradouro()) {
            $compLogradouro = $objMdPetIntegracaoDTO->getStrSinCompLogradouro() == 'S' ? $objMdPetIntegracaoDTO->getStrSinCompLogradouro() : '';
        } else {
            $objMdPetIntegracaoDTO->setStrSinCompLogradouro('N');
        }

        $objMdPetIntegParametroDTO = new MdPetIntegParametroDTO;
        $objMdPetIntegParametroDTO->setNumIdMdPetIntegracao($objMdPetIntegracaoDTO->getNumIdMdPetIntegracao());
        //        $objMdPetIntegParametroDTO->setStrTpParametro('D');
        $objMdPetIntegParametroDTO->setBolExclusaoLogica(false);
        $objMdPetIntegParametroDTO->retTodos();
        $objMdPetIntegParametroRN = new MdPetIntegParametroRN();
        $arrObjMdPetIntegParametroDTO = $objMdPetIntegParametroRN->listar($objMdPetIntegParametroDTO);
        foreach ($arrObjMdPetIntegParametroDTO as $item) {
            if (trim($item->getStrNomeCampo()) == 'PrazoExpiracao') {
                $strItensSelCachePrazoExpiracao = $item->getStrNome();
                $strItensSelCacheDataArmazenamento = $item->getStrNome();
            }
            if (trim($item->getStrNome()) == 'cnpjEmpresa' && $item->getStrTpParametro() == 'E') {
                $strItensSelCnpjEmpresa = $item->getStrNomeCampo();
            }
        }
        $objMdPetIntegParametroDTO = new MdPetIntegParametroDTO;
        $objMdPetIntegParametroDTO->setNumIdMdPetIntegracao($objMdPetIntegracaoDTO->getNumIdMdPetIntegracao());
        //        $objMdPetIntegParametroDTO->setStrTpParametro('P');
        $objMdPetIntegParametroDTO->setBolExclusaoLogica(false);
        $objMdPetIntegParametroDTO->retTodos();
        $objMdPetIntegParametroRN = new MdPetIntegParametroRN();
        $arrObjMdPetIntegParametroDTO = $objMdPetIntegParametroRN->listar($objMdPetIntegParametroDTO);
        $arrParametrosCadastrados = array();
        if (!empty($arrObjMdPetIntegParametroDTO)) {
            foreach ($arrObjMdPetIntegParametroDTO as $item) {
                $arrParametrosCadastrados[] = array(
                    'nome' => $item->getStrNome(),
                    'campo_nome' => $item->getStrNomeCampo(),
                    'valor' => $item->getStrValorPadrao()
                );
                if (trim($item->getStrNomeCampo()) == 'PrazoExpiracao') {
                    $strItensSelCachePrazoExpiracao = $item->getStrNome();
                    $strItensSelCacheDataArmazenamento = $item->getStrNome();
                }
            }
        }

        $strItensSelMdPetIntegFuncionalid = MdPetIntegFuncionalidINT::montarSelectNomeNaoUtilizado('null', '&nbsp;', $objMdPetIntegracaoDTO->getNumIdMdPetIntegFuncionalid(), $objMdPetIntegracaoDTO->getNumIdMdPetIntegracao());
    } else {
        $strItensSelMdPetIntegFuncionalid = MdPetIntegFuncionalidINT::montarSelectNomeNaoUtilizado('null', '&nbsp;', $objMdPetIntegracaoDTO->getNumIdMdPetIntegFuncionalid());
        $staUtilizarWsNao = "";
        $staUtilizarWsSim = "";
        $staTpClienteWs = "";
    }

    $arrParametrosEntradas = array(
        'cnpjEmpresa' => 'CNPJ da Pessoa Jur�dica',
        'identificacaoOrigem' => 'Identifica��o Origem',
        'periodoCache' => 'Per�odo de Expira��o do Cache'
    );

    $arrParametrosSaida = array(
        'cnpjEmpresa' => 'CNPJ da Pessoa Jur�dica',
        'razaoSocial' => 'Raz�o Social',
        'codSituacaoCadastral' => 'C�digo da Situa��o Cadastral',
        'descSituacaoCadastral' => 'Descri��o da Situa��o Cadastral',
        'dtUltAltSituacaoCadastral' => 'Data da �ltima Altera��o da Situa��o Cadastral',
        'tpLogradouro' => 'Tipo Logradouro do Endere�o',
        'logradouro' => 'Logradouro do Endere�o',
        'numero' => 'N�mero do Endere�o',
        'complemento' => 'Complemento do Endere�o',
        'cep' => 'CEP do Endere�o',
        'bairro' => 'Bairro do Endere�o',
        'codIbgeMunicipio' => 'C�digo IBGE do Munic�pio do Endere�o',
        'cpfRespLegal' => 'CPF do Respons�vel Legal',
        'nomeRespLegal' => 'Nome do Respons�vel Legal',
    );

    $strSumarioTabelaEntrada = 'Tabela de configura��o dos dados de entrada do web-service.';
    $strCaptionTabelaEntrada = 'Dados de entrada';

    $strResultadoParamEntrada .= '<table width="100%" id="tableParametroEntrada" class="infraTable" summary="' . $strSumarioTabelaEntrada . '">' . "\n";
    $strResultadoParamEntrada .= '<tr>';

    $strResultadoParamEntrada .= '<th class="infraTh" width="50%">&nbsp;Campo de Origem no SEI&nbsp;</th>' . "\n";
    $strResultadoParamEntrada .= '<th class="infraTh" width="50%">&nbsp;Dados de Entrada no Webservice&nbsp;</th>' . "\n";
    $strResultadoParamEntrada .= '</tr>' . "\n";
    $strCssTr = '';
    $i = 0;
    foreach ($arrParametrosEntradas as $chave => $itemParametroEntrada) {

        $idLinha = $i;
        $strCssTr = '<tr id="paramEntradaTable_' . $chave . '" class="infraTrClara">';


        $strResultadoParamEntrada .= $strCssTr;
        $strResultadoParamEntrada .= "<td id='campo_{$chave}'  style='padding: 8px;' >";
        $strResultadoParamEntrada .= "<input type='hidden' name='hdnArrayDadosEntrada[" . $chave . "]' value='" . $itemParametroEntrada . "' />";
        $strResultadoParamEntrada .= PaginaSEI::tratarHTML($itemParametroEntrada);
        $strResultadoParamEntrada .= "</td>";
        $strResultadoParamEntrada .= "<td align='left'  style='padding: 8px;' >";
        if ($chave == 'periodoCache') {
            $strResultadoParamEntrada .= "<select id='selCachePrazoExpiracao' style='width:52%; float: left' name='selCachePrazoExpiracao' class='infraSelect form-control' tabindex='" . PaginaSEI::getInstance()->getProxTabDados() . "'></select> <img src='" . PaginaSEI::getInstance()->getDiretorioSvgGlobal() . "/ajuda.svg' name='ajuda' " . PaginaSEI::montarTitleTooltip("Selecione o campo de entrada da Opera��o que define o Prazo de Expira��o do Cache das informa��es da Receita Federal.", 'Ajuda') . " alt='Ajuda' style='margin-left: 0% !important; margin-right: 3%' class='infraImgModulo' />";
            $strResultadoParamEntrada .= "<input type='text' id='txtPrazo' style='width:25%;' name='txtPrazo' class='infraText' value='" . $mes[2] . "' onkeypress='return infraMascaraNumero(this,event,2);' maxlength='30' tabindex='" . PaginaSEI::getInstance()->getProxTabDados() . "'/><img src='" . PaginaSEI::getInstance()->getDiretorioSvgGlobal() . "/ajuda.svg' name='ajuda' " . PaginaSEI::montarTitleTooltip('Defina a quantidade de meses que o SEI deve considerar as informa��es em cache atualizadas. Se atribu�do valor igual a 0 (zero), o SEI ir� ignorar o cache e obter� as informa��es direto da Receita Federal.', 'Ajuda') . " alt='Ajuda' class='infraImgModulo' />";
        } else {
            $strResultadoParamEntrada .= "<select id='nomeFuncionalDadosEntrada_$chave' class='infraSelect selParametrosS  form-control' name='nomeFuncionalDadosEntrada[$chave]'></select>";
        }

        $strResultadoParamEntrada .= '</td>';

        $strResultadoParamEntrada .= '</tr>' . "\n";
        $i++;
    }
    $strResultadoParamEntrada .= '</table>';

    $strSumarioTabelaSaida = 'Tabela de configura��o dos dados de Saida do web-service.';
    $strCaptionTabelaSaida = 'Dados de Saida';

    $strResultadoParamSaida .= '<table width="100%" id="tableParametroSaida" class="infraTable" summary="' . $strSumarioTabelaSaida . '">' . "\n";
    $strResultadoParamSaida .= '<tr>';

    $strResultadoParamSaida .= '<th class="infraTh" width="50%">&nbsp;Campo de Origem no SEI&nbsp;</th>' . "\n";
    $strResultadoParamSaida .= '<th class="infraTh" width="50%">&nbsp;Dados de Saida no Webservice&nbsp;</th>' . "\n";
    $strResultadoParamSaida .= '</tr>' . "\n";
    $strCssTr = '';
    $i = 0;
    foreach ($arrParametrosSaida as $chave => $itemParametroSaida) {


        switch ($chave) {
            case 'tpLogradouro':
                $mostrar = $tpLogradouro == "" ? "display: none" : "";
                break;
            case 'numero':
                $mostrar = $nuLogradouro == "" ? "display: none" : "";
                break;
            case 'complemento':
                $mostrar = $compLogradouro == "" ? "display: none" : "";
                break;
            default:
                $mostrar = "";
        }


        $idLinha = $i;
        $strCssTr = '<tr id="paramSaidaTable_' . $chave . '" class="infraTrClara" style="' . $mostrar . '">';


        $strResultadoParamSaida .= $strCssTr;
        $strResultadoParamSaida .= "<td id='campo_{$chave}' style='padding: 8px;' >";
        $strResultadoParamSaida .= "<input type='hidden' name='hdnArrayDadosSaida[" . $chave . "]' value='" . $itemParametroSaida . "' />";
        $strResultadoParamSaida .= PaginaSEI::tratarHTML($itemParametroSaida);
        $strResultadoParamSaida .= "</td>";
        $strResultadoParamSaida .= "<td align='left' style='padding: 8px;' ><select id='nomeFuncionalDadosSaida_$chave' class='infraSelect selParametrosS  form-control' name='nomeFuncionalDadosSaida[$chave]'></select></td>";

        $strResultadoParamSaida .= '</tr>' . "\n";
        $i++;
    }
    $strResultadoParamSaida .= '</table>';
} catch (Exception $e) {
    PaginaSEI::getInstance()->processarExcecao($e);
}

PaginaSEI::getInstance()->montarDocType();
PaginaSEI::getInstance()->abrirHtml();
PaginaSEI::getInstance()->abrirHead();
PaginaSEI::getInstance()->montarMeta();
PaginaSEI::getInstance()->montarTitle(PaginaSEI::getInstance()->getStrNomeSistema() . ' - ' . $strTitulo);
PaginaSEI::getInstance()->montarStyle();
PaginaSEI::getInstance()->abrirStyle();
PaginaSEI::getInstance()->fecharStyle();
PaginaSEI::getInstance()->montarJavaScript();
require_once "md_pet_integracao_cadastro_css.php";
PaginaSEI::getInstance()->fecharHead();
PaginaSEI::getInstance()->abrirBody($strTitulo, 'onload="inicializar();"');
?>
<form id="frmMdPetIntegracaoCadastro" method="post" onsubmit="return OnSubmitForm();" action="<?= SessaoSEI::getInstance()->assinarLink('controlador.php?acao=' . $_GET['acao'] . '&acao_origem=' . $_GET['acao']) ?>">
    <?
    PaginaSEI::getInstance()->montarBarraComandosSuperior($arrComandos);
    PaginaSEI::getInstance()->abrirAreaDados('auto');
    ?>
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-10 e col-xl-8">
            <div class="form-group">
                <label class="infraLabelObrigatorio" for="txtNome" id="lblNome">Nome:</label>
                <input type="text" id="txtNome" name="txtNome" class="infraText form-control" value="<?= PaginaSEI::tratarHTML($objMdPetIntegracaoDTO->getStrNome()); ?>" onkeypress="return infraMascaraTexto(this,event,30);" maxlength="30" tabindex="<?= PaginaSEI::getInstance()->getProxTabDados() ?>" />
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-10 col-xl-8">
            <div class="form-group">
                <label class="infraLabelObrigatorio" for="selMdPetIntegFuncionalid" id="lblMdPetIntegFuncionalid">Funcionalidade:</label>
                <select id="selMdPetIntegFuncionalid" name="selMdPetIntegFuncionalid" class="infraSelect form-control" tabindex="<?= PaginaSEI::getInstance()->getProxTabDados() ?>">
                    <?= $strItensSelMdPetIntegFuncionalid ?>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-10 col-xl-8">
            <fieldset class="infraFieldset fieldSetIntegracao form-control">
                <legend class="infraLegend">&nbsp;Indica��o de Integra��o com a Receita Federal&nbsp; <img id="imgAjuda2" src="<?= PaginaSEI::getInstance()->getDiretorioImagensGlobal() ?>/ajuda.gif" name="ajuda" <?= PaginaSEI::montarTitleTooltip('� extremamente recomendado que se utilize Integra��o com a base de dados da Receita Federal para validar se o CPF do Usu�rio Externo que est� formalizando a vincula��o como Respons�vel Legal de Pessoa Jur�dica � de fato do Respons�vel Legal pelo CNPJ constante na Receita Federal. \n \n Caso opte por ativar as funcionalidades afetas a Pessoa Jur�dica e Procura��o Eletr�nica para os Usu�rios Externos Sem Integra��o com a base da Receita Federal, os Usu�rios Externos continuar�o a declarar a responsabilidade, at� penal, sobre as informa��es prestadas, mas poder�o ocorrer contradi��o e, caso necessite, Suspens�o e Altera��o da vincula��o podem ser efetivadas pelo menu Administra��o > Peticionamento Eletr�nico > Vincula��es e Procura��es Eletr�nicas.', 'Ajuda') ?> alt="Ajuda" class="infraImgFielset" /></legend>
                <div class="form-group">
                    <input <?php echo $staUtilizarWsNao; ?> type="radio" name="rdStaUtilizarWs" class="infraRadio" id="rdStaUtilizarWsNao" value="N" onclick="habilitaWs()">
                    <label for="rdStaUtilizarWsNao" id="lblStaUtilizarWsNao" class="infraLabelRadio">Sem Integra��o
                        <img id="imgAjuda2" src="<?= PaginaSEI::getInstance()->getDiretorioSvgGlobal() ?>/ajuda.svg" name="ajuda" <?= PaginaSEI::montarTitleTooltip('Ao selecionar esta op��o, n�o ocorrer� qualquer valida��o se o CPF do Usu�rio Externo que est� formalizando a vincula��o como Respons�vel Legal de Pessoa Jur�dica � de fato do Respons�vel Legal pelo CNPJ constante na Receita Federal, ficando exclusivamente sob responsabilidade, at� penal, da auto declara��o efetivada pelo Usu�rio Externo e documentos que anexar no Peticionamento de formaliza��o.', 'Ajuda') ?> alt="Ajuda" class="infraImgModulo" /></label>
                    <input <?php echo $staUtilizarWsSim; ?> type="radio" name="rdStaUtilizarWs" class="infraRadio" id="rdStaUtilizarWsSim" value="S" onclick="habilitaWs()">
                    <label name="rdStaUtilizarWsSim" id="lblStaUtilizarWsSim" for="rdStaUtilizarWsSim" class="infraLabelRadio">Com Integra��o
                        <img id="imgAjuda2" src="<?= PaginaSEI::getInstance()->getDiretorioSvgGlobal() ?>/ajuda.svg" name="ajuda" <?= PaginaSEI::montarTitleTooltip('Ao selecionar esta op��o, o CPF do Usu�rio Externo que est� formalizando a vincula��o como Respons�vel Legal de Pessoa Jur�dica ser� validado por integra��o configurada abaixo se � de fato do Respons�vel Legal pelo CNPJ constante na Receita Federal. \n \n Se n�o ocorrer a valida��o o Usu�rio Externo n�o poder� prosseguir com o Peticionamento inicial de Respons�vel Legal de Pessoa Jur�dica.') ?> alt="Ajuda" class="infraImgModulo" /></label>
                </div>
            </fieldset>
        </div>
    </div>
    <div class="row" id="blcTextoSemWs" style="display: none;">
        <div class="col-sm-12 col-md-12 col-lg-10 col-xl-8">
            <p style="font-size: 12px; padding-top: 10px">
                <span STYLE="color: red; font-weight: bold">ATEN�AO</span>: � extremamente recomendado que se
                utilize Integra��o com a base de dados da Receita Federal para validar se o CPF do Usu�rio Externo
                que est� formalizando a vincula��o como Respons�vel Legal de Pessoa Jur�dica � de fato do
                Respons�vel Legal pelo CNPJ constante na Receita Federal.<br />
                <br />
                Caso opte por ativar as funcionalidades afetas a Pessoa Jur�dica e Procura��o Eletr�nica para os
                Usu�rios Externos Sem Integra��o com a base da Receita Federal, n�o ocorrer� qualquer valida��o se o
                CPF do Usu�rio Externo que est� formalizando a vincula��o como Respons�vel Legal de Pessoa Jur�dica
                � de fato do Respons�vel Legal pelo CNPJ constante na Receita Federal, ficando exclusivamente sob
                responsabilidade, at� penal, da auto declara��o efetivada pelo Usu�rio Externo e documentos que
                anexar no Peticionamento de formaliza��o.<br />
                <br />
                Ao selecionar a op��o Sem Integra��o, contradi��es podem ocorrer e, caso necessite, Suspens�o e
                Altera��o da vincula��o podem ser efetivadas pelo menu Administra��o > Peticionamento Eletr�nico >
                Vincula��es e Procura��es Eletr�nicas.
            </p>
        </div>
    </div>
    <div class="row" id="blcTipoClienteWs" style="display: none;">
        <div class="col-sm-6 col-md-6 col-lg-5 col-xl-4">
            <div class="form-group">
                <label id="lblStaTpClienteWs" for="txtStaTpClienteWs" class="infraLabelObrigatorio">Tipo Cliente
                    WS:</label><br />
                <input <?php echo $staTpClienteWs; ?> type="radio" name="rdStaTpClienteWs" id="rdStaTpClienteWsSoap" class="infraRadio" value="S">
                <label for="rdStaTpClienteWsSoap" id="lblStaTpClienteWsSoap" class="infraLabelRadio">SOAP</label>
            </div>
        </div>
        <div class="col-sm-6 col-md-6 col-lg-5 col-xl-4">
            <div class="form-group">
                <label id="lblNuVersao" for="txtNuVersao" class="infraLabelObrigatorio">Vers�o SOAP:</label>
                <select id="selNuVersao" name="selNuVersao" class="infraSelect form-control" tabindex="<?= PaginaSEI::getInstance()->getProxTabDados() ?>">
                    <option value="1.1" <?php echo ($numNuVersao == "1,1") ? 'selected' : ''; ?>>1.1</option>
                    <option value="1.2" <?php echo ($numNuVersao == "1,2") ? 'selected' : ''; ?>>1.2</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row" id="blcEnderecoWs" style="display: none;">
        <div class="col-sm-12 col-md-12 col-lg-10 col-xl-8">
            <div class="form-group">
                <label id="lblEnderecoWsdl" for="txtEnderecoWsdl" class="infraLabelObrigatorio">Endere�o do
                    Webservice:</label>
                <div class="input-group mb-3">
                    <input type="text" id="txtEnderecoWsdl" name="txtEnderecoWsdl" class="infraText form-control" value="<?= PaginaSEI::tratarHTML($objMdPetIntegracaoDTO->getStrEnderecoWsdl()); ?>" onkeypress="return infraMascaraTexto(this,event,100);" maxlength="100" tabindex="<?= PaginaSEI::getInstance()->getProxTabDados() ?>" />
                    <button type="button" accesskey="V" name="btnValidar" id="btnValidar" value="Validar" class="infraButton" onclick="validarWsdl();"><span class="infraTeclaAtalho">V</span>alidar
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="row" id="blcOperacaoWs" style="display: none;">
        <div class="col-sm-12 col-md-12 col-lg-10 col-xl-8">
            <div class="form-group">
                <label id="lblOperacaoWsdl" for="selOperacaoWsdl" class="infraLabelObrigatorio">Opera��o:</label>
                <select id="selOperacaoWsdl" name="selOperacaoWsdl" onchange="operacaoSelecionar()" class="infraSelect form-control" tabindex="<?= PaginaSEI::getInstance()->getProxTabDados() ?>"></select>
                <select id="selParametrosE" name="selParametrosE[]" multiple style="left:400px;display:none"></select>
                <select id="selParametrosS" name="selParametrosS[]" multiple style="left:500px;display:none"></select>
            </div>
        </div>
    </div>
    <div class="row" id="blcCacheWs" style="display: none;">
        <div class="col-sm-12 col-md-12 col-lg-10 col-xl-8">
            <div class="form-group">
                <input type="checkbox" id="chkSinCache" name="chkSinCache" onchange="cacheMarcaDesmarca(this);" class="infraCheckbox" <?= PaginaSEI::getInstance()->setCheckbox($objMdPetIntegracaoDTO->getStrSinCache()) ?> tabindex="<?= PaginaSEI::getInstance()->getProxTabDados() ?>" />
                <label id="lblSinCache" for="chkSinCache" class="infraLabelCheckbox">Marque caso seu Webservice tenha
                    controle de expira��o de cache</label>
                <img src="<?= PaginaSEI::getInstance()->getDiretorioSvgGlobal() ?>/ajuda.svg" name="ajuda" <?= PaginaSEI::montarTitleTooltip('Marque caso a opera��o selecionada acima utilize controle de expira��o de cache das informa��es recuperadas da Receita Federal.') ?>alt="Ajuda" class="infraImgModulo" />
            </div>
            <div class="form-group">
                <input type="checkbox" id="chkSinTipo" name="chkSinTipo" onchange="tipoMarcaDesmarca(this);" class="infraCheckbox" <?= PaginaSEI::getInstance()->setCheckbox($objMdPetIntegracaoDTO->getStrSinTpLogradouro()) ?> tabindex="<?= PaginaSEI::getInstance()->getProxTabDados() ?>" />
                <label id="lblSinTipo" for="chkSinTipo" class="infraLabelCheckbox">Marque caso seu Webservice tenha o
                    Tipo do Logradouro separado do pr�prio Logradouro</label>
                <img src="<?= PaginaSEI::getInstance()->getDiretorioSvgGlobal() ?>/ajuda.svg" name="ajuda" <?= PaginaSEI::montarTitleTooltip('Ao marcar esta op��o, o Tipo de Logradouro ser� agrupado com o Logradouro. \n \nIsso � v�lido somente para Opera��es que possuem em sua estrutura as duas informa��es separadamente.') ?>alt="Ajuda" class="infraImgModulo" />
            </div>
            <div class="form-group">
                <input type="checkbox" id="chkSinNumero" name="chkSinNumero" onchange="numeroMarcaDesmarca(this);" class="infraCheckbox" <?= PaginaSEI::getInstance()->setCheckbox($objMdPetIntegracaoDTO->getStrSinNuLogradouro()) ?> tabindex="<?= PaginaSEI::getInstance()->getProxTabDados() ?>" />
                <label id="lblSinNumero" for="chkSinNumero" class="infraLabelCheckbox">Marque caso seu Webservice tenha
                    o N�mero do Logradouro separado do pr�prio Logradouro</label>
                <img src="<?= PaginaSEI::getInstance()->getDiretorioSvgGlobal() ?>/ajuda.svg" name="ajuda" <?= PaginaSEI::montarTitleTooltip('Ao marcar esta op��o, o N�mero de Logradouro ser� agrupado com o Logradouro. \n \nIsso � v�lido somente para Opera��es que possuem em sua estrutura as duas informa��es separadamente.') ?>alt="Ajuda" class="infraImgModulo" />
            </div>
            <div class="form-group">
                <input type="checkbox" id="chkSinComplemento" name="chkSinComplemento" onchange="complementoMarcaDesmarca(this);" class="infraCheckbox" <?= PaginaSEI::getInstance()->setCheckbox($objMdPetIntegracaoDTO->getStrSinCompLogradouro()) ?> tabindex="<?= PaginaSEI::getInstance()->getProxTabDados() ?>" />
                <label id="lblSinComplemento" for="chkSinComplemento" class="infraLabelCheckbox">Marque caso seu
                    Webservice tenha o Complemento do Logradouro separado do pr�prio Logradouro</label>
                <img src="<?= PaginaSEI::getInstance()->getDiretorioSvgGlobal() ?>/ajuda.svg" name="ajuda" <?= PaginaSEI::montarTitleTooltip('Ao marcar esta op��o, o Complemento de Logradouro ser� agrupado com o Logradouro. \n \nIsso � v�lido somente para Opera��es que possuem em sua estrutura as duas informa��es separadamente.') ?>alt="Ajuda" class="infraImgModulo" />
            </div>
        </div>
    </div>
    <div class="row" id="blcEntradaWs" style="display: none;">
        <div class="col-sm-12 col-md-12 col-lg-10 col-xl-8">
            <?
            PaginaSEI::getInstance()->montarAreaTabela($strResultadoParamEntrada, 1);
            ?>
        </div>
    </div>
    <div class="row" id="blcSaidaWs" style="display: none;">
        <div class="col-sm-12 col-md-12 col-lg-10 col-xl-8">
            <?
            PaginaSEI::getInstance()->montarAreaTabela($strResultadoParamSaida, 1);
            ?>
        </div>
    </div>
    <div class="container" style="display: none;">


        <!-- div id="divSinCache" class="infraDivCheckbox" -->
        <fieldset style="display:none" id="fldParametrosCache" class="infraFieldset">
            <legend class="infraLegend">&nbsp;Par�metros do Cache&nbsp;</legend>
            <div class="container">
                <div class="bloco" style="display:none;">
                    <div class="form-group">
                        <label id="lblCacheDataArmazenamento" for="selCacheDataArmazenamento" class="infraLabelObrigatorio">Campo de Retorno da Data de Armazenamento: <img src="<?= PaginaSEI::getInstance()->getDiretorioSvgGlobal() ?>/ajuda.svg" name="ajuda" <?= PaginaSEI::montarTitleTooltip('Selecione o campo da Opera��o que retorna a Data de Armazenamento do cache da informa��es da Receita Federal e que foi utilizado na valida��o do per�odo de expira��o definido nos campo abaixo.', 'Ajuda') ?>alt="Ajuda" class="infraImgModulo" />
                        </label>
                        <select id="selCacheDataArmazenamento" style="width:300px;" name="selCacheDataArmazenamento" class="infraSelect form-control" tabindex="<?= PaginaSEI::getInstance()->getProxTabDados() ?>"></select>
                    </div>
                </div>

                <div class="clear">&nbsp;</div>

                <div class="bloco">
                    <label id="lblCachePrazoExpiracao" for="selCachePrazoExpiracao" class="infraLabelObrigatorio">Campo
                        de Entrada para Prazo de Expira��o do Cache:
                    </label>

                </div>

                <div class="bloco">
                    <label class="infraLabelObrigatorio" for="txtPrazo" id="lblPrazo">Par�metro de Meses de
                        Expira��o:
                    </label>

                </div>

                <div class="clear">&nbsp;</div>

                <!-- div class="bloco">
                <label id="lblQtdMes" for="txtQtdMesx" class="infraLabelObrigatorio">Quantidade de Meses:</label><br>
                <input type="text" id="txtQtdMes" name="txtQtdMes" class="infraText" size=2 value="<?= $objMdPetIntegracaoDTO->getStrNome(); ?>" onkeypress="return infraMascaraTexto(this,event,2);" maxlength="2" tabindex="<?= PaginaSEI::getInstance()->getProxTabDados() ?>" />
            </div-->
            </div>
        </fieldset>
        <!-- /div -->
    </div>
    <?
    PaginaSEI::getInstance()->fecharAreaDados();
    ?>
    <input type="hidden" id="hdnIdMdPetIntegracao" name="hdnIdMdPetIntegracao" value="<?= $objMdPetIntegracaoDTO->getNumIdMdPetIntegracao(); ?>" />
</form>
<?
require_once "md_pet_integracao_cadastro_js.php";
PaginaSEI::getInstance()->fecharBody();
PaginaSEI::getInstance()->fecharHtml();
