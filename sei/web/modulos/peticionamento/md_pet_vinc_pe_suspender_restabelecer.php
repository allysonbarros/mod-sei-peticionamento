<?
/**
 * ANATEL
 *
 * 23/06/2016 - criado por marcelo.bezerra@cast.com.br - CAST
 *
 */

try {

    require_once dirname(__FILE__) . '/../../SEI.php';

    session_start();

    //////////////////////////////////////////////////////////////////////////////
    InfraDebug::getInstance()->setBolLigado(false);
    InfraDebug::getInstance()->setBolDebugInfra(false);
    InfraDebug::getInstance()->limpar();
    //////////////////////////////////////////////////////////////////////////////

//  PaginaSEI::getInstance()->setTipoPagina(InfraPagina::$TIPO_PAGINA_SIMPLES);
    $strLinkAjaxValidacoesNumeroSEI = SessaoSEI::getInstance()->assinarLink('controlador_ajax.php?acao_ajax=md_pet_validar_num_sei');

    switch ($_GET['acao']) {

        case 'md_pet_vinc_suspender_restabelecer':

            $strTitulo = $_GET['operacao'] == 'A' ? 'Restabelecer' : 'Suspender';
            $strTitulo .= ' Respons�vel Legal';
            $strAten��o = $_GET['operacao'] == 'A' ? 'O Restabelecimento' : 'A Suspens�o';
            $janelaSelecaoPorNome = SessaoSEIExterna::getInstance()->getAtributo('janelaSelecaoPorNome');
            $strPrimeiroItemValor = 'null';
            $strPrimeiroItemDescricao = '&nbsp;';
            $strValorItemSelecionado = null;
            $strTipo = 'Cadastro';

            $operacao = isset($_GET['operacao']) ? $_GET['operacao'] : $_POST['hdnOperacao'];
            $idVinculo = isset($_GET['idVinculo']) ? $_GET['idVinculo'] : $_POST['hdnIdVinculo'];

            //Recuperar dados da Pessoa Juridica
            $objMdPetVinculoRN = new MdPetVinculoRN();
            $objMdPetVinculoDTO = new MdPetVinculoDTO();
            $objMdPetVinculoDTO->retNumIdMdPetVinculo();
            $objMdPetVinculoDTO->retDblCNPJ();
            $objMdPetVinculoDTO->retStrRazaoSocialNomeVinc();
            $objMdPetVinculoDTO->retNumIdContatoRepresentante();
            $objMdPetVinculoDTO->retStrCpfContatoRepresentante();
            $objMdPetVinculoDTO->retStrNomeContatoRepresentante();
            $objMdPetVinculoDTO->setNumIdMdPetVinculo($idVinculo);
            $objMdPetVinculoDTO->setStrTipoRepresentante(MdPetVincRepresentantRN::$PE_RESPONSAVEL_LEGAL);
            $objMdPetVinculoDTO->setStrStaResponsavelLegal('S');
            $objMdPetVinculoDTO->setDistinct(true);
            $objMdPetVinculoDTO = $objMdPetVinculoRN->consultar($objMdPetVinculoDTO);

            if (!empty($_POST)) {
            }
            break;

        default:
            throw new InfraException("A��o '" . $_GET['acao'] . "' n�o reconhecida.");
    }

} catch (Exception $e) {
    PaginaSEI::getInstance()->processarExcecao($e);
}

$hashAnexo = "";
$idAnexo = "";

PaginaSEI::getInstance()->montarDocType();
PaginaSEI::getInstance()->abrirHtml();
PaginaSEI::getInstance()->abrirHead();
PaginaSEI::getInstance()->montarMeta();
PaginaSEI::getInstance()->montarTitle(PaginaSEI::getInstance()->getStrNomeSistema() . ' - ' . $strTitulo);
PaginaSEI::getInstance()->montarStyle();
PaginaSEI::getInstance()->abrirStyle();

