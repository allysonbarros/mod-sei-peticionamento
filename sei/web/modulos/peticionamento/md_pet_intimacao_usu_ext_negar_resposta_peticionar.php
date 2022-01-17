<?php
/**
 * ANATEL
 *
 * 07/08/2019 - criado por kamyla.sakamoto@castgroup.com.br - CAST
 *
 */
require_once dirname(__FILE__) . '/../../SEI.php';
SessaoSEIExterna::getInstance()->validarLink();
SessaoSEIExterna::getInstance()->validarPermissao($_GET['acao']);
PaginaSEIExterna::getInstance()->setTipoPagina(InfraPagina::$TIPO_PAGINA_SIMPLES);

$arrComandos = array();
$texto = '';
$idContato = $_GET['id_contato'];

switch ($_GET['acao']) {

    case 'md_pet_intimacao_usu_ext_negar_resposta_peticionar':
        try {
            $strTitulo = 'Responder Intima��o Eletr�nica n�o Permitida';

            $arrComandos[] = '<button type="button" accesskey="C" name="sbmFechar" id="sbmFechar"  onclick="fechar();" value="Fechar" class="infraButton">Fe<span class="infraTeclaAtalho">c</span>har</button>';

            $objContatoDTO = new ContatoDTO();
            $objContatoDTO->retStrNome();
            $objContatoDTO->retDblCpf();
            $objContatoDTO->retDblCnpj();
            $objContatoDTO->setNumIdContato($idContato);
            $objContatoRN = new ContatoRN();
            $objContatoDTO = $objContatoRN->consultarRN0324($objContatoDTO);

            $texto = 'Voc� n�o possui mais permiss�o para Responder a Intima��o Eletr�nica, conforme abaixo:<br><br>Destinat�rios n�o permitidos:<br>';

            if (!is_null(InfraUtil::formatarCpfCnpj($objContatoDTO->retDblCpf()))) {
                $texto .= '&nbsp;&nbsp;&nbsp;&nbsp;- '.$objContatoDTO->getStrNome() . ' (' . InfraUtil::formatarCpfCnpj($objContatoDTO->getDblCpf()) . ')';
            } else {
                $texto .= '&nbsp;&nbsp;&nbsp;&nbsp;- '.$objContatoDTO->getStrNome() . ' (' . InfraUtil::formatarCpfCnpj($objContatoDTO->getDblCnpj()) . ')';
            }

            $texto .= ', verifique seus Poderes de Representa��o.';
            
            $url = "controlador_externo.php?acao=usuario_externo_controle_acessos&acao_origem=usuario_externo_logar&acao_origem=md_pet_usu_ext_recibo_listar&id_orgao_acesso_externo=0";
	    $urlAssinada = SessaoSEIExterna::getInstance()->assinarLink($url);
            
        } catch (Exception $e) {
            PaginaSEIExterna::getInstance()->processarExcecao($e);
        }

        break;
    default:
        throw new InfraException("A��o '" . $_GET['acao'] . "' n�o reconhecida.");
}

PaginaSEIExterna::getInstance()->montarDocType();
PaginaSEIExterna::getInstance()->abrirHtml();
PaginaSEIExterna::getInstance()->abrirHead();
PaginaSEIExterna::getInstance()->montarMeta();
PaginaSEIExterna::getInstance()->montarTitle(':: ' . PaginaSEIExterna::getInstance()->getStrNomeSistema() . ' - ' . $strTitulo . ' ::');
PaginaSEIExterna::getInstance()->montarStyle();
PaginaSEIExterna::getInstance()->abrirStyle();
PaginaSEIExterna::getInstance()->fecharStyle();
PaginaSEIExterna::getInstance()->montarJavaScript();
PaginaSEIExterna::getInstance()->abrirJavaScript();
PaginaSEIExterna::getInstance()->fecharJavaScript();
PaginaSEIExterna::getInstance()->fecharHead();
PaginaSEIExterna::getInstance()->abrirBody();
?>
<form action="<?php echo SessaoSEIExterna::getInstance()->assinarLink('controlador_externo.php?acao=md_pet_intimacao_usu_ext_confirmar_aceite&id_procedimento=' . $_GET['id_procedimento'] . '&id_acesso_externo=' . $_GET['id_acesso_externo'] . '&id_documento=' . $_GET['id_documento']); ?>" method="post" id="frmMdPetIntimacaoConfirmarAceite" name="frmMdPetIntimacaoConfirmarAceite">

    <?php PaginaSEIExterna::getInstance()->montarBarraComandosSuperior($arrComandos); ?>

    <div class="row linha">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <h4>
                <?php echo $strTitulo; ?>
            </h4>
        </div>
    </div>

    <div class="row linha">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 textoIntimacaoEletronica">
            <h2>
                <?php echo $texto; ?>
            </h2>
        </div>
    </div>

</form>
<?php
SessaoSEIExterna::getInstance()->configurarAcessoExterno($_GET['id_acesso_externo']);
PaginaSEIExterna::getInstance()->fecharBody();
PaginaSEIExterna::getInstance()->fecharHtml();
SessaoSEIExterna::getInstance()->configurarAcessoExterno(0);
?>


<script type="text/javascript">
    function fechar() {
        window.opener.location = '<?= $urlAssinada;?>';
        window.opener.focus();
        window.close();
    }
</script>
