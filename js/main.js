$(document).ready(function () {
	
	
	
	function alerta(success, mensagem, redirect = null, button = null) {
		if (success) {
			toastr.success(mensagem, 'SUCESSO');

			if (redirect !== null) {
				setTimeout(function () {
					window.location.href = redirect;
				}, 1500);
			}
		} else {
			toastr.error(mensagem, 'AVISO');
		}
	}

	/* Login */
	$('#login').on('submit', function (e) {
		e.preventDefault();

		$.ajax({
			url: 'api.php',
			type: 'POST',
			dataType: 'JSON',
			data: { cmd: 'doLogin', data: $(this).serialize() },
			success: function (resultado) {
				alerta(resultado.success, resultado.message, resultado.url);
			}
		});
	});


	function getSubCategorias(idCat, idSubCat){
		$.ajax({
			url: 'api.php',
			type: 'POST',
			dataType: 'JSON',
			data: { cmd: 'getSubCategorias', idCat: idCat },
			success: function (resultado) {
				var subcategorias = '';
				subcategorias += "<option value='0'>Selecione uma subcategoria</option>';";
				resultado.subcategorias.forEach(function (value) {

					if (idSubCat === value.cod_subcategoria) {

						subcategorias += "<option selected value='" + value.cod_subcategoria + "'> " + value.nome_subcategoria + ' </option>';

					} else {
						subcategorias += "<option value='" + value.cod_subcategoria + "'> " + value.nome_subcategoria + ' </option>';						
					}
				});

				$('.subcatSelect').empty().append(subcategorias);
				$('.subcatSelect').prop('disabled', false);
			}
		});
	}

	/* Perfil */
	$('#editProfile').on('submit', function (e) {
		e.preventDefault();


		$.ajax({
			url: 'api.php',
			type: 'POST',
			dataType: 'JSON',
			data: { cmd: 'editProfile', data: $(this).serialize() },
			success: function (resultado) {
				alerta(resultado.success, resultado.message, resultado.url);
			}
		});
	});

	/* Users */
	$('#editUser').on('submit', function (e) {
		e.preventDefault();


		$.ajax({
			url: 'api.php',
			type: 'POST',
			dataType: 'JSON',
			data: { cmd: 'editUser', data: $(this).serialize() },
			success: function (resultado) {
				alerta(resultado.success, resultado.message, resultado.url);
			}
		});
	});

	$(document).on('click', '.editUser', function () {

		$('#editUser_id').val($(this).attr('data-id'));

		$.ajax({
			url: 'api.php',
			type: 'POST',
			dataType: 'JSON',
			data: { cmd: 'verUser', id: $(this).attr('data-id') },
			success: function (resultado) {

				$('#nome_func').val(resultado.nome_func);
				$('#username').val(resultado.username);
				$('#type_user').val(resultado.tipo_user);

				$('#modalEdit').modal({ backdrop: 'static', keyboard: false });
			}
		});
	});

	$(document).on('click', '.eliminarUser', function () {
		var idU = $(this).attr('data-id');
		swal(
			{
				title: 'Tem a certeza?',
				text: 'Se apagar este registo, deixará de conseguir visualizá-lo!',
				type: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#ed5565',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Sim, apagar!'
			},
			function () {
			$.ajax({
					url: 'api.php',
					type: 'POST',
					dataType: 'JSON',
					data: { cmd: 'eliminarUser', id: idU},
					success: function (resultado) {
						alerta(resultado.success, resultado.message, resultado.url);
					}
				});
			});
	});

	$('#addUser').on('submit', function (e) {
		e.preventDefault();

		$.ajax({
			url: 'api.php',
			type: 'POST',
			dataType: 'JSON',
			data: { cmd: 'addUser', data: $(this).serialize() },
			success: function (resultado) {
				alerta(resultado.success, resultado.message, resultado.url);
			}
		});
	});
	
	/* Clientes */
	$('#editClient').on('submit', function (e) {
		e.preventDefault();


		$.ajax({
			url: 'api.php',
			type: 'POST',
			dataType: 'JSON',
			data: { cmd: 'editClient', data: $(this).serialize() },
			success: function (resultado) {
				alerta(resultado.success, resultado.message, resultado.url);
			}
		});
	});

	$(document).on('click', '.editClient', function () {

		$('#editClient_id').val($(this).attr('data-id'));

		$.ajax({
			url: 'api.php',
			type: 'POST',
			dataType: 'JSON',
			data: { cmd: 'verClient', cod_cliente: $(this).attr('data-id') },
			success: function (resultado) {

				$('#nome_cliente').val(resultado.nome_cliente);
				$('#morada').val(resultado.morada);
				$('#cod_postal').val(resultado.cod_postal);
				$('#localidade').val(resultado.localidade);
				$('#cidade').val(resultado.cidade);
				$('#num_tel').val(resultado.num_tel);
				$('#contribuinte').val(resultado.contribuinte);

				$('#modalEdit').modal({ backdrop: 'static', keyboard: false });
			}
		});
	});

	$(document).on('click', '.eliminarClient', function () {
		var idC = $(this).attr('data-id');
		swal(
			{
				title: 'Tem a certeza?',
				text: 'Se apagar este registo, deixará de conseguir visualizá-lo!',
				type: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#ed5565',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Sim, apagar!'
			},
			function () {
			$.ajax({
					url: 'api.php',
					type: 'POST',
					dataType: 'JSON',
					data: { cmd: 'eliminarClient', cod_cliente: idC},
					success: function (resultado) {
						alerta(resultado.success, resultado.message, resultado.url);
					}
				});
			});
	});

	$('#addClient').on('submit', function (e) {
		e.preventDefault();

		$.ajax({
			url: 'api.php',
			type: 'POST',
			dataType: 'JSON',
			data: { cmd: 'addClient', data: $(this).serialize() },
			success: function (resultado) {
				alerta(resultado.success, resultado.message, resultado.url);
			}
		});
	});

	/* Categorias */
	$('#editCat').on('submit', function (e) {
		e.preventDefault();


		$.ajax({
			url: 'api.php',
			type: 'POST',
			dataType: 'JSON',
			data: { cmd: 'editCat', data: $(this).serialize() },
			success: function (resultado) {
				alerta(resultado.success, resultado.message, resultado.url);
			}
		});
	});

	$(document).on('click', '.editCat', function () {

		$('#editCat_id').val($(this).attr('data-id'));

		$.ajax({
			url: 'api.php',
			type: 'POST',
			dataType: 'JSON',
			data: { cmd: 'verCat', cod_categoria: $(this).attr('data-id') },
			success: function (resultado) {

				$('#nome_categoria').val(resultado.nome_categoria);
				

				$('#modalEdit').modal({ backdrop: 'static', keyboard: false });
			}
		});
	});

	$(document).on('click', '.eliminarCat', function () {
		var idCa = $(this).attr('data-id');
		swal(
			{
				title: 'Tem a certeza?',
				text: 'Se apagar este registo, deixará de conseguir visualizá-lo!',
				type: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#ed5565',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Sim, apagar!'
			},
			function () {
			$.ajax({
					url: 'api.php',
					type: 'POST',
					dataType: 'JSON',
					data: { cmd: 'eliminarCat', cod_categoria: idCa},
					success: function (resultado) {
						alerta(resultado.success, resultado.message, resultado.url);
					}
				});
			});
	});

	$('#addCat').on('submit', function (e) {
		e.preventDefault();

		$.ajax({
			url: 'api.php',
			type: 'POST',
			dataType: 'JSON',
			data: { cmd: 'addCat', data: $(this).serialize() },
			success: function (resultado) {
				alerta(resultado.success, resultado.message, resultado.url);
			}
		});
	});
	
	/* SubCategorias */
	$('#editSubCat').on('submit', function (e) {
		e.preventDefault();


		$.ajax({
			url: 'api.php',
			type: 'POST',
			dataType: 'JSON',
			data: { cmd: 'editSubCat', data: $(this).serialize() },
			success: function (resultado) {
				alerta(resultado.success, resultado.message, resultado.url);
			}
		});
	});

	$(document).on('click', '.editSubCat', function () {

		$('#editSubCat_id').val($(this).attr('data-id'));

		$.ajax({
			url: 'api.php',
			type: 'POST',
			dataType: 'JSON',
			data: { cmd: 'verSubCat', cod_subcategoria: $(this).attr('data-id') },
			success: function (resultado) {
				console.log(resultado);
				$('#nome_subcategoria').val(resultado.nome_subcategoria);
				$('#iva').val(resultado.iva);
				

				$('#modalEdit1').modal({ backdrop: 'static', keyboard: false });
			}
		});
	});

	$(document).on('click', '.eliminarSubCat', function () {
		var idS = $(this).attr('data-id');
		swal(
			{
				title: 'Tem a certeza?',
				text: 'Se apagar este registo, deixará de conseguir visualizá-lo!',
				type: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#ed5565',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Sim, apagar!'
			},
			function () {
			$.ajax({
					url: 'api.php',
					type: 'POST',
					dataType: 'JSON',
					data: { cmd: 'eliminarSubCat', cod_subcategoria: idS},
					success: function (resultado) {
						alerta(resultado.success, resultado.message, resultado.url);
					}
				});
			});
	});

	$('#addSubCat').on('submit', function (e) {
		e.preventDefault();

		$.ajax({
			url: 'api.php',
			type: 'POST',
			dataType: 'JSON',
			data: { cmd: 'addSubCat', data: $(this).serialize() },
			success: function (resultado) {
				alerta(resultado.success, resultado.message, resultado.url);
			}
		});
	});

	/* Produtos */
	$('#editProd').on('submit', function (e) {
		e.preventDefault();


		$.ajax({
			url: 'api.php',
			type: 'POST',
			dataType: 'JSON',
			data: { cmd: 'editProd', data: $(this).serialize() },
			success: function (resultado) {
				alerta(resultado.success, resultado.message, resultado.url);
			}
		});
	});

	$(document).on('click', '.editProd', function () {

		$('#editProd_id').val($(this).attr('data-id'));

		$.ajax({
			url: 'api.php',
			type: 'POST',
			dataType: 'JSON',
			data: { cmd: 'verProd', cod_produto: $(this).attr('data-id') },
			success: function (resultado) {
				console.log(resultado);
				$('#nome_produto').val(resultado.nome_produto);
				//$('#cod_categoria').val(resultado.cod_categoria);
				$('#cod_categoria').val(resultado.cod_categoria ? resultado.cod_categoria : $('.changeCategoria').val());

				getSubCategorias(resultado.cod_categoria, resultado.cod_subcategoria);

				//$('#cod_subcategoria').val(resultado.cod_subcategoria ? resultado.cod_subcategoria : $('.subcatSelect').val());
				$('#quant_disp').val(resultado.quant_disp);
				$('#preco').val(resultado.preco);
				

				$('#modalEdit2').modal({ backdrop: 'static', keyboard: false });
			}
		});
	});

	$(document).on('click', '.eliminarProd', function () {
		var idP = $(this).attr('data-id');
		swal(
			{
				title: 'Tem a certeza?',
				text: 'Se apagar este registo, deixará de conseguir visualizá-lo!',
				type: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#ed5565',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Sim, apagar!'
			},
			function () {
			$.ajax({
					url: 'api.php',
					type: 'POST',
					dataType: 'JSON',
					data: { cmd: 'eliminarProd', cod_produto: idP},
					success: function (resultado) {
						alerta(resultado.success, resultado.message, resultado.url);
					}
				});
			});
	});

	$('#addProd').on('submit', function (e) {
		e.preventDefault();

		$.ajax({
			url: 'api.php',
			type: 'POST',
			dataType: 'JSON',
			data: { cmd: 'addProd', data: $(this).serialize() },
			success: function (resultado) {
				alerta(resultado.success, resultado.message, resultado.url);
			}
		});
	});

$(document).on('change', '.changeCategoria', function () {
		$.ajax({
			url: 'api.php',
			type: 'POST',
			dataType: 'JSON',
			data: { cmd: 'getSubCategorias', idCat: $(this).val() },
			success: function (resultado) {
				var subcategorias = '';
				subcategorias += "<option value='0'>Selecione uma subcategoria</option>';";
				resultado.subcategorias.forEach(function (value) {
					subcategorias += "<option value='" + value.cod_subcategoria + "'> " + value.nome_subcategoria + ' </option>';
				});

				$('.subcatSelect').empty().append(subcategorias);
				$('.subcatSelect').prop('disabled', false);
			}
		});
	});

	/* Encomendas */
	/*$('#editEncProd').on('submit', function (e) {
		e.preventDefault();


		$.ajax({
			url: 'api.php',
			type: 'POST',
			dataType: 'JSON',
			data: { cmd: 'editEncProd', data: $(this).serialize() },
			success: function (resultado) {
				alerta(resultado.success, resultado.message, resultado.url);
			}
		});
	});

	$(document).on('click', '.editEncProd', function () {

		$('#editProd_id').val($(this).attr('data-id'));

		$.ajax({
			url: 'api.php',
			type: 'POST',
			dataType: 'JSON',
			data: { cmd: 'verProd', cod_produto: $(this).attr('data-id') },
			success: function (resultado) {
				console.log(resultado);
				$('#nome_produto').val(resultado.nome_produto);
				//$('#cod_categoria').val(resultado.cod_categoria);
				$('#cod_categoria').val(resultado.cod_categoria ? resultado.cod_categoria : $('.changeCategoria').val());

				getSubCategorias(resultado.cod_categoria, resultado.cod_subcategoria);

				//$('#cod_subcategoria').val(resultado.cod_subcategoria ? resultado.cod_subcategoria : $('.subcatSelect').val());
				$('#quant_disp').val(resultado.quant_disp);
				$('#preco').val(resultado.preco);
				

				$('#modalEdit2').modal({ backdrop: 'static', keyboard: false });
			}
		});
	});

	$(document).on('click', '.eliminarProd', function () {
		var idP = $(this).attr('data-id');
		swal(
			{
				title: 'Tem a certeza?',
				text: 'Se apagar este registo, deixará de conseguir visualizá-lo!',
				type: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#ed5565',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Sim, apagar!'
			},
			function () {
			$.ajax({
					url: 'api.php',
					type: 'POST',
					dataType: 'JSON',
					data: { cmd: 'eliminarProd', cod_produto: idP},
					success: function (resultado) {
						alerta(resultado.success, resultado.message, resultado.url);
					}
				});
			});
	});*/

	$('#addEncProd').on('submit', function (e) {
		e.preventDefault();

		$.ajax({
			url: 'api.php',
			type: 'POST',
			dataType: 'JSON',
			data: { cmd: 'addEncProd', data: $(this).serialize() },
			success: function (resultado) {
				alerta(resultado.success, resultado.message, resultado.url);
			}
		});
	});

	$(document).on('click', '.viewEncProd', function () {
		$('#verEncProd_id').val($(this).attr('data-id'));

		$.ajax({
			url: 'api.php',
			type: 'POST',
			dataType: 'JSON',
			data: { cmd: 'verEncProd', cod_encomenda: $(this).attr('data-id')},
			success: function (resultado) {
				var produtos = '';
				for (let i = 0; i < resultado.length; i++) {
					produtos += "<tr>";
					produtos += "<td>" + resultado[i].nome_produto + "</td>";
					produtos += "<td>" + resultado[i].preco_prods + "</td>";
					produtos += "<td>" + resultado[i].quant + "</td>";
					produtos += "</tr>";
				};
				$('.tableViewEncProd').empty().append(produtos);
			}
		});
	});

	$('#editStatus').on('submit', function (e) {
		e.preventDefault();


		$.ajax({
			url: 'api.php',
			type: 'POST',
			dataType: 'JSON',
			data: { cmd: 'editStatus', data: $(this).serialize() },
			success: function (resultado) {
				alerta(resultado.success, resultado.message, resultado.url);
			}
		});
	});

	$(document).on('click', '.editStatus', function () {

		$('#verEnc_id').val($(this).attr('id'));
		$('#verStatus_id').val($(this).attr('data-id'));
		var status = $(this).attr('data-id');
		$.ajax({
			url: 'api.php',
			type: 'POST',
			dataType: 'JSON',
			data: { cmd: 'getEstados'},
			success: function (resultado) {
				var estados = '';
				estados += "<option value='0'>Selecione um estado</option>';";
				console.log(resultado);
				resultado.estados.forEach(function (value) {
					console.log(status + '|' + value.cod_estado);
					if (status === value.cod_estado) {
						console.log("entrei!");
						estados += "<option selected value='" + value.cod_estado + "'> " + value.estado + ' </option>';
						
					} else {
						estados += "<option value='" + value.cod_estado + "'> " + value.estado + ' </option>';						
					}
				
				})
				$('#cod_estado').empty().append(estados);

				$('#modalStatus').modal({ backdrop: 'static', keyboard: false });
			}

		});
	});


});