PaginaSEI::getInstance()->fecharStyle();
PaginaSEI::getInstance()->montarJavaScript();
PaginaSEI::getInstance()->abrirJavaScript();
PaginaSEI::getInstance()->fecharJavaScript();
PaginaSEI::getInstance()->fecharHead();
PaginaSEI::getInstance()->abrirBody($strTitulo, 'onload="inicializar();"');
?>
    <style type="text/css">
        #txtInformativo {
            font-size: 13px;
        }

        #field1 {
            height: auto;
            width: 97%;
            margin-bottom: 11px;
        }

        #field2 {
            height: auto;
            width: 97%;
            margin-bottom: 11px;
        }

        .sizeFieldset {
            height: auto;
            width: 88%;
        }

        .fieldsetClear {
            border: none !important;
        }
    </style>
<?php
$urlBaseLink = "";
$arrComandos = array();
$arrComandos[] = '<button type="button" accesskey="s" name="Salvar" value="Salvar" onclick="salvar()" class="infraButton"><span class="infraTeclaAtalho">S</span>alvar</button>';
$arrComandos[] = '<button type="button" accesskey="c" name="btnFechar" value="Fechar" onclick="location.href=\'' . SessaoSEI::getInstance()->assinarLink('controlador.php?acao=' . PaginaSEI::getInstance()->getAcaoRetorno() . '&acao_origem=' . $_GET['acao']) . '\';" class="infraButton"><span class="infraTeclaAtalho">C</span>ancelar</button>';

