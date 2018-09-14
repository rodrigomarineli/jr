(function($)
{

	$(document).on('click', '.select_all', function(event) {
		var all = $(this).attr('data-select');
		if($(this).is(":checked")){
			$('.all_'+all).each(function(i) {
				$(this).prop('checked', true);
			});
		}
		else{
			$('.all_'+all).each(function(i) {
				$(this).prop('checked', false);
			});
		}
	});

	$(document).on('click', '.select_none', function(event) {
		var all = $(this).attr('data-select');
		console.log(all);
		if($(this).is(":checked")){
			$('.none_'+all).each(function(i) {
				$(this).prop('checked', false);
			});
		}
		else{
			$('.none_'+all).each(function(i) {
				$(this).prop('checked', true);
			});
		}
		// $('.none').each(function(i) {
		// 	$(this).prop('checked', false);
		// });
	});

	// sortable tables
	$('.menu-pag').on('click',function(e){
		e.preventDefault();
		var table = $('table').attr('data-table');
		var item = $(this).attr('data-item');
		var status = $(this).attr('data-status');
		var campo = $(this).attr('data-campo');
		$("#ordem").load(url_site+"js/ajax/status.php?item="+item+"&status="+status+"&table="+table+"&campo="+campo);
		if(status == 1) {
			$('.menu-item-'+item+' > i').removeClass('icon-check');
			$('.menu-item-'+item+' > i').addClass('icon-check-empty');
			$(this).attr('data-status','0');
		}
		else if(status == 0) {
			$('.menu-item-'+item+' > i').removeClass('icon-check-empty');
			$('.menu-item-'+item+' > i').addClass('icon-check');
			$(this).attr('data-status','1');
		}
	})


	$(document).on('click','.destaque', function (e) {
		e.preventDefault();
		var table = $('table').attr('data-table');
		var item = $(this).attr('data-item');
		var status = $(this).attr('data-status');
		var campo = $(this).attr('data-campo');
		if(status == 0) {
			$('.destaque-item-'+item+' > i').removeClass('icon-star-empty');
			$('.destaque-item-'+item+' > i').addClass('icon-star');
			$(this).attr('data-status','1');
		}
		else if(status == 1) {
			$('.destaque-item-'+item+' > i').removeClass('icon-star');
			$('.destaque-item-'+item+' > i').addClass('icon-star-empty');
			$(this).attr('data-status','0');
		}
		if(status == 1){
			status = 0;
		}
		else {
			status = 1;
		}
		$("#ordem").load(url_site+"js/ajax/status.php?item="+item+"&status="+status+"&table="+table+"&campo="+campo);
		// location.reload();
	})

	$(document).on('click','.destaque2', function (e) {
		e.preventDefault();
		var table = $('table').attr('data-table');
		var item = $(this).attr('data-item');
		var status = $(this).attr('data-status');
		var campo = $(this).attr('data-campo');
		if(status == 0) {
			$('.destaque-item2-'+item+' > i').removeClass('icon-star-empty');
			$('.destaque-item2-'+item+' > i').addClass('icon-star');
			$(this).attr('data-status','1');
		}
		else if(status == 1) {
			$('.destaque-item2-'+item+' > i').removeClass('icon-star');
			$('.destaque-item2-'+item+' > i').addClass('icon-star-empty');
			$(this).attr('data-status','0');
		}
		if(status == 1){
			status = 0;
		}
		else {
			status = 1;
		}
		$("#ordem").load(url_site+"js/ajax/status.php?item="+item+"&status="+status+"&table="+table+"&campo="+campo);
		// location.reload();
	})

	$('.promocao').on('click',function(e){
		e.preventDefault();
		var table = $('table').attr('data-table');
		var item = $(this).attr('data-item');
		var status = $(this).attr('data-status');
		var campo = $(this).attr('data-campo');
		if(status == 0) {
			$('.promocao-item-'+item+' > i').removeClass('icon-heart-empty');
			$('.promocao-item-'+item+' > i').addClass('icon-heart');
			$(this).attr('data-status','2');
		}
		else if(status == 1) {
			$('.promocao-item-'+item+' > i').removeClass('icon-heart');
			$('.promocao-item-'+item+' > i').addClass('icon-heart-empty');
			$(this).attr('data-status','1');
		}
		if(status == 1){
			status = 0;
		}
		else {
			status = 1;
		}
		$("#ordem").load(url_site+"js/ajax/status.php?item="+item+"&status="+status+"&table="+table+"&campo="+campo);
		location.reload();
	})

	$(document).on('click','.addsubmenu', function (e) {
		e.preventDefault();
		var table = $('table').attr('data-table');
		var item = $(this).attr('data-item');
		var status = $(this).attr('data-status');
		var campo = $(this).attr('data-campo');
		if(status == 2) {
			$('.destaque-item-'+item+' > i').removeClass('icon-check');
			$('.destaque-item-'+item+' > i').addClass('icon-check-empty');
			$(this).attr('data-status','2');
		}
		else if(status == 1) {
			$('.destaque-item-'+item+' > i').removeClass('icon-check-empty');
			$('.destaque-item-'+item+' > i').addClass('icon-check');
			$(this).attr('data-status','1');
		}
		if(status == 1){
			status = 2;
		}
		else {
			status = 1;
		}
		$("#ordem").load(url_site+"js/ajax/status.php?item="+item+"&status="+status+"&table="+table+"&campo="+campo);
		location.reload();
	})

	$('.addsubmenunivel2').on('click',function(e){
		e.preventDefault();
		var table = $('table').attr('data-table');
		var item = $(this).attr('data-item');
		var status = $(this).attr('data-status');
		var campo = $(this).attr('data-campo');
		if(status == 3) {
			$('.destaque-item-'+item+' > i').removeClass('icon-check');
			$('.destaque-item-'+item+' > i').addClass('icon-check-empty');
			$(this).attr('data-status','3');
		}
		else if(status == 2) {
			$('.destaque-item-'+item+' > i').removeClass('icon-check-empty');
			$('.destaque-item-'+item+' > i').addClass('icon-check');
			$(this).attr('data-status','2');
		}
		if(status == 2){
			status = 3;
		}
		else {
			status = 2;
		}
		$("#ordem").load(url_site +"js/ajax/status.php?item="+item+"&status="+status+"&table="+table+"&campo="+campo);
		location.reload();
	})

	$('#preco_modelo').change(function(event) {
		if($(this).is(':checked')){
			var tipo = $('#tipo option:selected').val();
			$.ajax({
				url: 'js/ajax/pega_preco_modelo.php',
				type: 'POST',
				data: {tipo: tipo},
			})
			.success(function(data) {
				var preco = parseFloat(data).toFixed(2);
				preco = preco.replace('.',',');
				preco = preco.replace(/^\s+|\s+$/g,"");
				$('#preco').val(preco);
			})
			
		}
	});

	$('#preco_categoria').change(function(event) {
		if($(this).is(':checked')){
			var categoria = $('#categoria option:selected').val();
			$.ajax({
				url: 'js/ajax/pega_preco_categoria.php',
				type: 'POST',
				data: {categoria: categoria},
			})
			.success(function(data) {
				var preco = parseFloat(data).toFixed(2);
				preco = preco.replace('.',',');
				preco = preco.replace(/^\s+|\s+$/g,"");
				$('#preco').val(preco);
			})
			
		}
	});

})(jQuery);



