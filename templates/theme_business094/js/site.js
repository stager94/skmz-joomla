var Site = {
	start: function(){
		Site.Modules();
		Site.Menu();
		Site.Table();
	},
	
	Modules: function(){
		var modules = $$('.cont');
		var toggles = $$('.tog');
		modules.each( function(mod, index){
			var Slide = new Fx.Slide( mod, { duration:800, wait:false, transition:Fx.Transitions.Quart.easeOut });
			var fx = new Fx.Style( mod, 'opacity', { duration:800, wait:false });
			
			toggles[index].addEvent('click', function(e){
				e = new Event(e).stop();
				Slide.toggle();
				if( Slide.wrapper.offsetHeight == 0 ){
					fx.start(0, 1);	
				}
				else{
					fx.start(0, 1);
				}
			});
		});
	},
	
	Menu: function(){
		var entries = $$('.moduletable_menu li a');
		entries.each( function(el){
			var fx = new Fx.Styles( el, { duration:300, wait:false });
			
			el.addEvent('mouseenter', function(){
				fx.start({
				});
			});
			el.addEvent( 'mouseleave', function(){
				fx.start({

				});
			});
		});
	},
	
	Table: function(){
		var rows1 = $$('.sectiontableentry1');
		rows1.each( function( row1 ){
			var fx = new Fx.Styles( row1, { duration:300, wait:false } );
			row1.addEvent( 'mouseenter', function(){
				fx.start({
			
				});
			});
			row1.addEvent( 'mouseleave', function(){
				fx.start({
					
				});
			});
		});
		
		var rows2 = $$('.sectiontableentry2');
		rows2.each( function( row2 ){
			var fx2 = new Fx.Styles( row2, { duration:300, wait:false } );
			row2.addEvent( 'mouseenter', function(){
				fx2.start({
					
				});
			});
			row2.addEvent( 'mouseleave', function(){
				fx2.start({
				
				});
			});
		});
	}
}
window.addEvent('domready', Site.start );