//$strLinkBaseFormEdicao = 'controlador_externo.php?edicaoExibir=true&acao=' . $_GET['acao'];
$strLinkBaseFormEdicao = 'controlador.php?edicaoExibir=true&acao=' . $_GET['acao'];
$strLinkEdicaHash = PaginaSEI::getInstance()->formatarXHTML(SessaoSEI::getInstance()->assinarLink($strLinkBaseFormEdicao));
?>

    <!-- Formulario usado para viabilizar fluxo de edi��o de contato -->

    <form id="frmEdicaoAuxiliar"
          name="frmEdicaoAuxiliar"
          method="post"
          action="<?= $strLinkEdicaHash ?>">

        <?php
        PaginaSEI::getInstance()->abrirAreaDados('auto');
        PaginaSEI::getInstance()->montarBarraComandosSuperior($arrComandos);
        ?>
        <br/><br/>
        <fieldset>
            <legend>ATEN��O</legend>
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-9 col-xl-9">
                    <p id=txtInformativo><?
                        if ($_GET['operacao'] == MdPetVincRepresentantRN::$RP_ATIVO){
                        ?>
                        O Restabelecimento do Respons�vel Legal deve ser motivado em documento espec�fico, a ser
                        indicado no
                        campo abaixo. Todas as Procura��es Eletr�nicas geradas ser�o restabelecidas, o Usu�rio Externo
                        ser�
                        notificado e este ato constar� no processo referente � Pessoa Jur�dica.</p>
                    <? } else { ?>
                        A Suspens�o do Respons�vel Legal deve ser motivado em documento espec�fico, a ser indicado no campo abaixo. Todas as Procura��es Eletr�nicas geradas pelo Respons�vel Legal ser�o suspensas, o Usu�rio Externo ser� notificado e este ato constar� no processo referente � Pessoa Jur�dica. A suspens�o como Respons�vel Legal n�o impede o Usu�rio Externo de peticionar em pr�prio nome.</p>
                    <? } ?>
                </div>
            </div>

        </fieldset>
        <div class="row">
            <div class="col-sm-12 col-md-5 col-lg-4 col-xl-3">
                <label id="lblCnpj" class="infraLabelObrigatorio">CNPJ:</label><br/>
                <input type="text" id="txtCnpj" name="txtCnpj"
                       class="infraText form-control"
                       disabled="disabled"
                       value="<?= PaginaSEI::tratarHTML(InfraUtil::formatarCnpj($objMdPetVinculoDTO->getDblCNPJ())) ?>"
                       onkeypress="return infraMascaraTexto(this,event,250);" maxlength="250"
                       tabindex="<?= PaginaSEI::getInstance()->getProxTabDados() ?>"/>
            </div>
            <div class="col-sm-12 col-md-7 col-lg-6 col-xl-6">
                <label id="lblRazaoSocial" class="infraLabelObrigatorio">Raz�o Social:</label><br/>
                <input type="text" id="txtRazaoSocial" name="txtRazaoSocial"
                       class="infraText form-control"
                       disabled="disabled"
                       value="<?= PaginaSEI::tratarHTML($objMdPetVinculoDTO->getStrRazaoSocialNomeVinc()) ?>"
                       onkeypress="return infraMascaraTexto(this,event,250);" maxlength="250"
                       tabindex="<?= PaginaSEI::getInstance()->getProxTabDados() ?>"/>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-5 col-lg-4 col-xl-3">
                <label id="lblCnpj" class="infraLabelObrigatorio">CPF do Respons�vel Legal:</label><br/>
                <input type="text" id="txtCpf" name="txtCpf"
                       class="infraText form-control"
                       disabled="disabled"
                       value="<?= PaginaSEI::tratarHTML(InfraUtil::formatarCpf($objMdPetVinculoDTO->getStrCpfContatoRepresentante())) ?>"
                       onkeypress="return infraMascaraTexto(this,event,250);" maxlength="250"
                       tabindex="<?= PaginaSEI::getInstance()->getProxTabDados() ?>"/>

            </div>
            <div class="col-sm-12 col-md-7 col-lg-6 col-xl-6">
                <label id="txtRazaoSocial" class="infraLabelObrigatorio">Nome do Respons�vel Legal:</label><br/>
                <input type="text" id="txtNome" name="txtNome"
                       disabled="disabled"
                       class="infraText form-control"
                       value="<?= PaginaSEI::tratarHTML($objMdPetVinculoDTO->getStrNomeContatoRepresentante()) ?>"
                       onkeypress="return infraMascaraTexto(this,event,250);" maxlength="250"
                       tabindex="<?= PaginaSEI::getInstance()->getProxTabDados() ?>"/>

            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-5 col-lg-4 col-xl-3">
                <label class="infraLabelObrigatorio">N�mero
                    SEI da Justificativa: </label><br/>
                <div class="input-group mb-3">
                    <input type="text" id="txtNumeroSei" name="txtNumeroSei" style="width: 70%"
                           class="infraText form-control"
                           value=""
                           onkeypress="return infraMascaraTexto(this,event,250);" maxlength="10"
                           tabindex="<?= PaginaSEI::getInstance()->getProxTabDados() ?>"/>
                    <button type="button" accesskey="V" style="margin-left: 5px"
                            id="btnValidar" onclick="controlarNumeroSEI();" class="infraButton">
                        <span class="infraTeclaAtalho">V</span>alidar
                    </button>
                </div>
            </div>
            <div class="col-sm-12 col-md-7 col-lg-6 col-xl-6">
                <label class="infraLabelObrigatorio"></label><br/>
                <input type="text" id="txtTipo" name="txtTipo" class="infraText form-control"
                       readonly="readonly"
                       tabindex="<?= PaginaSEI::getInstance()->getProxTabDados() ?>" value="<?= $txtTipo ?>"/>
            </div>
        </div>
        <input type="hidden" name="hdnIdVinculo" id="hdnIdVinculo" value="<?php echo $idVinculo ?>"/>
        <input type="hidden" name="hdnOperacao" id="hdnOperacao" value="<?php echo $operacao ?>"/>
        <input type="hidden" name="hdnIdContatoNovo" id="hdnIdContatoNovo" value=""/>
        <input type="hidden" name="hdnIdContato" id="hdnIdContato"
               value="<?= $objMdPetVinculoDTO->getNumIdContatoRepresentante() ?>"/>
        <input type="hidden" name="hdnIdDocumento" id="hdnIdDocumento" value=""/>
    </form>

<?php
PaginaSEI::getInstance()->montarBarraComandosInferior($arrComandos);
//PaginaSEI::getInstance()->montarAreaDebug();
PaginaSEI::getInstance()->fecharAreaDados();
require_once 'md_pet_vinc_pe_suspender_restabelecer_js.php';
PaginaSEI::getInstance()->fecharBody();
PaginaSEI::getInstance()->fecharHtml();
?>
