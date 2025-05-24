$(function(){
	var lang = $('html').attr('lang');
	var myURL = window.location.href;
	if(myURL.indexOf("#") != -1){
	    myURL = myURL.replace('#','');
	}

	var table = $('#kt_datatable');
	var designElems = $('input[name="designElems"]').length ?  JSON.parse($('input[name="designElems"]').val()) : [];
	var tableData = designElems.tableData;
	var columnsDef = [];
	var columnsVar = [];
	var columnDefsVar = [];

	var urlParams;
	(window.onpopstate = function () {
	    var match,
	        pl     = /\+/g,  // Regex for replacing addition symbol with a space
	        search = /([^&=]+)=?([^&]*)/g,
	        decode = function (s) { return decodeURIComponent(s.replace(pl, " ")); },
	        query  = window.location.search.substring(1);

	    urlParams = {};
	    while (match = search.exec(query))
	       urlParams[decode(match[1])] = decode(match[2]);
	})();

	function getIndex(key,val) {
		var i = 0;
		var x ;
		$.each(tableData,function(index, el) {
			if(index === key && val === el){
				x = i;
			}else{
				i++;
			}
		});
		return parseInt(x);
	}

	if(lang == 'en'){
		var showCols = "Show Columns <i class='fa fas fa-angle-down'></i>";
		var direction = 'ltr';
		var search = ' Search ';
		var info = 'Showing items from  _START_ to _END_ (total _TOTAL_ )';
		var lengthMenu = 'Showing _MENU_ items';
		var emptyTable = "No records found";
		var processing = "Processing";
		var infoEmpty = "No Results found";
		var rows1 = "You've choosed %d items";
		var rows2 = "You've choosed only one item";
		var changeImage = "Change Image";
		var prev = "<";
		var next = ">";
		var first = "First";
		var last = "Last";
		var editText = 'Edit';
		var copyText = 'Copy';
		var deleteText = 'Delete';
		var showText = 'View';
		var viewText = 'View';
		var exportText = 'Export Contacts';
		var actionsVar = 'Actions';
		var detailsText = 'Details';
		var enableText = 'Enable';
		var disableText = 'Disable';
		var refreshText = 'Refresh';
		var restoreText = 'Restore';
		var forceDeleteText = 'Force Delete';

	}else{
		var showCols = " عرض الأعمدة <i class='fa fas fa-angle-down'></i>";
		var direction = 'rtl';
		var search = ' البحث: ';
		var viewText = 'عرض';
		var info = 'يتم العرض من  _START_ إلى _END_ (العدد الكلي للسجلات _TOTAL_ )';
		var lengthMenu = 'عرض _MENU_ سجلات';
		var emptyTable = "لا يوجد نتائج مسجلة";
		var processing = "جاري التحميل";
		var infoEmpty = "لا يوجد نتائج مسجلة";
		var rows1 = "لقد قمت باختيار %d عناصر";
		var rows2 = "لقد قمت باختيار عنصر واحد";
		var changeImage = "تغيير الصورة";
		var prev = "<";
		var next = ">";
		var first = "الاول";
		var last = "الاخير";
		var editText = 'تعديل';
		var copyText = 'تكرار';
		var deleteText = 'حذف';
		var showText = 'عرض';
		var exportText = 'استيراد جهات الارسال';
		var actionsVar = 'الاجراءات';
		var detailsText = 'التفاصيل';
		var enableText = 'تفعيل';
		var disableText = 'تعطيل';
		var refreshText = 'تحديث';
		var restoreText = 'استعادة';
		var forceDeleteText = 'حذف نهائي';
	}

	var iCounter = 0;
	columnsVar.push({'data': 'id', 'responsivePriority': -1});
	columnDefsVar.push(
		{
			targets: 0,
			width: '10px',
			className: 'dt-left text-center',
			orderable: false,
			render: function(data, type, full, meta) {
				return `
                <label class="checkbox checkbox-single">
                    <input type="checkbox" value="${full.id}" class="checkable"/>
                    <span></span>
                </label>`;
			},
		}
	);

	
	$.each(tableData,function(index,item){
		if(index != 'actions'){
			columnsDef.push(index);
			if(item['type'] == 'date'){
				columnsVar.push({'data': index, 'type' : item['type'],});
			}else{
				columnsVar.push({'data': index,});
			}
			if(index == 'id'){
				columnDefsVar.push({
					'targets': 1,
					'title' : item['label'],
					'orderable':true,
				});
			}else if(index == 'image'){
				columnDefsVar.push({
					'targets': getIndex(index,item) + 1,
					'title' : item['label'],
					'className': item['className'],
					render: function(data, type, full, meta) {
						let varX = item['data-col'];
						return '<span class="symbol symbol-60 mr-3"  data-toggle="tooltip" data-original-title="'+changeImage+'">'+
								"<input type='file' class='hidden tableImg' "+($('input[name="data-area"]').val() == 1 ? '' : 'disabled')+" data-area='"+full.id+"' name='"+index+"'>"+
                        		"<span class='symbol-label' style='background-image: url("+full[varX]+")'></span>"+
		                    '</span>';
					},
				});
			}else if(index == 'status'){
				columnDefsVar.push({
					'targets': getIndex(index,item) + 1,
					'title' : item['label'],
					'className': item['className'],
					render: function(data, type, full, meta) {
						return '<span class="switch switch-sm switch-icon">'+
                        		'<label>'+
                        			"<input type='checkbox'  "+($('input[name="data-area"]').val() == 1 ? '' : 'disabled')+" class='form-control' data-area='"+full.id+"' data-tabs='status'   "+(full.status == 1 ? 'checked' : '')+"/>"+
		                            '<span></span>'+
		                        '</label>'+
		                    '</span>';
					},
				});
			}else{
				columnDefsVar.push({
					'targets': getIndex(index,item) + 1,
					'title' : item['label'],
					'className': item['className'],
					render: function(data, type, full, meta) {
						var labelClass = '';
						if(getIndex(index,item) == 1){
							labelClass = full.labelClass;
						}
						return '<a class="'+item['anchor-class']+' '+labelClass+'" data-col="'+item['data-col']+'" data-id="'+full.id+'">'+data+'</a>';
					},
				});
			}
		}else{
			columnsVar.push({'data': 'id', 'responsivePriority': -1});
			columnDefsVar.push({
				targets: -1,
				title: actionsVar,
				className: 'text-center',
				width: '150px',
				orderable: false,
				render: function(data, type, full, meta) {
					var editButton = '';
					var deleteButton = '';
					var showButton = '';

					var restoreButton = '';
					var forceDeleteButton = '';

					if($('input[name="data-area"]').val() == 1){
						editButton = '<a data-toggle="tooltip" data-original-title="'+editText+'" href="/'+designElems.mainData.url+'/edit/'+data+'" class="mx-1 action-icon edit btn btn-sm btn-primary btn-icon">  <i class="icon-xl la la-edit"></i> '+editText+' </a>';
					}
					if($('input[name="data-cols"]').val() == 1){
						deleteButton = '<a data-toggle="tooltip" data-original-title="'+deleteText+'" onclick="deleteItem('+data+')" class="mx-1 action-icon btn btn-sm btn-danger btn-icon"> <i class="icon-xl la la-trash"></i></a>'
					}
					if($('input[name="data-vws"]').val() == 1){
						showButton = '<a data-toggle="tooltip" data-original-title="'+showText+'" href="/'+(designElems.mainData.url.split('?')[0]) +'/view/'+data+'" class="mx-1 action-icon btn btn-sm btn-info btn-icon"> <i class="icon-xl la la-eye"></i></a>'
					}
					if(full.deleted_at != null){
						if($('input[name="data-rows"]').val() == 1){
							restoreButton = '<a data-toggle="tooltip" data-original-title="'+restoreText+'" href="/'+designElems.mainData.url+'/restore/'+data+'" class="mx-1 action-icon btn btn-sm btn-info btn-icon"> <i class="icon-xl la la-refresh"></i></a>';
						}
						if($('input[name="data-cols"]').val() == 1){
							forceDeleteButton = '<a data-toggle="tooltip" data-original-title="'+forceDeleteText+'" href="/'+designElems.mainData.url+'/destroy/'+data+'" class="mx-1 action-icon btn btn-sm btn-danger btn-icon"> <i class="icon-xl la la-trash"></i></a>';
						}
						deleteButton = '';
					}
				
					return editButton + showButton + deleteButton + restoreButton + forceDeleteButton ;
				},
			});
		}
	});

	// begin first table
	var DataTable = table.DataTable({
		// DOM Layout settings
		dom:'Bfrtip',
		dom:
			"<'row mg-b-25'<'views'l><'listPDF'B><'searchTable'f>>" +
			"<'row'<'col-sm-12 'tr>>" +
			"<'row'<'col-xs-6 col-sm-6 col-md-6 'i><'col-xs-6 col-sm-6 col-md-6 'p>>", // read more: https://datatables.net/examples/basic_init/dom.html
        buttons: [
            {
                extend: 'colvis',
                columns: ':not(.noVis)',
                text: showCols,
            },
            {
             	extend: 'print',
             	customize: function (win) {
                   $(win.document.body).css('direction', direction);     
                },
					'exportOptions': {
			    	columns: ':not(:last-child)',
			  	},
         	},
         	{
             	extend: 'copy',
					'exportOptions': {
			    	columns: ':not(:last-child)',
			  	},
         	},
         	{
             	extend: 'excel',
					'exportOptions': {
			    	columns: ':not(:last-child)',
			  	},
         	},
         	{
             	extend: 'csv',
					'exportOptions': {
			    	columns: ':not(:last-child)',
			  	},
         	},
         	{
             	extend: 'pdf',
					'exportOptions': {
			    	columns: ':not(:last-child)',
			  	},
         	},
        ],
        oLanguage: {
			sSearch: search,
			sInfo: info,
			sLengthMenu: lengthMenu,
			sEmptyTable: emptyTable,
			sProcessing: processing,
			sInfoEmpty: infoEmpty,
			select:{
				rows: {
                	_: rows1,
                    0: "",
                    1: rows2
                }
			},
			oPaginate: {
		      	sPrevious: prev,
		      	sNext: next,
		      	sFirst: first,
		      	sLast: last,
		    },
		},
		headerCallback: function(thead, data, start, end, display) {
			thead.getElementsByTagName('th')[0].innerHTML = `
                <label class="checkbox checkbox-single">
                    <input type="checkbox" value="" class="group-checkable"/>
                    <span></span>
                </label>`;
		},
		createdRow: function( row, full, dataIndex ) {
	        // Set the data-status attribute, and add a class
	        if(full.deleted_at != null){
	        	$(row).addClass('bg-danger-o-50');
	        }
	    },
		drawCallback: function (settings) {
			$('a[data-col="color"]').each(function(index,item){
		    	$(item).css('background',$(item).text());
		    })
			$('.page-item').addClass('pagination-rounded');
			$('[data-toggle="tooltip"]').tooltip()
		},
		responsive: true,
		searchDelay: 500,
		processing: true,
		serverSide: true,
		ajax: {
			url: '/'+designElems.mainData.url,
			type: 'GET',
			data:function(dtParms){
				iCounter =1;
				$.each($('.searchForm select'),function(index,item){
			       	dtParms[$(item).attr('name')] = $(item).val();
				});
				$.each($('.searchForm input.datetimepicker-input'),function(index,item){
			       	dtParms[$(item).attr('name')] = $(item).val();
				});
				// $.each($('.searchForm input.datepicker'),function(index,item){
			    //    	dtParms[$(item).attr('name')] = $(item).val();
				// });
				$.each($('.searchForm input.datatable-input'),function(index,item){
					if($(item).attr('type') == 'checkbox'){
			       		dtParms[$(item).attr('name')] = $(item).is(":checked") ? 1 : 0;
					}else{
				       	dtParms[$(item).attr('name')] = $(item).val();
					}
				});
		        dtParms.columnsDef = columnsDef;
		        return dtParms
		    }
		},
		columns: columnsVar,
		columnDefs: columnDefsVar,
	});

	DataTable.on('change', '.group-checkable', function() {
		var set = $(this).closest('table').find('td:first-child .checkable');
		var checked = $(this).is(':checked');

		$(set).each(function() {
			if (checked) {
				$(this).prop('checked', true);
				$(this).closest('tr').addClass('active');
				$('.deleteSelected').removeClass('hidden');
			}
			else {
				$(this).prop('checked', false);
				$(this).closest('tr').removeClass('active');
				$('.deleteSelected').addClass('hidden');
			}
		});
	});

	DataTable.on('change', 'tbody tr .checkbox', function() {
		var checked = $(this).find('.checkable').is(':checked');
		$(this).parents('tr').toggleClass('active');
		if (checked) {
			$('.deleteSelected').removeClass('hidden');
		}
	});

	$(document).on('change','.datatable-input[type="checkbox"]',function(){
		$("#kt_search").trigger('click');
	});

	if ($("#kt_search")[0]) {
	    $("#kt_search").on("click", function (t) {
	        t.preventDefault();
	        var e = {};
	        $(".datatable-input").each(function () {
	            var a = $(this).data("col-index");
	            if(a){
		            e[a] ? e[a] += "|" + $(this).val() : e[a] = $(this).val();
	            }
	        });
	        $.each(e, function (t, e) {
	            DataTable.search(e || "", !1, !1);
	        });
	        DataTable.table().draw();
	    });
	}
	if ($("#kt_reset")[0]) {
	    $("#kt_reset").on("click", function (t) {
	        t.preventDefault(); 
	        $(".datatable-input").each(function () {
	            $(this).val(""); 
	            if($(this).data("col-index")){
		            DataTable.column($(this).data("col-index")).search("", !1, !1);
	            }
	        });
	        $(".searchForm select").each(function () {
	            $(this).val(" ").trigger('change'); 
	            DataTable.column($(this).data("col-index")).search("", !1, !1);
		        $('.searchForm select').selectpicker('refresh')
	        });
	        DataTable.table().draw();
	    });
	}

    $('.navi-print').on('click',function(e){
	    e.preventDefault();
	    e.stopPropagation();
	    $('.buttons-print')[0].click();
	});

	$('.navi-copy').on('click',function(e){
	    e.preventDefault();
	    e.stopPropagation();
	    $('.buttons-copy')[0].click();
	});

	$('.navi-excel').on('click',function(e){
	    e.preventDefault();
	    e.stopPropagation();
	    $('.buttons-excel')[0].click();
	});

	$('.navi-csv').on('click',function(e){
	    e.preventDefault();
	    e.stopPropagation();
	    $('.buttons-csv')[0].click();
	});

	$('.navi-pdf').on('click',function(e){
	    e.preventDefault();
	    e.stopPropagation();
	    $('.buttons-pdf')[0].click();
	});

	$('.quickEdit').on('click',function(e){
	    e.preventDefault();
	    e.stopPropagation();

	    $(this).toggleClass('opened');
	    $(this).children('i').toggleClass('flaticon2-check-mark')
	    var myDataObjs = [];
	    var i = 190;
	    $(document).find('table tbody tr td.edits').each(function(index,item){
	        var oldText = '';
	        if($('.quickEdit').hasClass('opened')){
	            var myText = $(item).find('a.editable').text();
	            $(item).find('a.editable').hide();
	            var myElem = '<span qe="scope">'+
	                            '<span>'+
	                                '<input type="text" class="form-control" qe="input" value="'+myText+'"/>'+
	                            '</span>'+
	                        '</span>';
	            if($(this).hasClass('selects')){
	                var selectOptions = '';
	                var selectName = $(this).children('a.editable').data('col');
	                var elem = $("select[name='"+selectName+"'] option");
	                elem.each(function(){
	                    var selected = '';
	                    if($(this).text() == myText){
	                        selected = ' selected';
	                    }
	                    if($(this).val() >= 0){
	                        selectOptions+= '<option value="'+$(this).val()+'" '+selected+'>'+$(this).text()+'</option>';
	                    }
	                });
	                myElem = '<span qe="scope">'+
	                            '<span>'+
	                                '<select class="form-control">'+
	                                    selectOptions+
	                                '</select>'+
	                            '</span>'+
	                        '</span>';
	            }
	            if($(this).hasClass('dates')){
	                myElem = '<span qe="scope">'+
	                            '<span>'+
	                                '<input type="text" class="form-control datetimepicker-input" id="kt_datetimepicker_'+i+'" value="'+myText+'" data-toggle="datetimepicker" data-target="#kt_datetimepicker_'+i+'"'+
	                            '</span>'+
	                        '</span>';
	            }
	            if(!$(item).find('a.dis').length){
	                $(item).append(myElem);
	            }
	            oldText = myText;
	            i++;
	        }else{
	            var myText = '';
	            var newVal = 0;
	            if($(this).hasClass('selects')){
	                myText = $(item).find('select option:selected').text();
	                newVal = $(item).find('select option:selected').val();
	            }else{
	                myText = $(item).find('input.form-control').val();
	            }
	            $(item).children('span').remove();
	            oldText = $(item).find('a.editable').text();
	            $(item).find('a.editable').text(myText);
	            $(item).find('a.editable').show();

	            if(myText != oldText){
	                var myCol = $(item).find('a.editable').data('col');
	                if($(this).hasClass('selects')){
	                    var myValue = newVal;
	                }else{
	                    var myValue = myText;
	                }
	                var myId = $(item).find('a.editable').data('id');
	                myDataObjs.push([myId,myCol,myValue]);
	            }

	        }
	    });

	    $('td.dates span span input.datetimepicker-input').datepicker({
	        enableTime:!0,
	        dateFormat:"Y-m-d H:i:s",
	    });
	    
	    if(myDataObjs[0] != null){
	        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
	        $.ajax({
	            type: 'POST',
	            url: "/"+designElems.mainData.url+'/fastEdit',
	            data:{
	                '_token': $('meta[name="csrf-token"]').attr('content'),
	                'data': myDataObjs,
	            },
	            success:function(data){
	                if(data.status == 1){
	                    successNotification(data.message);
	                    $('#kt_datatable').DataTable().ajax.reload();
	                }else{
	                    errorNotification(data.message);
	                    $('#kt_datatable').DataTable().ajax.reload();
	                }
	            },
	        });
	    }
	});
	
	$('.deleteSelected').on('click',function(e){
		e.preventDefault();
		e.stopPropagation();
		data = [];
		$.each($('table tr.active'),function(index,item){
			data.push($(item).find('.checkable').val());
		});
		$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
        $.ajax({
            type: 'POST',
            url: "/"+designElems.mainData.url+'/deleteSelected',
            data:{
                '_token': $('meta[name="csrf-token"]').attr('content'),
                'data': data,
            },
            success:function(data){
                if(data.status == 1){
                    successNotification(data.message);
					$('.deleteSelected').addClass('hidden');
                    $('#kt_datatable').DataTable().ajax.reload();
                }else{
                    errorNotification(data.message);
                    $('#kt_datatable').DataTable().ajax.reload();
                }
            },
        });
	});

	$(document).on('change','td input[type="checkbox"]',function(e){
		$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
        $.ajax({
            type: 'POST',
            url: "/"+designElems.mainData.url+'/fastEdit',
            data:{
                '_token': $('meta[name="csrf-token"]').attr('content'),
                'data': [[$(this).data('area'),$(this).data('tabs'), $(this).is(':checked') ? 1 : 0 ]],
            },
            success:function(data){
                if(data.status == 1){
                    successNotification(data.message);
                    $('#kt_datatable').DataTable().ajax.reload();
                }else{
                    errorNotification(data.message);
                    $('#kt_datatable').DataTable().ajax.reload();
                }
            },
        });
	});

	$(document).on('click','.symbol-label',function(){
		$(this).siblings('input[type="file"]').click();
	});

	$(document).on('change','.tableImg',function(){
		var id =  $(this).data('area');
		var column =  $(this).attr('name');
		var formData = new FormData();
	    formData.append('id', id);
	    formData.append(column, $(this)[0].files[0]);
		$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
		$.ajax({
	        type:'POST',
	        url: "/"+designElems.mainData.url+'/uploadImg',
	        data:formData,
	        cache:false,
	        contentType: false,
	        processData: false,
	        success:function(data){
	            if(data.status == 1){
	            	successNotification(data.message);
	            }else{
	            	errorNotification(data.status.message);
	            }
	        },
	        error: function(data){
	            errorNotification(data.status.message);
	        }
	    });
        $('#kt_datatable').DataTable().ajax.reload();
	})

	var arrows;
    if (lang == 'ar') {
        arrows = {
         	leftArrow: '<i class="la la-angle-right"></i>',
         	rightArrow: '<i class="la la-angle-left"></i>'
        }
    } else {
        arrows = {
         	leftArrow: '<i class="la la-angle-left"></i>',
         	rightArrow: '<i class="la la-angle-right"></i>'
        }
    }

	$('#kt_datepicker_5').datepicker({
       rtl: lang == 'ar' ?? 0,
       todayHighlight: true,
       templates: arrows
    });
});