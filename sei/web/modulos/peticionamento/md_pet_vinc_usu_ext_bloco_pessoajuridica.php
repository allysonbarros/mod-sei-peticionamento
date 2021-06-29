<fieldset id="fieldsetPessoaJuridicaConsulta" class="infraFieldset form-control sizeFieldset" style="width: auto;">
    <legend class="infraLegend">&nbsp; Registro da Pessoa Jur�dica &nbsp;</legend>
    <form name=frmCNPJ id=frmCNPJ action='' method=POST><input type="hidden" name="hdnNumeroCnpj"
                                                               id="hdnNumeroCnpj"></input></form>
    <div class="infraAreaDados">
        <?php $idDiv = $stWebService ? 'blcPj' : 'blcPjSemWs' ?>
        <div class="row">
            <div class="col-sm-12 col-md-4 col-lg-3 col-xl-2">
                <div id="<?php echo $idDiv ?>">
                    <label class="infraLabelObrigatorio" for="txtNumeroCnpj" id="lblNumeroCnpj">CNPJ:
                        <img style="margin-bottom: -4px;width:20px; height:20px !important"
                             src="<?= PaginaSEI::getInstance()->getDiretorioSvgGlobal() ?>/ajuda.svg"
                             name="ajuda" <?= PaginaSEI::montarTitleTooltip('Insira no campo abaixo o CNPJ da Pessoa Jur�dica � qual deseja se vincular.', 'Ajuda') ?>
                             alt="Ajuda" class="infraImg"/></label>
                    <input type="text" class="infraText" id="txtNumeroCnpj" onchange="esconderCamposPJ();"
                           name="txtNumeroCnpj" maxlength="18"
                           value="<?php echo !is_null($arrDadosPessoaJuridicaVinculo) ? InfraUtil::formatarCnpj($arrDadosPessoaJuridicaVinculo->getDblCNPJ()) : $hdnNumeroCnpj; ?>"
                           onkeypress="return infraMascaraCnpj(this,event);"
                           tabindex="<?= PaginaSEIExterna::getInstance()->getProxTabDados(); ?>"/>
                </div>
            </div>
            <?php if ($stWebService) { ?>
                <div class="col-sm-12 col-md-8 col-lg-7 col-xl-5">
                    <div class="bloco" id="blc">
                        <label id="lblCaptcha" for="txtCaptcha" class="infraLabelObrigatorio"><img
                                    valign=bottom
                                    src="/infra_js/infra_gerar_captcha.php?codetorandom=<?= $strCodigoParaGeracaoCaptcha; ?>"
                                    alt="<?= _('N�o foi poss�vel carregar a imagem de confirma��o'); ?>"/></label>
                    </div>
                    <div class="bloco" id="">
                        <label id="txtCaptchaLabel" for="txtCaptcha" class="infraLabelObrigatorio">C�digo de
                            Confirma��o:</label>
                        <input type="text" id="txtCaptcha" name="txtCaptcha" class="infraText"
                               value="" maxlength="4"
                               tabindex="<?= PaginaSEIExterna::getInstance()->getProxTabDados() ?>"/>
                        <button type="button" accesskey="V" name="btnValidar" id="btnValidar" value="Validar"
                                onclick="consultarDadosReceita()"
                                class="infraButton"
                                tabindex="<?= PaginaSEIExterna::getInstance()->getProxTabDados(); ?>"><span
                                    class="infraTeclaAtalho">V</span>alidar
                        </button>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-5 col-xl-4">
                    <div id="blcPjRazaoSocial">
                        <label class="infraLabelObrigatorio" for="txtRazaoSocialWsdl" id="lblNumeroCnpj">Raz�o
                            Social:</label>
                        <input type="text" class="infraText form-control blocInformacaoPj"
                               id="txtRazaoSocialWsdl" name="txtRazaoSocialWsdl" readonly
                               tabindex="<?= PaginaSEIExterna::getInstance()->getProxTabDados(); ?>"/>
                    </div>
                </div>
            <?php } else { ?>
                <div class="col-sm-12 col-md-4 col-lg-4">
                    &nbsp;&nbsp;<button type="button" accesskey="V" name="btnValidarSemWS" id="btnValidarSemWS"
                                        value="Validar"
                                        onclick=""
                                        class="infraButton"><span class="infraTeclaAtalho">V</span>alidar
                    </button>
                </div>
            <?php } ?>
        </div>
    </div>

    <div class="bloco">
        <label class="infraLabelObrigatorio" for="txtComplementoTipoDocumento">Aten��o:</label>
        <label>
            <ol class="Numerada" style="margin-top: 0%;">
                <li class="Numerada">Somente quem � de fato Respons�vel Legal pela Pessoa Jur�dica junto � Receita
                    Federal do Brasil (RFB) pode exercer a presente vincula��o.
                </li>
                <li class="Numerada">Ao efetivar a vincula��o como Respons�vel Legal, no �mbito
                    do(a) <?= $descricaoOrgao ?>, voc� ter� poderes para:
                    <ol class="Numerada">
                        <li class="Numerada">Gerenciar o cadastro da Pessoa Jur�dica;</li>
                        <li class="Numerada">Receber Intima��es Eletr�nicas e realizar Peticionamento Eletr�nico em nome
                            da Pessoa Jur�dica, com todos os poderes previstos no sistema;
                        </li>
                        <li class="Numerada">Conceder Procura��es Eletr�nicas Especiais a outros Usu�rios Externos, bem
                            como revog�-las quando lhe convier;
                        </li>
                        <li class="Numerada">Conceder Procura��es Eletr�nicas Simples a outros Usu�rios Externos, em
                            �mbito geral ou para processos espec�ficos, conforme poderes estabelecidos, para
                            representa��o da Pessoa Jur�dica Outorgante, bem como revog�-las quando lhe convier.
                        </li>
                    </ol>
                </li>
                <li class="Numerada">� sua responsabilidade zelar pela veracidade e validade dos dados sobre a Pessoa
                    Jur�dica � qual se vincula no �mbito do SEI-<?= $siglaOrgao ?>.
                </li>
            </ol>
        </label>
    </div>

    <div class="clear"></div>

    <div id="stDeclaracao" style="display:none">
        <div class="bloco" id="blcDeclaracaoCheck" style="width:3%">
            <input type=checkbox id="chkDeclaracao" value="S" class="infraCheckbox"
                   tabindex="<?= PaginaSEIExterna::getInstance()->getProxTabDados(); ?>"
                   onchange="//mostrarEsconderCampos(this)" style="margin-top: 30%;margin-left: 30%;">
        </div>
        <div class="bloco" id="blcDeclaracao" style="width:95%">
            <label id="lblDeclaracao"><span id="textoDeclaracao"><?= $textoFormatadoDeclaracao ?></span></label>
        </div>
        <div class="clear"></div>
    </div>

</fieldset>
<br/>

<input type="hidden" id="hdnTextoDeclaracaoFormatado" name="hdnTextoDeclaracaoFormatado"
       value='<?php echo $textoFormatadoDeclaracao; ?>'/>
<input type="hidden" id="hdnTextoDeclaracaoDestaque" name="hdnTextoDeclaracaoDestaque"
       value='<?php echo $textoDestaqueDeclaracao; ?>'/>

<input type="hidden" id="hdnIsCnpjValidado" name="hdnIsCnpjValidado" value="0"/>
<input type="hidden" id="hdnIdContatoNovo" name="hdnIdContatoNovo" value=""/>
<input type="hidden" id="hdnValorCaptcha" name="hdnValorCaptcha" value="">