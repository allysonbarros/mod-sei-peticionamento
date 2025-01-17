<fieldset id="fieldsetPessoaJuridicaConsulta" class="infraFieldset form-control sizeFieldset" style="width: auto;">
    <legend class="infraLegend">&nbsp; Registro da Pessoa Jur�dica &nbsp;</legend>
    <form name=frmCNPJ id=frmCNPJ action='' method=POST><input type="hidden" name="hdnNumeroCnpj"
                                                               id="hdnNumeroCnpj"></input></form>
    <div class="infraAreaDados">
        <?php $idDiv = $stWebService ? 'blcPj' : 'blcPjSemWs' ?>
        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div id="<?php echo $idDiv ?>">
                    <div class="form-group">
                        <label class="infraLabelObrigatorio" for="txtNumeroCnpj" id="lblNumeroCnpj">CNPJ:
                            <img style="margin-bottom: -4px;width:20px; height:20px !important"
                                src="<?= PaginaSEI::getInstance()->getDiretorioSvgGlobal() ?>/ajuda.svg"
                                name="ajuda" <?= PaginaSEI::montarTitleTooltip('Insira no campo abaixo o CNPJ da Pessoa Jur�dica � qual deseja se vincular.', 'Ajuda') ?>
                                alt="Ajuda" class="infraImg"/></label>
                        <input type="text" class="infraText form-control" id="txtNumeroCnpj" onchange="esconderCamposPJ();"
                            name="txtNumeroCnpj" maxlength="18"
                            value="<?php echo !is_null($arrDadosPessoaJuridicaVinculo) ? InfraUtil::formatarCnpj($arrDadosPessoaJuridicaVinculo->getDblCNPJ()) : $hdnNumeroCnpj; ?>"
                            onkeypress="return infraMascaraCnpj(this,event);"
                            tabindex="<?= PaginaSEIExterna::getInstance()->getProxTabDados(); ?>"/>
                    </div>
                </div>
            </div>
            <?php if ($stWebService) { ?>
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div id="blcPjRazaoSocial" class="form-group">
                        <label class="infraLabelObrigatorio" for="txtRazaoSocialWsdl" id="lblNumeroCnpj">Raz�o
                            Social:</label>
                        <input type="text" class="infraText form-control blocInformacaoPj"
                               id="txtRazaoSocialWsdl" name="txtRazaoSocialWsdl" readonly/>
                    </div>
                </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <div class="card" id="cardCaptcha">
                            <img class="card-img-top" src="/infra_js/infra_gerar_captcha.php?codetorandom=<?= $strCodigoParaGeracaoCaptcha; ?>" alt="<?= _('N�o foi poss�vel carregar a imagem de confirma��o'); ?>">
                            <div class="card-body">
                                <div class="form-group">
                                    <label id="txtCaptchaLabel" for="txtCaptcha" class="infraLabelObrigatorio">C�digo de
                                        Confirma��o:</label>
                                    <div class="input-group mb-3" style="margin: 0 !important;">
                                        <input type="text" id="txtCaptcha" name="txtCaptcha" class="infraText form-control"
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
                            </div>
                        </div>
                    </div>
            <?php } else { ?>
                <div class="col-sm-12 col-md-12 col-lg-9 col-xl-8">
                    <div class="bloco" id="blc">
                        <div class="card"  id="cardCaptcha">
                            <img class="card-img-top" src="/infra_js/infra_gerar_captcha.php?codetorandom=<?= $strCodigoParaGeracaoCaptcha; ?>" alt="<?= _('N�o foi poss�vel carregar a imagem de confirma��o'); ?>">
                            <div class="card-body">
                                <div class="form-group">
                                    <label id="txtCaptchaLabel" for="txtCaptcha" class="infraLabelObrigatorio">C�digo de
                                        Confirma��o:</label>
                                    <div class="input-group mb-3">
                                        <input type="text" id="txtCaptcha" name="txtCaptcha" class="infraText form-control"
                                            value="" maxlength="4"
                                            tabindex="<?= PaginaSEIExterna::getInstance()->getProxTabDados() ?>"/>

                                        <button type="button" accesskey="V" name="btnValidarSemWS" id="btnValidarSemWS"
                                                value="Validar"
                                                onclick=""
                                                class="infraButton"><span class="infraTeclaAtalho">V</span>alidar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
        <div class="bloco" id="blcDeclaracaoCheck" style="width:3%; min-width: 25px">
            <input type=checkbox id="chkDeclaracao" value="S" class="infraCheckbox"
                   tabindex="<?= PaginaSEIExterna::getInstance()->getProxTabDados(); ?>"
                   onchange="//mostrarEsconderCampos(this)" style="margin-top: 30%;margin-left: 30%;">
        </div>
        <div class="bloco" id="blcDeclaracao" style="width:93%">
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
