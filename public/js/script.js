$('.destroy').click(function (e) { 
	var dataUrl = $(this).attr('data-url'); // lấy giá trị của thuộc tính 
	$('#exampleModal a ').attr('href',dataUrl); // cập nhật giá trị cho thuộc tính href
});	