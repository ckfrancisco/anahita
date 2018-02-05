/**
 * Author: Rastin Mehr
 * Email: rastin@anahitapolis.com
 * Copyright 2015 rmdStudio Inc. www.rmdStudio.com
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */

;(function($, window) {
    
    'use strict';
    
    $.widget('anahita.documentSetAssignment', {
    	
    	_create : function () {
    		
    		var self = this;
    		this.documentId = this.element.data('document');
    		this.url = this.element.data('url');
    		
    		//open set selector event
    		this._on('[data-action="OpenSetSelector"]', {
    			click : function ( event ) {
    				event.preventDefault();
    				self._open( event.target.href );
    			}
    		});
    		
    		//Close set selector event
			this._on(this.element, {
				'click [data-action="CloseSetSelector"]' : function ( event ) {
					event.preventDefault();
					self._close(self.url);
				}
			});
    		
			var form = this.element.find('form');
			
			
			//Event to create a set and assign the document to it
			this._on(this.element, {
				elem : form,
				submit : function ( event ) {
					
					event.preventDefault();

					$.ajax({
						'method' : 'post',
						url : $(event.target).attr('action'),
						data : $(event.target).serialize(),
						success : function ( response ) {
							self.element.find('.an-entities').prepend(response);
						}
					});
				}
			});
			
			//add document event
			this._on(this.element, {
				'click [data-action="adddocument"], [data-action="removedocument"]' : function ( event ) {
					event.preventDefault();
					this._changeAssignment($(event.currentTarget));
				}
			});
    	},
    	
    	_open : function (url) {
    		
    		var self = this;
    		
    		$.ajax({
    			method : 'get',
    			url : url + '&document_id' + this.documentId,
    			beforeSend : function () {
    				self.element.slideUp();
    			},
    			success : function (response) {
    				self.element.html(response);
    			},
    			complete : function () {
    				self.element.slideDown();
    			}
    		});
    	},
    	
    	_close : function ( url ) {
    		
    		var self = this;
    		
    		$.ajax({
    			method : 'get',
    			url : url + '&document_id=' + this.documentId,
    			beforeSend : function () {
    				self.element.slideUp();
    			},
    			success : function (response){
    				self.element.html(response);
    			},
    			complete : function () {
    				self.element.slideDown();
    			}
    		});
    	},
    	
    	_changeAssignment : function (set) {

    		var self = this;
    		var action = set.data('action');
    		
    		$.ajax({
    			method : 'post',
    			url : set.data('url'),
    			data : {
    				document_id : this.documentId,
    				action : action
    			},
    			beforeSend : function () {
    				set.fadeTo('fast', 0.7).addClass('uiActivityIndicator');
    			},
    			success : function () {
    				
    				set.fadeTo('fast', 1).removeClass('uiActivityIndicator');
    				
    				if ( action == 'adddocument' ) {
    				
    					set.data('data-action', 'removedocument');
    					set.addClass('an-highlight');
    				
    				} else {
    				
    					set.data('data-action', 'adddocument');
    					set.removeClass('an-highlight');
    				
    				}
    			}
    		});
    	}
    });
    
    $('#sets-wrapper').documentSetAssignment();
    
}(jQuery, window));  