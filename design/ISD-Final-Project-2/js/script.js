$(document).ready(function() {
	var summary_filter={
		type:{
			flag:false,
			title_name:"Article Type",
			contents:["Clinical Trial","Review","Autobiography"]
		},
		species:{
			flag:false,
			title_name:"Species",
			contents:["Humans","Other Animals"]
		},
		subject:{
			flag:false,
			title_name:"Subject",
			contents:["AIDS","Cancer","Systematic Reviews"]
		},
		ages:{
			flag:false,
			title_name:"Ages",
			contents:["Child:birth-18years","Adult:19+years","Aged:65+years"]
		}
	}
	var tool={
		summary_page_init:function(){
			$('.summary-table').find('.table-operate').find('.currentpage').text(summarypage.current);
			$('.summary-table').find('.table-operate').find('.totalpage').text(summarypage.total);
			$('.summary-table').find('.table-operate').find('select').val(summarypage.shownum);
		},
		detail_page_init:function(){
			$('.details-table').find('.table-operate').find('.currentpage').text(detailpage.current);
			$('.details-table').find('.table-operate').find('.totalpage').text(detailpage.total);
			$('.details-table').find('.table-operate').find('select').val(detailpage.shownum);
		},
		class_toggle:function (object,cls) {
			object.bind('click', function(event) {
				$(this).parent('ul').find('li').removeClass(cls);
				$(this).addClass(cls);
			});
		},
		help_toggle:function(object,cls,index){
			object.bind('click', function(event) {
				$(this).parent('ul').find('li').removeClass(cls);
				$(this).addClass(cls);
				var num= index+1;
				var src = "images/picture"+num+".png";
				$('.help-body').find('img').attr('src', src);
			});
		},
		filter_toggle:function(object,cls){
			object.bind('click',function(event){
				if ($(this).hasClass(cls)) {
					$(this).removeClass(cls);
				}else{
					$(this).addClass(cls);
				}
			})
		},
		summary_table:function(){
			summarypage.total=Math.ceil(summary.length/summarypage.shownum);
			this.summary_page_init();
			var firstitem = summarypage.current==1?0:(summarypage.current-1)*summarypage.shownum
			var lastitem = summary.length>firstitem?parseInt(firstitem)+parseInt(summarypage.shownum):summary.length;	
			$('.summary-table').find('table').find('tbody').children('tr').remove();
			for (var i = firstitem; i < lastitem; i++) {
				var tr = $('<tr></tr>');
				var k=summary[i];
				for(var j in k){
					if (j==='Link') {
						var td=$('<td><p></p></td>').appendTo(tr);
					}else{
						var td = $('<td>'+k[j]+'</td>').appendTo(tr);
					}
				}
				tr.appendTo('.summary-table tbody');
			}
		},
		details_table:function(){
			detailpage.total=Math.ceil(detail.length/detailpage.shownum);
			this.detail_page_init();
			var firstitem = detailpage.current==1?0:(detailpage.current-1)*detailpage.shownum
			var lastitem = detail.length>firstitem?parseInt(firstitem)+parseInt(detailpage.shownum):summary.length;
			$('.details-table').find('table').find('tbody').children('tr').remove();
			for (var i = firstitem; i < lastitem; i++) {
				var tr = $('<tr></tr>');
				var k=detail[i];
				for(var j in k){
					if (j==='Article') {
						var td=$('<td><span></span></td>').appendTo(tr);
					}else{
						var td = $('<td>'+k[j]+'</td>').appendTo(tr);
					}
				}
				tr.appendTo('.details-table .table tbody');
			}
		},
		class_delete:function (object,cls) {
			object.removeClass(cls);
		},
		class_add:function(object,cls){
			object.addClass(cls);
		},
		shadow:function () {
			$('.shadow-wait').addClass('hidden');
			$('.search-box').addClass('hidden');
			$('.content').removeClass('hidden');
			$('.search').removeClass('hidden');
			$('header').find('span').removeClass('hidden');
			$('.sub-search-box').removeClass('hidden');
		},
		back_home:function(){
			$('.search-box').removeClass('hidden');
			$('.content').addClass('hidden');
			$('.search').addClass('hidden');
			$('header').find('span').addClass('hidden');
			$('.sub-search-box').addClass('hidden');
		},
		layout:function(){
			$('article').css('width',$('.content').width()-320);
			$('.mainbody').css('height',$(window).height());
			$('.sub-search-box').css('width',$('.content').width()-320)
			$(window).resize(function(event) {
				$('article').css('width',$('.content').width()-320);
				$('.mainbody').css('height',$(window).height());
				$('.sub-search-box').css('width',$('.content').width()-320)
			})
		},
		filter_change:function(){
			$('#change_filter').bind('click', function(event) {
				$('.additional_filter').each(function(index, el) {
					var checked = $(this).find("input[type='checkbox']").is(':checked');
					var name = $(this).find("input[type='checkbox']").attr('value');
					if (checked) {
						summary_filter[name].flag=true;
					}else{
						summary_filter[name].flag=false;
					}
				});
				tool.filter_add();
			});
		},
		filter_add:function(){
			$('.addtion').nextAll('.sub-filter').remove();
			for (var each in summary_filter){
				if (summary_filter[each].flag) {
					var filter_name = summary_filter[each].title_name;
					var sub_filter=$('<div class=\'sub-filter\'></div>');
					var sub_title=$('<h2>Filter By '+filter_name+'</h2>').appendTo(sub_filter);
					var sub_clear=$('<span>Clear</span>').appendTo(sub_filter);
					var sub_ul = $('<ul class=\"hidden\"></ul>').appendTo(sub_filter);
					for (var i = 0; i < summary_filter[each].contents.length; i++) {
						var sub_li = $('<li>'+summary_filter[each].contents[i]+'</li>').appendTo(sub_ul);
						tool.class_toggle($(sub_li),"filter-selected");
					};
					$(sub_filter).insertBefore('.summary p');
					sub_title.bind('click', function(event) {
						$(this).toggleClass('dropdown');
						if ($(this).hasClass('dropdown')) {
							$(this).parent('.sub-filter').find('ul').removeClass('hidden');
						}else{
							$(this).parent('.sub-filter').find('ul').addClass('hidden');
						}
					});
				};
			};
			tool.class_add($('.filter').find('li'),'filter-unselected');
			tool.class_add($('.sub-filter').find('h2'),'drop');
			$('.sub-filter').find('span').bind('click', function(event) {
				$(this).parent('.sub-filter').find('li').removeClass('filter-selected');
			});
		},
		filter_drop:function(){	
			$('.sub-filter').find('h2').bind('click', function(event) {
				$(this).toggleClass('dropdown');
				if ($(this).hasClass('dropdown')) {
					$(this).parent('.sub-filter').find('ul').removeClass('hidden');
				}else{
					$(this).parent('.sub-filter').find('ul').addClass('hidden');
				}
			});
		}
	};
	tool.class_toggle($('.sub-search-box').find('li'),"sub-selected");
	tool.class_toggle($('.search-box').find('li'),"selected");
	tool.class_add($('.filter').find('li'),'filter-unselected');
	tool.class_add($('.sub-filter').find('h2'),'drop');
	tool.class_add($('.sub-filter').find('ul'),'hidden');
	tool.layout();
	tool.filter_change();
	tool.filter_drop();
	$('header').find('span').bind('click', function(event) {
		tool.back_home();
	});
	$('section').each(function(index, el) {
		$(this).find('.sub-filter').each(function(index, el) {
			if (index==0) {
				tool.filter_toggle($(this).find('li'),'filter-selected');
			}else{
				tool.class_toggle($(this).find('li'),'filter-selected');
			}
		});
	});
	$('.summary p').bind('click', function(event) {
		tool.class_delete($('#summary_additional_filter'),'hidden');
		$('#summary_additional_filter').css({
			top: $('.summary p').offset().top-$('#summary_additional_filter').height()
		});
	});

	$('.additional_filter_close').bind('click', function(event) {
		$(this).parent('.filter_option').addClass('hidden');
	});


	$('nav').find('li').bind('click', function(event) {
		$(this).parent('ul').find('li').removeClass('active');
		$(this).addClass('active');
		$('section').addClass('hidden');
		$('section').eq($(this).index()).removeClass('hidden').css({left:40,opacity:0}).animate({left: 0,opacity:1}, 200);
		$('article').addClass('hidden');
		$('article').eq($(this).index()).removeClass('hidden');
	});

	$('#submit').bind('click', function(event) {
		$('.shadow-wait').removeClass('hidden');
		setTimeout(tool.shadow,2000);
		tool.summary_table();
		tool.details_table();
		$('.details-table').find('table').find('span').bind('click', function(event) {
		$('.details-table').find('.table').addClass('hidden');
		$('.sub-table').animate({width: $('article').outerWidth()}, 100);
	});
	});

	$('#sub-submit').bind('click', function(event) {
		$('.shadow-wait').removeClass('hidden');
		setTimeout(tool.shadow,2000);
	});

	$('.sub-filter').find('span').bind('click', function(event) {
		$(this).parent('.sub-filter').find('li').removeClass('filter-selected');
	});

	$('.filter').find('section').each(function(index, el) {
		$(this).find('span').eq(0).bind('click', function(event) {
			$(this).parent('section').find('li').removeClass('filter-selected');
		});
	});

	
	$('.goback').bind('click', function(event) {
		$('.details-table').find('.table').removeClass('hidden');
		$('.sub-table').animate({width: 0}, 100);
	});

	$('.summary-table').find('.table-operate').find('select').on('change', function(event) {
		event.preventDefault();
		summarypage.shownum=$(this).val();
		tool.summary_table();
	});
	$('.summary-table').find('.table-operate').find('.pre').on('click', function(event) {
		event.preventDefault();
		if (summarypage.current==1) {
			alert('It\'s the first page!');
		}else{
			summarypage.current=summarypage.current-1;
		}
		tool.summary_table();
	});

	$('.summary-table').find('.table-operate').find('.next').on('click', function(event) {
		event.preventDefault();
		if (summarypage.current==summarypage.total) {
			alert('It\'s the last page!');
		}else{
			summarypage.current=summarypage.current+1;
		}
		tool.summary_table();
	});


	$('.details-table').find('.table-operate').find('select').on('change', function(event) {
		event.preventDefault();
		detailpage.shownum=$(this).val();
		tool.details_table();
	});
	$('.details-table').find('.table-operate').find('.pre').on('click', function(event) {
		event.preventDefault();
		if (detailpage.current==1) {
			alert('It\'s the first page!');
		}else{
			detailpage.current=detailpage.current-1;
		}
		tool.details_table();
	});

	$('.details-table').find('.table-operate').find('.next').on('click', function(event) {
		event.preventDefault();
		if (detailpage.current==detailpage.total) {
			alert('It\'s the last page!');
		}else{
			detailpage.current=detailpage.current+1;
		}
		tool.details_table();
	});

	tool.filter_toggle($('.table-sort').find('li'),'subselected');

	$('.help-option').find('li').each(function(index, el) {
			tool.help_toggle($(this),'filter-selected',index);
			
	});

});