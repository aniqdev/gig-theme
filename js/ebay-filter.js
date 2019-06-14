// плагин multiselect
// https://davidstutz.github.io/bootstrap-multiselect/

// плагин ползунок
// https://api.jqueryui.com/slider/

var ajax_url = 'https://parser.gig-games.de/ajax-cross.php?action=ajax-ebay-filter';
// ajax_url = 'http://parser/ajax-cross.php?action=ajax-ebay-filter';


var qs = (function(a) { // query string
    if (a == "") return {};var b = {};
    for (var i = 0; i < a.length; ++i){
        var p=a[i].split('=', 2);
        if (p.length == 1) b[p[0]] = "";
        else b[p[0]] = decodeURIComponent(p[1].replace(/\+/g, " "));
    }return b;
})(window.location.search.substr(1).split('&'));

function get_partner_link(url){
	return 'https://rover.ebay.com/rover/1/707-53477-19255-0/1?icep_id=114&ipn=icep&toolid=20004&campid=5338243349&mpre='+encodeURIComponent(url)
}

function steam_to_gig(appid){ if(!appid) return 0; return +appid + 555555; }
function gig_to_steam(appid){ if(!appid) return 0; return +appid - 555555; }

var pic_hashes;

var slider_values1 = [0,100];
var slider_values2 = [0,100];
var slider_values3 = [0,100];
var slider_values4 = [0,100];
var slider_values5 = [1,100];

var send_default = {action: 'get_filter_count',
			volume: 'total',
			steam_table: 'steam_de',
			type: '',
			year: '',
			year_from: '',
			year_to: '',
			max_reviews: '',
			rating: '',
			our_price: '',
			steam_price: '',
			advantage: '',
			search: '',
			order_by: 'reviews_desc',
			offset: 0,
			limit: 20,
			fields: {os:['win','mac','linux']}};
var send = $.extend({}, send_default);


