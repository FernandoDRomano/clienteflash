$(function () {
	$('.FechaHoraMinuto').datetimepicker({
		format: 'DD/MM/YYYY HH:mm',locale: 'ru',
		date: new Date()
	});
	
});

$(function () {
	$('.Fecha').datetimepicker({
		format: 'YYYY/MM/DD',locale: 'ru',
		date: new Date()
	});
	
});

$(function () {
	$('.FechaHoraMinutoOpen').datetimepicker({
		format: 'DD/MM/YYYY HH:mm:00',locale: 'ru',//,
		inline: true,
		sideBySide: true
	})
});

$(function () {
	$('.FechaFull').datetimepicker({
		format: 'DD/MM/YYYY HH:mm:ss',locale: 'ru'
	})
});

$(function () {
	$('.FechaFullRegular').datetimepicker({
		format: 'YYYY/MM/DD HH:mm:ss',locale: 'ru'
	})
});