$(document).ready(function(){


    $('.checktipo').change(function(event) {
        event.preventDefault();
        var tipo = $(this).val();
        if(tipo == 1){
            $('#checkvid').hide();
            $('#checkimg').show();
        }
        else if(tipo == 2){
            $('#checkimg').hide();
            $('#checkvid').show();
        }
    });

    $('body').on('click','.deleteitem',function(event) {
        event.preventDefault();
        var table = $(this).parents('table').attr('data-table');
        if(table == undefined)
        	var table = $('table').attr('data-table');
        var item = $(this).attr('data-item');
        if (confirm("Tem certeza que deseja deletar este item?") == true){
            $("#ordem").load(url_site+"js/ajax/delete.php?item="+item+"&table="+table);
        }
    });

	// sortable tables
	if ($(".js-table-sortable").length){	
		$(".js-table-sortable").sortable({
			placeholder: "ui-state-highlight",
			items: "tbody tr",
			handle: ".js-sortable-handle",
			forcePlaceholderSize: true,
			helper: function(e, ui) 
			{
				ui.children().each(function() {
					$(this).width($(this).width());
				});
				return ui;
			},
			start: function(event, ui) 
			{
				ui.placeholder.html('<td colspan="' + $(this).find('tbody tr:first td').size() + '">&nbsp;</td>');
			},
			update : function () { 
                var order = $('.js-table-sortable').sortable('serialize');
                var table = $(this).attr('data-table');
                var page = $(this).attr('data-page');
                $("#ordem").load(url_site+"ajax/ordem.php?table="+table+"&page="+page+"&"+order); 
            } 
		});
	}

	$('.proc_img').click(function(event) {
		event.preventDefault();
		$('.bl_txt').hide();
		$('.bl_img').show();
		$('.proc_txt').show();
		$('.proc_img').hide();
	});

	$('.proc_txt').click(function(event) {
		event.preventDefault();
		$('.bl_txt').show();
		$('.bl_img').hide();
		$('.proc_txt').hide();
		$('.proc_img').show();
	});

	$('#salvar_rastreio').click(function(){
		var rastreio = $('#rastreio').val();
		var pedido = $('#rastreio').attr('data-pedido');
		$('#rastreioa').load('js/ajax/atualizar-rastreio.php',{rastreio:rastreio,pedido:pedido});
		alert('Código adicionado com sucesso');
	});

	$('#salvar_pg_status').click(function(){
		var status = $('#pg_status').val();
		var pedido = $('#pg_status').attr('data-pedido');
		$('#pg_statusa').load('js/ajax/atualizar-status.php',{status:status,pedido:pedido});
		alert('Status alterado com sucesso');
	});
});