var FilterApp = React.createClass({
  getInitialState: function() {
	return {tops:{month_top:[],rpg_top:[],strategie_top:[],abenteuer_top:[],top_2015:[]},
	count: 0, data: {year:[]}, opt_from: 0, opt_to: 3000, results:[], pagination:'',
	t:0,translations:0};
  },

  __:function(slug) { // функция для смены языков интерфейса
  	return (this.state.t && this.state.t[slug]) ? this.state.t[slug] : slug;
  },

  load_data: function(steam_table) {
	
	var F_this = this;

	$.post(ajax_url,
		{action:'get_filter_data', steam_table:steam_table},
		function(data) {

			if(!data) return false;
			F_this.setState({data:data});

			pic_hashes = data.picture_hashes;

			var genres_data = data.genres.map(function(el) {
				return {title: el.v, label: el.v, value: el.v};	});
			$('#genre_select').multiselect('dataprovider', genres_data);

			var tags_data = data.tags.map(function(el) {
				return {title: el.v, label: el.v, value: el.v};	});
			$('#tag_select').multiselect('dataprovider', tags_data);

			var developer_data = data.specs.map(function(el) {
				return {title: el.v, label: el.v, value: el.v};	});
			$('#specs_select').multiselect('dataprovider', developer_data);

			var publisher_data = data.lang.map(function(el) {
				return {title: el.v, label: el.v, value: el.v};	});
			$('#lang_select').multiselect('dataprovider', publisher_data);

			// костыль для смены надписи на мультиселекте - продолжение
			// так как код выше рефрешет мультиселект применяя дефолтные опции
		  	$('.ef-choose-btn .multiselect-selected-text').text(F_this.__('choose_an_option'));

		}, 'json');
  },

  changeLangClick: function(e) {

  	$('.gig-lang').removeClass('actv');
  	$(e.target).addClass('actv');
  	send.steam_table = e.target.id;
  	this.load_data(send.steam_table);
  	this.setState({t:this.state.translations[send.steam_table]});
  	this.resetFilter({scroll_up:false});

	// костыль для смены надписи на мультиселекте - начало
  	$('.ef-choose-btn .multiselect-selected-text').text(this.state.translations[send.steam_table]['choose_an_option']);
  },

  resetFilter: function(opts) {

	var opts = $.extend({scroll_up:true}, opts);
	var F_this = this;

	// сброс мультиселектов
	document.forms.first_form.reset();
	document.forms.second_form.reset();
	$('#genre_select').multiselect('refresh');
	$('#tag_select').multiselect('refresh');
	$('#specs_select').multiselect('refresh');
	$('#lang_select').multiselect('refresh');
	$('#dlc_select').multiselect('refresh');

	// сброс платформ
	// document.forms.platforms.reset();
	$('.f-platinp').each(function(){this.checked = false;});
	$('.checked_by_default').each(function(){this.checked = true;});

	// сброс годов
	document.forms.years.reset();

	// сброс ползунков
	$( "#slider-range1" ).slider('values', slider_values1);
	$( "#amount10" ).val(slider_values1[0]);
	$( "#amount11" ).val(slider_values1[1]);
	$( "#slider-range2" ).slider('values', slider_values2);
	$( "#amount20" ).val(slider_values2[0]);
	$( "#amount21" ).val(slider_values2[1]);
	$( "#slider-range3" ).slider('values', slider_values3);
	$( "#amount30" ).val(slider_values3[0]);
	$( "#amount31" ).val(slider_values3[1]);
	$( "#slider-range4" ).slider('values', slider_values4);
	$( "#amount40" ).val(slider_values4[0]);
	$( "#amount41" ).val(slider_values4[1]);
	$( "#slider-range5" ).slider('values', slider_values5);
	$( "#amount50" ).val(slider_values5[0]);
	$( "#amount51" ).val(slider_values5[1]);

	// сброс поля search
	this.refs.search.value = '';

	// сброс объекта send
	send = $.extend({}, send_default);
	send.fields = {os:['win','mac','linux']};
	send.steam_table = $('.gig-lang.actv').attr('id');

	// скрываем дисплей
	$('#h_elem').removeClass('show');
	$('#f_bestsales').removeClass('transpar');

	// прокрутка вверх страницы
	if(opts.scroll_up){
		$('body,html').animate({scrollTop: 0}, 1000, 'swing', function() {
			// удаление результатов
			F_this.setState({results:[], pagination:''});
		});
	}else{
		F_this.setState({results:[], pagination:''});
	}

  },

  scrollToResults: function() {
	//узнаем высоту от начала страницы до блока на который ссылается якорь
	var top = $('#search_results_header').offset().top;
	//анимируем переход на расстояние - top за 1000 мс
	$('body,html').animate({scrollTop: top}, 1000);
  },

  showResults: function(e) {
  	this.scrollToResults();

	var F_this = this;
	send.action = 'get_filter_results';
	send.count = this.state.count;
	$.post(ajax_url,
		send,
		function(data) {
			// console.log(data)
			F_this.setState({results:data.results, pagination:data.pagination});
		}, 'json');
  },

  showResultsClick: function() {
	send.offset = 0;
  	this.showResults();
  },

  get_count: function(target_name) {
	if (target_name !== 'search'){ // обнуляем поле search, если вновь использован фильтр
		this.refs.search.value = '';
		send.search = '';
	}
	var F_this = this;
	send.action = 'get_filter_count';
	$('.f-num-res').removeClass('scaled');
	$.post(ajax_url,
		send,
		function(data) {
			F_this.setState({count:data.count});
			$('#h_elem').addClass('show');
			$('#f_bestsales').addClass('transpar');
			$('.f-num-res').addClass('scaled');
		}, 'json');
  },

  platformChange: function(e) {
	var platforms_arr = [];
	// $('.f-platinp:checked').map(function(i,el){platforms_arr.push(el.value)});
	document.querySelectorAll('.f-platinp:checked').forEach(function(el){platforms_arr.push(el.value)});
	send.fields['os'] = platforms_arr;
	this.get_count();
  },

  yearChange: function(e) {
	// console.log(e.target.name + ' => ' + e.target.value);
	if(e.target.name === 'year'){
		$('#year_select2').val('all');
		$('#year_select3').val('all');
		send.year = e.target.value;
		send.year_from = '';
		send.year_to = '';
		this.setState({opt_from:0, opt_to: 3000});
		this.get_count();
	}else{
		$('#year_select1').val('all');
		send.year = '';
		send.year_from = $('#year_select2').val();
		this.setState({opt_from:+send.year_from});
		send.year_to = $('#year_select3').val();
		this.setState({opt_to:(send.year_to)?send.year_to:3000});
		this.get_count();
	}
  },

  drawYears: function(opt_from, opt_to) {
	return this.state.data.year.map((el,i)=>{
			if (opt_from) {
				if (el.v <= opt_from) {
					return (<option disabled value={el.v}>{el.v}</option>);
				}else{
					return (<option value={el.v}>{el.v}</option>);
				}
			}
			if (opt_to) {
				if (el.v >= opt_to) {
					return (<option disabled value={el.v}>{el.v}</option>);
				}else{
					return (<option value={el.v}>{el.v}</option>);
				}
			}
		});
  },

  sortChange: function(e) {
	send.order_by = e.target.value;
	this.showResults();
  },

  searchChange: function(e) {
	if (e.target.value.length > 2) {
		send.search = e.target.value;
		this.get_count(e.target.name);
	}
  },

  searchSubmit: function(e){
	e.preventDefault();
	this.showResultsClick();
  },

  gameClick: function(id,title) {
	$.post(ajax_url, {action:'game_click', ebay_id:id, ebay_title:title});
  },

  componentWillMount: function(){

	var F_this = this;

	$.post(ajax_url,
		{action:'get_translations', for:'gig-games'},
		function(data) {
			F_this.setState({translations:data.translations,
				t:data.translations[send.steam_table]})
		},'json');
  },

  componentDidMount: function() {

	var F_this = this;
	
	// =========================================================
	// ==============   фиксируем меню при прокрутке
	var h_elem = $('#h_elem');
	var h_parent_offset = $('#h_parent').offset().top; // высота шапки
	// var h_scroll_top= $(window).scrollTop();
	var h_scroll_top= window.pageYOffset;
	var is_mfixed = false; // чтоб не дергать addClass и removeClass при скроле, а только при смене значений
	 
	if(h_scroll_top > h_parent_offset){
		is_mfixed = true;
		h_elem.addClass('mfixed');
	}           
	 
	window.onscroll = function(){
		// h_scroll_top= $(window).scrollTop();
		h_scroll_top= window.pageYOffset;
		 
		if (h_scroll_top > h_parent_offset) {
			if(!is_mfixed) h_elem.addClass('mfixed');
			is_mfixed = true;
		}else{
			if(is_mfixed) h_elem.removeClass('mfixed');
			is_mfixed = false;
		}
	}
	// =========================================================
	var multiselect_options = {
		enableFiltering: true,
		buttonWidth: '100%',
		maxHeight: 500,
		enableCaseInsensitiveFiltering: true,
		buttonClass: 'btn ef-choose-btn',
		nonSelectedText: 'wähle eine Option',
		// nonSelectedText: this.__('choose_an_option'),
		onChange: function(element, checked) {
			send.fields[element[0].parentNode.title] = element.parent().val();
			F_this.get_count();
		},
	};

	$('#genre_select').multiselect(multiselect_options);
	$('#tag_select').multiselect(multiselect_options);
	$('#specs_select').multiselect(multiselect_options);
	$('#lang_select').multiselect(multiselect_options);
	$('#dlc_select').multiselect({buttonWidth: '100%',
		onChange: function(element, checked){
			send.type = element.parent().val();
			F_this.get_count();
	}});

	
	var slider_options1 = { // max_reviews
		min: 0,	max: 100, range: true, values: slider_values1,
		slide: function( event, ui ) {
			$( "#amount10" ).val(ui.values[ 0 ]);
			$( "#amount11" ).val(ui.values[ 1 ]);
		},
		change: function( event, ui ) {
			if (event.bubbles) {
				send.max_reviews = [ ui.values[0], ui.values[1] ];
				F_this.get_count();
			}
		}
	};
	$( "#slider-range1" ).slider(slider_options1);
	$( "#amount10" ).val(slider_values1[0]);
	$( "#amount11" ).val(slider_values1[1]);
	
	var slider_options2 = { // rating
		min: 0,	max: 100, range: true, values: slider_values2,
		slide: function( event, ui ) {
			$( "#amount20" ).val(ui.values[ 0 ]);
			$( "#amount21" ).val(ui.values[ 1 ]);
		},
		change: function( event, ui ) {
			if (event.bubbles) {
				send.rating = [ ui.values[0], ui.values[1] ];
				F_this.get_count();
			}
		}
	};
	$( "#slider-range2" ).slider(slider_options2);
	$( "#amount20" ).val(slider_values2[0]);
	$( "#amount21" ).val(slider_values2[1]);
	
	var slider_options3 = { // our_price
		min: 0,	max: 55, range: true, values: slider_values3,
		slide: function( event, ui ) {
			$( "#amount30" ).val(ui.values[ 0 ]);
			$( "#amount31" ).val(ui.values[ 1 ]);
		},
		change: function( event, ui ) {
			if (event.bubbles) {
				send.our_price = [ ui.values[0], ui.values[1] ];
				F_this.get_count();
			}
		}
	};
	$( "#slider-range3" ).slider(slider_options3);
	$( "#amount30" ).val(slider_values3[0]);
	$( "#amount31" ).val(slider_values3[1]);
	
	var slider_options4 = { // steam_price
		min: 0,	max: 100, range: true, values: slider_values4,
		slide: function( event, ui ) {
			$( "#amount40" ).val(ui.values[ 0 ]);
			$( "#amount41" ).val(ui.values[ 1 ]);
		},
		change: function( event, ui ) {
			if (event.bubbles) {
				send.steam_price = [ ui.values[0], ui.values[1] ];
				F_this.get_count();
			}
		}
	};
	$( "#slider-range4" ).slider(slider_options4);
	$( "#amount40" ).val(slider_values4[0]);
	$( "#amount41" ).val(slider_values4[1]);
	
	var slider_options5 = { // advantage
		min: 1,	max: 100, range: true, values: slider_values5,
		slide: function( event, ui ) {
			$( "#amount50" ).val(ui.values[ 0 ]);
			$( "#amount51" ).val(ui.values[ 1 ]);
		},
		change: function( event, ui ) {
			if (event.bubbles) {
				send.advantage = [ ui.values[0], ui.values[1] ];
				F_this.get_count();
			}
		}
	};
	$( "#slider-range5" ).slider(slider_options5);
	$( "#amount50" ).val(slider_values5[0]);
	$( "#amount51" ).val(slider_values5[1]);


	$('.f-pagination').on('click', 'a', function() {
		if (this.title !== 'current page') {
			send.offset = this.title;
			F_this.showResults();
		}
	})

	// =====================================================================

	this.load_data(send.steam_table);

	// =====================================================================
	$.post(ajax_url,
		{action:'get_tops'},
		function(data) {
			F_this.setState({tops:data});
		}, 'json');

	if(Object.keys(qs).length){

		if (qs.search && qs.search.length > 2) {
			send.search = qs.search;
			this.refs.search.value = qs.search;
		}
		if (qs.genre && qs.genre.length > 1) send.fields.genres = [qs.genre];
		if (qs.tag && qs.tag.length > 1) send.fields.tags = [qs.tag];
		if (qs.spec && qs.spec.length > 1) send.fields.specs = [qs.spec];
		if (qs.lang && qs.lang.length > 1) send.fields.lang = [qs.lang];
		if (qs.os && qs.os.length > 1) send.fields.os = [qs.os];
		if (qs.release && qs.release.length > 1) send.year = qs.release;
		if (qs.developer && qs.developer.length > 1) send.developer = qs.developer;
		if (qs.publisher && qs.publisher.length > 1) send.publisher = qs.publisher;

		this.showResultsClick();

		setTimeout(function(){
  			F_this.scrollToResults();
		}, 1000);
	} // if(qs)
	
  },

  header: function() {
  	return '';
  	return(<div>
  		<div className="container">
			<div className="row gig-header">
				<div className="col-sm-4 f-logo-side">
					<div onClick={this.changeLangClick} className="gig-langs">
						<label title="Deutsch" id="steam_de" className="gig-lang gig-lang1 actv"></label>
						<label title="English" id="steam_en" className="gig-lang gig-lang2"></label>
						<label title="Français" id="steam_fr" className="gig-lang gig-lang3"></label>
						<label title="Español" id="steam_es" className="gig-lang gig-lang4"></label>
						<label title="Italiano" id="steam_it" className="gig-lang gig-lang5"></label>
					</div>
					<div className="gig-logo-holder">
						<img className="gig-logo" src="//hot-body.net/gig-less/images/logo2.png" alt="" width="207" height="31"/>
					</div>
				</div>
				<div className="col-sm-8 pos-stat">
					<div className="f-menu">
						<a href="#" className="f-menu-item">Detailsuche</a>
						<a href="#" className="f-menu-item">Aktivierungsanleitung</a>
						<a href="#" className="f-menu-item">Über uns</a>
					</div>
				</div>
			</div>

		</div>
		
		<div className="f-full-width-line"></div>
	</div>)
  },

  render: function() {
	return (
	<div className="f-main-bg">
		{this.header()}
		<div className="container pos-rel">
			<div className="f-right-bg bg-dark"></div>
			<div className="row">
				<div className="col-sm-9">
					<div className="f-we-know text-center">{this.__('wellcome')}</div>
					<div className="f-number"><b>1</b>{this.__('game_feature')}</div>
					<form className="row" name="first_form">
						<div className="col-sm-4">
							<br/><label htmlFor="">{this.__('genres')}</label>
							<select id="genre_select" title="genres" name="genre[]" multiple className="form-control"></select>
						</div>
						<div className="col-sm-4">
							<br/><label htmlFor="">{this.__('tags')}</label>
							<select id="tag_select" title="tags" name="tag[]" multiple className="form-control"></select>
						</div>
						<div className="col-sm-4">
							<br/><label htmlFor="">{this.__('specifications')}</label>
							<select id="specs_select" title="specs" name="tag[]" multiple className="form-control"></select>
						</div>
					</form>
					<form className="row" name="second_form">
						<div className="col-sm-4">
							<br/><label htmlFor="">{this.__('app_dlc')}</label>
							<select id="dlc_select" className="form-control">
								<option value="">{this.__('all')}</option>
								<option value="app">{this.__('app')}</option>
								<option value="dlc">{this.__('dlc')}</option>
							</select>
						</div>
						<div className="col-sm-4">
							<br/><label htmlFor="">{this.__('language')}</label>
							<select id="lang_select" title="lang" name="tag[]" multiple className="form-control"></select>
						</div>
					</form>
					<div className="f-number"><b>2</b>{this.__('system')}</div>
					<form onChange={this.platformChange} className="row f-check-platform" name="platforms">
						<div className="col-sm-2 col-xs-4">
							<input defaultChecked="true" className="f-platinp checked_by_default" id="f-platinp1" type="checkbox" value="win"/>
							<label htmlFor="f-platinp1" title="Windows"></label>
						</div>

						<div className="col-sm-2 col-xs-4">
							<input defaultChecked="checked" className="f-platinp checked_by_default" id="f-platinp2" type="checkbox" value="mac"/>
							<label htmlFor="f-platinp2" title="Mac"></label>
						</div>

						<div className="col-sm-2 col-xs-4">
							<input defaultChecked="checked" className="f-platinp checked_by_default" id="f-platinp3" type="checkbox" value="linux"/>
							<label htmlFor="f-platinp3" title="Linux"></label>
						</div>

						<div className="col-sm-2 col-xs-4">
							<input className="f-platinp" id="f-platinp4" type="checkbox" value="htcvive"/>
							<label htmlFor="f-platinp4" title="HTC Vive"></label>
						</div>

						<div className="col-sm-2 col-xs-4">
							<input className="f-platinp" id="f-platinp5" type="checkbox" value="razerosvr"/>
							<label htmlFor="f-platinp5" title="razerosvr"></label>
						</div>

						<div className="col-sm-2 col-xs-4">
							<input className="f-platinp" id="f-platinp6" type="checkbox" value="oculusrift"/>
							<label htmlFor="f-platinp6" title="Oculus Rift"></label>
						</div>
					</form>
					<div className="f-number"><b>3</b>{this.__('years')}</div>
					<form onChange={this.yearChange} className="row" name="years">
						<div className="col-sm-6">
							<br/><label>{this.__('year')}</label>
							<select id="year_select1" name="year" className="form-control">
								<option value="all">{this.__('all')}</option>
								{this.state.data.year.map((el,i)=>{
									return (<option value={el.v}>{el.v}</option>)
								})}
							</select>
						</div>
						<div className="col-sm-6">
							<br/><div className="row">
								<div className="col-xs-12">
									<label>{this.__('or_interval')}</label>
								</div>
								<div className="col-xs-6">
									<label htmlFor="" className="f-year-label">{this.__('from')}</label>
									<select id="year_select2" name="year_from" className="form-control f-year-inp">
										<option value="all">{this.__('all')}</option>
										{this.drawYears(0, this.state.opt_to)}
									</select>
								</div>
								<div className="col-xs-6">
									<label htmlFor="" className="f-year-label">{this.__('to')}</label>
									<select id="year_select3" name="year_to" className="form-control f-year-inp">
										<option value="all">{this.__('all')}</option>
										{this.drawYears(this.state.opt_from, 3000)}
									</select>
								</div>
							</div>
						</div>
					</form>
					<div className="f-number"><b>4</b>{this.__('rating')}</div>
					<div className="row f-range-row">
						<div className="col-sm-6">
							<div className="row">
								<div className="col-xs-5">
									<label htmlFor="amount" className="f-label1">{this.__('degree')}:</label>
								</div>
								<div className="col-xs-7 text-right">
									<input className="f-amount" type="text" id="amount10" disabled/> –&nbsp;
									<input className="f-amount" type="text" id="amount11" disabled/>
								</div>
							</div>
						</div>
						<div className="col-sm-6">
							<div className="slider-range-tips">
								<b className="f-tip f-tip1">{this.__('unknown')}</b><b className="f-tip f-tip2">{this.__('very_famous')}</b>
							</div>
							<div id="slider-range1"></div>
						</div>
					</div>
					<div className="row f-range-row">
						<div className="col-sm-6">
							<div className="row">
								<div className="col-xs-5">
									<label htmlFor="amount">{this.__('review')}:</label>
								</div>
								<div className="col-xs-7 text-right">
									<input className="f-amount" type="text" id="amount20" disabled/> –&nbsp;
									<input className="f-amount" type="text" id="amount21" disabled/>
								</div>
							</div>
						</div>
						<div className="col-sm-6">
							<div id="slider-range2"></div>
						</div>
					</div>
					<div className="f-number"><b>5</b>{this.__('price')}</div>
					<div className="row f-range-row">
						<div className="col-sm-6">
							<div className="row">
								<div className="col-xs-5">
									<label htmlFor="amount">{this.__('our_price')}:</label>
								</div>
								<div className="col-xs-7 text-right">
									<input className="f-amount" type="text" id="amount30" disabled/> –&nbsp;
									<input className="f-amount" type="text" id="amount31" disabled/>
								</div>
							</div>
						</div>
						<div className="col-sm-6">
							<div id="slider-range3"></div>
						</div>
					</div>
					<div className="row f-range-row">
						<div className="col-sm-6">
							<div className="row">
								<div className="col-xs-5">
									<label htmlFor="amount">{this.__('steam_price')}:</label>
								</div>
								<div className="col-xs-7 text-right">
									<input className="f-amount" type="text" id="amount40" disabled/> –&nbsp;
									<input className="f-amount" type="text" id="amount41" disabled/>
								</div>
							</div>
						</div>
						<div className="col-sm-6">
							<div id="slider-range4"></div>
						</div>
					</div>
					<div className="row f-range-row">
						<div className="col-sm-6">
							<div className="row">
								<div className="col-xs-5">
									<label htmlFor="amount">{this.__('advantage')}:</label>
								</div>
								<div className="col-xs-7 text-right">
									<input className="f-amount" type="text" id="amount50" disabled/> –&nbsp;
									<input className="f-amount" type="text" id="amount51" disabled/>
								</div>
							</div>
						</div>
						<div className="col-sm-6">
							<div id="slider-range5"></div>
						</div>
					</div>

					<div className="f-number"><b>6</b>{this.__('use_search')}</div>
					<form onSubmit={this.searchSubmit} className="search-frm">
						<input onChange={this.searchChange} className="gig-search" name="search" ref="search" type="text" placeholder={this.__('search')}/>
						<button className="search-sbmt" type="submit"></button>
					</form>

					<div className="f-star">{this.__('may_differ')}</div>

					<div id="search_results_header" className="f-search-header bg-dark color-aqua clearfix"><b className="f-res-header f-float-l">{this.__('search_results')}: </b>
						<nav className="f-pagination f-float-l" dangerouslySetInnerHTML={{__html: this.state.pagination}}></nav>
						<div className="f-sort-by">{this.__('sort_by')}:
							<select onChange={this.sortChange} className="f-select">
								<option value="reviews_desc">{this.__('reviews_desc')}</option>
								<option value="rating_desc">{this.__('rating_desc')}</option>
								<option value="rating_asc">{this.__('rating_asc')}</option>
								<option value="price_asc">{this.__('price_asc')}</option>
								<option value="price_desc">{this.__('price_desc')}</option>
								<option value="advantage_desc">{this.__('advantage_desc')}</option>
							</select>
						</div>
					</div>

					{this.state.results.map(comp_resultItem.bind(this))}

					<div className="f-search-footer bg-dark color-aqua clearfix">
						<nav className="f-pagination text-right" dangerouslySetInnerHTML={{__html: this.state.pagination}}></nav>
					</div>

				</div>
				<div className="col-sm-3" id="h_parent">

					<div className="f-found-games" id="h_elem">
						<div className="f-corner"></div>
						<div className="row">
							<div className="col-sm-12 col-xs-4 text-center f-how-many">{this.__('found')} <b className="f-num-res">{this.state.count}</b> {this.__('games')}</div>
							<button onClick={this.showResultsClick} className="col-sm-12 col-xs-4 f-show">zeigen</button>
							<div onClick={this.resetFilter} className="col-sm-12 col-xs-4 f-reset-btn" href="#">zurücksetzen</div>
						</div>
					</div>

					<div id="f_bestsales" className="f-bestsales f-month-bestsales">

						<h3>{this.__('month_top')}</h3>
						<table className="f-bestsales-list">
						{this.state.tops.month_top.map((el,i)=>{
							return (
								<tr title={el.title_clean}>
									<td><img class="img50" src={'https://i.ebayimg.com/images/g/'+el['picture_hash']+'/s-l50.jpg'}/></td>
									<td className="top-title-td"><a className="clip" href={get_partner_link("https://www.ebay.de/itm/" + el.ebay_id)} target="_blank">{el.title_clean}</a></td>
									<td><span>€{el.ebay_price}</span></td>
								</tr>
							);
						})}
						</table>

						<h3>{this.__('strategie_top')}</h3>
						<table className="f-bestsales-list">
						{this.state.tops.strategie_top.map((el,i)=>{
							return (
								<tr title={el.title_clean}>
									<td><img class="img50" src={'https://i.ebayimg.com/images/g/'+el['picture_hash']+'/s-l50.jpg'}/></td>
									<td className="top-title-td"><a className="clip" href={get_partner_link("https://www.ebay.de/itm/" + el.ebay_id)} target="_blank">{el.title_clean}</a></td>
									<td><span>€{el.ebay_price}</span></td>
								</tr>
							);
						})}
						</table>

						<h3>{this.__('abenteuer_top')}</h3>
						<table className="f-bestsales-list">
						{this.state.tops.abenteuer_top.map((el,i)=>{
							return (
								<tr title={el.title_clean}>
									<td><img class="img50" src={'https://i.ebayimg.com/images/g/'+el['picture_hash']+'/s-l50.jpg'}/></td>
									<td className="top-title-td"><a className="clip" href={get_partner_link("https://www.ebay.de/itm/" + el.ebay_id)} target="_blank">{el.title_clean}</a></td>
									<td><span>€{el.ebay_price}</span></td>
								</tr>
							);
						})}
						</table>

						<h3>{this.__('rpg_top')}</h3>
						<table className="f-bestsales-list">
						{this.state.tops.rpg_top.map((el,i)=>{
							return (
								<tr title={el.title_clean}>
									<td><img class="img50" src={'https://i.ebayimg.com/images/g/'+el['picture_hash']+'/s-l50.jpg'}/></td>
									<td className="top-title-td"><a className="clip" href={get_partner_link("https://www.ebay.de/itm/" + el.ebay_id)} target="_blank">{el.title_clean}</a></td>
									<td><span>€{el.ebay_price}</span></td>
								</tr>
							);
						})}
						</table>

						<h3>{this.__('top_2015')}</h3>
						<table className="f-bestsales-list">
						{this.state.tops.top_2015.map((el,i)=>{
							return (
								<tr title={el.title_clean}>
									<td><img class="img50" src={'https://i.ebayimg.com/images/g/'+el['picture_hash']+'/s-l50.jpg'}/></td>
									<td className="top-title-td"><a className="clip" href={get_partner_link("https://www.ebay.de/itm/" + el.ebay_id)} target="_blank">{el.title_clean}</a></td>
									<td><span>€{el.ebay_price}</span></td>
								</tr>
							);
						})}
						</table>

					</div>

				</div>
			</div>
		</div>

	</div>
	);
  }
});






