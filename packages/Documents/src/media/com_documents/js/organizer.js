/**
 * Author: Rastin Mehr
 * Email: rastin@anahitapolis.com
 * Copyright 2015 rmdStudio Inc. www.rmdStudio.com
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */

;(function($, window) {
    
    'use strict';
    
    $.widget('anahita.setOrganizer', {
    
    	options : {
    	
    		selector : '#document-selector-list',
    		url : $('#set-documents').data('url'),
    		documents : $('#set-documents').find('.media-grid'),
    		thumbnail : '.thumbnail-wrapper',
    		cover : '#set-cover-wrapper',
    		form : '#set-form'
    	},
    	
    	_create : function () {
    		
    		var self = this;
    		
    		this.element.hide();
    		this.selector = null;
    		this.documentList = null;
    		
    		//open organizer
    		this._on('body', {
    			'click a[data-trigger="Organize"]' : function ( event ) {
    				event.preventDefault();
    				self.open( event.currentTarget.href );
    			}
    		});
    		
    		//close organizer 
    		this._on( this.element, {
    			'click a[data-trigger="CloseDocumentSelector"]' : function ( event ) {
    				event.preventDefault();
    				self.close();
    			}
    		});
    		
    		//before add set
    		this._on( this.options.form, {
    			'submit' : function ( event ) {
    				this._beforeAdd();
    			}
    		});
    	},
    	
    	open : function ( url ) {
    		
    		var self = this;
    		
    		$.get( url , function( response ){
    			
				self.element.html(response).slideDown();
				
    			self.selector = $(self.options.selector).sortable({
    				connectWith : $(self.options.documents),
    				scroll: false
    			});
    			
    			self.documentList = $(self.options.documents).sortable({
    				connectWith : $(self.options.selector),
    				cancel : '.cover',
    				update : function () {
    					if(self.options.url) {
    						self._edit();
    					}
    				}
    			});
    			
    			self.documentList.parent().addClass('an-highlight');
    		});
    	},
    	
    	close : function () {
    		
    		var self = this;
    		
    		this.element.slideUp('normal', function(){
				
    			self.selector.sortable('destroy');
				self.documentList.sortable('destroy');
				self.documentList.parent().removeClass('an-highlight');
				self.element.empty();
				
    		});
    	},
    	
    	_beforeAdd : function () {
    		
    		var self = this;
    		var hasDocuments = false;
			var thumbnails = self.documentList.find( self.options.thumbnail );

			if ( thumbnails.length == 0 ) {
				event.preventDefault();
			}
				
			$.each( thumbnails, function ( index, thumbnail ) {
				$(self.options.form).append('<input type="hidden" name="document_id[]" value=' + $(thumbnail).attr('document') + ' />');
			});
    	},
    	
    	_edit : function () {
    		
    		var self = this;
    		var thumbnails = this.documentList.find( this.options.thumbnail );
    		var data = 'action=updatedocuments';
    		
    		$.each( thumbnails, function ( index, thumbnail ) {
    			data += '&document_id[]=' + $(thumbnail).attr('document');
    		});
    		
    		$.ajax({
    			method : 'post',
    			url : this.options.url,
    			data : data,
    			success : function() {
    				
    				var thumbnails = $(self.options.documents).find(self.options.thumbnail);
    				
    				thumbnails.removeClass('cover');
    				thumbnails.first().addClass('cover');
    				
    				self._refreshCover();
    			}
    		});
    	},
    	
    	_refreshCover : function () {
    		
    		var self = this;

    		$.ajax({
    			method : 'get',
    			url : this.options.url,
    			data : 'layout=cover',
    			success : function ( response ) {
    				$(self.options.cover).html(response);
    			}
    		});
    	}
    });
    
    $('#document-selector').setOrganizer();
    
}(jQuery, window));  