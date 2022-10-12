  <?php 
  try {
 require_once dirname(__FILE__).'/../../SEI.php';
  
  	session_start();
  
  	PaginaSEI::getInstance()->setBolXHTML(false);
  	//////////////////////////////////////////////////////////////////////////////
  	//InfraDebug::getInstance()->setBolLigado(false);
  	//InfraDebug::getInstance()->setBolDebugInfra(true);
  
  	//InfraDebug::getInstance()->limpar();
  	//////////////////////////////////////////////////////////////////////////////
  
  	SessaoSEI::getInstance()->validarLink();
  
  	PaginaSEI::getInstance()->verificarSelecao('tipo_processo_peticionamento_selecionar_orientacoes');
  
  	SessaoSEI::getInstance()->validarPermissao($_GET['acao']);
  
  	$arrComandos = array();
  
  switch($_GET['acao']){
  	case 'md_pet_tipo_processo_cadastrar_orientacoes':
  		$strTitulo = 'Orienta��es Gerais';
  		$arrComandos[] = '<button type="submit" accesskey="S" name="sbmCadastrarOrientacoesPetIndisp" value="Salvar" class="infraButton"><span class="infraTeclaAtalho">S</span>alvar</button>';
  		$arrComandos[] = '<button type="button" accesskey="C" name="btnCancelar" id="btnCancelar" value="Cancelar" onclick="location.href=\''.PaginaSEI::getInstance()->formatarXHTML(SessaoSEI::getInstance()->assinarLink('controlador.php?acao='.PaginaSEI::getInstance()->getAcaoRetorno().'&acao_origem='.$_GET['acao'])).'\';" class="infraButton"><span class="infraTeclaAtalho">C</span>ancelar</button>';
  
  		$objEditorRN=new EditorRN();
  		$objEditorDTO=new EditorDTO();
  		 
  		$objEditorDTO->setStrNomeCampo('txaConteudo');
  		
  		$objEditorDTO->setStrSinSomenteLeitura('N');
  		 
  		$retEditor = $objEditorRN->montarSimples($objEditorDTO);
  		
  		
  		$objMdPetTpProcessoOrientacoesDTO2 = new MdPetTpProcessoOrientacoesDTO();
  		$objMdPetTpProcessoOrientacoesDTO2->setNumIdTipoProcessoOrientacoesPet(MdPetTpProcessoOrientacoesRN::$ID_FIXO_TP_PROCESSO_ORIENTACOES);
  		$objMdPetTpProcessoOrientacoesDTO2->retTodos();
 
  		$objMdPetTpProcessoOrientacoesRN  = new MdPetTpProcessoOrientacoesRN();
  		$objLista = $objMdPetTpProcessoOrientacoesRN->listar($objMdPetTpProcessoOrientacoesDTO2);
  		$alterar = count($objLista) > 0;
  		
  		$txtConteudo =''; 
  		if($alterar){
  			$txtConteudo = $objLista[0]->getStrOrientacoesGerais();
  		}
  		
		$objMdPetTpProcessoOrientacoesDTO = new MdPetTpProcessoOrientacoesDTO();
		$objMdPetTpProcessoOrientacoesDTO->setStrOrientacoesGerais($_POST['txaConteudo']);  				
		$objMdPetTpProcessoOrientacoesDTO->setNumIdTipoProcessoOrientacoesPet(MdPetTpProcessoOrientacoesRN::$ID_FIXO_TP_PROCESSO_ORIENTACOES);
		
  		if (isset($_POST['sbmCadastrarOrientacoesPetIndisp'])) {
  			try{
                $strConteudoSalvar = trim($_POST['txaConteudo']);
                if($strConteudoSalvar != '') {
  				$objEditorRN->validarTagsCriticas(array('jpg','png'), $_POST['txaConteudo']);
  				$objMdPetTpProcessoOrientacoesDTO2->setStrOrientacoesGerais($_POST['txaConteudo']);

				//Estilo
				$conjuntoEstilosRN = new ConjuntoEstilosRN();
		  		$conjuntoEstilosDTO = new ConjuntoEstilosDTO();
		  		$conjuntoEstilosDTO->setStrSinUltimo('S');
		  		$conjuntoEstilosDTO->retNumIdConjuntoEstilos();
		  		$conjuntoEstilosDTO = $conjuntoEstilosRN->consultar( $conjuntoEstilosDTO );
		  		$objMdPetTpProcessoOrientacoesDTO2->setNumIdConjuntoEstilos( $conjuntoEstilosDTO->getNumIdConjuntoEstilos() );

                $objMdPetTpProcessoOrientacoesDTO =  $alterar ? $objMdPetTpProcessoOrientacoesRN->alterar($objMdPetTpProcessoOrientacoesDTO2) : $objMdPetTpProcessoOrientacoesRN->cadastrar($objMdPetTpProcessoOrientacoesDTO);
  				header('Location: '.SessaoSEI::getInstance()->assinarLink('controlador.php?acao='.PaginaSEI::getInstance()->getAcaoRetorno().'&acao_origem='.$_GET['acao']));
  				die;
                }else{
                    $objInfraException = new InfraException();
                    $objInfraException->lancarValidacao('Informe o campo Conte�do!');
                }
  			}catch(Exception $e){
  				PaginaSEI::getInstance()->processarExcecao($e);
  			}
  		}
  		break;
  		
  		default:
  			throw new InfraException("A��o '".$_GET['acao']."' n�o reconhecida.");
  	break;
  	
  }
  }
  		catch(Exception $e){
  			PaginaSEI::getInstance()->processarExcecao($e);
  		}
  		
  		
  		PaginaSEI::getInstance()->montarDocType();
  		PaginaSEI::getInstance()->abrirHtml();
  		PaginaSEI::getInstance()->abrirHead();
  		PaginaSEI::getInstance()->montarMeta();
  		PaginaSEI::getInstance()->montarTitle(':: '.PaginaSEI::getInstance()->getStrNomeSistema().' - '.$strTitulo.' ::');
  		PaginaSEI::getInstance()->montarStyle();
  		EditorINT::montarCss();
  		PaginaSEI::getInstance()->abrirStyle();
  		?>
  		#lblNome {position:absolute;left:0%;top:0%;width:30%;}
  		#txtNome {position:absolute;left:0%;top:14%;width:30%;}
  		
  		#lblDescricao {position:absolute;left:0%;top:40%;width:95%;}
  		#txtDescricao {position:absolute;left:0%;top:54%;width:95%;}
  		
  		#lblConteudo {position:absolute;left:0%;top:25%;width:95%;}
  		
  		.cke_contents#cke_1_contents {height:290px !important;}
  		<?
  		PaginaSEI::getInstance()->fecharStyle();
  		PaginaSEI::getInstance()->montarJavaScript();
        PaginaSEI::getInstance()->abrirJavaScript();
        if (0){ ?>
  <script type="text/javascript">
      <?php } ?>

      function inicializar() {
          infraEfeitoTabelas();
      }

      function onSubmitForm() {
          if (infraTrim(CKEDITOR.instances['txaConteudo'].getData())=='') {
              alert('Informe o Conte�do.');
              document.getElementById('txaConteudo').focus();
              return false;
          }
      }

      <?php if (0){ ?>
  </script>
  <?php
  }
  PaginaSEI::getInstance()->fecharJavaScript();
  		echo $retEditor->getStrInicializacao();
  		PaginaSEI::getInstance()->fecharHead();
  		PaginaSEI::getInstance()->abrirBody($strTitulo,'onload="inicializar();"');
  ?>
  
  <form id="frmTextoPadraoInternoCadastro" method="post" onsubmit="return onSubmitForm();" action="<?=PaginaSEI::getInstance()->formatarXHTML(SessaoSEI::getInstance()->assinarLink('controlador.php?acao='.$_GET['acao'].'&acao_origem='.$_GET['acao']))?>">
  <?
PaginaSEI::getInstance()->montarBarraComandosSuperior($arrComandos);
PaginaSEI::getInstance()->abrirAreaDados('3em');
?>

<label id="lblConteudo" for="txaConteudo" accesskey="" class="infraLabelObrigatorio">Conte�do:</label>
<?php 
PaginaSEI::getInstance()->fecharAreaDados();

?>
  <table style="width: 100%">
    <td style="width: 95%">
      <div id="divEditores" style="overflow: auto;">
        <textarea id="txaConteudo" name="txaConteudo" rows="10" class="infraTextarea" tabindex="<?=PaginaSEI::getInstance()->getProxTabDados()?>"><?=PaginaSEI::tratarHTML($txtConteudo)?></textarea>
        <script type="text/javascript">
          <?=$retEditor->getStrEditores();?>
        </script>
      </div>
    </td>
  </table>
  </form>
  
  <?
PaginaSEI::getInstance()->fecharBody();
PaginaSEI::getInstance()->fecharHtml();
?>