ReactDOM.render(React.createElement(FilterApp, null), document.getElementById('filter_app_here'));





function comp_resultItem(el,i){
	var appsub = (el.type === 'dlc') ? 'app' : el.type;
	return (
		<a onClick={this.gameClick.bind(this, el.ebay_id, el.title)} href={myajax.home_url+'/game/?type='+el.type+'&appid='+steam_to_gig(el.appid)+'&title='+el.slug} className="row f-result-item bg-dark">
			<div className="col-xs-3">
				<img className="max-w100" alt="" src={'http://parser.gig-games.de/steam-images/'+appsub+'s-'+el.appid+'/header.jpg'}/>
				<div className="f-item-rating">{this.__('item_rating')}: <span className="color-aqua">{el.o_rating}/100</span></div>
			</div>
			<div className="col-xs-9">
				<div className="row">
					<div className="f-item-title clip">{el.title}</div>
					<div className="col-sm-4 col-xs-6">
						<div className="f-namval color-aqua">{this.__('release')}:
							<div className="color-white">{el.release}</div>
						</div>
						<div className="f-namval color-aqua">{this.__('developer')}:
							<div className="color-white">{el.developer}</div>
						</div>
						<div className="f-namval color-aqua">{this.__('publisher')}:
							<div className="color-white">{el.publisher}</div>
						</div>
					</div>
					<div className="col-sm-4 col-xs-6">
						{comp_ebayPrice.call(this, el)}
						{comp_steamPrice.call(this, el)}
					</div>
					<div className="col-xs-4 hidden-xs">
						{comp_Advantage.call(this, el)}
					</div>
				</div>
			</div>
		</a>
	)
}

function comp_ebayPrice(el) {
	if(!+el.reg_price || !+el.ebay_price || el.advantage <= 0) return '';
	return (<div>
				<div className="f-prc">{this.__('item_price')}:</div>
				<div className="color-aqua f-prc-num">€{el.ebay_price}</div>
			</div>)
}

function comp_steamPrice(el) {
	if(+el.reg_price == -1) var price = this.__('unbekannt');
	else if(!+el.reg_price) var price = this.__('kostenlos');
	else var price = '€'+(+el.reg_price>+el.old_price?el.reg_price:el.old_price);
	return <div>{this.__('item_steam_price')}: {price}</div>
}

function comp_Advantage(el) {
	if(!+el.reg_price || el.advantage <= 0) return '';
	return (<div>
				<div className="f-adv">{this.__('item_advantage')}:</div>
				<div className="f-adv-num">{el.advantage}%</div>
			</div>)
}