// customizar modelos
$(document).ready(function(){

	//FRENTE
	$(document).on('change', '.bg_frente', function(event) {
		event.preventDefault();
		var pagina = $(this).attr('data-pagina');
		$('#target_frente_'+pagina).css({
			background: 'url('+URL.createObjectURL(event.target.files[0])+')'
		});
		// var html_frente = $('#target_frente').html();
		// $('#html_frente').val(html_frente);
	});

	$(document).on('click', '.btn_texto', function(event) {
		event.preventDefault();
		var proporcao = $('#custom_modelos').attr('data-proporcao');
		var pagina = $(this).attr('data-pagina');
		var zindex;
		var texto = $('#texto_'+pagina).val();
		var fonte = $('#fonte_'+pagina+' option:selected').val();
		var tamanho = $('#tamanho').val()/proporcao;
		var cor = $('#cor_'+pagina).val();
		if($('#sobrepor_'+pagina).is(':checked')) {
			zindex = 'z-index: 300';
		}
		var html_texto = '<p style="font-family: '+fonte+'; font-size: '+tamanho+'px; color: '+cor+'; '+zindex+'"><span>'+texto+'</span><a href="" class="edit_texto"> </a><a href="" class="del_texto"> </a></p>';
		$('#target_frente_'+pagina+' .textos').append(html_texto);
		ModificaTamanhoPFrente();
		$('#texto_'+pagina).val('');
	});

	$(document).on('change', '.img_frente', function(event) {
		event.preventDefault();
		var pagina = $(this).attr('data-pagina');
		var imagem = URL.createObjectURL(event.target.files[0]);
		var imgs = $(this).attr('data-img');
		$('#target_frente_'+pagina+' img#imgs_'+imgs).attr('src', imagem);
		$('.false_img_frente_'+imgs).val(imagem);
		// $('.del_img').css('display', 'block');
	});

	$('.add_outra').click(function(event) {
		event.preventDefault();
		var i = $(this).attr('data-frente');
		var imgs = $('.img_frente_'+i).length;
		imgs2 = imgs+1;
		$('.outra_imagem_'+i).append('<div class="control-group"><label class="control-label">Upload de Imagem</label><div class="controls"><input type="file" class="default img_frente img_frente_'+i+'" accept="image/*" data-img="'+imgs2+'" data-pagina="'+i+'" name="img_frente_'+i+'[]" id="img_frente_'+i+'"><input type="hidden" name="false_img_frente_'+i+'[]" class="false_img_frente_'+imgs2+'" id="false_img_frente_'+i+'"></div></div>')
		$('#target_frente_'+i).append('<div class="draggableHelper" style="display:inline-block"><a href="" class="del_img"> </a><div class="image"><img class="output" id="imgs_'+imgs2+'"></div></div>');
	});

	$(".target_pagina").on('mouseover', 'p', function(event) {
		$(this).draggable();
	});

	//VERSO
	$(document).on('change', '.bg_verso', function(event) {
		event.preventDefault();
		$('#target_verso').css({
			background: 'url('+URL.createObjectURL(event.target.files[0])+')'
		});
	});

	$(document).on('click', '.btn_texto_verso', function(event) {
		event.preventDefault();
		var zindex;
		var texto = $('#texto_verso').val();
		var fonte = $('#fonte_verso option:selected').val();
		var tamanho = $('#tamanho_verso').val();
		var cor = $('#cor_verso').val();
		if($('#sobrepor_verso').is(':checked')) {
			zindex = 'z-index: 300';
		}
		var html_texto = '<p style="font-family: '+fonte+'; font-size: '+tamanho+'px; color: '+cor+'; '+zindex+'"><span>'+texto+'</span><a href="" class="edit_texto"> </a><a href="" class="del_texto"> </a></p>';
		$('#target_verso .textos').append(html_texto);
		ModificaTamanhoPFrente();
		$('#texto').val('');
	});

	$(document).on('change', '.img_verso', function(event) {
		event.preventDefault();
		var imagem = URL.createObjectURL(event.target.files[0]);
		$('#target_verso img').attr('src', imagem);
		$('#false_img_verso').val(imagem);
		// $('.del_img').css('display', 'block');
	});

    $('body').on('click', '.del_file', function(event) {
    	event.preventDefault();
    	var table = $(this).attr('data-table');
        var item = $(this).attr('data-item');
        var foto = $(this).attr('data-foto');
        var pasta = $(this).attr('data-pasta');
        if (confirm("Tem certeza que deseja deletar este item?") == true){
            $("#ordem").load(url_site+"js/ajax/delete.php?item="+item+"&table="+table+"&foto="+foto+"&pasta="+pasta);
        }
    });

	$("#target_verso").on('mouseover', 'p', function(event) {
		$(this).draggable();
	});

	$(document).on('mouseover', '.draggableHelper', function(event) {
		$(this).draggable({
			containment: "#area_editavel",
			scroll: false
		});
	});

	$(document).on('mouseover', '.output', function(event) {
		$(this).resizable({aspectRatio: true});
	});

	$(document).on('click', '.del_texto', function(event) {
		event.preventDefault();
		$(this).parent('p').empty();
	});

	$(document).on('click', '.del_img', function(event) {
		event.preventDefault();
		$(this).parent('.draggableHelper').children('.image').html('<img class="output" id="imgs_1" />');
		// $('.image').html('<img class="output" />');
		// $('.del_img').css('display', 'none');
	});

	$('#salvar_custom_modelos').click(function(event) {
		event.preventDefault();
		$('.target_pagina').each(function(index, el) {
			var pagina = $(this).attr('data-pagina');
			var html_frente = $('#target_frente_'+pagina).html();
			$('#html_frente_'+pagina).val(html_frente);
		});
		// var html_frente = $('#target_frente').html();
		// $('#html_frente').val(html_frente);
		// var html_verso = $('#target_verso').html();
		// $('#html_verso').val(html_verso);
		$("#salvar3").trigger("click");
	});

});

function ModificaTamanhoPFrente(){
	$('#target_frente .textos p').each(function(index, el) {
		$(this).css('width', '100%');
		var y = $('span', this).width();
		y = y + 44;
		$(this).css('width', y+'px');
	});
}